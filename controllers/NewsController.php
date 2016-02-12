<?php

namespace app\controllers;

use Yii;
use yii\base\Response;
use yii\base\View;
use yii\filters\AccessControl;
use yii\helpers\Url;
use yii\web\Controller;
use yii\filters\VerbFilter;
use app\models\LoginForm;
use app\models\Category;
use app\models\Subcategory;
use app\models\Establishment;
use app\models\News;
use yii\data\Pagination;
use app\models\Categorynews;
use app\models\Newspartner;
use yii\db\Connection;
use app\models\Event;
use yii\data\ActiveDataProvider;
use app\models\Categoryevent;
use app\models\Subcategoryevent;
use yii\helpers\ArrayHelper;
use yii\widgets\ActiveForm;

class NewsController extends Controller
{
    public $enableCsrfValidation = false;

    public function behaviors()
    {
        return [
            /*'access' => [
                'class' => AccessControl::className(),
                'only' => ['logout'],
                'rules' => [
                    [
                        'actions' => ['logout'],
                        'allow' => true,
                        'roles' => ['@'],
                    ],
                ],
            ],
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'logout' => ['post'],
                ],
            ],*/
        ];
    }

    public function actions()
    {
        return [
            'error' => [
                'class' => 'yii\web\ErrorAction',
            ],
            'captcha' => [
                'class' => 'yii\captcha\CaptchaAction',
                'fixedVerifyCode' => YII_ENV_TEST ? 'testme' : null,
            ],
        ];
    }


    public function actionNews() {
        $cat = 0;
        $partner = false;
        parse_str(Yii::$app->request->queryString);
        $query = News::find();
        if ($cat != 0) {
            $query = $query->where(['CategorynewsID' => $cat]);
        }
        $pages = new Pagination(['totalCount' => $query->count(), 'pageSize' => 9]);
        $news = $query->offset($pages->offset)->limit($pages->limit)->all();
        $category = Categorynews::find()->all();
        return $this->render('news', [
            'news' => $news,
            'pages' => $pages,
            'cat' => $cat,
            'category' => $category,
            'partner' => $partner,
        ]);
    }

    public function actionNewspartner() {
        $query = Newspartner::find();
        $pages = new Pagination(['totalCount' => $query->count(), 'pageSize' => 9]);
        $news = $query->offset($pages->offset)->limit($pages->limit)->all();
        $partner = true;
        return $this->render('news', [
            'news' => $news,
            'pages' => $pages,
            'partner' => $partner,
        ]);
    }

    public function actionNewsitem($id, $partner) {
        $p = false;
        if ($partner == 'true') {
            $model = Newspartner::find()->where(['ID' => $id])->one();
            $model->updateCounters(['Views' => 1]);
            $model->save();
            $pop = Newspartner::find()->orderBy(['Views' => SORT_DESC])->limit(4)->all();
            $p = true;
        }
        else {
            $model = News::find()->where(['ID' => $id])->one();
            $model->updateCounters(['Views' => 1]);
            $model->save();
            $pop = News::find()->orderBy(['Views' => SORT_DESC])->limit(4)->all();
        }
        return $this->render('news_item', [
            'model' => $model,
            'pop' => $pop,
            'partner' => $p,
        ]);
    }

}
