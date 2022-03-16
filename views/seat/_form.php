<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\Seat */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="seat-form">

    <?php $form = ActiveForm::begin(); ?>
    
    <?php
    echo $form->field($model, 'office_id')->dropDownList($offices, ['prompt' => 'Choose an office']);

    $ctrlAct = \Yii::$app->controller->id . '-' . \Yii::$app->controller->action->id;
    if (in_array($ctrlAct, ['seat-update',], true)) {
        echo $form->field($model, 'office_seat_id')->textInput(['maxlength' => true]);
    }
    ?>

    <div class="form-group">
        <?= Html::submitButton(Yii::t('app', 'Save'), ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
