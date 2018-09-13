<?php

use yii\db\Migration;

/**
 * Class m180506_175350_user
 */
class m180506_175350_user extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {

    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        echo "m180506_175350_user cannot be reverted.\n";

        return false;
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m180506_175350_user cannot be reverted.\n";

        return false;
    }
    */
}
