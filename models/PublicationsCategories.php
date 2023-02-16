<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "publications_categories".
 *
 * @property int $id
 * @property int $category_id
 * @property int $publication_id
 *
 * @property Categories $category
 * @property Publications $publication
 */
class PublicationsCategories extends \yii\db\ActiveRecord
{
    public $count;
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'publications_categories';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['category_id', 'publication_id'], 'required'],
            [['category_id', 'publication_id'], 'integer'],
            [['category_id'], 'exist', 'skipOnError' => true, 'targetClass' => Categories::class, 'targetAttribute' => ['category_id' => 'id']],
            [['publication_id'], 'exist', 'skipOnError' => true, 'targetClass' => Publications::class, 'targetAttribute' => ['publication_id' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'category_id' => 'Category ID',
            'publication_id' => 'Publication ID',
        ];
    }

    /**
     * Gets query for [[Category]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getCategory()
    {
        return $this->hasOne(Categories::class, ['id' => 'category_id']);
    }

    /**
     * Gets query for [[Publication]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getPublication()
    {
        return $this->hasOne(Publications::class, ['id' => 'publication_id']);
    }
}
