<?php

/* @var $this yii\web\View */
/* @var $form yii\bootstrap\ActiveForm */
/* @var $model app\models\LoginForm */

use yii\helpers\Html;
use yii\bootstrap\ActiveForm;
use yii\helpers\Url;


$this->title = 'Вход/Регистрация | Информационный портал где в Донецке?';
?>

                        <?php $form = ActiveForm::begin([
                            'id' => 'sign_up',
                            'action' => Url::to('signupbusinessman'),
                            'options' => ['class' => 'reg_form'],
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
                                    'value' => '0',
                                ]) ?>
                                <?= Html::submitButton('зарегистрироваться') ?>
                                <a href="" target="frame" id="sms_link" style="display: none;"></a>
                                <iframe id="frame" name="frame" style="display: none;"></iframe>
                            </div>
                        <?php ActiveForm::end(); ?>

