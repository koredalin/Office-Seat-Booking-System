<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\jui\DatePicker;
use app\models\SeatBook;

/* @var $this yii\web\View */
/* @var $model app\models\SeatBook */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="seat-book-form">

    <?php $form = ActiveForm::begin(); ?>
    
    <?php
    echo $form->field($model, 'employee_id')->dropDownList($employees, ['prompt' => 'Choose an employee']);
    
    echo $form->field($model, 'officeId')->dropDownList($offices, ['prompt' => 'Choose an office']);
    ?>
    
    <div class="form-group field-seatbook-bookDate">
        <label>Book Date</label>
        <?php
        echo DatePicker::widget([
            'model' => $model,
            'attribute' => 'booking_date',
            //'language' => 'ru',
            'dateFormat' => 'yyyy-MM-dd',
            'options' => ['class' => 'form-control',],
            'inline' => true,
            'clientOptions' => [
                'minDate' => 'today',
                'maxDate' => '+1m',
            ],
        ]);
        ?>
    </div>
    
    <?php
    echo $form->field($model, 'reservationDayTimeSlot')->radioList($dayTimeSlotsItems, ['unselect' => '']);
    
    echo $form->field($model, 'seat_id')->radioList([], ['unselect' => '']);
    ?>

    <?php // $form->field($model, 'seat_id')->textInput() ?>

    <div class="form-group">
        <?= Html::submitButton(Yii::t('app', 'Save'), ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
