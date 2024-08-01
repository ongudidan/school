<?php
/**
 * @link https://www.yiiframework.com/
 * @copyright Copyright (c) 2008 Yii Software LLC
 * @license https://www.yiiframework.com/license/
 */

namespace app\assets;

use yii\web\AssetBundle;

/**
 * Main application asset bundle.
 *
 * @author Qiang Xue <qiang.xue@gmail.com>
 * @since 2.0
 */
class DashboardAsset extends AssetBundle
{
    public $basePath = '@webroot';
    public $baseUrl = '@web';
    public $css = [
        // 'css/site.css',
      "/web/dashboard/css/app.min.css",
      "/web/dashboard/css/style.css",
      "/web/dashboard/css/components.css",
      "/web/dashboard/css/custom.css",
    ];
    public $js = [
        "web/dashboard/js/app.min.js",
        "web/dashboard/bundles/chartjs/chart.min.js",
        "web/dashboard/bundles/jquery.sparkline.min.js",
        "web/dashboard/bundles/apexcharts/apexcharts.min.js",
        "web/dashboard/bundles/jqvmap/dist/jquery.vmap.min.js",
        "web/dashboard/bundles/jqvmap/dist/maps/jquery.vmap.world.js",
        "web/dashboard/bundles/jqvmap/dist/maps/jquery.vmap.indonesia.js",
        "web/dashboard/js/page/widget-chart.js",
        "web/dashboard/js/scripts.js",
        "web/dashboard/js/custom.js",
    ];
    public $depends = [
        'yii\web\YiiAsset',
        'yii\bootstrap5\BootstrapAsset'
    ];
}
