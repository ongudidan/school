<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/** @var yii\web\View $this */
/** @var app\models\Teachers $model */

$this->title = $model->teacher_id;
$this->params['breadcrumbs'][] = ['label' => 'Teachers', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
\yii\web\YiiAsset::register($this);
?>
<div class="teachers-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Update', ['update', 'teacher_id' => $model->teacher_id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Delete', ['delete', 'teacher_id' => $model->teacher_id], [
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
            'teacher_id',
            'user_id',
            'first_name',
            'last_name',
            'staff_no',
            'phone',
            'email:email',
            'dob',
            'gender',
            'address:ntext',
            'created_at',
            'updated_at',
        ],
    ]) ?>

</div>
