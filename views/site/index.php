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
        <li class="tickets-list__item">
          <div class="ticket-card ticket-card--color09">
            <div class="ticket-card__img">
              <img src="/img/item09.jpg" srcset="/img/item09@2x.jpg 2x" alt="Изображение товара">
            </div>
            <div class="ticket-card__info">
              <span class="ticket-card__label">Куплю</span>
              <div class="ticket-card__categories">
                <a href="#">Дом</a>
              </div>
              <div class="ticket-card__header">
                <h3 class="ticket-card__title"><a href="#">Монстера</a></h3>
                <p class="ticket-card__price"><span class="js-sum">1000</span> ₽</p>
              </div>
              <div class="ticket-card__desc">
                <p>Куплю монстеру зеленую в хорошем зеленом состоянии, буду поливать...</p>
              </div>
            </div>
          </div>
        </li>
        <li class="tickets-list__item">
          <div class="ticket-card ticket-card--color10">
            <div class="ticket-card__img">
              <img src="/img/item10.jpg" srcset="img/item10@2x.jpg 2x" alt="Изображение товара">
            </div>
            <div class="ticket-card__info">
              <span class="ticket-card__label">ПРОДАМ</span>
              <div class="ticket-card__categories">
                <a href="#">Дом</a>
              </div>
              <div class="ticket-card__header">
                <h3 class="ticket-card__title"><a href="#">Мое старое кресло</a></h3>
                <p class="ticket-card__price"><span class="js-sum">4000</span> ₽</p>
              </div>
              <div class="ticket-card__desc">
                <p>Продам свое старое кресло, чтобы сидеть и читать книги зимними...</p>
              </div>
            </div>
          </div>
        </li>
        <li class="tickets-list__item">
          <div class="ticket-card ticket-card--color11">
            <div class="ticket-card__img">
              <img src="/img/item11.jpg" srcset="/img/item11@2x.jpg 2x" alt="Изображение товара">
            </div>
            <div class="ticket-card__info">
              <span class="ticket-card__label">ПРОДАМ</span>
              <div class="ticket-card__categories">
                <a href="#">ЭЛЕКТРОНИКА</a>
              </div>
              <div class="ticket-card__header">
                <h3 class="ticket-card__title"><a href="#">Дедушкины часы</a></h3>
                <p class="ticket-card__price"><span class="js-sum">45 000</span> ₽</p>
              </div>
              <div class="ticket-card__desc">
                <p>Продаю дедушкины часы в&nbsp;прекрасном состоянии, ходят до...</p>
              </div>
            </div>
          </div>
        </li>
        <li class="tickets-list__item">
          <div class="ticket-card ticket-card--color04">
            <div class="ticket-card__img">
              <img src="/img/item04.jpg" srcset="/img/item04@2x.jpg 2x" alt="Изображение товара">
            </div>
            <div class="ticket-card__info">
              <span class="ticket-card__label">Куплю</span>
              <div class="ticket-card__categories">
                <a href="#">Дом</a>
              </div>
              <div class="ticket-card__header">
                <h3 class="ticket-card__title"><a href="#">Кофеварка</a></h3>
                <p class="ticket-card__price"><span class="js-sum">2000</span> ₽</p>
              </div>
              <div class="ticket-card__desc">
                <p>Куплю вот такую итальянскую кофеварку, можно любой фирмы...</p>
              </div>
            </div>
          </div>
        </li>
      </ul>
    </div>
  </section>
<?php endif;?>
</main>
