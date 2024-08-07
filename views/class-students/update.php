<?php

use yii\helpers\Html;

/** @var yii\web\View $this */
/** @var app\models\ClassStudents $model */

$this->title = 'Update Class Students: ' . $model->class_students_id;
$this->params['breadcrumbs'][] = ['label' => 'Class Students', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->class_students_id, 'url' => ['view', 'class_students_id' => $model->class_students_id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="class-students-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
