<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "publications".
 *
 * @property int $id
 * @property string $creation_time
 * @property string $title
 * @property string $description
 * @property int $publication_categories
 * @property int $creator_id
 * @property int $price
 * @property int|null $is_sell
 *
 * @property Users $creator
 * @property PublicationsCategories[] $publicationsCategories
 * @property PublicationsFiles[] $publicationsFiles
 */
class Publications extends \yii\db\ActiveRecord
{

    public const PUBLICATION_TYPE = [
        'buy' => 'КУПЛЮ',
        'sell' => 'ПРОДАМ',
    ];
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'publications';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['creation_time', 'title', 'description', 'creator_id', 'price'], 'required'],
            [['creation_time'], 'safe'],
            [['creator_id', 'price', 'is_sell'], 'integer'],
            [['title'], 'string', 'max' => 122],
            [['description'], 'string', 'max' => 255],
            [['creator_id'], 'exist', 'skipOnError' => true, 'targetClass' => Users::class, 'targetAttribute' => ['creator_id' => 'id']],
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
            'title' => 'Title',
            'description' => 'Description',
            'creator_id' => 'Creator ID',
            'price' => 'Price',
            'is_sell' => 'Is Sell',
        ];
    }

    /**
     * Gets query for [[Creator]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getCreator()
    {
        return $this->hasOne(Users::class, ['id' => 'creator_id']);
    }

    /**
     * Gets query for [[PublicationsCategories]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getPublicationsCategories()
    {
        return $this->hasMany(PublicationsCategories::class, ['publication_id' => 'id']);
    }

    /**
     * Gets query for [[PublicationsFiles]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getPublicationsFiles()
    {
        return $this->hasMany(PublicationsFiles::class, ['publication_id' => 'id']);
    }
}
