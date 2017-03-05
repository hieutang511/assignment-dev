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

    <h2>The List</h2>
    <table id="myTable" class="display" cellspacing="0" width="100%">
        <thead>
            <tr>
                <th>Player Id</th>
                <th>Aggregated Orders</th>
            </tr>
        </thead>
    </table>
</div>
