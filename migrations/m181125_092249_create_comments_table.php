<?php

use yii\db\Migration;

/**
 * Handles the creation of table `comments`.
 */
class m181125_092249_create_comments_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('comments', [
            'id' => $this->primaryKey(),
            'text' => $this->text(),
            'user_id' => $this->integer(),
            'task_id' => $this->integer(),
            'date_of_creation' => $this->dateTime()->notNull(),
            'date_of_update' => $this->dateTime(),
            'file' => $this->text(),
        ]);
        
        $this->addForeignKey('fk_users_comments', 'comments', 'user_id', 'users', 'id');
        $this->addForeignKey('fk_tasks_comments', 'comments', 'task_id', 'tasks', 'id');
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('comments');
    }
}
