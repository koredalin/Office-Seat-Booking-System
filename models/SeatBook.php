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
    public int $officeId = 0;
    public string $bookDate = '';
    const PART_DAY_RESERVATION = 'part_day';
    const WHOLE_DAY_RESERVATION = 'whole_day';
    public string $reservationTimeType = '';
    const RESERVATION_DAY_TIME_SLOTS = [
        '8:00-8:59' => [
            'label' => '8:00-8:59',
            'timeStart' => '8:00:00',
            'timeEnd' => '8:59:59',
        ],
        '9:00-9:59' => [
            'label' => '9:00-9:59',
            'timeStart' => '9:00:00',
            'timeEnd' => '9:59:59',
        ],
        '10:00-10:59' => [
            'label' => '10:00-10:59',
            'timeStart' => '10:00:00',
            'timeEnd' => '10:59:59',
        ],
        '11:00-11:59' => [
            'label' => '11:00-11:59',
            'timeStart' => '11:00:00',
            'timeEnd' => '11:59:59',
        ],
        '12:00-12:59' => [
            'label' => '12:00-12:59',
            'timeStart' => '12:00:00',
            'timeEnd' => '12:59:59',
        ],
        '13:00-13:59' => [
            'label' => '13:00-13:59',
            'timeStart' => '13:00:00',
            'timeEnd' => '13:59:59',
        ],
        '14:00-14:59' => [
            'label' => '14:00-14:59',
            'timeStart' => '14:00:00',
            'timeEnd' => '14:59:59',
        ],
        '15:00-15:59' => [
            'label' => '15:00-15:59',
            'timeStart' => '15:00:00',
            'timeEnd' => '15:59:59',
        ],
        '16:00-16:59' => [
            'label' => '16:00-16:59',
            'timeStart' => '16:00:00',
            'timeEnd' => '16:59:59',
        ],
    ];
    public array $reservationDayTimeSlots = [];
    
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
            [['employee_id', 'officeId', 'seat_id'], 'integer'],
            [['bookDate', 'reservationTimeType', 'start_time', 'end_time', 'created_at', 'updated_at'], 'safe'],
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
