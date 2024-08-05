<?php

use yii\helpers\Html;

/** @var yii\web\View $this */
/** @var app\models\ClassTeachers $model */

$this->title = 'Create Class Teachers';
$this->params['breadcrumbs'][] = ['label' => 'Class Teachers', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="class-teachers-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
