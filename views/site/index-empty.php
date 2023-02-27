<?php
use yii\helpers\Url;
?>
<main class="page-content">
    <div class="message">
        <div class="message__text">
            <p>На сайте еще не опубликовано ни&nbsp;одного объявления.</p>
        </div>
        <a href="<?= Url::to(['/login']);?>" class="message__link btn btn--big">Вход и регистрация</a>
    </div>
</main>