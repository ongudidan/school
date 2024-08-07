<?php

use app\models\Users;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\grid\GridView;

/** @var yii\web\View $this */
/** @var app\models\UsersSearch $searchModel */
/** @var yii\data\ActiveDataProvider $dataProvider */

$this->title = 'Users';
$this->params['breadcrumbs'][] = $this->title;
?>
<div>
    <div class="card">
        <div class="card-header">
            <h4><?= $this->title?></h4>
            <div class="card-header-action">
                <form method="get" action="<?= Url::to(['index']) ?>">
                    <div class="input-group">
                        <input type="text" name="UsersSearch[username]" class="form-control" placeholder="Search by username" value="<?= Html::encode($searchModel->username) ?>">
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
                            <th>Username</th>
                            <th>Created At</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody class="ui-sortable">
                        <?php foreach ($dataProvider->getModels() as $index => $user) { ?>
                            <tr>
                                <td class="text-center">
                                    <?= $dataProvider->pagination->page * $dataProvider->pagination->pageSize + $index + 1 ?>
                                </td>
                                <td><?= Html::encode($user->username) ?></td>
                                <td><?= Html::encode(Yii::$app->formatter->asDatetime($user->created_at)) ?></td>
                                <td>
                                    <div class="dropdown d-inline">
                                        <button class="btn btn-primary dropdown-toggle" type="button" id="dropdownMenuButton2" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                            Action
                                        </button>
                                        <div class="dropdown-menu" x-placement="top-start" style="position: absolute; transform: translate3d(0px, -133px, 0px); top: 0px; left: 0px; will-change: transform;">
                                            <a class="dropdown-item has-icon" href="<?= Url::to(['users/view', 'user_id' => $user->user_id]) ?>"><i class="far fa-heart"></i> View</a>
                                            <a class="dropdown-item has-icon" href="<?= Url::to(['users/update', 'user_id' => $user->user_id]) ?>"><i class="far fa-file"></i> Update</a>
                                            <a class="dropdown-item has-icon" href="<?= Url::to(['users/delete', 'user_id' => $user->user_id]) ?>"><i class="far fa-clock"></i> Delete</a>
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
                <?= \yii\widgets\LinkPager::widget([
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
