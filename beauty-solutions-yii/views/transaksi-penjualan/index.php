<?php

use app\models\TransaksiPenjualan;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\grid\ActionColumn;
use yii\grid\GridView;

/** @var yii\web\View $this */
/** @var app\models\TransaksiPenjualanSearch $searchModel */
/** @var yii\data\ActiveDataProvider $dataProvider */

$this->title = 'Transaksi Penjualan';
// $this->params['breadcrumbs'][] = $this->title;
?>
<div class="transaksi-penjualan-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Yii::$app->user->identity->role == 'admin' 
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
            'id_owner',
            'tanggal',
            [
                'class' => ActionColumn::className(),
                'urlCreator' => function ($action, TransaksiPenjualan $model, $key, $index, $column) {
                    return Url::toRoute([$action, 'id' => $model->id]);
                }
            ],
        ],
    ]); ?>


</div>
