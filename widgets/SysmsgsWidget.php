<?php

namespace greeschenko\sysmsgs\widgets;

use yii\base\Widget;
use yii\helpers\Html;
use greeschenko\sysmsgs\assets\SysmsgsAsset;

class SysmsgsWidget extends Widget
{
    public $id;
    public $groupcode;
    public $data;
    public $options = [];

    public function init()
    {
        parent::init();
    }

    public function run()
    {
        echo Html::tag('span',
            Html::tag('i','',['class' => 'fa fa-envelope-o'])
            .' '
            .Html::tag('span',
                Html::tag('i','',['class' => 'fa fa-spinner fa-pulse']),
                ['id' => 'msgcount']),
            ['class' => 'msgbtn']);

        echo Html::tag('div','',[
            'class' => 'sysmsgsres',
            'style' => 'display:none;'
        ]);
        echo Html::tag(
            'div',
            Html::a('Архів повідомлень','/sysmsgs/my/archive'),
            [
                'class' => 'sysmsgsshowall text-center',
                'style' => 'display:none;'
            ]
        );
        echo Html::tag('div','
            <div class="alert alert-{{type}}">
                <a href="#" class="close" data-id="{{id}}" data-dismiss="alert" aria-label="close">&times;</a>
                <strong>{{date}}</strong>
                {{content}}
            </div>
        ',['class' => 'sysmsgsors hidden']);

        $this->registerClientScript();
    }

    public function registerClientScript()
    {
        $view = $this->getView();
        SysmsgsAsset::register($view);
    }
}
