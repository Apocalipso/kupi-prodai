<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/** @var yii\web\View $this */
/** @var app\models\Users $model */
/** @var ActiveForm $form */
?>
<main class="page-content">
    <section class="login">
        <h1 class="visually-hidden">Логин</h1>

        <?php $form = ActiveForm::begin(
                [
                    'id' => 'loginForm',
                    'method' => 'post',
                    'options' => [
                        'class' => 'login__form form',
                        'enctype' => 'multipart/form-data',
                        'autocomplete' => 'off'
                    ],
                    'errorCssClass' => 'form__field--invalid'
                ]
        ); ?>
        <div class="login__title">
            <a class="login__link" href="/register">Регистрация</a>
            <h2>Вход</h2>
        </div>
        <?= $form->field($loginForm, 'email',['errorOptions' => ['tag' => 'span'], 'options' =>['class' => 'form__field login__field']])->label()->textInput(['class' => 'js-field']);?>
        <?= $form->field($loginForm, 'password',['errorOptions' => ['tag' => 'span'], 'options' =>['class' => 'form__field login__field']])->label()->passwordInput(['class' => 'js-field']);?>

        <?= Html::submitButton('Войти', ['class' => 'login__button btn btn--medium js-button','disabled' => 'disabled']) ?>
        <a class="btn btn--small btn--flex btn--white" href="/login/auth?authclient=vkontakte">
            Войти через
            <span class="icon icon--vk"></span>
        </a>
        <?php ActiveForm::end(); ?>

    </section>
</main>