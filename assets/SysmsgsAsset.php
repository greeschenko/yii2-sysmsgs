<?php

namespace greeschenko\sysmsgs\assets;

use yii\web\AssetBundle;

class SysmsgsAsset extends AssetBundle
{
    public $sourcePath = '@greeschenko/sysmsgs/web';
    public $css = [
        'css/sysmsgs.css',
    ];
    public $js = [
        'js/sysmsgs.js',
    ];
    public $depends = [
        'yii\web\JqueryAsset',
        'yii\bootstrap\BootstrapAsset',
        'greeschenko\sysmsgs\assets\FontsAsset',
    ];
}
