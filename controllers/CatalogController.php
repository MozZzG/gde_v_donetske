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

class CatalogController extends Controller
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

    public function actionCatalog($id) {
        $subcategory = Subcategory::find()->where(['ID' => $id])->one();
        $more = false;

        if (Yii::$app->request->isAjax) {
            parse_str(Yii::$app->request->queryString);
            $establishments = Establishment::find()->where([
                'SubcategoryID' => $id,
                'Top' => false,
                'New' => 0,
            ])->orderBy(['Rating' => SORT_DESC])->limit(8)->offset($k)->all();
            return $this->renderPartial('_catalog', [
                'subcategory' => $subcategory,
                'establishments' => $establishments,
            ]);
        }

        $establishments = Establishment::find()->where([
            'SubcategoryID' => $id,
            'Top' => false,
            'New' => 0,
        ])->orderBy(['Rating' => SORT_DESC])->limit(8)->all();
        if (Establishment::find()->where([
                'SubcategoryID' => $id,
                'Top' => false,
                'New' => 0,
            ])->count() > 8) {
            $more = true;
        }
        $establishments_top = Establishment::find()->where([
            'SubcategoryID' => $id,
            'Top' => true,
            'New' => 0,
        ])->orderBy(['Rating' => SORT_DESC])->all();

        $news = Newspartner::find()
            ->orderBy(['Date' => SORT_DESC])
            ->limit(6)
            ->all();

        return $this->render('catalog', [
            'subcategory' => $subcategory,
            'establishments' => $establishments,
            'establishments_top' => $establishments_top,
            'more' => $more,
            'news' => $news,
        ]);
    }

    public function actionCatalogshowmore($id, $k) {
        $more = false;
        if (Establishment::find()->where([
                'SubcategoryID' => $id,
                'Top' => false,
                'New' => 0,
            ])->count() > $k+8) {
            $more = true;
        }
        return $more;
    }

    public function actionEstablishment($id) {
        $est = Establishment::find()->where(['ID' => $id])->one();
        $est->updateCounters(['Views' => 1]);
        $est->save();
        $place = 0;
        $all = Establishment::find()->where(['SubcategoryID' => $est->SubcategoryID, 'New' => 0])->orderBy(['Rating' => SORT_DESC])->all();
        foreach ($all as $item) {
            $place++;
            if ($est->ID == $item->ID) break;
        }
        $recommend = Establishment::find()
            ->where(['SubcategoryID' => $est->SubcategoryID, 'New' => 0])
            ->andWhere('NOT ID='.$id)
            ->orderBy(['Rating' => SORT_DESC])
            ->limit(4)
            ->all();
        $query_news = Newspartner::find()->where(['EstablishmentID' => $est->ID]);
        $pages_news = new Pagination(['totalCount' => $query_news->count(), 'pageSize' => 5]);
        $news = $query_news->offset($pages_news->offset)->limit($pages_news->limit)->all();
        $query_events = Event::find()->where(['EstablishmentID' => $est->ID, 'New' => 0]);
        $pages_events = new Pagination(['totalCount' => $query_events->count(), 'pageSize' => 5]);
        $events = $query_events->offset($pages_events->offset)->limit($pages_events->limit)->all();

        return $this->render('establishment', [
            'est' => $est,
            'news' => $news,
            'pages_news' => $pages_news,
            'recommend' => $recommend,
            'events' => $events,
            'pages_events' => $pages_events,
            'place' => $place,
        ]);
    }




}
