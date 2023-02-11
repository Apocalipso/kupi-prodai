<main class="page-content">
    <section class="comments">
        <div class="comments__wrapper">
            <h1 class="visually-hidden">Страница комментариев</h1>
            <?php foreach ($publications as $publication):?>
                <div class="comments__block">
                    <div class="comments__header">
                        <a href="/offers/<?=$publication->id;?>" class="announce-card">
                            <h2 class="announce-card__title"><?=$publication->title;?></h2>
                            <span class="announce-card__info">
                              <span class="announce-card__price">₽ <?=$publication->price;?></span>
                              <?php if ($publication->is_sell ===1):?>
                                  <span class="announce-card__type">КУПЛЮ</span>
                              <?php else:?>
                                  <span class="announce-card__type">ПРОДАМ</span>
                              <?php endif;?>
                            </span>
                        </a>
                    </div>
                    <ul class="comments-list">
                        <?php foreach ($publication->comments as $comment):?>
                            <li class="js-card">
                                <div class="comment-card">
                                    <div class="comment-card__header">
                                        <a class="comment-card__avatar avatar">
                                            <img src="<?=$comment->user->avatar;?>" alt="Аватар пользователя <?=$comment->user->name;?>">
                                        </a>
                                        <p class="comment-card__author"><?=$comment->user->name;?></p>
                                    </div>
                                    <div class="comment-card__content">
                                        <p><?=$comment->text?></p>
                                    </div>
                                    <a href="/comments/delete/<?=$comment->id;?>" class="comment-card__delete js-delete" type="button">Удалить</a>
                                </div>
                            </li>
                        <?php endforeach;?>
                    </ul>
                </div>
            <?php endforeach;?>
        </div>
    </section>
</main>