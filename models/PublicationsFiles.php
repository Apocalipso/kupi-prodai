<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "publications_files".
 *
 * @property int $id
 * @property string $creation_time
 * @property int $publication_id
 * @property string $name
 * @property string $path
 *
 * @property Publications $publication
 */
class PublicationsFiles extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'publications_files';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['creation_time', 'publication_id', 'name', 'path'], 'required'],
            [['creation_time'], 'safe'],
            [['publication_id'], 'integer'],
            [['name'], 'string', 'max' => 122],
            [['path'], 'string', 'max' => 512],
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
            'publication_id' => 'Publication ID',
            'name' => 'Name',
            'path' => 'Path',
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
}
