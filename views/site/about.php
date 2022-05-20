<?php

/** @var yii\web\View $this */

use yii\helpers\Html;

$this->title = 'About';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="site-about">
    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        This is the About page. You may modify the following file to customize its content:
    </p>

    <code><?= __FILE__ ?></code>
</div>

<?= Html::img(
    '@web/img/logo.png', 
    [
        'alt' => 'Mi logotipo',
        'width' => '200px'
    ]
) ?>

<?= Html::a(
    'Perfil',
    [
        'user/ver',
        'id' => 2
    ],
    [
        'class' => 'btn btn-success'
    ]
) ?>

<?= Html::a(
    'Mi web',
    'https://youtube.com',
    [
        'class' => 'btn btn-primary',
        'target' => '_blank'
    ]
) ?>

<?= Html::a(
    Html::img('@web/img/logo.png',
    [
        'alt' => 'Mi logotipo',
        'width' => '200px'
    ]),
    'https://youtube.com',
    [
        'title' => 'Mi web',
        'target' => '_blank'
    ]
)?>