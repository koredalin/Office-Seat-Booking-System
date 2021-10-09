<?php

namespace app\models;

use Yii;
use app\models\Office;
use app\models\SeatBook;

/**
 * This is the model class for table "seats".
 *
 * @property int $id
 * @property int $office_id
 * @property int $office_seat_id
 * @property string $created_at
 * @property string $updated_at
 */
class Seat extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName(): string
    {
        return 'seats';
    }

    /**
     * {@inheritdoc}
     */
    public function rules(): array
    {
        return [
            [['office_id', 'office_seat_id', 'created_at', 'updated_at'], 'required'],
            [['office_id', 'office_seat_id'], 'integer'],
            [['created_at', 'updated_at'], 'safe'],
            [['office_id', 'office_seat_id'], 'unique', 'targetAttribute' => ['office_id', 'office_seat_id']], 
            [['office_id'], 'exist', 'skipOnError' => true, 'targetClass' => Office::className(), 'targetAttribute' => ['office_id' => 'id']], 
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels(): array
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'office_id' => Yii::t('app', 'Office ID'),
            'office_seat_id' => Yii::t('app', 'Office Seat ID'),
            'created_at' => Yii::t('app', 'Created At'),
            'updated_at' => Yii::t('app', 'Updated At'),
        ];
    }

    /**
     * Gets query for [[Office]].
     *
     * @return \yii\db\ActiveQuery|\app\models\queries\OfficesQuery
     */
    public function getOffice()
    {
        return $this->hasOne(Office::className(), ['id' => 'office_id']);
    }

    /**
     * Gets query for [[SeatBook]].
     *
     * @return \yii\db\ActiveQuery|\app\models\queries\SeatBookQuery
     */
    public function getSeatsBook()
    {
        return $this->hasMany(SeatBook::className(), ['seat_id' => 'id']);
    }

    /**
     * {@inheritdoc}
     * @return \app\models\queries\SeatQuery the active query used by this AR class.
     */
    public static function find(): \app\models\queries\SeatQuery
    {
        return new \app\models\queries\SeatQuery(get_called_class());
    }
}
