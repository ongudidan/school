<?php

use app\models\Attendance;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\grid\ActionColumn;
use yii\grid\GridView;

/** @var yii\web\View $this */
/** @var app\models\AttendanceSearch $searchModel */
/** @var yii\data\ActiveDataProvider $dataProvider */

$this->title = 'Attendances';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="attendance-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Create Attendance', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'attendance_id',
            'student_id',
            'class_id',
            'date',
            'status',
            //'created_at',
            //'updated_at',
            [
                'class' => ActionColumn::className(),
                'urlCreator' => function ($action, Attendance $model, $key, $index, $column) {
                    return Url::toRoute([$action, 'attendance_id' => $model->attendance_id]);
                 }
            ],
        ],
    ]); ?>


</div>
