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
            'attribute' => 'bookDate',
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
    echo $form->field($model, 'reservationTimeType')->radioList([SeatBook::PART_DAY_RESERVATION => 'Part day reservation', SeatBook::WHOLE_DAY_RESERVATION => 'Whole day reservation',], ['unselect' => '']);
    
    $checkboxItems = [];
    foreach (SeatBook::RESERVATION_DAY_TIME_SLOTS as $slot => $slotInfo) {
        $checkboxItems[$slot] = trim($slotInfo['label'] ?? '');
    }
    echo $form->field($model, 'reservationDayTimeSlots')->checkboxList($checkboxItems, []);
    ?>

    <?= $form->field($model, 'seat_id')->textInput() ?>

    <?= $form->field($model, 'start_time')->textInput() ?>

    <?= $form->field($model, 'end_time')->textInput() ?>

    <div class="form-group">
        <?= Html::submitButton(Yii::t('app', 'Save'), ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
