<?php

use yii\db\Migration;

/**
 * Handles the creation of table `tasks`.
 */
class m181030_112740_create_tasks_table extends Migration {

    /**
     * {@inheritdoc}
     */
    public function safeUp() {
        $this->createTable('tasks', [
            'id' => $this->primaryKey(),
            'title' => $this->string(50)->notNull(),
            'description' => $this->text(),
            'userIdCreated' => $this->integer(),
            'userIdAssigned' => $this->integer(),
            'dateOfCreation' => $this->dateTime()->notNull(),
            'deadline' => $this->dateTime()->notNull()
        ]);

        $this->createTable('users', [
            'id' => $this->primaryKey(),
            'username' => $this->string(50)->notNull(),
            'password' => $this->string(50)->notNull(),
            'authKey' => $this->string(50),
            'accessToken' => $this->string(50)
        ]);
        
        $this->addForeignKey('fk_users_assigned_tasks', 'tasks', 'userIdAssigned', 'users', 'id');
        $this->addForeignKey('fk_tasks_user_created', 'tasks', 'userIdCreated', 'users', 'id');
        
        $this->batchInsert('users', ['id', 'username', 'password', 'authKey', 'accessToken'],
            [[ '100', 'admin', 'admin', 'test100key', '100-token'],
            [ '101', 'demo', 'demo', 'test101key', '101-token'],
        ]);
        
        $this->batchInsert('tasks', ['title', 'dateOfCreation', 'deadline', 'userIdCreated'], 
                [['Important Task', '2018-01-12', '2019-01-12', '100'],
                ['Second Task', '2018-10-12', '2020-02-03', '100']]);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown() {
        $this->delete('tasks', ['in', 'title', ['Important Task', 'Second Task']]);
        $this->delete('users', ['in', 'id', ['100', '101']]);
        $this->dropTable('tasks');
        $this->dropTable('users');
    }

}
