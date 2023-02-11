<main class="page-content">
    <section class="ticket">
        <div class="ticket__wrapper">
            <h1 class="visually-hidden">Карточка объявления</h1>
            <div class="ticket__content">
                <div class="ticket__img">
                    <img src="<?=$publication->publicationsFiles[0]->path;?>" alt="<?=$publication->title?>">
                </div>
                <div class="ticket__info">
                    <h2 class="ticket__title"><?=$publication->title;?></h2>
                    <div class="ticket__header">
                        <p class="ticket__price"><span class="js-sum"><?=$publication->price;?></span> ₽</p>
                        <?php if ($publication->is_sell ===1):?>
                            <p class="ticket__action">КУПЛЮ</p>
                        <?php else:?>
                            <p class="ticket__action">ПРОДАМ</p>
                        <?php endif;?>
                    </div>
                    <div class="ticket__desc">
                        <p><?=$publication->description;?></p>
                    </div>
                    <div class="ticket__data">
                        <p>
                            <b>Дата добавления:</b>
                            <span>20 ноября 2019</span>
                        </p>
                        <p>
                            <b>Автор:</b>
                            <a><?=$publication->creator->name?></a>
                        </p>
                        <p>
                            <b>Контакты:</b>
                            <a href="mailto:<?=$publication->creator->email?>"><?=$publication->creator->email?></a>
                        </p>
                    </div>
                    <ul class="ticket__tags">
                        <li>
                            <a href="#" class="category-tile category-tile--small">
                <span class="category-tile__image">
                  <img src="img/cat.jpg" srcset="img/cat@2x.jpg 2x" alt="Иконка категории">
                </span>
                                <span class="category-tile__label">Дом</span>
                            </a>
                        </li>
                        <li>
                            <a href="#" class="category-tile category-tile--small">
                <span class="category-tile__image">
                  <img src="img/cat04.jpg" srcset="img/cat04@2x.jpg 2x" alt="Иконка категории">
                </span>
                                <span class="category-tile__label">Спорт и отдых</span>
                            </a>
                        </li>
                    </ul>
                </div>
            </div>




            <div class="ticket__comments">
                <h2 class="ticket__subtitle">Коментарии</h2>
                <div class="ticket__comment-form">
                    <form action="#" method="post" class="form comment-form">
                        <div class="comment-form__header">
                            <a href="#" class="comment-form__avatar avatar">
                                <img src="img/avatar.jpg" srcset="img/avatar@2x.jpg 2x" alt="Аватар пользователя">
                            </a>
                            <p class="comment-form__author">Вам слово</p>
                        </div>
                        <div class="comment-form__field">
                            <div class="form__field">
                                <textarea name="comment" id="comment-field" cols="30" rows="10" class="js-field">Нормальное вообще кресло! А как насч</textarea>
                                <label for="comment-field">Текст комментария</label>
                                <span>Обязательное поле</span>
                            </div>
                        </div>
                        <button class="comment-form__button btn btn--white js-button" type="submit" disabled="">Отправить</button>
                    </form>
                </div>
                <div class="ticket__comments-list">
                    <ul class="comments-list">
                        <li>
                            <div class="comment-card">
                                <div class="comment-card__header">
                                    <a href="#" class="comment-card__avatar avatar">
                                        <img src="img/avatar02.jpg" srcset="img/avatar02@2x.jpg 2x" alt="Аватар пользователя">
                                    </a>
                                    <p class="comment-card__author">Георгий Шпиц</p>
                                </div>
                                <div class="comment-card__content">
                                    <p>Что это за рухлядь? Стыдно такое даже фотографировать, не то, что&nbsp;продавать.</p>
                                </div>
                            </div>
                        </li>
                        <li>
                            <div class="comment-card">
                                <div class="comment-card__header">
                                    <a href="#" class="comment-card__avatar avatar">
                                        <img src="img/avatar03.jpg" srcset="img/avatar03@2x.jpg 2x" alt="Аватар пользователя">
                                    </a>
                                    <p class="comment-card__author">Александр Бурый</p>
                                </div>
                                <div class="comment-card__content">
                                    <p>А можете доставить мне домой? Готов доплатить 300 сверху. <br>Живу в центре прямо рядом с Моховой улицей. Готов купить прямо сейчас. Мой телефон 9032594748</p>
                                </div>
                            </div>
                        </li>
                    </ul>
                </div>
            </div>
            <button class="chat-button" type="button" aria-label="Открыть окно чата"></button>
        </div>
    </section>
</main>