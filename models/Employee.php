<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "employees".
 *
 * @property int $id
 * @property string $first_name
 * @property string $last_name
 * @property string $payroll_number
 * @property string $email
 * @property string $created_at
 * @property string $updated_at
 */
class Employee extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName(): string
    {
        return 'employees';
    }

    /**
     * {@inheritdoc}
     */
    public function rules(): array
    {
        return [
            [['first_name', 'last_name', 'payroll_number', 'email', 'created_at', 'updated_at'], 'required'],
            [['created_at', 'updated_at'], 'safe'],
            [['first_name', 'last_name'], 'string', 'max' => 60],
            [['payroll_number'], 'string', 'max' => 40],
            [['email'], 'string', 'max' => 255],
            ['email', 'email',],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels(): array
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'first_name' => Yii::t('app', 'First Name'),
            'last_name' => Yii::t('app', 'Last Name'),
            'payroll_number' => Yii::t('app', 'Payroll Number'),
            'email' => Yii::t('app', 'Email'),
            'created_at' => Yii::t('app', 'Created At'),
            'updated_at' => Yii::t('app', 'Updated At'),
        ];
    }

    /**
     * {@inheritdoc}
     * @return \app\models\queries\EmployeeQuery the active query used by this AR class.
     */
    public static function find(): \app\models\queries\EmployeeQuery
    {
        return new \app\models\queries\EmployeeQuery(get_called_class());
    }
}
