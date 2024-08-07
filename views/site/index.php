<?php

/** @var yii\web\View $this */

$this->title = 'My Yii Application';

$items = [
    ['title' => 'Total Students', 'count' => number_format($students_count), 'image' => '/assets/img/banner/1.png'],
    ['title' => 'Total Teachers', 'count' => number_format($teachers_count), 'image' => '/assets/img/banner/2.png'],
    ['title' => 'Total Classes', 'count' => number_format($classes_count), 'image' => '/assets/img/banner/3.png'],
    ['title' => 'Total Subjects', 'count' => number_format($subjects_count), 'image' => '/assets/img/banner/4.png'],
];
?>

<div class="row ">
    <?php foreach ($items as $item) { ?>
        <div class="col-xl-3 col-lg-6 col-md-6 col-sm-6 col-xs-12">
            <div class="card">
                <div class="card-statistic-4">
                    <div class="align-items-center justify-content-between">
                        <div class="row ">
                            <div class="col-lg-6 col-md-6 col-sm-6 col-xs-6 pr-0 pt-3">
                                <div class="card-content">
                                    <h5 class="font-15"><?= $item['title'] ?></h5>
                                    <h2 class="mb-3 font-18"><?= $item['count'] ?></h2>
                                </div>
                            </div>
                            <div class="col-lg-6 col-md-6 col-sm-6 col-xs-6 pl-0">
                                <div class="banner-img">
                                    <img src="<?= $item['image'] ?>" alt="">
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    <?php } ?>
</div>