<?php
use app\models\Categories;
?>
<main class="page-content">
    <section class="tickets-list">
        <h2 class="visually-hidden">Самые новые предложения</h2>
        <div class="tickets-list__wrapper">
            <div class="tickets-list__header">
                <a href="/offers/add" class="tickets-list__btn btn btn--big"><span>Новая публикация</span></a>
            </div>
            <?php if($myPublications):?>
            <ul>
                <?php foreach ($myPublications as $publication):?>
                <li class="tickets-list__item js-card">
                    <div class="ticket-card ticket-card--color06">
                        <div class="ticket-card__img">
                            <img src="<?=$publication->publicationsFiles[0]->path;?>" alt="<?=$publication->title?>">
                        </div>
                        <div class="ticket-card__info">
                            <?php if ($publication->is_sell === 1):?>
                                <span class="ticket-card__label">ПРОДАМ</span>
                            <?php else:?>
                                <span class="ticket-card__label">КУПЛЮ</span>
                            <?php endif;?>
                            <div class="ticket-card__categories">
                                <?php foreach ($publication->publicationsCategories as $category):?>
                                    <a href="/offers/category/<?=$category->id?>"><?=Categories::findOne($category->id)->name?></a>
                                <?php endforeach;?>
                            </div>
                            <div class="ticket-card__header">
                                <h3 class="ticket-card__title"><a href="/offers/<?=$publication->id?>"><?=$publication->title?></a></h3>
                                <p class="ticket-card__price"><span class="js-sum"><?=$publication->price?></span> ₽</p>
                            </div>
                        </div>
                        <a href="/offers/delete/<?=$publication->id?>" class="ticket-card__del js-delete" type="button">Удалить</a>
                    </div>
                </li>
                <?php endforeach;?>
            </ul>
            <?php endif;?>
        </div>
    </section>
</main>