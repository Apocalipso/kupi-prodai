<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "categories".
 *
 * @property int $id
 * @property string $creation_time
 * @property string $name
 * @property string|null $img
 * @property string $symbol_code
 *
 * @property PublicationsCategories[] $publicationsCategories
 */
class Categories extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'categories';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['creation_time', 'name', 'symbol_code'], 'required'],
            [['creation_time'], 'safe'],
            [['name'], 'string', 'max' => 64],
            [['img'], 'string', 'max' => 128],
            [['symbol_code'], 'string', 'max' => 122],
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
            'name' => 'Name',
            'img' => 'Img',
            'symbol_code' => 'Symbol Code',
        ];
    }

    /**
     * Gets query for [[PublicationsCategories]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getPublicationsCategories()
    {
        return $this->hasMany(PublicationsCategories::class, ['category_id' => 'id']);
    }
}
