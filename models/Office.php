<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "offices".
 *
 * @property int $id
 * @property int $office_name
 * @property string $created_at
 * @property string $updated_at
 */
class Office extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'offices';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['office_name', 'created_at', 'updated_at'], 'required'],
            [['office_name'], 'integer'],
            [['created_at', 'updated_at'], 'safe'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'office_name' => Yii::t('app', 'Office Name'),
            'created_at' => Yii::t('app', 'Created At'),
            'updated_at' => Yii::t('app', 'Updated At'),
        ];
    }

    /**
     * {@inheritdoc}
     * @return \app\models\queries\OfficeQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new \app\models\queries\OfficeQuery(get_called_class());
    }
}
