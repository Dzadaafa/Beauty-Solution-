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

</div>
