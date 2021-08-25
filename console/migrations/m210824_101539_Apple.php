<?php

use yii\db\Migration;

/**
 * Class m210824_101539_Apple
 */
class m210824_101539_Apple extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function up()
    {
        $this->createTable('{{%apple}}', [
            'id' => $this->primaryKey(),
            'size' => $this->decimal()->defaultValue(0),
            'status' => $this->smallInteger()->notNull()->defaultValue(0),
            'color' => $this->string()->notNull(),
            'created_at' => $this->integer()->notNull(),
            'fall_at' => $this->integer(),
        ]);
    }

    /**
     * {@inheritdoc}
     */
    public function down()
    {
        echo "m210824_101539_Apple cannot be reverted.\n";
        $this->dropTable('{{%apple}}');
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m210824_101539_Apple cannot be reverted.\n";

        return false;
    }
    */
}
