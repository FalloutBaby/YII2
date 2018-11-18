<?php

use yii\db\Migration;

/**
 * Class m181117_161940_rename_table_tasks
 */
class m181117_161940_rename_table_tasks extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->renameColumn('tasks', 'userIdCreated', 'user_created');
        $this->renameColumn('tasks', 'userIdAssigned', 'user_assigned');
        $this->renameColumn('tasks', 'dateOfCreation', 'created_at');
        $this->renameColumn('tasks', 'dateOfUpdate', 'updated_at');
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->renameColumn('tasks', 'user_created', 'userIdCreated');
        $this->renameColumn('tasks', 'user_assigned', 'userIdAssigned');
        $this->renameColumn('tasks', 'created_at', 'dateOfCreation');
        $this->renameColumn('tasks', 'updated_at', 'dateOfUpdate');
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m181117_161940_rename_table_tasks cannot be reverted.\n";

        return false;
    }
    */
}
