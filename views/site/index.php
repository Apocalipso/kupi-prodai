<?php

/** @var yii\web\View $this */

$this->title = 'Куплю Продам';
?>
<main class="page-content">
  <section class="categories-list">
    <h1 class="visually-hidden">Сервис объявлений "Куплю - продам"</h1>
    <ul class="categories-list__wrapper">
      <?php foreach ($categories as $category):?>
      <li class="categories-list__item">
        <a href="/offers/category/<?=$category->category_id;?>" class="category-tile category-tile--default">
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
  <?php if ($mostComments):?>
  <section class="tickets-list">
    <h2 class="visually-hidden">Самые обсуждаемые предложения</h2>
    <div class="tickets-list__wrapper">
      <div class="tickets-list__header">
        <p class="tickets-list__title">Самые обсуждаемые</p>
      </div>
      <ul>
        <?php foreach ($mostComments as $comment):?>
        <li class="tickets-list__item">
          <div class="ticket-card ticket-card--color09">
            <div class="ticket-card__img">
              <img src="<?=$comment->publication->publicationsFiles[0]->path?>" alt="Изображение товара <?=$comment->publication->title?>">
            </div>
            <div class="ticket-card__info">
            <?php if ($comment->publication->is_sell ===1):?>
                <span class="ticket-card__label">Продам</span>
            <?php else:?>
                <span class="ticket-card__label">Куплю</span>
            <?php endif;?>
              <div class="ticket-card__categories">
                  <?php foreach ($comment->publication->publicationsCategories as $category):?>
                      <a href="/offers/category/<?=$category->category_id?>"><?=$category->category->name?></a>
                  <?php endforeach;?>
              </div>
              <div class="ticket-card__header">
                <h3 class="ticket-card__title"><a href="#"><?=$comment->publication->title;?></a></h3>
                <p class="ticket-card__price"><span class="js-sum"><?=$comment->publication->price;?></span> ₽</p>
              </div>
              <div class="ticket-card__desc">
                <p><?=$comment->publication->description;?></p>
              </div>
            </div>
          </div>
        </li>
        <?php endforeach;?>
      </ul>
    </div>
  </section>
<?php endif;?>
</main>
