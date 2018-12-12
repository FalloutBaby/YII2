<?php

use yii\db\Migration;

/**
 * Class m181129_154841_rbac_init
 */
class m181129_154841_rbac_init extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $am = Yii::$app->authManager;
        
        $admin = $am->createRole('admin');
        $moder = $am->createRole('moderator');
        
        $am->add($admin);
        $am->add($moder);
        
        $permissionAdminAccess = $am->createPermission('adminAccess');
        $permissionCreateTask = $am->createPermission('createTask');
        $permissionUpdateTask = $am->createPermission('updateTask');
        $permissionDeleteTask = $am->createPermission('deleteTask');
        $permissionDeleteComment = $am->createPermission('deleteComment');
        
        $am->add($permissionAdminAccess);
        $am->add($permissionCreateTask);
        $am->add($permissionUpdateTask);
        $am->add($permissionDeleteTask);
        $am->add($permissionDeleteComment);
        
        $am->addChild($admin, $permissionAdminAccess);
        $am->addChild($admin, $permissionCreateTask);
        $am->addChild($admin, $permissionDeleteTask);
        $am->addChild($admin, $permissionDeleteComment);
        $am->addChild($admin, $permissionUpdateTask);
        $am->addChild($moder, $permissionDeleteComment);
        $am->addChild($moder, $permissionCreateTask);
        $am->addChild($moder, $permissionUpdateTask);
        
        $am->assign($admin, 100);
        $am->assign($moder, 101);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        echo "m181129_154841_rbac_init cannot be reverted.\n";

        return false;
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m181129_154841_rbac_init cannot be reverted.\n";

        return false;
    }
    */
}
