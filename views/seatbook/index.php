<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\widgets\Pjax;
/* @var $this yii\web\View */
/* @var $searchModel app\models\search\SeatBookSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Yii::t('app', 'Seat Books');
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="seat-book-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a(Yii::t('app', 'Create Seat Book'), ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?php Pjax::begin(); ?>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'id',
            [
                'label' => 'Employee Email',
                'attribute' => 'employeeEmail',
                'format' => 'raw',
                'value' => function ($data) {
                    return $data->employee->email;
                },
            ],
            'booking_date',
            [
                'label' => 'Office Name',
                'attribute' => 'officeName',
                'format' => 'raw',
                'value' => function ($data) {
                    return $data->seat->office->office_name;
                },
            ],
            'seat_id',
            [
                'label' => 'Office Seat ID',
                'attribute' => 'officeSeatId',
                'format' => 'raw',
                'value' => function ($data) {
                    return $data->seat->office_seat_id;
                },
            ],
            [
                'label' => 'Seat Book Time Slot',
                'attribute' => 'seatBookTimeSlotLabel',
                'format' => 'raw',
                'value' => function ($data) {
                    return $data->seatBookTimeSlot->label;
                },
            ],
            'created_at',
            'updated_at',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>

    <?php Pjax::end(); ?>
    
    <p><strong>Note: </strong><i>Seat ID</i> is the id in `<i>seats</i>` table. <i>Office Seat ID</i> is just like the name of a single chair in an office-room.</p>

</div>
