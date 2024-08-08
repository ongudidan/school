<?php

/** @var yii\web\View $this */
/** @var yii\bootstrap5\ActiveForm $form */

/** @var app\models\LoginForm $model */

use yii\bootstrap5\ActiveForm;

$this->title = 'Login';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="site-login">

    <div id="app">
        <div id="app">
            <section class="section">
                <div class="container mt-5">
                    <div class="row">
                        <div class="col-12 col-sm-8 offset-sm-2 col-md-6 offset-md-3 col-lg-6 offset-lg-3 col-xl-4 offset-xl-4">
                            <div class="card card-primary">
                                <div class="card-header">
                                    <h4><?= $this->title?></h4>
                                </div>
                                <div class="card-body">
                                    <?php $form = ActiveForm::begin()?>
                                        <div class="form-group">

                                            <?= $form->field($model, 'username')->textInput(['autofocus' => true]) ?>

                                        </div>
                                        <div class="form-group">

                                            <?= $form->field($model, 'password')->passwordInput() ?>

                                        </div>
                                        <div class="form-group">
                                            <div class="custom-control custom-checkbox">
                                                <?= $form->field($model, 'rememberMe')->checkbox([
                                                    'template' => "<div class=\"custom-control custom-checkbox\">{input} {label}</div>\n<div class=\"col-lg-8\">{error}</div>",
                                                ]) ?>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <button type="submit" class="btn btn-primary btn-lg btn-block" tabindex="4">
                                                Login
                                            </button>
                                        </div>
                                    <?php ActiveForm::end()?>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </section>
        </div>
    </div>
</div>