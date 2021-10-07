<?php

namespace app\models\queries;

use app\models\SeatBookTimeSlot;

/**
 * This is the ActiveQuery class for [[\app\models\SeatBook]].
 *
 * @see \app\models\SeatBook
 */
class SeatBookQuery extends \yii\db\ActiveQuery
{
    /*public function active()
    {
        return $this->andWhere('[[status]]=1');
    }*/

    /**
     * {@inheritdoc}
     * @return \app\models\SeatBook[]|array
     */
    public function all($db = null)
    {
        return parent::all($db);
    }

    /**
     * {@inheritdoc}
     * @return \app\models\SeatBook|array|null
     */
    public function one($db = null)
    {
        return parent::one($db);
    }

    /**
     * {@inheritdoc}
     * @return \app\models\SeatBook[]|array
     */
    public function getOfficeReservedSeats(int $officeId, string $bookingDate, int $timeSlotId)
    {
        $timeSlotIds = array_merge([$timeSlotId], [SeatBookTimeSlot::WHOLE_WORKING_DAY_ID]);
        $result = $this->select('seats_book.*')
            ->innerJoin('seats')
            ->where([
                'seats.office_id' => $officeId,
                'booking_date' => $bookingDate,
                'seat_book_time_slot_id' => $timeSlotIds
            ])
            ->all();
//        print_r($result); exit;
        return $result;
    }
}
