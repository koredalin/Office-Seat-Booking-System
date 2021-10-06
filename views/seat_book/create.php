<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\SeatBook */

$this->title = Yii::t('app', 'Create Seat Book');
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Seat Books'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="seat-book-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
