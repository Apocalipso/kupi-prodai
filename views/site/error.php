<?php

/** @var yii\web\View $this */
/** @var string $name */
/** @var string $message */
/** @var Exception$exception */

use yii\helpers\Html;

$this->title = $name;
?>

<main>
    <section class="error">
        <h1 class="error__title"><?= Html::encode($this->title) ?></h1>
        <h2 class="error__subtitle"><?= nl2br(Html::encode($message)) ?></h2>
        <ul class="error__list">
            <li class="error__item">
                <a href="/login">Вход и регистрация</a>
            </li>
            <li class="error__item">
                <a href="/offers/add">Новая публикация</a>
            </li>
            <li class="error__item">
                <a href="/">Главная страница</a>
            </li>
        </ul>
        <form class="error__search search search--small" method="get" action="#" autocomplete="off">
            <input type="search" name="query" placeholder="Поиск" aria-label="Поиск">
            <div class="search__icon"></div>
            <div class="search__close-btn"></div>
        </form>
        <a class="error__logo logo" href="/">
            <img src="/img/logo.svg" width="179" height="34" alt="Логотип Куплю Продам">
        </a>
    </section>
</main>