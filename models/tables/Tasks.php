<?php

namespace app\models\tables;

use yii\behaviors\TimestampBehavior;
use yii\db\Expression;
use Yii;
use app\models\tables\Users;

/**
 * This is the model class for table "tasks".
 *
 * @property int $id
 * @property string $title
 * @property string $description
 * @property int $user_created
 * @property int $user_assigned
 * @property string $created_at
 * @property string $updated_at
 * @property string $deadline
 *
 * @property Users $userCreated0
 * @property Users $userAssigned0
 */
class Tasks extends \yii\db\ActiveRecord {

    /**
     * {@inheritdoc}
     */
    public static function tableName() {

        return 'tasks';
    }

    /**
     * {@inheritdoc}
     */

    public function rules() {
        return [
            [['title', 'deadline'], 'required'],
            [['description'], 'string'],
            [['user_created', 'user_assigned'], 'integer'],
            [['created_at', 'deadline', 'updated_at'], 'safe'],
            [['title'], 'string', 'max' => 50],
            [['user_created'], 'exist', 'skipOnError' => true, 'targetClass' => Users::className(), 'targetAttribute' => ['user_created' => 'id']],
            [['user_assigned'], 'exist', 'skipOnError' => true, 'targetClass' => Users::className(), 'targetAttribute' => ['user_assigned' => 'id']],
        ];
    }

    public function behaviors() {
        return [
            'timestamp' => [
            'class' => TimestampBehavior::className(),
            'createdAtAttribute' => 'created_at',
            'updatedAtAttribute' => 'updated_at',
            'value' => new Expression('NOW()'),]
        ];
    }
    
    /**
     * {@inheritdoc}
     */
    public function attributeLabels() {
        return Yii::t('task', 'attributes');
    }

    /**
     * @return \yii\db\ActiveQuery
     */

    public function getUserCreated0() {
        return $this->hasOne(Users::className(), ['id' => 'user_created']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getUserAssigned0() {
        return $this->hasOne(Users::className(), ['id' => 'user_assigned']);
    }

    public function notification() {
        Yii::$app->mailer->compose()
                ->setTo(Users::findOne($this->user_assigned)->email)
                ->setFrom(Users::findOne($this->user_created)->email)
                ->setSubject('New task assigned to you')
                ->setTextBody($this->title . ': ' . $this->description . ' Выполнить до ' . $this->deadline)
                ->send();
        return true;
    }

}
