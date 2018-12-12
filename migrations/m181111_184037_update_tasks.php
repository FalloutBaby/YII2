<?php

use yii\db\Migration;

/**
 * Class m181111_184037_update_tasks
 */
class m181111_184037_update_tasks extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->addColumn('tasks', 'dateOfUpdate', $this->dateTime());
        $this->addColumn('users', 'email', $this->text());
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropColumn('users', 'email');
        $this->dropColumn('tasks', 'dateOfUpdate');
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m181111_184037_update_tasks cannot be reverted.\n";

        return false;
    }
    */
}
