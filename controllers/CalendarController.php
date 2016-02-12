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

class CalendarController extends Controller
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

    public function actionCalendar() {
        $open_cat = false;
        $open_sub = false;
        $cat = null;
        $subcat = null;
        if (Yii::$app->request->isAjax) {
            parse_str(Yii::$app->request->queryString);
            if ($cat != null) {
                $c = Categoryevent::find()->where(['ID' => $cat])->one();
                $cats = Subcategoryevent::find()->where(['CategoryeventID' => $cat])->all();
                $query = Event::find()->where(['CategoryeventID' => $cat, 'New' => 0]);
                $dataProvider = new ActiveDataProvider([
                    'query' => $query,
                    'pagination' => ['pageSize' => 30],
                ]);
                $open_cat = true;
                return $this->renderPartial('calendar', [
                    'dataProvider' => $dataProvider,
                    'cats' => $cats,
                    'open_cat' => $open_cat,
                    'open_sub' => $open_sub,
                    'c' => $c,
                ]);
            }
            else if ($subcat != null) {
                $s = Subcategoryevent::find()->where(['ID' => $subcat])->one();
                $c = Categoryevent::find()->where(['ID' => $s->CategoryeventID])->one();
                $cats = Subcategoryevent::find()->where(['CategoryeventID' => $c->ID])->all();
                $query = Event::find()->where(['SubcategoryeventID' => $s->ID, 'New' => 0]);
                $dataProvider = new ActiveDataProvider([
                    'query' => $query,
                    'pagination' => ['pageSize' => 30],
                ]);
                $open_cat = true;
                $open_sub = true;
                return $this->renderPartial('calendar', [
                    'dataProvider' => $dataProvider,
                    'open_cat' => $open_cat,
                    'open_sub' => $open_sub,
                    'cats' => $cats,
                    'c' => $c,
                    's' => $s,
                ]);
            }

            $query = Event::find()->where(['New' => 0]);
            $dataProvider = new ActiveDataProvider([
                'query' => $query,
                'pagination' => ['pageSize' => 30]
            ]);

            $cats = Categoryevent::find()->all();

            return $this->renderPartial('calendar', [
                'dataProvider' => $dataProvider,
                'cats' => $cats,
                'open_cat' => $open_cat,
                'open_sub' => $open_sub,
            ]);
        }

        $query = Event::find()->where(['New' => 0]);
        $dataProvider = new ActiveDataProvider([
            'query' => $query,
            'pagination' => ['pageSize' => 30]
        ]);

        $cats = Categoryevent::find()->all();

        return $this->render('calendar', [
            'dataProvider' => $dataProvider,
            'cats' => $cats,
            'open_cat' => $open_cat,
            'open_sub' => $open_sub,
        ]);
    }

    public function actionCalendarday($items) {
        $items = explode('-', $items);
        $events = Event::find()->where(['New' => 0]);
        foreach ($items as $item) {
            $events->orWhere(['ID' => $item]);
        }
        $events->all();
        $cats = Categoryevent::find()->all();
        return $this->render('calendarday', [
            'events' => $events,
            'cats' => $cats,
        ]);
    }




}
