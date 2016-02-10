<?php

namespace app\controllers;

use app\models\EsttestForm;
use app\models\EventtestForm;
use app\models\SignupbusinessmanForm;
use app\models\SignupForm;
use Yii;
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
            ->where(['IndexTop' => true,])
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
            'password' => '',
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
        $model_reg = new SignupForm();
        $model_bus = new SignupbusinessmanForm();
        $cat = Category::find()->all();
        $cats = ArrayHelper::map($cat, 'ID', 'Name');
        if ($model->load(Yii::$app->request->post()) && $model->login()) {
            return $this->goBack();
        }
        return $this->render('login', [
            'model' => $model,
            'model_reg' => $model_reg,
            'model_bus' => $model_bus,
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
        $model_bus = new SignupbusinessmanForm();
        $cat = Category::find()->all();
        $cats = ArrayHelper::map($cat, 'ID', 'Name');
        if ($model_reg->load(Yii::$app->request->post()) && $model_reg->signup()) {
            $us = Users::find()->where(['Email' => $model_reg->email])->one();
            mail($us->Email, 'Подтверждение регистрации | Информационный портал где в Донецке?', 'Для завершения регистрации перейдите по ссылке: http://gdevdonetske.com/new_site/confirm?id='.$us->ID);
            return $this->actionSignupaccess();
        }
        return $this->render('login', [
            'model' => $model,
            'model_reg' => $model_reg,
            'model_bus' => $model_bus,
            'cats' => $cats,
            'subcats' => ['' => ''],
        ]);
    }

    public function actionSignupbusinessman() {
        if (!\Yii::$app->user->isGuest) {
            return $this->redirect(Url::to('office'));
        }

        $model = new LoginForm();
        $model_reg = new SignupForm();
        $model_bus = new SignupbusinessmanForm();
        $cat = Category::find()->all();
        $cats = ArrayHelper::map($cat, 'ID', 'Name');
        if ($model_bus->load(Yii::$app->request->post()) && $model_bus->signup()) {
            return $this->redirect(Url::to('office'));
        }
        return $this->render('login', [
            'model' => $model,
            'model_reg' => $model_reg,
            'model_bus' => $model_bus,
            'cats' => $cats,
            'subcats' => ['' => ''],
        ]);
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

            if ($model->load(Yii::$app->request->post()) && $model->Sendtoadmins($est->ID, $est->SubcategoryID)) {
                return $this->render('office_sended_est');
            }

            return $this->render('office', [
                'est' => $est,
                'model' => $model,
                'events' => $events,
                'pages_events' => $pages_events,
            ]);
        }
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

    public function actionConfirm($id) {
        $us = Users::find()->where(['ID' => $id])->one();
        $us->Confirmed = 1;
        $us->save();

        $model = new LoginForm();
        $model_reg = new SignupForm();
        $model_bus = new SignupbusinessmanForm();
        $cat = Category::find()->all();
        $cats = ArrayHelper::map($cat, 'ID', 'Name');

        return $this->render('confirm_access', [
            'model' => $model,
            'model_reg' => $model_reg,
            'model_bus' => $model_bus,
            'cats' => $cats,
            'subcats' => ['' => ''],
        ]);
    }

    public function actionSignupaccess() {
        $model = new LoginForm();
        $model_reg = new SignupForm();
        $model_bus = new SignupbusinessmanForm();
        $cat = Category::find()->all();
        $cats = ArrayHelper::map($cat, 'ID', 'Name');

        return $this->render('reg_access', [
            'model' => $model,
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
            //mail($user->Email, $est->Name.' прошло проверку', 'Ваше заведение "'.$est_test->Name.'" было опубликовано на сайте "Где в Донецке..?": http://gdevonetske.com/establishment?id='.$est->ID.' Благодарим за сотрудничество!');
            $this->redirect(Url::to(['establishment', 'id' => $est->ID]));

        }
    }

    public function actionEventedit($event, $est) {
        $model = new EventtestForm();
        $est = Establishment::find()->where(['ID' => $est])->one();
        $cat = Categoryevent::find()->all();
        $cats = ArrayHelper::map($cat, 'ID', 'Name');
        if ($event) {
            $ev = Event::find()->where(['ID' => $event, 'New' => 1])->one();
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

    public function actionTestevent() {
        $model = new EventtestForm();
        if ($model->load(Yii::$app->request->post()) && $model->Sendtoadmins()) {
            return $this->render('office_sended_est');
        }
        return false;
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
