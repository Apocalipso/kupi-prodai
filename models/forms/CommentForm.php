<?php

namespace app\models\forms;

use Yii;
use yii\base\Model;
use yii\db\ActiveRecord;

class CommentForm extends Model
{
    public $text;

    public function rules()
    {
        return [
            [['text'], 'string', 'min' => 20]
        ];
    }

    public function attributeLabels()
    {
        return [
            'text' => 'Текст комментария'
        ];
    }
}