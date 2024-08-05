<?php

use app\models\ClassTeachers;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\grid\ActionColumn;
use yii\grid\GridView;

/** @var yii\web\View $this */
/** @var app\models\ClassTeachersSearch $searchModel */
/** @var yii\data\ActiveDataProvider $dataProvider */

$this->title = 'Class Teachers';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="class-teachers-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Create Class Teachers', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'class_teahers_id',
            'class.class_name',
            'teacher.staff_no',
            [
                'class' => ActionColumn::className(),
                'urlCreator' => function ($action, ClassTeachers $model, $key, $index, $column) {
                    return Url::toRoute([$action, 'class_teahers_id' => $model->class_teahers_id]);
                 }
            ],
        ],
    ]); ?>


</div>
