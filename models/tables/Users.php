<?php

namespace app\models\tables;

/**
 * This is the model class for table "users".
 *
 * @property int $id
 * @property string $username
 * @property string $password
 * @property string $email
 * @property string $authKey
 * @property string $accessToken
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
            [['email'], 'safe'],
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
            'email' => 'Почта',
            'authKey' => 'Ключ авторизации',
            'accessToken' => 'Токен',
        ];
    }
}
