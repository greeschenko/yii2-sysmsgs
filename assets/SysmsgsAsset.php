<?php

namespace greeschenko\sysmsgs\assets;

use yii\web\AssetBundle;

class SysmsgsAsset extends AssetBundle
{
    public $sourcePath = '@greeschenko/sysmsgs/web';
    public $css = [
        'css/sysmsgs.min.css',
    ];
    public $js = [
        'js/sysmsgs.min.js',
    ];
    public $depends = [
        'yii\web\JqueryAsset',
        'yii\bootstrap\BootstrapAsset',
        'greeschenko\sysmsgs\assets\FontsAsset',
        'greeschenko\sysmsgs\assets\HatajsAsset',
    ];
}
