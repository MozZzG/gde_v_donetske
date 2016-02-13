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
use app\models\Establishmenttest;
use app\models\Users;
use app\models\Eventtest;

class ManagerController extends Controller
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

    public function actionEstablishmenttest($id) {
        $est = Establishmenttest::find()->where(['ID' => $id])->one();
        $user = Users::find()->where(['ID' => $est->UserID])->one();
        $user_mail = $user->Email;
        /*$query_news = Newspartner::find()->where(['EstablishmentID' => $est->ID]);
        $pages_news = new Pagination(['totalCount' => $query_news->count(), 'pageSize' => 5]);
        $news = $query_news->offset($pages_news->offset)->limit($pages_news->limit)->all();
        */$query_events = Event::find()->where(['EstablishmentID' => $est->ID, 'New' => 0]);
        $pages_events = new Pagination(['totalCount' => $query_events->count(), 'pageSize' => 5]);
        $events = $query_events->offset($pages_events->offset)->limit($pages_events->limit)->all();

        return $this->render('establishment_test', [
            'est' => $est,
            'user_mail' => $user_mail,
            /*'news' => $news,
            'pages_news' => $pages_news,
            'recommend' => $recommend,*/
            'events' => $events,
            'pages_events' => $pages_events,
        ]);
    }

    public function actionEventtest($id) {
        $ev = Eventtest::find()->where(['ID' => $id])->one();
        $user = Users::find()->where(['ID' => $ev->establishment->UserID])->one();
        $user_mail = $user->Email;
        $subcat = Subcategoryevent::find()->where(['CategoryeventID' => $ev->categoryevent->ID])->one();
        if ($subcat) $subcat = $subcat->Name;
        else $subcat = '';
        return $this->render('event_test', [
            'model' => $ev,
            'user_mail' => $user_mail,
            'subcat' => $subcat,
        ]);
    }

    public function actionAddevent($id) {
        $test = Eventtest::find()->where(['ID' => $id])->one();
        $event = Event::find()->where(['ID' => $test->EventID])->one();
        $event->Photo = $test->Photo;
        $event->Date = $test->Date;
        $event->Name = $test->Name;
        $event->Place = $test->Place;
        $event->Time = $test->Time;
        $event->Contacts = $test->Contacts;
        $event->CategoryeventID = $test->CategoryeventID;
        $event->SubcategoryeventID = $test->SubcategoryeventID;
        $event->EstablishmentID = $test->EstablishmentID;
        $event->New = 0;
        if ($event->save()) {
            $test->delete();
            $user = Users::find()->where(['ID' => $event->establishment->UserID])->one();
            //mail($user->Email, $event->Name.' прошло проверку', 'Ваша афиша "'.$event->Name.'" была опубликована на сайте "Где в Донецке..?": http://gdevdonetske.com/establishment?id='.$event->EstablishmentID.' Благодарим за сотрудничество!');
            $this->redirect(Url::to(['establishment', 'id' => $event->EstablishmentID]));
        }
    }

    public function actionAddest($id) {
        $test = Establishmenttest::find()->where(['ID' => $id])->one();
        $est = Establishment::find()->where(['ID' => $test->EstablishmentID])->one();
        $est->Name = $test->Name;
        $est->About = $test->About;
        $est->Text = $test->Text;
        $est->Field1Name = $test->Field1Name;
        $est->Field1Value = $test->Field1Value;
        $est->Field2Name = $test->Field2Name;
        $est->Field2Value = $test->Field2Value;
        $est->Worktime = $test->Worktime;
        $est->Phone = $test->Phone;
        $est->Address = $test->Address;
        $est->Website = $test->Website;
        $est->Video = $test->Video;
        $est->Map = $test->Map;
        $est->Photo1 = $test->Photo1;
        $est->Photo2 = $test->Photo2;
        $est->Photo3 = $test->Photo3;
        $est->Photo4 = $test->Photo4;
        $est->Photo5 = $test->Photo5;
        $est->Photo6 = $test->Photo6;
        $est->Photo7 = $test->Photo7;
        $est->Photo8 = $test->Photo8;
        $est->Photo9 = $test->Photo9;
        $est->Photo10 = $test->Photo10;
        $est->New = 0;
        if ($est->save()) {
            $test->delete();
            $user = Users::find()->where(['ID' => $est->UserID])->one();
            //mail($user->Email, $est->Name.' прошло проверку', 'Ваше заведение "'.$est->Name.'" было опубликовано на сайте "Где в Донецке..?": http://gdevdonetske.com/establishment?id='.$est->ID.' Благодарим за сотрудничество!');
            $this->redirect(Url::to(['establishment', 'id' => $est->ID]));

        }
    }




}
