<li class="tickets-list__item">
    <div class="ticket-card ticket-card--color06">
        <div class="ticket-card__img">
            <img src="<?=$model->publicationsFiles[0]->path?>" alt="Изображение товара <?=$model->title;?>">
        </div>
        <div class="ticket-card__info">
            <?php if ($model->is_sell ===1):?>
                <span class="ticket-card__label">Продам</span>
            <?php else:?>
                <span class="ticket-card__label">Куплю</span>
            <?php endif;?>
            <div class="ticket-card__categories">
                <?php foreach ($model->publicationsCategories as $category):?>
                    <a href="/offers/category/<?=$category->category_id?>"><?=$category->category->name?></a>
                <?php endforeach;?>
            </div>
            <div class="ticket-card__header">
                <h3 class="ticket-card__title">
                    <a href="/offers/<?=$model->id;?>"><?=$model->title;?></a>
                </h3>
                <p class="ticket-card__price"><span class="js-sum"><?=$model->price;?></span> ₽</p>
            </div>
            <div class="ticket-card__desc">
                <p><?=$model->description;?></p>
            </div>
        </div>
    </div>
</li>