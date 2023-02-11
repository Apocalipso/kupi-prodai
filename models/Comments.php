<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "comments".
 *
 * @property int $id
 * @property string $creation_time
 * @property string $text
 * @property int $user_id
 * @property int|null $publication_id
 *
 * @property Publications $publication
 * @property Users $user
 */
class Comments extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'comments';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['creation_time', 'text', 'user_id'], 'required'],
            [['creation_time'], 'safe'],
            [['text'], 'string'],
            [['user_id', 'publication_id'], 'integer'],
            [['user_id'], 'exist', 'skipOnError' => true, 'targetClass' => Users::class, 'targetAttribute' => ['user_id' => 'id']],
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
            'creation_time' => 'Creation Time',
            'text' => 'Text',
            'user_id' => 'User ID',
            'publication_id' => 'Publication ID',
        ];
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

    /**
     * Gets query for [[User]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getUser()
    {
        return $this->hasOne(Users::class, ['id' => 'user_id']);
    }
}
