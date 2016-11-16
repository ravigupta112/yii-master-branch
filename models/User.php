<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "{{%user}}".
 *
 * @property integer $id
 * @property integer $role_id
 * @property string $name
 * @property string $emp_id
 * @property string $email
 * @property string $password
 * @property string $created_dt
 *
 * @property Timesheet[] $timesheets
 * @property Role $role
 */
class User extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%user}}';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['role_id'], 'integer'],
            [['name', 'emp_id', 'email', 'password'], 'required'],
            [['created_dt'], 'safe'],
            [['name', 'email', 'password'], 'string', 'max' => 255],
            [['emp_id'], 'string', 'max' => 20],
            [['email'], 'unique'],
            [['role_id'], 'exist', 'skipOnError' => true, 'targetClass' => Role::className(), 'targetAttribute' => ['role_id' => 'id']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'role_id' => Yii::t('app', 'Role'),
            'name' => Yii::t('app', 'Name'),
            'emp_id' => Yii::t('app', 'Emp ID'),
            'email' => Yii::t('app', 'Email'),
            'password' => Yii::t('app', 'Password'),
            'created_dt' => Yii::t('app', 'Created Dt'),
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getTimesheets()
    {
        return $this->hasMany(Timesheet::className(), ['user_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getRole()
    {
        return $this->hasOne(Role::className(), ['id' => 'role_id']);
    }
}
