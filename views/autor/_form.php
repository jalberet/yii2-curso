<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use app\models\Pais;
use yii\helpers\ArrayHelper;
use kartik\select2\Select2;

/* @var $this yii\web\View */
/* @var $model app\models\Autor */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="autor-form">

    <?php $form = ActiveForm::begin([
        'id' => 'contact-form',
        'enableAjaxValidation' => true,
        'enableClientValidation' => false,
        'options' => [
            'enctype' => 'multipart/form-data'
        ]
    ]); ?>

    <?= $form->field($model, 'nombres')->textInput(['maxlength' => true]) ?>
    
    <?= $form->field($model, 'apellidos')->textInput(['maxlength' => true]) ?>
    
    <?= $form->field($model, 'archivo')->fileInput() ?>
    
    <?=
    $form->field($model, 'pais_id')->widget(Select2::classname(), [
        'data' => ArrayHelper::map(Pais::find()->all(), 'id', 'pais'),
        'options' => ['placeholder' => 'Select a state ...'],
        'pluginOptions' => [
            'allowClear' => true
        ],
    ]);
    ?>

    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
