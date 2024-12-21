<?php

use yii\helpers\Html;

/** @var yii\web\View $this */
/** @var app\models\TransaksiPembelian $model */

$this->title = 'Create Transaksi Pembelian';
$this->params['breadcrumbs'][] = ['label' => 'Transaksi Pembelians', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="transaksi-pembelian-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
        'barang' => $barang,
    ]) ?>

</div>
