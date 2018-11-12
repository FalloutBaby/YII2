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
 * @property int $userIdCreated
 * @property int $userIdAssigned
 * @property string $dateOfCreation
 * @property string $dateOfUpdate
 * @property string $deadline
 *
 * @property Users $userIdCreated0
 * @property Users $userIdAssigned0
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
            [['userIdCreated', 'userIdAssigned'], 'integer'],
            [['dateOfCreation', 'deadline', 'dateOfUpdate'], 'safe'],
            [['title'], 'string', 'max' => 50],
            [['userIdCreated'], 'exist', 'skipOnError' => true, 'targetClass' => Users::className(), 'targetAttribute' => ['userIdCreated' => 'id']],
            [['userIdAssigned'], 'exist', 'skipOnError' => true, 'targetClass' => Users::className(), 'targetAttribute' => ['userIdAssigned' => 'id']],
        ];
    }

    public function behaviors() {
        return [
            'timestamp' => [
            'class' => TimestampBehavior::className(),
            'createdAtAttribute' => 'dateOfCreation',
            'updatedAtAttribute' => 'dateOfUpdate',
            'value' => new Expression('NOW()'),]
        ];
    }
    
    /**
     * {@inheritdoc}
     */
    public function attributeLabels() {
        return [
            'id' => 'ID',
            'title' => 'Задача',
            'description' => 'Описание задачи',
            'userIdCreated' => 'Id создавшего пользователя',
            'userIdAssigned' => 'Id выполняющего пользователя',
            'dateOfCreation' => 'Дата создания',
            'dateOfUpdate' => 'Обновлено',
            'deadline' => 'Дедлайн',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getUserIdCreated0() {
        return $this->hasOne(Users::className(), ['id' => 'userIdCreated']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getUserIdAssigned0() {
        return $this->hasOne(Users::className(), ['id' => 'userIdAssigned']);
    }

    public function notification() {
        Yii::$app->mailer->compose()
                ->setTo(Users::findOne($this->userIdAssigned)->email)
                ->setFrom(Users::findOne($this->userIdCreated)->email)
                ->setSubject('New task assigned to you')
                ->setTextBody($this->title . ': ' . $this->description . ' Выполнить до ' . $this->deadline)
                ->send();
        return true;
    }

}
