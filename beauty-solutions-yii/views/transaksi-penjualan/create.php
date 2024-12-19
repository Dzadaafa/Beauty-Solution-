<?php

use yii\helpers\Html;

/** @var yii\web\View $this */
/** @var app\models\TransaksiPenjualan $model */

$this->title = 'Create Transaksi Penjualan';
$this->params['breadcrumbs'][] = ['label' => 'Transaksi Penjualans', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="transaksi-penjualan-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
