<?php

namespace app\models\tables;

use Yii;

/**
 * This is the model class for table "tasks".
 *
 * @property int $id
 * @property string $title
 * @property string $description
 * @property int $userIdCreated
 * @property int $userIdAssigned
 * @property string $dateOfCreation
 * @property string $deadline
 *
 * @property Users $userIdCreated0
 * @property Users $userIdAssigned0
 */
class Tasks extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'tasks';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['title', 'dateOfCreation', 'deadline'], 'required'],
            [['description'], 'string'],
            [['userIdCreated', 'userIdAssigned'], 'integer'],
            [['dateOfCreation', 'deadline'], 'safe'],
            [['title'], 'string', 'max' => 50],
            [['userIdCreated'], 'exist', 'skipOnError' => true, 'targetClass' => Users::className(), 'targetAttribute' => ['userIdCreated' => 'id']],
            [['userIdAssigned'], 'exist', 'skipOnError' => true, 'targetClass' => Users::className(), 'targetAttribute' => ['userIdAssigned' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'title' => 'Title',
            'description' => 'Description',
            'userIdCreated' => 'User Id Created',
            'userIdAssigned' => 'User Id Assigned',
            'dateOfCreation' => 'Date Of Creation',
            'deadline' => 'Deadline',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getUserIdCreated0()
    {
        return $this->hasOne(Users::className(), ['id' => 'userIdCreated']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getUserIdAssigned0()
    {
        return $this->hasOne(Users::className(), ['id' => 'userIdAssigned']);
    }
}
