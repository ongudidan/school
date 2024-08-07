<?php

use app\models\Subjects;
use app\models\Teachers;
use yii\helpers\ArrayHelper;
use yii\helpers\Html;
use yii\widgets\ActiveForm;

/** @var yii\web\View $this */
/** @var app\models\TeacherSubjects $model */
/** @var yii\widgets\ActiveForm $form */
?>

<div class="teacher-subjects-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'teacher_id')->dropDownList(
          ArrayHelper::map(Teachers::find()->all(), 'teacher_id', 'staff_no'),
          ['prompt' => 'Select Teacher']
    ) ?>

    <?= $form->field($model, 'subject_id')->dropDownList(
          ArrayHelper::map(Subjects::find()->all(), 'subject_id', 'subject_name'),
          ['prompt' => 'Select Subject']
    ) ?>

    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
