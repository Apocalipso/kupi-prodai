<?php
use yii\helpers\Html;
use yii\widgets\ActiveForm;
?>
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
                            <p class="ticket__action">ПРОДАМ</p>
                        <?php else:?>
                            <p class="ticket__action">КУПЛЮ</p>
                        <?php endif;?>
                    </div>
                    <div class="ticket__desc">
                        <p><?=$publication->description;?></p>
                    </div>
                    <div class="ticket__data">
                        <p>
                            <b>Дата добавления:</b>
                            <span><?=Yii::$app->formatter->asRelativeTime($publication->creation_time);?></span>
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
                        <?php foreach ($publication->publicationsCategories as $category):?>
                            <li>
                                <a href="/offers/category/<?=$category->category->id;?>" class="category-tile category-tile--small">
                                    <span class="category-tile__image">
                                      <img src="<?=$category->category->img;?>" alt="Иконка категории <?=$category->category->name;?>">
                                    </span>
                                    <span class="category-tile__label"><?=$category->category->name;?></span>
                                </a>
                            </li>
                        <?php endforeach;?>
                    </ul>
                </div>
            </div>


            <div class="ticket__comments">
                <?php if(Yii::$app->user->isGuest):?>
                <div class="ticket__warning">
                    <p>Отправка комментариев доступна <br>только для зарегистрированных пользователей.</p>
                    <a href="/register" class="btn btn--big">Вход и регистрация</a>
                </div>
                <?php endif;?>

                <h2 class="ticket__subtitle">Коментарии</h2>

                <?php if(!Yii::$app->user->isGuest):?>
                <div class="ticket__comment-form">
                    <?php $form = ActiveForm::begin(
                        [
                            'id' => 'commentadd',
                            'method' => 'post',
                            'options' => [
                                'class' => 'form comment-form',
                                'autocomplete' => 'off'
                            ],
                            'errorCssClass' => 'form__field--invalid'
                        ]
                    );?>
                    <div class="comment-form__header">
                        <a class="comment-form__avatar avatar">
                            <img src="<?=Yii::$app->user->getIdentity()->avatar?>" alt="Аватар пользователя <?=Yii::$app->user->getIdentity()->name?>">
                        </a>
                        <p class="comment-form__author">Вам слово</p>
                    </div>
                    <div class="comment-form__field">
                        <?= $form->field( $commentForm, 'text',['options' => ['class' => 'form__field'],'errorOptions' => ['tag' => 'span']])->label()->textarea(['class' => 'js-field','rows' => '10', 'cols' => '30']) ?>
                    </div>
                    <?= Html::submitButton('Отправить', ['class' => 'comment-form__button btn btn--white js-button', 'disabled' => '']) ?>
                    <?php ActiveForm::end();?>
                </div>
                <?php endif;?>

                <?php if ($publication->comments):?>
                    <div class="ticket__comments-list">
                        <ul class="comments-list">
                            <?php foreach ($publication->comments as $comment):?>
                                <?php Yii::debug($comment);?>
                                <li>
                                    <div class="comment-card">
                                        <div class="comment-card__header">
                                            <a class="comment-card__avatar avatar">
                                                <img src="<?=$comment->user->avatar?>" alt="Аватар пользователя <?=$comment->user->name?>">
                                            </a>
                                            <p class="comment-card__author"><?=$comment->user->name?></p>
                                        </div>
                                        <div class="comment-card__content">
                                            <p><?=$comment->text?></p>
                                        </div>
                                    </div>
                                </li>
                            <?php endforeach;?>
                        </ul>
                    </div>
                <?php else:?>
                    <div class="ticket__message">
                        <p>У этой публикации еще нет ни одного комментария.</p>
                    </div>
                <?php endif;?>
            </div>
            <button class="chat-button" type="button" aria-label="Открыть окно чата"></button>
        </div>
    </section>
</main>