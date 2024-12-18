<?php

use app\models\Owner;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\grid\ActionColumn;
use yii\grid\GridView;

/** @var yii\web\View $this */
/** @var app\models\OwnerSearch $searchModel */
/** @var yii\data\ActiveDataProvider $dataProvider */

$this->title = 'Owners';
// $this->params['breadcrumbs'][] = $this->title;
?>
<div class="owner-index">

    <h1><?= Html::encode($this->title) ?></h1>
    
    <p>
        <?= Yii::$app->user->identity->role == 'admin' 
            ? Html::a('Create Owner', ['create'], ['class' => 'btn btn-success']) 
            : null 
        ?>
    </p>

    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => null,//$searchModel,
        // 'options' => [
        //     'class' => ''
        // ],
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'id',
            'nama',
            'alamat',
            'no_telepon',
            [
                'class' => ActionColumn::className(),
                'template' => Yii::$app->user->identity->role == 'admin' ? '{view} {update} {delete}' : '{view}',
                'urlCreator' => function ($action, Owner $model, $key, $index, $column) {
                    return Url::toRoute([$action, 'id' => $model->id]);
                }
            ],
        ],
    ]); ?>


</div>
