<?php

use app\models\ClassStudents;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\grid\ActionColumn;
use yii\grid\GridView;
use yii\widgets\LinkPager;

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


<div class="card">
    <div class="card-header">
        <h4>Class students</h4>
        <div class="card-header-action">
            <form method="get" action="<?= Url::to(['index']) ?>">
                <div class="input-group">
                    <input type="text" name="ClassStudentsSearch[globalSearch]" class="form-control" placeholder="Student no | class Name" value="<?= Html::encode($searchModel->globalSearch) ?>">
                    <div class="input-group-btn">
                        <button class="btn btn-primary"><i class="fas fa-search"></i></button>
                    </div>
                </div>
            </form>
        </div>
    </div>
    <div class="card-body p-0">
        <div class="table-responsive">
            <table class="table table-striped" id="sortable-table">
                <thead>
                    <tr>
                        <th class="text-center">#</th>
                        <th>Class Name</th>
                        <th>Student Number</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody class="ui-sortable">
                    <?php foreach($dataProvider->getModels() as $index => $class_student): ?>
                        <tr>
                            <td class="text-center">
                                <?= $dataProvider->pagination->page * $dataProvider->pagination->pageSize + $index + 1 ?>
                            </td>
                            <td><?= Html::encode($class_student->class->class_name) ?></td>
                            <td><?= Html::encode($class_student->student->student_no) ?></td>
                            <td>
                                <div class="dropdown d-inline">
                                    <button class="btn btn-primary dropdown-toggle" type="button" id="dropdownMenuButton2" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                        Action
                                    </button>
                                    <div class="dropdown-menu" aria-labelledby="dropdownMenuButton2">
                                        <a class="dropdown-item has-icon" href="<?= Url::to(['class-students/view', 'class_student_id' => $class_student->class_student_id]) ?>"><i class="far fa-eye"></i> View</a>
                                        <a class="dropdown-item has-icon" href="<?= Url::to(['class-students/update', 'class_student_id' => $class_student->class_student_id]) ?>"><i class="far fa-edit"></i> Update</a>
                                        <a class="dropdown-item has-icon" href="<?= Url::to(['class-students/delete', 'class_student_id' => $class_student->class_student_id]) ?>"><i class="far fa-trash-alt"></i> Delete</a>
                                    </div>
                                </div>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>
    </div>
    <div class="card-footer text-right">
        <nav class="d-inline-block">
            <?= LinkPager::widget([
                'pagination' => $dataProvider->pagination,
                'options' => ['class' => 'pagination mb-0'],
                'linkOptions' => ['class' => 'page-link'],
                'pageCssClass' => 'page-item',
                'prevPageCssClass' => 'page-item',
                'nextPageCssClass' => 'page-item',
                'activePageCssClass' => 'active',
            ]) ?>
        </nav>
    </div>
</div>


</div>
