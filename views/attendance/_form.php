<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/** @var yii\web\View $this */
/** @var app\models\Attendance $model */
/** @var yii\widgets\ActiveForm $form */
?>

<div class="attendance-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'student_id')->textInput() ?>

    <?= $form->field($model, 'class_id')->textInput() ?>

    <?= $form->field($model, 'date')->textInput() ?>

    <?= $form->field($model, 'status')->textInput(['maxlength' => true]) ?>

    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>
    

</div>
