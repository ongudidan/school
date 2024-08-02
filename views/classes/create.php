<?php

use yii\helpers\Html;

/** @var yii\web\View $this */
/** @var app\models\Classes $model */

$this->title = 'Create Classes';
$this->params['breadcrumbs'][] = ['label' => 'Classes', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="classes-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
