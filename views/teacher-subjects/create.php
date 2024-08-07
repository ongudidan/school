<?php

use yii\helpers\Html;

/** @var yii\web\View $this */
/** @var app\models\TeacherSubjects $model */

$this->title = 'Create Teacher Subjects';
$this->params['breadcrumbs'][] = ['label' => 'Teacher Subjects', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="teacher-subjects-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
