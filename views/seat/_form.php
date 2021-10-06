<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\Seat */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="seat-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'office_id')->textInput() ?>

    <?= $form->field($model, 'office_seat_id')->textInput() ?>

    <div class="form-group">
        <?= Html::submitButton(Yii::t('app', 'Save'), ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
