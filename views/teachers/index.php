<?php

use app\models\Teachers;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\widgets\LinkPager;
use yii\widgets\Pjax;

/** @var yii\web\View $this */
/** @var app\models\TeachersSearch $searchModel */
/** @var yii\data\ActiveDataProvider $dataProvider */

$this->title = 'Teachers';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="teachers-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Create Teachers', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <div class="col-12 col-md-12 col-lg-12">
        <div class="card">
            <div class="card-header">
                <h4>TEACHERS</h4>
            </div>
            <div class="card-body p-0">
                <div class="table-responsive">
                    <table class="table table-striped table-md">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>First Name</th>
                                <th>Last Name</th>
                                <th>DOB</th>
                                <th>Gender</th>
                                <th>Address</th>
                                <th>Created At</th>
                                <th>Updated At</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            Pjax::begin();
                            $counter = $pagination->offset + 1;
                            foreach ($teachers as $teacher) { ?>
                                <tr>
                                    <td><?= $counter . '.' ?></td>
                                    <td><?= Html::encode($teacher->first_name) ?></td>
                                    <td><?= Html::encode($teacher->last_name) ?></td>
                                    <td><?= Html::encode($teacher->dob) ?></td>
                                    <td><?= Html::encode($teacher->gender) ?></td>
                                    <td><?= Html::encode($teacher->address) ?></td>
                                    <td><?= Html::encode(date('Y-m-d', strtotime($teacher->created_at))) ?></td>
                                    <td><?= Html::encode(date('Y-m-d', strtotime($teacher->updated_at))) ?></td>
                                    <td>
                                        <a href="<?= Url::to(['teachers/view', 'teacher_id' => $teacher->teacher_id]) ?>" id="view" class="btn btn-primary btn-action mr-1" data-toggle="tooltip" title="View"><i class="fas fa-eye"></i></a>
                                        <a href="<?= Url::to(['teachers/update', 'teacher_id' => $teacher->teacher_id]) ?>" id="edit" class="btn btn-success btn-action mr-1" data-toggle="tooltip" title="Edit"><i class="fas fa-pencil-alt"></i></a>
                                        <a href="<?= Url::to(['teachers/delete', 'teacher_id' => $teacher->teacher_id]) ?>" id="delete" class="btn btn-danger btn-action" data-toggle="tooltip" title="Delete" data-confirm="Are you sure? This action cannot be undone." data-method="post"><i class="fas fa-trash"></i></a>
                                    </td>
                                </tr>
                            <?php
                                $counter++;
                            }
                            Pjax::end();
                            ?>
                        </tbody>
                    </table>
                </div>
            </div>
            <div class="card-footer text-right">
                <nav class="d-inline-block">
                    <?= LinkPager::widget([
                        'pagination' => $pagination,
                        'options' => ['class' => 'pagination mb-0'],
                        'linkOptions' => ['class' => 'page-link'],
                        'pageCssClass' => 'page-item',
                        'prevPageCssClass' => 'page-item',
                        'nextPageCssClass' => 'page-item',
                        'firstPageCssClass' => 'page-item',
                        'lastPageCssClass' => 'page-item',
                        'activePageCssClass' => 'active',
                        'disabledPageCssClass' => 'disabled',
                    ]) ?>
                </nav>
            </div>
        </div>
    </div>
</div>
