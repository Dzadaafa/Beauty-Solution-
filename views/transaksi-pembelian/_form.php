<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/** @var yii\web\View $this */
/** @var app\models\TransaksiPembelian $model */
/** @var yii\widgets\ActiveForm $form */
?>

<div class="transaksi-pembelian-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'id')->textInput() ?>

    <?= $form->field($model, 'id_distributor')->textInput() ?>

    <?= $form->field($model, 'id_owner')->textInput() ?>

    <?= $form->field($model, 'jumlah_bayar')->textInput() ?>

    <?= $form->field($model, 'tanggal')->textInput() ?>

    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
