<?php

/** @var yii\web\View $this */

use yii\helpers\Html;

$this->title = 'About';
// $this->params['breadcrumbs'][] = $this->title;
?>
<div class="site-about">
    <h1><?= Html::encode($this->title) ?></h1>

    <table class="table table-bordered">
        <thead class="table-dark">
            <tr>
                <th scope="col">ID</th>
                <th scope="col">Name</th>
                <th scope="col">Alamat</th>
            </tr>
        </thead>
    <?php foreach ($data as $item): ?>
        <tbody>
            <tr scope="row">
                <td><?= $item['id'] ?></td>
                <td><?= $item['nama'] ?></td>
                <td><?= $item['alamat']?></td>
            </tr>
        </tbody>
    <?php endforeach; ?>
</table>

    <code><?= __FILE__ ?></code>
</div>
