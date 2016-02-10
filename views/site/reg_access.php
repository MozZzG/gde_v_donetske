<?php

/* @var $this yii\web\View */
/* @var $form yii\bootstrap\ActiveForm */
/* @var $model app\models\LoginForm */

use yii\helpers\Html;
use yii\bootstrap\ActiveForm;
use yii\helpers\Url;
use himiklab\yii2\recaptcha\ReCaptcha;

$this->registerJsFile('js/login.js');

$this->title = 'Вход/Регистрация | Информационный портал где в Донецке?';
?>

<div class="row">
    <div class="col-sm-10">
        <div class="row">
            <div class="col-sm-4">
                <h2 class="reg_title">Вход / Регистрация</h2>
                <?php $form = ActiveForm::begin([
                    'id' => 'sign_in',
                    'action' => 'login',
                    'options' => ['class' => 'reg_form'],
                ]); ?>

                <div class="form_group">
                    <?= $form->field($model, 'email')->textInput(['placeholder' => 'email'])->label(false) ?>
                    <?= $form->field($model, 'password')->passwordInput(['placeholder' => 'пароль'])->label(false) ?>
                    <?= $form->field($model, 'rememberMe')->checkbox([
                        'template' => "{input}<label for=\"remember\"><span>запомнить</span></label>\n<div class=\"col-lg-8\">{error}</div>",
                        'id' => 'remember',
                    ]) ?>
                    <?= Html::submitButton('войти', ['name' => 'login']) ?>
                    <a href="#">восстановить пароль</a>
                    <h4>Или войдите через социальную сеть</h4>
                    <div id="uLogin" data-ulogin="display=panel;fields=first_name,last_name;providers=facebook,twitter,googleplus,vkontakte,yandex,odnoklassniki,mailru;hidden=;redirect_uri=site/loginsoc"></div>
                </div>

                <?php ActiveForm::end(); ?>

                <?php $form = ActiveForm::begin([
                    'id' => 'sign_in_businessman',
                    'action' => 'login_bus',
                    'options' => ['class' => 'reg_form', 'style' => 'display: none;'],
                ]); ?>

                <div class="form_group">
                    <?= $form->field($model_login_bus, 'phone')->textInput(['placeholder' => 'номер телефона'])->label(false) ?>
                    <?= $form->field($model_login_bus, 'password')->passwordInput(['placeholder' => 'пароль'])->label(false) ?>
                    <?= $form->field($model_login_bus, 'rememberMe')->checkbox([
                        'template' => "{input}<label for=\"remember_bus\"><span>запомнить</span></label>\n<div class=\"col-lg-8\">{error}</div>",
                        'id' => 'remember_bus',
                    ]) ?>
                    <?= Html::submitButton('войти', ['name' => 'login_bus']) ?>
                    <a href="#">восстановить пароль</a>
                </div>

                <?php ActiveForm::end(); ?>
            </div>
            <div class="col-sm-8 sign_up_blocks">
                <h2 class="reg_client"><a href="#" id="reg">для предпринимателей</a></h2>
                <h2 class="reg_client active"><a href="#" id="reg1">для посетителей</a></h2>
                <div class="clr"></div>
                <div class="row">
                    <div class="col-sm-5">
                        <div class="call_to_manager" style="display: none;">
                            не нашли нужную подкатегорию или возникли другие вопросы, свяжитесь с нашим менеджером<br>099 960 15 20
                        </div>
                    </div>
                    <div class="col-sm-7">
                        <?php $form = ActiveForm::begin([
                            'id' => 'sign_up',
                            'action' => Url::to('signupbusinessman'),
                            'options' => ['class' => 'reg_form', 'style' => 'display: none;'],
                        ]); ?>
                        <div class="form_group">
                            <?= $form->field($model_bus, 'phone')->textInput(['placeholder' => 'номер телефона: 38хххххххххх'])->label(false) ?>
                            <button id="bus_sms">отправить sms с кодом подтверждения</button>
                            <?= $form->field($model_bus, 'activation_code')->hiddenInput()->label(false) ?>
                            <?= $form->field($model_bus, 'user_activation_code')->textInput(['placeholder' => 'полученный код'])->label(false) ?>
                        </div>
                        <div class="form_group">
                            <?= $form->field($model_bus, 'email')->textInput(['placeholder' => 'email'])->label(false) ?>
                            <?= $form->field($model_bus, 'password')->passwordInput(['placeholder' => 'пароль'])->label(false) ?>
                            <?= $form->field($model_bus, 'passwordRep')->passwordInput(['placeholder' => 'подтверждение пароля'])->label(false) ?>
                        </div>
                        <div class="form_group">
                            <?= $form->field($model_bus, 'est_name')->textInput(['placeholder' => 'название организации'])->label(false) ?>
                            <?= $form->field($model_bus, 'category')->dropDownList($cats, ['prompt' => 'категория'])->label(false) ?>
                            <?= $form->field($model_bus, 'subcategory')->dropDownList($subcats, ['prompt' => 'подкатегория'])->label(false) ?>
                            <a href="#" class="soglas">Пользовательское соглашение (нажмите, чтобы прочитать)</a><br>
                            <?= $form->field($model_bus, 'accept')->checkbox([
                                'template' => "{input}<label for=\"accept\">Я принимаю пользовательское<br>соглашение<span></span></label>\n<div class=\"col-lg-8\">{error}</div>",
                                'id' => 'accept',
                            ]) ?>
                            <?= Html::submitButton('зарегистрироваться') ?>
                            <a href="" target="frame" id="sms_link" style="display: none;"></a>
                            <iframe id="frame" name="frame" style="display: none;"></iframe>
                        </div>
                        <?php ActiveForm::end(); ?>
                        <?php $form = ActiveForm::begin([
                            'id' => 'sign_up_user',
                            'action' => Url::to('signup'),
                            'options' => ['class' => 'reg_form'],
                        ]); ?>
                        <div class="form_group">
                            <?= $form->field($model_reg, 'email')->textInput(['placeholder' => 'email'])->label(false) ?>
                            <?= $form->field($model_reg, 'password')->passwordInput(['placeholder' => 'пароль'])->label(false) ?>
                            <?= $form->field($model_reg, 'passwordRep')->passwordInput(['placeholder' => 'подтверждение пароля'])->label(false) ?>
                        </div>
                        <div class="form_group">
                            <span class="nomer_text">Вы можете привязать свой номер телефона для осуществления покупок</span>
                            <?= $form->field($model_reg, 'phone')->textInput(['placeholder' => 'номер телефона: 38хххххххххх'])->label(false) ?>
                            <button id="user_sms">отправить sms с кодом подтверждения</button>
                            <?= $form->field($model_reg, 'activation_code')->hiddenInput()->label(false) ?>
                            <?= $form->field($model_reg, 'user_activation_code')->textInput(['placeholder' => 'полученный код'])->label(false) ?>
                            <?= ReCaptcha::widget([
                                'name' => 'reCaptcha',
                                'siteKey' => '6LfvLBMTAAAAAFICCh1VD0lhZlsW1eEjBEDMTIvx',
                                'widgetOptions' => ['class' => 'captcha']
                            ]) ?>
                            <?= Html::submitButton('зарегистрироваться') ?>
                        </div>
                        <?php ActiveForm::end(); ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="col-sm-2 right">
        <div class="banner"><img src="img/banner1.jpg"></div>
        <div class="banner"><img src="img/banner2.jpg"></div>
    </div>
</div>

<div id="window_reg" class="modal fade in">
    <div class="modal-dialog">
        <div class="modal-content">
            <!-- Заголовок модального окна -->
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                <h4 class="modal-title">Аккаунт создан</h4>
            </div>
            <!-- Основное содержимое модального окна -->
            <div class="modal-body">
                Благодарим Вас за выбор нашей компании.<br>Мы приложим максимум усилий, чтобы обеспечить бесперебойную работу нашего интернет-портала и качественную<br>поддержку в консультации и решении возникших вопросов.
                <p><strong>Для подтверждения email-адреса и активации аккаунта<br>перейдите по ссылке в письме.</strong></p>
            </div>
            <!-- Футер модального окна -->
            <div class="modal-footer">
                С уважением, администрация портала "Где в Донецке..?"
            </div>
        </div>
    </div>
</div>

<div id="window_soglas" class="modal fade in">
    <div class="modal-dialog">
        <div class="modal-content">
            <!-- Заголовок модального окна -->
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                <h4 class="modal-title">Пользовательское соглашение</h4>
            </div>
            <!-- Основное содержимое модального окна -->
            <div class="modal-body">
                <p>1. Общие требования
                <p>1.1 При создании страницы пользователем на сайте не должны вступать в противоречие с требованиями действующего законодательства и общепринятых норм морали и нравственности.
                <p>1.2 Не допускается спам и дублирования страниц в каталоге для повышения эффективности рекламы и привлечения клиентов.
                <p>1.3 Создание страницы и размещение на ней информации должно соответствовать строгому регламенту. В ином случие администрация в одностороннем порядке имеет право ее
                    отредактировать либо изменить.
                <p>1.4 Текстовые статьи о ваших услугах либо заведении пишуться только под заказ нашими журналистами либо делают рерайтинг уже имеющейся Вашей статьи.
                    Дублирование Ваших статей на нашем портале запрещенно.
                <p>1.5 Картинки в слайдере должны иметь хорошее качество и отображать реальный вид вашей деятельности.
                <p>1.6 При использовании сервиса календаря событий не допускаеться спам банеров на разные даты. Один банер должен быть размещен только на ту дату когда будет
                    проведено мероприятие ,акция либо скидка. Когда рекламый банер становиться не актуальный он автоматически удаляеться через 30дней с Вашей страницы и
                    из сервиса календаря событий.
                <p>2.    Общие условия пользования Сервисом
                <p>2.1. Использование функциональных возможностей Сервиса допускается только после прохождения Пользователем регистрации
                    и авторизации на портале в соответствии с установленной Администрацией процедурой.
                <p>2.2. Технические, организационные и коммерческие условия использования Сервиса, в том числе его функциональных
                    возможностей доводятся до сведения Пользователей путем отдельного размещения на портале или другим удобным способом информирования Пользователей.
                <p>2.3. Выбранные Пользователем логин и пароль являются необходимой и достаточной информацией для доступа Пользователя на портал.
                    Пользователь не имеет права передавать свои логин и пароль третьим лицам, несет полную ответственность за их
                    сохранность, самостоятельно выбирая способ их хранения.
                <p>3. Воспользовавшись любой из указанных выше возможностей по использованию Сервисов портала вы подтверждаете, что:
                <p>3.1 Ознакомились с условиями настоящего Соглашения в полном объеме до начала использования Сервисов.
                <p>3.2 Принимаете все условия настоящего Соглашения в полном объеме без каких-либо изъятий и ограничений с
                    вашей стороны и обязуетесь их соблюдать или прекратить использование Сервисов портала. Если вы не согласны с условиями
                    настоящего Соглашения или не имеете права на заключение договора на их основе, вам следует незамедлительно
                    прекратить любое использование Сервисов.
                <p>3.3 Соглашение (в том числе любая из его частей) может быть изменено Администрацией без какого-либо специального
                    уведомления. Новая редакция Соглашения вступает в силу с момента ее размещения на Сайте Администрации либо
                    доведения до сведения Пользователя в иной удобной форме, если иное не предусмотрено новой редакцией Соглашения.
                <p>В случае поступлений жалоб на Ваше заведение или услуги Администрация портала в праве приостановить показ Вашей страницы на время разберательств.
                    Если жалобы подтвердяться Ваша страница будет удалена без права востановления и создания новой.
                <p>Администрация Сайта вправе в любое время в одностороннем порядке изменять и даже приостановить показ страницы, если она нарушает правила бесплатного использования сервисов и условий
                    настоящего Соглашения. При несогласии Пользователя с внесенными изменениями он обязан отказаться от доступа к Сайту, прекратить использование материалов и сервисов Сайта.
            </div>
        </div>
    </div>
</div>

<div id="window_phone_error" class="modal fade">
    <div class="modal-dialog">
        <div class="modal-content">
            <!-- Заголовок модального окна -->
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                <h4 class="modal-title">Ошибка!</h4>
            </div>
            <!-- Основное содержимое модального окна -->
            <div class="modal-body">
                Неверный формат номера! Шаблон: 38хххххххххх
            </div>
        </div>
    </div>
</div>

<script src="//ulogin.ru/js/ulogin.js"></script>
<script src='https://www.google.com/recaptcha/api.js'></script>

