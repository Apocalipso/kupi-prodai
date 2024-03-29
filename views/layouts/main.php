<?php

/** @var yii\web\View $this */
/** @var string $content */

use app\assets\AppAsset;
use app\widgets\Alert;
use yii\bootstrap5\Breadcrumbs;
use yii\bootstrap5\Html;
use yii\bootstrap5\Nav;
use yii\bootstrap5\NavBar;
use yii\widgets\ActiveForm;
use app\models\forms\SearchForm;
use yii\helpers\Url;

AppAsset::register($this);

$this->registerCsrfMetaTags();
$this->registerMetaTag(['charset' => Yii::$app->charset], 'charset');
$this->registerMetaTag(['name' => 'viewport', 'content' => 'width=device-width, initial-scale=1, shrink-to-fit=no']);
$this->registerMetaTag(['name' => 'description', 'content' => $this->params['meta_description'] ?? '']);
$this->registerMetaTag(['name' => 'keywords', 'content' => $this->params['meta_keywords'] ?? '']);
$this->registerLinkTag(['rel' => 'icon', 'type' => 'image/x-icon', 'href' => Yii::getAlias('/img/favicon.ico')]);
?>
<?php $this->beginPage() ?>
<!DOCTYPE html>
<html lang="<?= Yii::$app->language ?>" class="h-100">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title><?= Html::encode($this->title) ?></title>
    <?php $this->head() ?>
</head>
<body class="d-flex flex-column h-100">
<?php $this->beginBody() ?>

<header class="header <?php if(!Yii::$app->user->isGuest) echo 'header--logged'?>">
  <div class="header__wrapper">
    <a class="header__logo logo" href="/">
      <img src="/img/logo.svg" width="179" height="34" alt="Логотип Куплю Продам">
    </a>
    <nav class="header__user-menu">
      <ul class="header__list">
        <li class="header__item">
          <a href="<?= Url::to(['/my']);?>">Публикации</a>
        </li>
        <li class="header__item">
          <a href="<?= Url::to(['/my/comments']);?>">Комментарии</a>
        </li>
      </ul>
    </nav>

    <?php $searchForm = new SearchForm();
    $searchWord = '';
    if (Yii::$app->request->get('SearchForm')){
        $searchWord = Yii::$app->request->get('SearchForm')['search'];
    }
    $form = ActiveForm::begin([
        'method' => 'get',
        'action' => ['/search'],
        'options' => [
            'class' => 'search search-active',
            'autocomplete' => 'off',
        ],
    ]); ?>
      <?= $form->field($searchForm, 'search',['options' => ['tag' => false]])->textInput(['type' => 'search', 'placeholder' => 'Поиск', 'value' => $searchWord ])->label(false) ?>
      <div class="search__icon"></div>
      <div class="search__close-btn"></div>
      <?php ActiveForm::end(); ?>

    <?php if(Yii::$app->user->getIdentity()):?>
        <a class="header__avatar avatar" href="<?= Url::to(['/site/logout']);?>">
          <img src="<?=Yii::$app->user->getIdentity()->avatar?>" alt="Аватар пользователя">
        </a>
    <?php endif;?>
    <a class="header__input" href="<?= Url::to(['/login']);?>">Вход и регистрация</a>
  </div>
</header>

<?=$content;?>

<footer class="page-footer">
  <div class="page-footer__wrapper">
    <div class="page-footer__col">
      <a href="#" class="page-footer__logo-academy" aria-label="Ссылка на сайт HTML-Академии">
        <svg width="132" height="46">
          <use xlink:href="/img/sprite_auto.svg#logo-htmlac"></use>
        </svg>
      </a>
      <p class="page-footer__copyright">© <?=date("Y");?> Проект Академии</p>
    </div>
    <div class="page-footer__col">
      <a href="<?= Url::to(['/']);?>" class="page-footer__logo logo">
        <img src="/img/logo.svg" width="179" height="35" alt="Логотип Куплю Продам">
      </a>
    </div>
    <div class="page-footer__col">
      <ul class="page-footer__nav">
        <li>
          <a href="<?= Url::to(['/login']);?>">Вход и регистрация</a>
        </li>
        <li>
          <a href="<?= Url::to(['/offers/add']);?>">Создать объявление</a>
        </li>
      </ul>
    </div>
  </div>
</footer>

<?php $this->endBody() ?>
</body>
</html>
<?php $this->endPage() ?>
