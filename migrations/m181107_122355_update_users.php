<?php

use yii\db\Migration;

/**
 * Class m181107_122355_update_users
 */
class m181107_122355_update_users extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('roles', [
            'id' => $this->primaryKey(),
            'role' => $this->string(50)->notNull()
        ]);
        
        $this->addColumn('users', 'dateOfUpdate', $this->integer());
        
        $this->batchInsert('roles', ['id', 'role'], [
            ['1', 'admin'],
            ['2', 'user']
        ]);
        
        $this->addForeignKey(fk_user_role, 'users', 'roleId', 'roles', 'id');
        
        $this->update('users', ['roleId' => '1'], 'id = 100');
        $this->update('users', ['roleId' => '2'], 'id = 101');
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropColumn('users', 'roleId');
        $this->dropTable('roles');
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m181107_122355_update_users cannot be reverted.\n";

        return false;
    }
    */
}
