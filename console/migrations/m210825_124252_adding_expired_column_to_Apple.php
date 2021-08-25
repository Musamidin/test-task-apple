<?php

use yii\db\Migration;

/**
 * Class m210825_124252_adding_expired_column_to_Apple
 */
class m210825_124252_adding_expired_column_to_Apple extends Migration
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
        echo "m210825_124252_adding_expired_column_to_Apple cannot be reverted.\n";

        return false;
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m210825_124252_adding_expired_column_to_Apple cannot be reverted.\n";

        return false;
    }
    */
}
