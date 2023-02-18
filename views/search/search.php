<?php
use yii\widgets\ListView;
use yii\widgets\LinkPager;
?>
<main class="page-content">
    <section class="search-results">
        <h1 class="visually-hidden">Результаты поиска</h1>
        <div class="search-results__wrapper">
            <?php if ($count == 0):?>
                <div class="search-results__message">
                    <p>Не найдено <br>ни&nbsp;одной публикации</p>
                </div>
            <?php else:?>
                <p class="search-results__label">Найдено <span class="js-results"><?=$count?> публикации</span></p>

                <?= ListView::widget([
                    'dataProvider' => $dataProvider,
                    'itemView' => '_search',
                    'layout' => "<ul class='search-results__list'>{items}</ul>",
                    'itemOptions' => ['tag' => false]
                ]);
                ?>

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

            <?php endif;?>
        </div>
    </section>
    <section class="tickets-list">
        <h2 class="visually-hidden">Самые новые предложения</h2>
        <div class="tickets-list__wrapper">
            <div class="tickets-list__header">
                <p class="tickets-list__title">Самое свежее</p>
            </div>
            <ul>
                <?php foreach ($allPublication as $publication):?>
                    <li class="tickets-list__item">
                        <div class="ticket-card ticket-card--color01">
                            <div class="ticket-card__img">
                                <img src="<?=$publication->publicationsFiles[0]->path;?>" alt="Изображение товара <?=$publication->title?>">
                            </div>
                            <div class="ticket-card__info">
                                <?php if ($publication->is_sell ===1):?>
                                    <span class="ticket-card__label">Продам</span>
                                <?php else:?>
                                    <span class="ticket-card__label">Куплю</span>
                                <?php endif;?>
                                <div class="ticket-card__categories">
                                    <?php foreach ($publication->publicationsCategories as $category):?>
                                        <a href="/offers/category/<?=$category->category_id?>"><?=$category->category->name?></a>
                                    <?php endforeach;?>
                                </div>
                                <div class="ticket-card__header">
                                    <h3 class="ticket-card__title"><a href="/offers/<?=$publication->id?>"><?=$publication->title?></a></h3>
                                    <p class="ticket-card__price"><span class="js-sum"><?=$publication->price?></span> ₽</p>
                                </div>
                                <div class="ticket-card__desc">
                                    <p><?=$publication->description?></p>
                                </div>
                            </div>
                        </div>
                    </li>
                <?php endforeach;?>
            </ul>
        </div>
    </section>
</main>