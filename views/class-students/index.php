<?php

use app\models\ClassStudents;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\grid\ActionColumn;
use yii\grid\GridView;

/** @var yii\web\View $this */
/** @var app\models\ClassStudentsSearch $searchModel */
/** @var yii\data\ActiveDataProvider $dataProvider */

$this->title = 'Class Students';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="class-students-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Create Class Students', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'class_students_id',
            'class_id',
            'student_id',
            [
                'class' => ActionColumn::className(),
                'urlCreator' => function ($action, ClassStudents $model, $key, $index, $column) {
                    return Url::toRoute([$action, 'class_students_id' => $model->class_students_id]);
                 }
            ],
        ],
    ]); ?>


</div>
