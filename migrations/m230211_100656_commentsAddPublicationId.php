<?php

use yii\db\Migration;

/**
 * Class m230211_100656_commentsAddPublicationId
 */
class m230211_100656_commentsAddPublicationId extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->addColumn('comments', 'publication_id', $this->integer());
        $this->addForeignKey(
            'publicationIdToComments',
            'comments',
            'publication_id',
            'publications',
            'id',
            'CASCADE'
        );
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropForeignKey(
            'publicationIdToComments',
            'comments'
        );
        $this->dropColumn('comments', 'publication_id');
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m230211_100656_commentsAddPublicationId cannot be reverted.\n";

        return false;
    }
    */
}
