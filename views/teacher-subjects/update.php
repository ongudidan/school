<?php

use yii\helpers\Html;

/** @var yii\web\View $this */
/** @var app\models\TeacherSubjects $model */

$this->title = 'Update Teacher Subjects: ' . $model->teacher_subject_id;
$this->params['breadcrumbs'][] = ['label' => 'Teacher Subjects', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->teacher_subject_id, 'url' => ['view', 'teacher_subject_id' => $model->teacher_subject_id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="teacher-subjects-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
