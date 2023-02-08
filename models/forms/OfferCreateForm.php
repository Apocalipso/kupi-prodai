<?php
namespace app\models\forms;

use Yii;
use yii\base\Model;
use yii\db\ActiveRecord;
use app\models\Categories;

class OfferCreateForm extends Model
{
    public $photo;
    public $title;
    public $description;
    public $price;
    public $publication_categories;
    public $is_sell;
    public $creator_id;

    public function rules()
    {
        return [
            [['title', 'description', 'publication_categories', 'price', 'is_sell'], 'required'],
            [['price'], 'integer'],
            [['title'], 'string', 'max' => 122],
            [['description'], 'string', 'max' => 255],
            ['price', 'integer' , 'min' =>100],
            [['photo'], 'file', 'skipOnEmpty' => true,'maxFiles' => 1,'extensions' => 'png, jpg']
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'creation_time' => 'Creation Time',
            'title' => 'Название',
            'description' => 'Описание',
            'publication_categories' => 'Выбрать категорию публикации',
            'creator_id' => 'Creator ID',
            'price' => 'Цена',
            'is_sell' => 'Тип объявления',
            'photo' => 'Загрузить фото...'
        ];
    }
}
