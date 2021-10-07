<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "seats_book_time_slots".
 *
 * @property int $id
 * @property string $time_slot_db_key
 * @property string $label
 * @property string $start_time
 * @property string $end_time
 *
 * @property SeatsBook[] $seatsBooks
 */
class SeatBookTimeSlot extends \yii\db\ActiveRecord
{
    const WHOLE_WORKING_DAY_ID = 10;
    const WHOLE_WORKING_DAY_DB_KEY = 'whole_working_day';
    
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'seats_book_time_slots';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['label', 'time_slot_db_key', 'start_time', 'end_time'], 'required'],
            [['time_slot_db_key', 'start_time', 'end_time'], 'safe'],
            [['time_slot_db_key', 'label',], 'string', 'max' => 60],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'label' => Yii::t('app', 'Label'),
            'start_time' => Yii::t('app', 'Start Time'),
            'end_time' => Yii::t('app', 'End Time'),
        ];
    }

    /**
     * Gets query for [[SeatsBooks]].
     *
     * @return \yii\db\ActiveQuery|\app\models\queries\SeatsBookQuery
     */
    public function getSeatsBooks()
    {
        return $this->hasMany(SeatsBook::className(), ['seats_book_time_slots_id' => 'id']);
    }

    /**
     * {@inheritdoc}
     * @return \app\models\queries\SeatBookTimeSlotQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new \app\models\queries\SeatBookTimeSlotQuery(get_called_class());
    }
}
