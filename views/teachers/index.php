<?php

use yii\helpers\Html;
use yii\helpers\Url;
use yii\widgets\LinkPager;

/** @var yii\web\View $this */
/** @var app\models\TeachersSearch $searchModel */
/** @var yii\data\ActiveDataProvider $dataProvider */

$this->title = 'Teachers';
$this->params['breadcrumbs'][] = $this->title;
?>
<div>
    <div class="card">
        <div class="card-header">
            <h4>Teachers</h4>
            <div class="card-header-action">
                <form method="get" action="<?= Url::to(['index']) ?>">
                    <div class="input-group">
                        <input type="text" name="TeachersSearch[staff_no]" class="form-control" placeholder="Search by staff number" value="<?= Html::encode($searchModel->staff_no) ?>">
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
                            <th class="text-center">
                                #
                            </th>
                            <th>Staff number</th>
                            <th>First Name</th>
                            <th>Last Name</th>
                            <th>Email</th>
                            <th>Phone number</th>
                            <th>Created At</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody class="ui-sortable">
                        <?php foreach ($dataProvider->getModels() as $index => $teacher) { ?>
                            <tr>
                                <td class="text-center">
                                    <?= $dataProvider->pagination->page * $dataProvider->pagination->pageSize + $index + 1 ?>
                                </td>
                                <td><?= Html::encode($teacher->staff_no) ?></td>
                                <td><?= Html::encode($teacher->first_name) ?></td>
                                <td><?= Html::encode($teacher->last_name) ?></td>
                                <td><?= Html::encode($teacher->email) ?></td>
                                <td><?= Html::encode($teacher->phone) ?></td>
                                <td><?= Html::encode(Yii::$app->formatter->asDatetime($teacher->created_at)) ?></td>
                                <td>
                                    <a href="<?= Url::to(['teachers/view', 'teacher_id' => $teacher->teacher_id]) ?>" class="btn btn-primary btn-action mr-1" data-toggle="tooltip" title="View"><i class="fas fa-eye"></i></a>
                                    <a href="<?= Url::to(['teachers/update', 'teacher_id' => $teacher->teacher_id]) ?>" class="btn btn-success btn-action mr-1" data-toggle="tooltip" title="Edit"><i class="fas fa-pencil-alt"></i></a>
                                    <a href="<?= Url::to(['teachers/delete', 'teacher_id' => $teacher->teacher_id]) ?>" class="btn btn-danger btn-action" data-toggle="tooltip" title="Delete" data-confirm="Are You Sure?|This action can not be undone. Do you want to continue?" data-confirm-yes="alert('Deleted')"><i class="fas fa-trash"></i></a>
                                </td>
                            </tr>
                        <?php } ?>
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
