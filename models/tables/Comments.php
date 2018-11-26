<?php

namespace app\models\tables;
use yii\behaviors\TimestampBehavior;
use yii\db\Expression;
use Yii;
use yii\imagine\Image;
use app\models\tables\Users;

/**
 * This is the model class for table "comments".
 *
 * @property int $id
 * @property string $text
 * @property int $user_id
 * @property int $task_id
 * @property string $date_of_creation
 * @property string $file
 *
 * @property Tasks $task
 * @property Users $user
 */
class Comments extends \yii\db\ActiveRecord
{
    
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'comments';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['text'], 'string'],
            [['user_id', 'task_id'], 'integer'],
            [['date_of_creation', 'date_of_update'], 'safe'],
            [['file'], 'file'],
            [['task_id'], 'exist', 'skipOnError' => true, 'targetClass' => Tasks::className(), 'targetAttribute' => ['task_id' => 'id']],
            [['user_id'], 'exist', 'skipOnError' => true, 'targetClass' => Users::className(), 'targetAttribute' => ['user_id' => 'id']],
        ];
    }

    public function behaviors() {
        return [
            'timestamp' => [
            'class' => TimestampBehavior::className(),
            'createdAtAttribute' => 'date_of_creation',
            'updatedAtAttribute' => 'date_of_update',
            'value' => new Expression('NOW()'),]
        ];
    }
    
    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'text' => 'Комментарий',
            'user_id' => 'ID пользователя',
            'task_id' => 'ID задачи',
            'date_of_creation' => 'Дата',
            'file' => 'Файл',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getTask()
    {
        return $this->hasOne(Tasks::className(), ['id' => 'task_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getUser()
    {
        return $this->hasOne(Users::className(), ['id' => 'user_id']);
    }
    
    public function uploadFile()
    {
        $fileName = $this->file->baseName . "." . $this->file->extension;
        $path = '@uploads/' . $fileName;
        $this->file->saveAs(Yii::getAlias($path));
        Image::thumbnail($path, 200, 100)->save(Yii::getAlias('@uploads/preview/' . $fileName));
    }
}
