<?php

use app\models\TeacherSubjects;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\grid\ActionColumn;
use yii\grid\GridView;

/** @var yii\web\View $this */
/** @var app\models\TeacherSubjectsSearch $searchModel */
/** @var yii\data\ActiveDataProvider $dataProvider */

$this->title = 'Teacher Subjects';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="teacher-subjects-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Create Teacher Subjects', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'teacher_subject_id',
            'teacher_id',
            'subject_id',
            [
                'class' => ActionColumn::className(),
                'urlCreator' => function ($action, TeacherSubjects $model, $key, $index, $column) {
                    return Url::toRoute([$action, 'teacher_subject_id' => $model->teacher_subject_id]);
                 }
            ],
        ],
    ]); ?>


</div>
