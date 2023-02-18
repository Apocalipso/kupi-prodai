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

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m230218_195210_AddModeratorUser cannot be reverted.\n";

        return false;
    }
    */
}
