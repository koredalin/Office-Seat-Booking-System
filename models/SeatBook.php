<?php

namespace app\models;

use Yii;
use app\models\Employee;
use app\models\Seat;

/**
 * This is the model class for table "seats_book".
 *
 * @property int $id
 * @property int $employee_id
 * @property int $seat_id
 * @property string $start_time
 * @property string $end_time
 * @property string $created_at
 * @property string $updated_at
 */
class SeatBook extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'seats_book';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['employee_id', 'seat_id', 'start_time', 'end_time', 'created_at', 'updated_at'], 'required'],
            [['employee_id', 'seat_id'], 'integer'],
            [['start_time', 'end_time', 'created_at', 'updated_at'], 'safe'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'employee_id' => Yii::t('app', 'Employee ID'),
            'seat_id' => Yii::t('app', 'Seat ID'),
            'start_time' => Yii::t('app', 'Start Time'),
            'end_time' => Yii::t('app', 'End Time'),
            'created_at' => Yii::t('app', 'Created At'),
            'updated_at' => Yii::t('app', 'Updated At'),
        ];
    }

    /**
     * Gets query for [[Employee]].
     *
     * @return \yii\db\ActiveQuery|\app\models\queries\EmployeesQuery
     */
    public function getEmployee()
    {
        return $this->hasOne(Employee::className(), ['id' => 'employee_id']);
    }

    /**
     * Gets query for [[Seat]].
     *
     * @return \yii\db\ActiveQuery|\app\models\queries\SeatQuery
     */
    public function getSeat()
    {
        return $this->hasOne(Seat::className(), ['id' => 'seat_id']);
    }

    /**
     * {@inheritdoc}
     * @return \app\models\queries\SeatBookQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new \app\models\queries\SeatBookQuery(get_called_class());
    }
}
