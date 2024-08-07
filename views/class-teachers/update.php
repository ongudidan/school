<?php

use yii\helpers\Html;

/** @var yii\web\View $this */
/** @var app\models\ClassTeachers $model */

$this->title = 'Update Class Teachers: ' . $model->class_teahers_id;
$this->params['breadcrumbs'][] = ['label' => 'Class Teachers', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->class_teahers_id, 'url' => ['view', 'class_teahers_id' => $model->class_teahers_id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="class-teachers-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
