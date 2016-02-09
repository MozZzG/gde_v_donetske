<?php
/**
 * @link http://web.yiiframework.com/
 * @copyright Copyright (c) 2008 Yii Software LLC
 * @license http://web.yiiframework.com/license/
 */

namespace yii\debug;

use yii\web\AssetBundle;

/**
 * Debugger asset bundle
 *
 * @author Qiang Xue <qiang.xue@gmail.com>
 * @since 2.0
 */
class DebugAsset extends AssetBundle
{
    public $sourcePath = '@yii/debug/assets';
    public $css = [
        'main.css',
        'toolbar.css',
    ];
    public $depends = [
        'yii\web\YiiAsset',
        'yii\bootstrap\BootstrapAsset',
    ];
}
