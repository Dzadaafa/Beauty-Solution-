<?php

/** @var yii\web\View $this */

use app\widgets\Alert;

$this->title = 'Beauty Solutions';
?>
<div class="site-index">

    <div class="jumbotron text-center text-dark bg-transparent mt-5 mb-5">
        <h1 class="display-4">Welcome!</h1>
        

        <p class="lead text-dark">You're not good-looking enough? i knew it.</p>

        <?= Yii::$app->user->isGuest ? '<p><a class="btn btn-lg btn-dark" href="/site/login">Get started</a></p>' : null ?>
    </div>

    <div class="body-content">

        <div class="row d-flex flex-wrap flex-row justify-content-center gap-2">
            <div class="col-lg-4 mb-3 bg-light shadow px-4 py-3 rounded">
                <h2>Heading</h2>

                <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et
                    dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip
                    ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu
                    fugiat nulla pariatur.</p>

                <p><a class="btn btn-outline-dark shadow-sm" href="https://www.yiiframework.com/doc/">Yii Documentation &raquo;</a></p>
            </div>
            <div class="col-lg-4 mb-3 bg-light shadow px-4 py-3 rounded">
                <h2>Heading</h2>

                <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et
                    dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip
                    ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu
                    fugiat nulla pariatur.</p>

                <p><a class="btn btn-outline-dark shadow-sm" href="https://www.yiiframework.com/forum/">Yii Forum &raquo;</a></p>
            </div>
            
        </div>

    </div>
</div>
