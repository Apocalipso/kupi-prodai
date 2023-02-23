<?php

use yii\db\Migration;

/**
 * Class m230210_054436_publication_publicationcategories_delete
 */
class m230210_054436_publication_publicationcategories_delete extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->dropColumn('publications', 'publication_categories');
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->addColumn('publications', 'publication_categories', $this->integer());
    }

}
