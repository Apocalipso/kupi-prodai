<?php

/** @var yii\web\View $this */
/** @var string $name */
/** @var string $message */
/** @var Exception$exception */

use yii\widgets\ActiveForm;
use app\models\forms\SearchForm;
use yii\helpers\Html;
use yii\helpers\Url;

$this->title = $name;
?>

<main>
    <section class="error">
        <h1 class="error__title"><?= Html::encode($this->title) ?></h1>
        <h2 class="error__subtitle"><?= nl2br(Html::encode($message)) ?></h2>
        <ul class="error__list">
            <li class="error__item">
                <a href="<?= Url::to(['/login']);?>">Вход и регистрация</a>
            </li>
            <li class="error__item">
                <a href="<?= Url::to(['/offers/add']);?>">Новая публикация</a>
            </li>
            <li class="error__item">
                <a href="<?= Url::to(['/']);?>">Главная страница</a>
            </li>
        </ul>
        <?php $searchForm = new SearchForm();

        $form = ActiveForm::begin([
            'method' => 'get',
            'action' => ['/search'],
            'options' => [
                'class' => 'error__search search search--small',
                'autocomplete' => 'off',
            ],
        ]); ?>
        <?= $form->field($searchForm, 'search',['options' => ['tag' => false]])->textInput(['type' => 'search', 'placeholder' => 'Поиск'])->label(false) ?>
        <div class="search__icon"></div>
        <div class="search__close-btn"></div>
        <?php ActiveForm::end(); ?>
        <a class="error__logo logo" href="/">
            <img src="/img/logo.svg" width="179" height="34" alt="Логотип Куплю Продам">
        </a>
    </section>
</main>