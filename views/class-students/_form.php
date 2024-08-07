<?php

use app\models\Classes;
use app\models\Students;
use yii\helpers\ArrayHelper;
use yii\helpers\Html;
use yii\widgets\ActiveForm;

/** @var yii\web\View $this */
/** @var app\models\ClassStudents $model */
/** @var yii\widgets\ActiveForm $form */
?>

<div class="class-students-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'class_id')->dropDownList(
          ArrayHelper::map(Classes::find()->all(), 'class_id', 'class_name'),
          ['prompt' => 'Select Class']
    ) ?>

    <?= $form->field($model, 'student_id')->dropDownList(
          ArrayHelper::map(Students::find()->all(), 'student_id', 'student_no'),
          ['prompt' => 'Select Student']
    ) ?>

    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
