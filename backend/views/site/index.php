<?php

/* @var $this yii\web\View */

use yii\helpers\Html;
use yii\widgets\ActiveForm;

$this->title = 'My Yii Application';
?>
<div class="site-index">

    <div class="jumbotron text-center bg-transparent">
        <h1 class="display-4">Congratulations!</h1>

        <p class="lead">You have successfully created your Yii-powered application.</p>
        <?php
        $form = ActiveForm::begin([
        'method' => 'get',
        'action' => '/backend/web/site/create',
        'id' => 'btn-form',
        'options' => ['class' => 'form-horizontal'],
        ]) ?>
        <p><?= Html::submitButton('Get Apple tree', ['class' => 'btn-lg btn-success']) ?></p>
        <?php ActiveForm::end() ?>
    </div>

    <div class="body-content">
        <ul>
            <?php foreach ($app as $item): ?>
            <li >
                <div class="apple" style="background: <?= $item['color']; ?>">
                    сколько съели: <?= $item['size']; ?> % |
                    дата появления: <?= date('Y-m-d H:i:s',$item['created_at']); ?>
                    <?php if($item['status'] == 1): ?>
                        | дата падения: <?= date('Y-m-d H:i:s',$item['fall_at']); ?>
                    <?php endif;?>
                    <?php if($item['status'] == 0): ?>
                        | <?= Html::a('Упасть на землю', ['site/fall', 'id' => $item['id']], ['class' => 'profile-link']) ?>
                    <?php endif;?>
                    <?php if($item['status'] == 1): ?>
                        | <?= Html::a('Сесть', ['site/eat', 'id' => $item['id']], ['class' => 'profile-link']) ?>
                    <?php endif;?>
                </div>
            </li>
            <?php endforeach;?>
        </ul>
    </div>
</div>
