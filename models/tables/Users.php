<?php

namespace app\models\tables;

/**
 * This is the model class for table "users".
 *
 * @property int $id
 * @property string $username
 * @property string $password
 * @property string $authKey
 * @property string $accessToken
 * @property int $roleId
 */
class Users extends \yii\db\ActiveRecord {

    /**
     * {@inheritdoc}
     */
    public static function tableName() {
        return 'users';
    }

    /**
     * {@inheritdoc}
     */
    public function rules() {
        return [
            [['username', 'password'], 'required'],
            [['username', 'password', 'authKey', 'accessToken'], 'string', 'max' => 50],
            [['username'], 'unique'],
            [['roleId'], 'number']
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels() {
        return [
            'id' => 'ID',
            'username' => 'Имя',
            'password' => 'Пароль',
            'authKey' => 'Ключ авторизации',
            'accessToken' => 'Токен',
            'roleId' => 'Доступ',
        ];
    }

    public function getRole() {
        return $this->hasOne(Roles::class, ['id' => 'roleId']);
    }

}
