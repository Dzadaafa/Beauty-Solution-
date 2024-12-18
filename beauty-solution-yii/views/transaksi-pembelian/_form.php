<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/** @var yii\web\View $this */
/** @var app\models\TransaksiPembelian $model */
/** @var yii\widgets\ActiveForm $form */
?>

<div class="transaksi-pembelian-form">

    <?php $form = ActiveForm::begin(); ?>

    <!--?= $form->field($model, 'id')->textInput() ?-->

    <?= $form->field($model, 'id_distributor')->textInput() ?>

    <?= $form->field($model, 'id_owner')->textInput() ?>

    <?= Html::label('ID Barang', 'id_barang') ?>
    <?= Html::input('number', 'id_barang', '', ['class' => 'form-control', 'id' => 'id_barang', 'min' => 0]) ?>

    <?= Html::label('Jumlah Barang Masuk', 'jumlah_barang_masuk') ?>
    <?= Html::input('number', 'jumlah_barang_masuk', '', ['class' => 'form-control', 'id' => 'jumlah_barang_masuk', 'min' => 1]) ?>

    <?= $form->field($model, 'jumlah_bayar')->textInput() ?>

    <!-- $form->field($model, 'tanggal')->textInput() ?-->

    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
