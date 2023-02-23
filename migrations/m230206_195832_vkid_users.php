<?php

use yii\db\Migration;

/**
 * Class m230206_195832_vkid_users
 */
class m230206_195832_vkid_users extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->addColumn('users', 'vk_id', $this->integer()->unique());
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropColumn('users', 'vk_id');
    }

}
