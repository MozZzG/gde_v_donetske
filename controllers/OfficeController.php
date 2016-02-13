<?php

namespace app\controllers;

use app\models\EsttestForm;
use app\models\EventtestForm;
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

class OfficeController extends Controller
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


    public function actionOffice() {
        if (!\Yii::$app->user->isGuest) {
            $est = Establishment::find()->where(['UserID' => Yii::$app->user->ID])->one();
            $model = new EsttestForm();
            $model->Name = $est->Name;
            $model->About = $est->About;
            $model->Text = $est->Text;
            $model->Field1Name = $est->Field1Name;
            $model->Field1Value = $est->Field1Value;
            $model->Field2Name = $est->Field2Name;
            $model->Field2Value = $est->Field2Value;
            $model->Worktime = $est->Worktime;
            $model->Phone = $est->Phone;
            $model->Address = $est->Address;
            $model->Website = $est->Website;
            $model->Video = $est->Video;
            $model->Map = $est->Map;
            $model->Photo1 = $est->Photo1;
            $model->Photo2 = $est->Photo2;
            $model->Photo3 = $est->Photo3;
            $model->Photo4 = $est->Photo4;
            $model->Photo5 = $est->Photo5;
            $model->Photo6 = $est->Photo6;
            $model->Photo7 = $est->Photo7;
            $model->Photo8 = $est->Photo8;
            $model->Photo9 = $est->Photo9;
            $model->Photo10 = $est->Photo10;

            $query_events = Event::find()->where(['EstablishmentID' => $est->ID, 'New' => 0]);
            $pages_events = new Pagination(['totalCount' => $query_events->count()+1, 'pageSize' => 5]);
            $events = $query_events->offset($pages_events->offset)->limit($pages_events->limit)->all();

            $query_news = Newspartner::find()->where(['EstablishmentID' => $est->ID]);
            $pages_news = new Pagination(['totalCount' => $query_news->count()+1, 'pageSize' => 5]);
            $news = $query_news->offset($pages_news->offset)->limit($pages_news->limit)->all();

            if ($model->load(Yii::$app->request->post()) && $model->Sendtoadmins($est->ID, $est->SubcategoryID)) {
                return $this->render('office_sended_est');
            }

            return $this->render('office', [
                'est' => $est,
                'model' => $model,
                'events' => $events,
                'pages_events' => $pages_events,
                'news' => $news,
                'pages_news' => $pages_news,
            ]);
        }
    }

    public function actionAddnews($phone, $est) {
        $est = Establishment::find()->where(['ID' => $est])->one();
        //mail('komarovats93@gmail.com', 'Заказ новости', 'Владелец заведения "'.$est->Name.'" хочет заказать новость. Свяжитесь с ним по телефону: '.$phone);
        return true;
    }

    public function actionAddestimg() {
        $est = Yii::$app->request->post('est_id');
        $num = Yii::$app->request->post('photo_num');
        $ext = substr(basename($_FILES['photo']['name']), strrpos(basename($_FILES['photo']['name']), '.'));
        $name = $est.'_'.$num.$ext;
        $success = move_uploaded_file($_FILES['photo']['tmp_name'], 'img/establishments/'.$name);
        echo $name;
    }

    public function actionDelestimg($photo) {
        return unlink('img/establishments/'.$photo);
    }

    public function actionEventedit($event, $est) {
        $model = new EventtestForm();
        $est = Establishment::find()->where(['ID' => $est])->one();
        $cat = Categoryevent::find()->all();
        $cats = ArrayHelper::map($cat, 'ID', 'Name');
        if ($event) {
            $ev = Event::find()->where(['ID' => $event])->one();
            $model->Photo = $ev->Photo;
            $model->Name = $ev->Name;
            $model->Date = $ev->Date;
            $model->Place = $ev->Place;
            $model->Time = $ev->Time;
            $model->Contacts = $ev->Contacts;
            $model->CategoryeventID = $ev->CategoryeventID;
            $model->SubcategoryeventID = $ev->SubcategoryeventID;
            $model->EstablishmentID = $ev->EstablishmentID;
            $model->EventID = $ev->ID;
        }
        else {
            $ev = new Event();
            $ev->EstablishmentID = $est->ID;
            $ev->New = 1;
            $ev->save();
            $event = $ev->ID;
        }
        return $this->renderPartial('event_form', [
            'model' => $model,
            'est' => $est,
            'cats' => $cats,
            'event' => $event,
            'subcats' => ['' => ''],
        ]);
    }

    public function actionTestevent($est) {
        $model = new EventtestForm();
        $est = Establishment::find()->where(['ID' => $est])->one();
        $cat = Categoryevent::find()->all();
        $cats = ArrayHelper::map($cat, 'ID', 'Name');
        if ($model->load(Yii::$app->request->post()) && $model->Sendtoadmins()) {
            return null;
        }
        $subcats = Subcategoryevent::find()->where(['CategoryeventID' => $model->CategoryeventID])->all();
        $event = $model->EventID;
        return $this->renderPartial('event_form', [
            'model' => $model,
            'est' => $est,
            'cats' => $cats,
            'subcats' => $subcats,
            'event' => $event,
        ]);
    }

    public function actionAddimgevent() {
        $ev = Yii::$app->request->post('event_id');
        $ext = substr(basename($_FILES['photo_event']['name']), strrpos(basename($_FILES['photo_event']['name']), '.'));
        $name = $ev.$ext;
        $success = move_uploaded_file($_FILES['photo_event']['tmp_name'], 'img/events/'.$name);
        echo $name;
    }

    public function actionDelimgevent($photo) {
        return unlink('img/events/'.$photo);
    }

    public function actionGeteventsubs($cat) {
        $cats = Subcategoryevent::find()->where(['CategoryeventID' => $cat])->all();
        $res = '<option value="">подкатегория</option>';
        foreach ($cats as $c) {
            $res .= '<option value="'.$c->ID.'">'.$c->Name.'</option>';
        }
        return $res;
    }

}
