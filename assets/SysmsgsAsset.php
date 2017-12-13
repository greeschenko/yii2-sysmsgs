<?php

namespace greeschenko\sysmsgs\assets;

use yii\web\AssetBundle;

class SysmsgsAsset extends AssetBundle
{
    public $sourcePath = '@greeschenko/sysmsgs/web';
    public $css = [
        'css/sysmsgs.min.css?v=0.0.1',
    ];
    public $js = [
        'js/sysmsgs.min.js?v=0.0.2',
    ];
    public $depends = [
        'yii\web\JqueryAsset',
        'yii\bootstrap\BootstrapAsset',
        'greeschenko\sysmsgs\assets\FontsAsset',
        'greeschenko\sysmsgs\assets\HatajsAsset',
    ];
}
