<?php

namespace app\controllers;

use app\models\Eventtest;
use app\models\LoginbusinessmanForm;
use app\models\SignupbusinessmanForm;
use app\models\SignupForm;
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
use app\models\Users;
use yii\helpers\ArrayHelper;
use app\models\Establishmenttest;
use yii\widgets\ActiveForm;

class SiteController extends Controller
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

    public function actionIndex()
    {
        $news_partner1 = Newspartner::find()
            ->orderBy(['Date' => SORT_DESC])
            ->limit(5)
            ->all();
        $news_partner2 = Newspartner::find()
            ->orderBy(['Date' => SORT_DESC])
            ->limit(5)
            ->offset(5)
            ->all();
        $news = News::find()
            ->orderBy(['Date' => SORT_DESC])
            ->limit(10)
            ->all();
        $establishments = Establishment::find()
            ->where(['IndexTop' => true])
            ->andWhere(['New' => 0])
            ->orderBy(['Rating' => SORT_DESC])
            ->limit(2)
            ->all();
        $cinemas = Event::find()
            ->where(['IndexTop' => 1])
            ->andWhere(['CategoryeventID' => 3, 'New' => 0])
            ->limit(2)
            ->all();
        $theatres = Event::find()
            ->where(['IndexTop' => 1])
            ->andWhere(['CategoryeventID' => 4, 'New' => 0])
            ->limit(2)
            ->all();
        $parties = Event::find()
            ->where(['IndexTop' => 1, 'New' => 0])
            ->andWhere(['not', ['CategoryeventID' => 3]])
            ->andWhere(['not', ['CategoryeventID' => 4]])
            ->limit(2)
            ->all();


        $db_forum = new Connection([
            'dsn' => 'mysql:host=localhost;dbname=forum',
            'username' => 'root',
            'password' => 'avram007700',
            'charset' => 'utf8',
        ]);
        $posts = $db_forum->createCommand('SELECT questions.ID, Caption, DateTime, categories.Name AS Cat, users.Name, LastName, Avatar FROM questions, categories, users WHERE questions.UserID=users.ID AND questions.CategoryID=categories.ID ORDER BY DateTime DESC LIMIT 14')
            ->queryAll();
        $dates = [];
        foreach ($posts as $p) {
            $dates[$p['ID']] = $this->CalculateDate($p['DateTime']);
        }


        return $this->render('index', [
            'establishments' => $establishments,
            'news' => $news,
            'news_partner1' => $news_partner1,
            'news_partner2' => $news_partner2,
            'posts' => $posts,
            'dates' => $dates,
            'cinemas' => $cinemas,
            'theatres' => $theatres,
            'parties' => $parties,
        ]);
    }

    public function actionLogin()
    {
        if (!\Yii::$app->user->isGuest) {
            return $this->goHome();
        }

        $model = new LoginForm();
        $model_login_bus = new LoginbusinessmanForm();
        $model_reg = new SignupForm();
        $model_bus = new SignupbusinessmanForm();
        $cat = Category::find()->all();
        $cats = ArrayHelper::map($cat, 'ID', 'Name');
        if ($model->load(Yii::$app->request->post()) && $model->login()) {
            return $this->goHome();
        }
        return $this->render('login', [
            'model' => $model,
            'model_reg' => $model_reg,
            'model_bus' => $model_bus,
            'model_login_bus' => $model_login_bus,
            'cats' => $cats,
            'subcats' => ['' => ''],
        ]);
    }

    public function actionLoginbus()
    {
        if (!\Yii::$app->user->isGuest) {
            return $this->goHome();
        }

        $model = new LoginForm();
        $model_login_bus = new LoginbusinessmanForm();
        $model_reg = new SignupForm();
        $model_bus = new SignupbusinessmanForm();
        $cat = Category::find()->all();
        $cats = ArrayHelper::map($cat, 'ID', 'Name');
        if ($model_login_bus->load(Yii::$app->request->post()) && $model_login_bus->login()) {
            return $this->redirect('office');
        }
        return $this->render('login', [
            'model' => $model,
            'model_reg' => $model_reg,
            'model_bus' => $model_bus,
            'model_login_bus' => $model_login_bus,
            'cats' => $cats,
            'subcats' => ['' => ''],
        ]);
    }

    public function actionGetsubcat($id) {
        $sub = Subcategory::find()->where(['CategoryID' => $id])->all();
        $res = '';
        foreach ($sub as $s) {
            $res .= '<option value="'.$s->ID.'">'.$s->Name.'</option>';
        }
        return $res;
    }

    public function actionSignup() {
        if (!\Yii::$app->user->isGuest) {
            return $this->goHome();
        }

        $model = new LoginForm();
        $model_reg = new SignupForm();
        $model_login_bus = new LoginbusinessmanForm();
        $model_bus = new SignupbusinessmanForm();
        $cat = Category::find()->all();
        $cats = ArrayHelper::map($cat, 'ID', 'Name');
        if ($model_reg->load(Yii::$app->request->post()) && $model_reg->signup()) {
            $us = Users::find()->where(['Email' => $model_reg->email])->one();
            //mail($us->Email, 'Подтверждение регистрации | Информационный портал где в Донецке?', 'Для завершения регистрации перейдите по ссылке: http://gdevdonetske.com/confirm?id='.$us->ID);
            return $this->actionSignupaccess();
        }
        return $this->render('login', [
            'model' => $model,
            'model_reg' => $model_reg,
            'model_bus' => $model_bus,
            'model_login_bus' => $model_login_bus,
            'cats' => $cats,
            'subcats' => ['' => ''],
        ]);
    }

    public function actionSignupbusinessman() {
        /*if (!\Yii::$app->user->isGuest) {
            return $this->redirect(Url::to('office'));
        }

        $model = new LoginForm();
        $model_login_bus = new LoginbusinessmanForm();
        $model_reg = new SignupForm();*/
        $model_bus = new SignupbusinessmanForm();
        $cat = Category::find()->all();
        $cats = ArrayHelper::map($cat, 'ID', 'Name');
        if ($model_bus->load(Yii::$app->request->post()) && $model_bus->signup()) {
            return null;
        }
        $subcats = Subcategory::find()->where(['CategoryID' => $model_bus->category])->all();
        $subcat = ArrayHelper::map($subcats, 'ID', 'Name');
        return $this->renderPartial('reg_bus_access', [
            'model_bus' => $model_bus,
            'cats' => $cats,
            'subcats' => $subcat,
        ]);
    }

    public function actionConfirm($id) {
        $us = Users::find()->where(['ID' => $id])->one();
        $us->Confirmed = 1;
        $us->save();

        $model = new LoginForm();
        $model_login_bus = new LoginbusinessmanForm();
        $model_reg = new SignupForm();
        $model_bus = new SignupbusinessmanForm();
        $cat = Category::find()->all();
        $cats = ArrayHelper::map($cat, 'ID', 'Name');

        return $this->render('confirm_access', [
            'model' => $model,
            'model_login_bus' => $model_login_bus,
            'model_reg' => $model_reg,
            'model_bus' => $model_bus,
            'cats' => $cats,
            'subcats' => ['' => ''],
        ]);
    }

    public function actionSignupaccess() {
        $model = new LoginForm();
        $model_login_bus = new LoginbusinessmanForm();
        $model_reg = new SignupForm();
        $model_bus = new SignupbusinessmanForm();
        $cat = Category::find()->all();
        $cats = ArrayHelper::map($cat, 'ID', 'Name');

        return $this->render('reg_access', [
            'model' => $model,
            'model_login_bus' => $model_login_bus,
            'model_reg' => $model_reg,
            'model_bus' => $model_bus,
            'cats' => $cats,
            'subcats' => ['' => ''],
        ]);
    }

    public function actionLoginsoc()
    {
        $s = file_get_contents('http://ulogin.ru/token.php?token=' . $_POST['token'] . '&host=' . $_SERVER['HTTP_HOST']);
        $user = json_decode($s, true);
        $user_our = Users::find()->where(['Social' => $user['network'].$user['uid']])->one();
        if ($user_our) {
            Yii::$app->user->login($user_our);
            return $this->goHome();
        }
        else {
            $av = rand(1, 10);
            $model = new Users();
            $model->Name = $user['first_name'];
            $model->LastName = $user['last_name'];
            $model->Avatar = 'avatar/default/'.$av.'.jpg';
            $model->Social = $user['network'].$user['uid'];
            $model->Email = '';
            $model->Password = '';
            $model->Confirmed = 1;
            $model->Questions = 0;
            $model->Answers = 0;
            $model->Ban = 0;
            $model->NewID = 0;
            $model->Phone = '';
            $model->Businessman = 0;
            if ($model->save()) Yii::$app->user->login($model);
            return $this->goHome();
        }
    }

    public function actionLogout()
    {
        Yii::$app->user->logout();

        return $this->goHome();
    }







    private function CalculateDate($timestamp) {
        $arDate = date_parse($timestamp);
        $timestamp2 = intval(time());
        $timestampl = mktime( // отдаем в timestamp
            $arDate['hour'], // час
            $arDate['minute'], // минута
            $arDate['second'], // секунда
            $arDate['month'], // месяц
            $arDate['day'], // день
            $arDate['year'] // год
        );
        if ($timestampl && $timestamp2)  {
            $time_lapse = $timestamp2 - $timestampl;

            $minutes = floor($time_lapse/60);
            $text = '';
            if ($minutes > 59) {
                $hours = floor($minutes/60);
                if ($hours > 23) {
                    $days = floor($hours/24);
                    if ($days > 6) {
                        $weeks = floor($days/7);
                        if ($weeks > 3) {
                            $months = floor($weeks/4);
                            if ($months > 11) {
                                $years = floor($months/12);
                                switch ($years) {
                                    case 1: case 21:
                                {$text = 'год';
                                    break;}
                                    case 2: case 3: case 4:
                                    case 22: case 23: case 24:
                                {$text = 'года';
                                    break;}
                                    default:
                                    {$text = 'лет';
                                        break;}
                                }
                                $result = $years.' '.$text;
                            }
                            else {
                                switch ($months) {
                                    case 1:
                                    {$text = 'месяц';
                                        break;}
                                    case 2: case 3: case 4:
                                {$text = 'месяца';
                                    break;}
                                    default:
                                    {$text = 'месяцев';
                                        break;}
                                }
                                $result = $months.' '.$text;
                            }
                        }
                        else {
                            switch ($weeks) {
                                case 1:
                                {$text = 'неделю';
                                    break;}
                                default:
                                {$text = 'недели';
                                    break;}
                            }
                            $result = $weeks.' '.$text;
                        }
                    }
                    else {
                        switch ($days) {
                            case 1:
                            {$text = 'день';
                                break;}
                            case 2: case 3: case 4:
                        {$text = 'дня';
                            break;}

                            default:
                            {$text = 'дней';
                                break;}
                        }
                        $result = $days.' '.$text;
                    }
                }
                else {
                    switch ($hours) {
                        case 1: case 21:
                    {$text = 'час';
                        break;}
                        case 2: case 3: case 4: case 22: case 23:
                    {$text = 'часа';
                        break;}

                        default:
                        {$text = 'часов';
                            break;}
                    }
                    $result = $hours.' '.$text;
                }
            }
            else if ($minutes) {
                switch ($minutes) {
                    case 1:	case 21: case 31: case 41: case 51:
                {$text = 'минуту';
                    break;}
                    case 2: case 3: case 4: case 22: case 23: case 24:
                    case 32: case 33: case 34: case 42: case 43: case 44:
                    case 52: case 53: case 54:
                {$text = 'минуты';
                    break;}
                    default:
                    {$text = 'минут';
                        break;}
                }
                $result = $minutes.' '.$text;
            }
            else {
                $result = 'несколько секунд';
            }
            return $result;
        }
        return false;
    }
}
