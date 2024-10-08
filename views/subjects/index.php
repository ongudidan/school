<?php

use app\models\Subjects;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\grid\ActionColumn;
use yii\grid\GridView;
use yii\widgets\LinkPager;

/** @var yii\web\View $this */
/** @var app\models\SubjectsSearch $searchModel */
/** @var yii\data\ActiveDataProvider $dataProvider */

$this->title = 'Subjects';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="subjects-index">

    <p>
        <?= Html::a('Create Subjects', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

<div class="card">
        <div class="card-header">
            <h4><?= $this->title ?></h4>
            <div class="card-header-action">
                <form method="get" action="<?= Url::to(['index']) ?>">
                    <div class="input-group">
                        <input type="text" name="SubjectsSearch[globalSearch]" class="form-control" placeholder="Search by subject name" value="<?= Html::encode($searchModel->globalSearch) ?>">
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
                            <th> Name</th>
                            <th>Description</th>
                            <th>Created At</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody class="ui-sortable">
                        <?php foreach ($dataProvider->getModels() as $index => $subject) { ?>
                            <tr>
                                <td class="text-center">
                                    <?= $dataProvider->pagination->page * $dataProvider->pagination->pageSize + $index + 1 ?>
                                </td>
                                <td><?= Html::encode($subject->subject_name) ?></td>
                                <td><?= Html::encode($subject->description) ?></td>
                                <td><?= Html::encode(Yii::$app->formatter->asDatetime($subject->created_at)) ?></td>
                                <td>
                                    <div class="dropdown d-inline">
                                        <button class="btn btn-primary dropdown-toggle" type="button" id="dropdownMenuButton2" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                            Action
                                        </button>
                                        <div class="dropdown-menu" x-placement="top-start" style="position: absolute; transform: translate3d(0px, -133px, 0px); top: 0px; left: 0px; will-change: transform;">
                                            <a class="dropdown-item has-icon" href="<?= Url::to(['subjects/view', 'subject_id' => $subject->subject_id]) ?>"><i class="far fa-heart"></i> View</a>
                                            <a class="dropdown-item has-icon" href="<?= Url::to(['subjects/update', 'subject_id' => $subject->subject_id]) ?>"><i class="far fa-file"></i> Update</a>
                                            <a class="dropdown-item has-icon" href="<?= Url::to(['subjects/delete', 'subject_id' => $subject->subject_id]) ?>"><i class="far fa-clock"></i> Delete</a>
                                        </div>
                                    </div>
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
