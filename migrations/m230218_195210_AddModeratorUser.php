<?php

use yii\db\Migration;

/**
 * Class m230218_195210_AddModeratorUser
 */
class m230218_195210_AddModeratorUser extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->addColumn('users', 'moderator', $this->tinyInteger());
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropColumn('users', 'moderator');
    }
    
}