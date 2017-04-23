<?php

namespace greeschenko\sysmsgs\assets;

use yii\web\AssetBundle;

class HatajsAsset extends AssetBundle
{
    public $sourcePath = '@vendor/greeschenko/hatajs';
    public $js = [
        'web/js/hatajs.min.js',
    ];
}
