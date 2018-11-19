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
        
        $this->batchInsert('tasks', ['title', 'description', 'created_at', 'deadline', 'user_created', 'user_assigned'], 
                [['Задача простая', 'Не срочная', '2018-11-19', '2019-01-12', '101', '100'],
                ['Задача для админа', 'Админ, выполни эту задачу', '2018-11-19', '2018-12-03', '101', '100'],
                ['Задача 2', 'Еще одна не срочная задача', '2018-11-19', '2019-01-14', '100', '100'],
                ['Важная задача', 'Это очень важная задача, будьте внимательны!', '2018-11-19', '2019-01-01', '100', '101'],
                ['Задача 3', 'Эта задача на неделю', '2018-11-19', '2018-11-26', '100', '100'],
                ['Задача 4', 'К февралю надо выполнить', '2018-11-19', '2019-02-01', '101', '101'],
                ['Задача 5', 'Еще одна задача, обычная', '2018-11-19', '2019-01-12', '101', '101'],
                ['Срочная задача', '', '2018-11-19', '2019-01-01', '100', '101'],
                ['Сдать проект', 'Эта задача на неделю', '2018-11-19', '2018-11-26', '100', '100'],
                ['Выполнить заказ', 'К февралю надо выполнить', '2018-11-19', '2019-02-01', '100', '101'],
                ['Проверить сайт', 'Еще одна задача, обычная', '2018-11-19', '2019-01-12', '100', '100']]);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->delete('tasks', ['in', 'title',
            ['Задача простая', 'Задача 2', 'Задача 3', 'Задача 4', 'Задача 5',
             'Задача для админа', 'Важная задача',
             'Срочная задача', 'Сдать проект', 'Выполнить заказ', 'Проверить сайт']]);
        
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
