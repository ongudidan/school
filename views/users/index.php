<?php

use app\models\Users;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\grid\ActionColumn;
use yii\grid\GridView;
use yii\widgets\LinkPager;

/** @var yii\web\View $this */
/** @var app\models\UsersSearch $searchModel */
/** @var yii\data\ActiveDataProvider $dataProvider */

$this->title = 'Users';
$this->params['breadcrumbs'][] = $this->title;
?>
<div>

    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <div class="col-12 col-md-12 col-lg-12">
        <div class="card">
            <div class="card-header">
                <h4>USERS</h4>
            </div>
            <div class="card-body p-0">
                <div class="table-responsive">
                    <table class="table table-striped table-md">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>Username</th>
                                <th>Role</th>
                                <th>Email</th>
                                <th>Phone</th>
                                <th>Created At</th>
                                <th>Updated At</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            $counter = $pagination->offset + 1;
                            foreach ($users as $user) { ?>
                                <tr>
                                    <td><?= $counter ?></td>
                                    <td><?= Html::encode($user->username) ?></td>
                                    <td><?= Html::encode($user->role) ?></td>
                                    <td><?= Html::encode($user->email) ?></td>
                                    <td><?= Html::encode($user->phone) ?></td>
                                    <td><?= Html::encode(date('Y-m-d', strtotime($user->created_at))) ?></td>
                                    <td><?= Html::encode(date('Y-m-d', strtotime($user->updated_at))) ?></td>
                                    <td>
                                        <a href="<?= Url::to(['users/view', 'user_id' => $user->user_id]) ?>" class="btn btn-primary btn-action mr-1" data-toggle="tooltip" title="View"><i class="fas fa-eye"></i></a>
                                        <a href="<?= Url::to(['users/update', 'user_id' => $user->user_id]) ?>" class="btn btn-success btn-action mr-1" data-toggle="tooltip" title="Edit"><i class="fas fa-pencil-alt"></i></a>
                                        <a href="<?= Url::to(['users/delete', 'user_id' => $user->user_id]) ?>" class="btn btn-danger btn-action" data-toggle="tooltip" title="Delete" data-confirm="Are you sure? This action cannot be undone." data-method="post"><i class="fas fa-trash"></i></a>
                                    </td>
                                </tr>
                            <?php
                                $counter++;
                            } ?>
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
