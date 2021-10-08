<?php

namespace app\models;

use Yii;
use app\models\Employee;
use app\models\Seat;
use app\models\SeatBookTimeSlot;

/**
 * This is the model class for table "seats_book".
 *
 * @property int $id
 * @property int $employee_id
 * @property string $booking_date
 * @property int $seat_id
 * @property int $seat_book_time_slot_id
 * @property string $created_at
 * @property string $updated_at
 *
 * @property Employees $employee
 * @property Seats $seat
 * @property SeatsBookTimeSlots $seatBookTimeSlot
 */
class SeatBook extends \yii\db\ActiveRecord
{
    public int $officeId = 0;
//    public string $bookDate = '';
//    const PART_DAY_BOOK = 'part_day';
//    const WHOLE_DAY_BOOK = 'whole_day';
//    public int $reservationDayTimeSlot = 0;
    
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
            [['employee_id', 'booking_date', 'seat_id', 'seat_book_time_slot_id', 'created_at', 'updated_at'], 'required'],
            [['employee_id', 'officeId', 'seat_id', 'seat_book_time_slot_id'], 'integer'],
            [['booking_date', 'created_at', 'updated_at'], 'safe'],
            [['seat_id', 'seat_book_time_slot_id'], 'unique', 'targetAttribute' => ['seat_id', 'seat_book_time_slot_id']],
            [['employee_id'], 'exist', 'skipOnError' => true, 'targetClass' => Employee::className(), 'targetAttribute' => ['employee_id' => 'id']],
            [['seat_id'], 'exist', 'skipOnError' => true, 'targetClass' => Seat::className(), 'targetAttribute' => ['seat_id' => 'id']],
            [['seat_book_time_slot_id'], 'exist', 'skipOnError' => true, 'targetClass' => SeatBookTimeSlot::className(), 'targetAttribute' => ['seat_book_time_slot_id' => 'id']],
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
            'booking_date' => Yii::t('app', 'Booking Date'),
            'seat_id' => Yii::t('app', 'Seat ID'),
            'seat_book_time_slot_id' => Yii::t('app', 'Seat Book Time Slot ID'),
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
     * Gets query for [[SeatBookTimeSlot]].
     *
     * @return \yii\db\ActiveQuery|\app\models\queries\SeatBookTimeSlotQuery
     */
    public function getSeatBookTimeSlot()
    {
        return $this->hasOne(SeatBookTimeSlot::className(), ['id' => 'seat_book_time_slot_id']);
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
