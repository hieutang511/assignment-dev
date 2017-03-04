<?php

/* @var $this yii\web\View */

$this->title = 'Dashboard';
?>
<div class="site-index">
    <div class="btn-group" role="group" aria-label="...">
        <button id='barBtn' type="button" class="btn btn-primary">Bar chart</button>
        <button id='lineBtn' type="button" class="btn btn-primary">Line chart</button>
    </div>
    <canvas id="myChart"></canvas>

</div>
