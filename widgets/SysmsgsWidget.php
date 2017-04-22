<?php

namespace greeschenko\sysmsgs\widgets;

use yii\base\Widget;
use yii\helpers\Html;
use greeschenko\sysmsgs\assets\SysmsgsAsset;

class SysmsgsWidget extends Widget
{
    public $id;
    public $groupcode = '';
    public $reselement;
    public $data;
    public $options = [];

    public function init()
    {
        parent::init();
    }

    public function run()
    {
        $options = [
            'id' => $this->getId(),
            'class' => 'sysmsgs',
            'data-res' => $this->reselement,
            'data-group' => $this->groupcode,
        ];

        echo Html::tag('div', '', $options);

        $this->registerClientScript();
    }

    public function registerClientScript()
    {
        $view = $this->getView();
        SysmsgsAsset::register($view);
    }
}
