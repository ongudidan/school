<?php

use yii\helpers\Html;

/** @var yii\web\View $this */
/** @var app\models\ClassStudents $model */

$this->title = 'Create Class Students';
$this->params['breadcrumbs'][] = ['label' => 'Class Students', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="class-students-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
