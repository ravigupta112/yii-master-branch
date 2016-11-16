<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "{{%timesheet}}".
 *
 * @property integer $id
 * @property integer $user_id
 * @property string $project
 * @property string $description
 * @property string $hours
 * @property string $status
 * @property string $total
 * @property string $estimate
 * @property string $created_dt
 *
 * @property User $user
 */
class Timesheet extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%timesheet}}';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['user_id', 'project', 'description', 'hours', 'status', 'estimate'], 'required'],
            [['user_id'], 'integer'],
            [['description', 'status'], 'string'],
            [['created_dt'], 'safe'],
            [['project'], 'string', 'max' => 255],
            [['hours'], 'string', 'max' => 10],
            [['total', 'estimate'], 'string', 'max' => 20],
            [['user_id'], 'exist', 'skipOnError' => true, 'targetClass' => User::className(), 'targetAttribute' => ['user_id' => 'id']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'user_id' => Yii::t('app', 'User ID'),
            'project' => Yii::t('app', 'Project'),
            'description' => Yii::t('app', 'Description'),
            'hours' => Yii::t('app', 'Hours'),
            'status' => Yii::t('app', 'Status'),
            'total' => Yii::t('app', 'Total'),
            'estimate' => Yii::t('app', 'Estimate'),
            'created_dt' => Yii::t('app', 'Created Dt'),
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getUser()
    {
        return $this->hasOne(User::className(), ['id' => 'user_id']);
    }
}
