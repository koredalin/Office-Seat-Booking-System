<?php

use yii\helpers\Html;

/* @var $this yii\web\View */

$this->title = 'Office-Seat Booking System';
?>
<div class="site-index">

    <div class="jumbotron text-center bg-transparent">
        <h1 class="display-5"><?php echo $this->title; ?></h1>

        <p class="lead">Welcome to our booking system.</p>
        
        <?php echo Html::a('&laquo; Bookings &raquo;', ['/seatbook/index'], ['class' => 'btn btn-lg btn-success']); ?>
    </div>

    <div class="body-content">

        <div class="row">
            <div class="col-lg-4">
                <h2>Employees</h2>

                <p>Employees review.</p>

                <?php echo Html::a('Employees &raquo;', ['/employee/index'], ['class' => 'btn btn-outline-secondary']); ?>
            </div>
            <div class="col-lg-4">
                <h2>Offices</h2>

                <p>Offices review.</p>

                <?php echo Html::a('Offices &raquo;', ['/office/index'], ['class' => 'btn btn-outline-secondary']); ?>
            </div>
            <div class="col-lg-4">
                <h2>Seats</h2>

                <p>Seats review.</p>

                <?php echo Html::a('Seats &raquo;', ['/seat/index'], ['class' => 'btn btn-outline-secondary center-hor']); ?>
            </div>
        </div>

    </div>
</div>
