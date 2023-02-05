<?php
use yii\widgets\ActiveForm;
use yii\helpers\Html;
?>
<link rel="stylesheet" href="/css/style.min.css">
<main class="page-content">
    <section class="sign-up">
        <h1 class="visually-hidden">Регистрация</h1>
        <?php $form = ActiveForm::begin(
                [
                        'id' => 'registerForm',
                        'method' => 'post',
                        'options' => [
                                'class' => 'sign-up__form form',
                                'enctype' => 'multipart/form-data',
                                'autocomplete' => 'off'
                        ],
                        'errorCssClass' => 'form__field--invalid'
                ]
        );
        ?>
        <div class="sign-up__title">
            <h2>Регистрация</h2>
            <a class="sign-up__link" href="/login">Вход</a>
        </div>
        <div class="sign-up__avatar-container js-preview-container">
            <div class="sign-up__avatar js-preview"></div>
                <?=$form->field($registerForm, 'file',['options' => ['class' => 'sign-up__field-avatar'],
                    'template' => "{input}<label for=\"avatar\"><span class=\"sign-up__text-upload\">Загрузить аватар…</span><span class=\"sign-up__text-another\">Загрузить другой аватар…</span></label>{error}",
                'inputOptions' => ['id' => 'avatar','class' => 'visually-hidden js-file-field', 'type' => 'file']])?>
        </div>
        <div class="form__field sign-up__field">
            <?=$form->field($registerForm, 'name',['errorOptions' => ['tag' => 'span']])->label()->textInput(['class' => 'js-field']);?>
        </div>
        <div class="form__field sign-up__field">
            <?=$form->field($registerForm, 'email',['errorOptions' => ['tag' => 'span']])->label()->textInput(['class' => 'js-field']);?>
        </div>
        <div class="form__field sign-up__field">
            <?=$form->field($registerForm, 'password',['errorOptions' => ['tag' => 'span']])->label()->passwordInput(['class' => 'js-field']);?>
        </div>
        <div class="form__field sign-up__field">
            <?=$form->field($registerForm, 'repeatPassword',['errorOptions' => ['tag' => 'span']])->label()->passwordInput(['class' => 'js-field']);?>
        </div>

        <?= Html::submitButton('Создать аккаунт', ['class' => 'sign-up__button btn btn--medium js-button', 'disabled' => 'disabled']) ?>
        <a class="btn btn--small btn--flex btn--white" href="/login/auth?authclient=vkontakte">
            Войти через
            <span class="icon icon--vk"></span>
        </a>
        <?php ActiveForm::end();?>
    </section>
</main>