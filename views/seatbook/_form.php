<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\jui\DatePicker;
use app\models\SeatBookTimeSlot;

/* @var $this yii\web\View */
/* @var $model app\models\SeatBook */
/* @var $form yii\widgets\ActiveForm */


echo '<script>' . PHP_EOL;
    echo 'let officeSeatsUrl = \'' . \Yii::$app->getUrlManager()->createUrl('seatbook/officeseats') . '\';' . PHP_EOL;
    echo 'let wholeWorkingDayBookId = ' . SeatBookTimeSlot::WHOLE_WORKING_DAY_ID . ';' . PHP_EOL;
echo '</script>' . PHP_EOL;
?>

<div class="seat-book-form">

    <?php $form = ActiveForm::begin(); ?>
    
    <?php
    echo $form->field($model, 'employee_id')->dropDownList($employees, ['prompt' => 'Choose an employee']);

    echo $form->field($model, 'officeId')->dropDownList($offices, ['prompt' => 'Choose an office',]);

    echo $form->field($model, 'booking_date')->widget(DatePicker::classname(), [
        'dateFormat' => 'yyyy-MM-dd',
        'options' => ['class' => 'form-control',],
        'clientOptions' => [
            'minDate' => 'today',
            'maxDate' => '+1m',
            'autoclose' => true,
//            'format' => 'yyyy-MM-dd'
        ],
    ]);
    ?>
    
    <?php
    echo $form->field($model, 'seat_book_time_slot_id')->radioList($dayTimeSlotsItems, ['unselect' => '']);

    echo $form->field($model, 'seat_id')->radioList([], ['unselect' => '']);
    ?>
    <div id="no_office_seats" class="help-block">The office has no seats!</div>

    <?php // $form->field($model, 'seat_id')->textInput() ?>

    <div class="form-group">
        <?= Html::submitButton(Yii::t('app', 'Save'), ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
