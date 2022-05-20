<?php

use yii\helpers\Html;
use yii\helpers\Url;
use yii\grid\ActionColumn;
use yii\grid\GridView;
use app\models\Pais;
//use kartik\alert\AlertBlock;
use kartik\growl\Growl;

/* @var $this yii\web\View */
/* @var $searchModel app\models\PaisSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Pais';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="pais-index">
    <?php
//    AlertBlock::widget([
//        'type' => AlertBlock::TYPE_ALERT,
//        'useSessionFlash' => true,
//        'delay' => 3000,
//    ]);
        if(Yii::$app->session->getFlash("success")){
            echo Growl::widget([
                'type' => Growl::TYPE_SUCCESS,
                'title' => 'Registro exitoso',
                'icon' => 'fas fa-check-circle',
                'body' => Yii::$app->session->getFlash("success"),
                'showSeparator' => true,
                'delay' => 1000,
                'pluginOptions' => [
                    'showProgressbar' => true,
                    'placement' => [
                        'from' => 'top',
                        'align' => 'right',
                    ]
                ]
            ]);
        }elseif(Yii::$app->session->getFlash("error")){
            echo Growl::widget([
                'type' => Growl::TYPE_DANGER,
                'title' => 'No se realizó el registro',
                'icon' => 'fas fa-times-circle',
                'body' => Yii::$app->session->getFlash('error'),
                'showSeparator' => true,
                'delay' => 4500,
                'pluginOptions' => [
                    'showProgressbar' => true,
                    'placement' => [
                        'from' => 'top',
                        'align' => 'right',
                    ]
                ]
            ]);
        }
    ?>
    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Create Pais', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'id',
            'pais',
            'slug',
            [
                'attribute' => 'created_by',
                'value' => 'createdBy.username',
                'label' => 'Creado por',
                'format' => 'raw',
            ],
            'created_at:datetime',
            //'updated_by',
            //'updated_at',
            [
                'class' => ActionColumn::className(),
                'urlCreator' => function ($action, Pais $model, $key, $index, $column) {
                    return Url::toRoute([$action, 'id' => $model->id]);
                 }
            ],
        ],
    ]); ?>


</div>
