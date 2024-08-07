<?php

use app\models\Classes;
use app\models\Teachers;
use yii\helpers\ArrayHelper;
use yii\helpers\Html;
use yii\widgets\ActiveForm;

/** @var yii\web\View $this */
/** @var app\models\ClassTeachers $model */
/** @var yii\widgets\ActiveForm $form */
?>

<div class="class-teachers-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'class_id')->dropDownList(
          ArrayHelper::map(Classes::find()->all(), 'class_id', 'class_name'),
          ['prompt' => 'Select Class']
    ) ?>

    <?= $form->field($model, 'teacher_id')->dropDownList(
         ArrayHelper::map(Teachers::find()->all(), 'teacher_id', 'staff_no'),
         ['prompt' => 'Select Teacher']
    ) ?>

    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
