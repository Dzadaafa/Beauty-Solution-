<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/** @var yii\web\View $this */
/** @var app\models\TransaksiPembelian $model */

$this->title = $model->id;
$this->params['breadcrumbs'][] = ['label' => 'Transaksi Pembelians', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
\yii\web\YiiAsset::register($this);
?>
<div class="transaksi-pembelian-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Yii::$app->user->identity->role == 'user' ? Html::a('Update', ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) : null?>
    </p>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'id',
            'id_distributor',
            'id_owner',
            'jumlah_bayar',
            'tanggal',
        ],
    ]) ?>

    <h2>Detail</h2>

    <table class="table table-bordered">
            <thead class="table-dark">
                <tr>
                <!-- no | id_pembelian | id_barang | jumlah_barang_masuk | harga_beli  -->
                    <th scope="col">No</th>
                    <th scope="col">ID Pembelian</th>
                    <th scope="col">ID Barang</th>
                    <th scope="col">Jumlah Barang Masuk</th>
                    <th scope="col">Harga Beli</th>
                </tr>
            </thead>
        <?php foreach ($data as $item): ?>
            <tbody>
                <tr scope="row">
                    <td><?= $item['no'] ?></td>
                    <td><?= $item['id_pembelian'] ?></td>
                    <td><?= $item['id_barang'] ?></td>
                    <td><?= $item['jumlah_barang_masuk'] ?></td>
                    <td><?= $item['harga_beli'] ?></td>
                </tr>
            </tbody>
        <?php endforeach; ?>
    </table>

</div>
