<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/** @var yii\web\View $this */
/** @var app\models\Attendance $model */

$this->title = $model->attendance_id;
$this->params['breadcrumbs'][] = ['label' => 'Attendances', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
\yii\web\YiiAsset::register($this);
?>
<div class="attendance-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Update', ['update', 'attendance_id' => $model->attendance_id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Delete', ['delete', 'attendance_id' => $model->attendance_id], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => 'Are you sure you want to delete this item?',
                'method' => 'post',
            ],
        ]) ?>
    </p>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'attendance_id',
            'student_id',
            'class_id',
            'date',
            'status',
            'created_at',
            'updated_at',
        ],
    ]) ?>

</div>
