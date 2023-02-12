<?php
use yii\widgets\ActiveForm;
use yii\helpers\Html;
use app\models\Categories;
use yii\helpers\ArrayHelper;
$publication_categories = ArrayHelper::map(Categories::find()->all(), 'id', 'name');
if ($publication->publicationsCategories){
    $selectedCategory = [];
    foreach ($publication->publicationsCategories as $category){
        $selectedCategory[$category->category_id] = ['Selected'=>'selected'];
    }
}
?>
<main class="page-content">
    <section class="ticket-form">
        <div class="ticket-form__wrapper">
            <h1 class="ticket-form__title">Редактировать публикацию</h1>
            <div class="ticket-form__tile">
                <?php $form = ActiveForm::begin(
                    [
                        'id' => 'registerForm',
                        'method' => 'post',
                        'options' => [
                            'class' => 'ticket-form__form form',
                            'enctype' => 'multipart/form-data',
                            'autocomplete' => 'off'
                        ],
                        'errorCssClass' => 'form__field--invalid'
                    ]
                );
                ?>
                <div class="ticket-form__avatar-container js-preview-container uploaded">
                    <div class="ticket-form__avatar js-preview">
                        <img src="<?=$publication->publicationsFiles[0]->path?>">
                    </div>
                    <?=$form->field($offerForm, 'photo',['options' => ['class' => 'ticket-form__field-avatar'],
                        'template' => "{input}<label for=\"avatar\"><span class=\"ticket-form__text-upload\">Загрузить фото…</span>
                            <span class=\"ticket-form__text-another\">Загрузить другое фото…</span></label>{error}",
                        'inputOptions' => ['id' => 'avatar','class' => 'visually-hidden js-file-field', 'type' => 'file']])?>
                    <div class="ticket-form__content">
                        <div class="ticket-form__row">
                            <?=$form->field($offerForm, 'title',['options' => ['class' => 'form__field'],'errorOptions' => ['tag' => 'span']])->label()->textInput(['class' => 'js-field', 'value' => $publication->title]);?>
                        </div>
                        <div class="ticket-form__row">
                            <?= $form->field($offerForm, 'description',['options' => ['class' => 'form__field'],'errorOptions' => ['tag' => 'span']])->label()->textarea(['class' => 'js-field','rows' => '10', 'cols' => '30', 'value' => $publication->description]) ?>
                        </div>
                        <?=$form->field($offerForm, 'publication_categories[]', ['options' => ['class' => 'ticket-form__row'],'inputOptions' => ['id' => 'category-field', 'class' => 'form__select js-multiple-select', 'data-label'=> 'Выбрать категорию публикации']])
                            ->dropDownList($publication_categories, ['multiple'=>'multiple','options' => $selectedCategory])->label(false); ?>
                        <div class="ticket-form__row">
                            <div class="form__field form__field--price">
                                <?=$form->field($offerForm, 'price',['options' => ['class' => 'form__field form__field--price', 'multiple' => 'multiple'],'errorOptions' => ['tag' => 'span']])->label()->textInput(['class' => 'js-field js-price','type' => 'number', 'value' => $publication->price]);?>
                            </div>
                            <?= $form->field($offerForm, 'is_sell')->radioList(
                                [
                                    0 => 'Куплю',
                                    1 => 'Продам',
                                ],
                                [   'value'=>$publication->is_sell,
                                    'class' => 'form__switch switch',
                                    'item' => function ($index, $label, $name, $checked, $value) {
                                        return
                                            Html::beginTag('div', ['class' => 'switch__item']) .
                                            Html::radio($name, $checked, ['value' => $value, 'id' => $index, 'class' => 'visually-hidden']) .
                                            Html::label($label, $index, ['class' => 'switch__button']) .
                                            Html::endTag('div');
                                    }
                                ]
                            )->label(false);?>
                        </div>
                    </div>
                    <?= Html::submitButton('Сохранить', ['class' => 'form__button btn btn--medium js-button', 'disabled' => 'false']) ?>
                    <?php ActiveForm::end();?>
                </div>
    </section>
</main>