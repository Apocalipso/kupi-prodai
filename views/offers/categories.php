<?php
use yii\widgets\LinkPager;
use yii\widgets\ListView;
use yii\helpers\Url;
?>
<main class="page-content">
    <section class="categories-list">
        <h1 class="visually-hidden">Сервис объявлений "Куплю - продам"</h1>
        <ul class="categories-list__wrapper">
            <?php foreach ($categories as $category):?>
                <li class="categories-list__item">
                    <a href="<?= Url::to(['/offers/category/', 'id' => $category->category_id]);?>" class="category-tile <?php if ($category->category_id === $currentCategory->id) echo ' category-tile--default';?>">
                      <span class="category-tile__image">
                        <img src="<?=$category->category->img?>" alt="Иконка категории <?=$category->category->name?>">
                      </span>
                      <span class="category-tile__label"><?=$category->category->name?> <span class="category-tile__qty js-qty"><?=$category['count']?></span></span>
                    </a>
                </li>
            <?php endforeach;?>
        </ul>
    </section>
    <section class="tickets-list">
        <h2 class="visually-hidden">Предложения из категории <?=$currentCategory->name;?></h2>
        <div class="tickets-list__wrapper">
            <div class="tickets-list__header">
                <p class="tickets-list__title"><?=$currentCategory->name;?> <b class="js-qty"><?=$countOffers;?></b></p>
            </div>
            <?= ListView::widget(
                [
                    'dataProvider' => $dataProvider,
                    'itemView' => '_offers',
                    'layout' => "<ul>{items}</ul>",
                    'summary' => false,
                    'emptyText' => 'Объявления отсутствуют',
                    'emptyTextOptions' => [
                        'tag' => 'p',
                        'class' => 'pagination',
                    ],
                    'itemOptions' => [
                        'tag' => false,
                    ]
                ]
            ) ?>
            <div class="tickets-list__pagination">
                <?= LinkPager::widget([
                    'pagination' => $pagination,
                    'options' => [
                        'tag' => 'ul',
                        'class' => 'pagination',
                    ],
                    'disabledListItemSubTagOptions' => ['tag' => 'a', 'class' => 'active'],
                    'disableCurrentPageButton' => true,
                    'maxButtonCount' => 5,
                    'prevPageLabel' => false,
                    'nextPageLabel' => 'дальше',
                    'hideOnSinglePage' => true
                ]); ?>
            </div>
        </div>
    </section>
</main>