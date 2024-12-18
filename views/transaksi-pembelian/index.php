<?php

use app\models\TransaksiPembelian;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\grid\ActionColumn;
use yii\grid\GridView;

/** @var yii\web\View $this */
/** @var app\models\TransaksiPembelianSearch $searchModel */
/** @var yii\data\ActiveDataProvider $dataProvider */

$this->title = 'Transaksi Pembelian';
// $this->params['breadcrumbs'][] = $this->title;
?>
<div class="transaksi-pembelian-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Yii::$app->user->identity->role == 'user' 
            ? Html::a('Tambah Transaksi', ['create'], ['class' => 'btn btn-success']) 
            : null 
        ?>
    </p>

    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'id',
            'id_distributor',
            'id_owner',
            'jumlah_bayar',
            'tanggal',
            [
                'class' => ActionColumn::className(),
                'template' => Yii::$app->user->identity->role == 'user' ? '{view} {update}' : '{view}',
                'urlCreator' => function ($action, TransaksiPembelian $model, $key, $index, $column) {
                    return Url::toRoute([$action, 'id' => $model->id]);
                }
            ],
        ],
    ]); ?>


</div>
