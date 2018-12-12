<?php

use yii\db\Migration;

/**
 * Class m181129_145228_drop_column
 */
class m181129_145228_drop_column extends Migration {

    /**
     * {@inheritdoc}
     */
    public function safeUp() {
        $this->dropForeignKey(
                'fk_user_role', 'users'
        );

        $this->dropColumn('users', 'roleId');

        $this->dropTable('roles');
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown() {
        $this->addColumn('users', 'roleId', $this->integer());

        $this->addForeignKey(fk_user_role, 'users', 'roleId', 'roles', 'id');
        
        $this->createTable('roles', [
            'id' => $this->primaryKey(),
            'role' => $this->string(50)->notNull()
        ]);
    }

    /*
      // Use up()/down() to run migration code without a transaction.
      public function up()
      {

      }

      public function down()
      {
      echo "m181129_145228_drop_column cannot be reverted.\n";

      return false;
      }
     */
}
