<?php

$this->title = 'Архів повідомлень';
$this->params['breadcrumbs'][] = $this->title;
?>
<p class="lead">Архів повідомлень</p>
<div class="sysmsgarcivelist">
    <?php foreach ($data as $one): ?>
    <div class="alert alert-<?=$one->typelist[$one->type]?>">
        <a href="#" class="close" data-id="<?=$one->id?>" data-dismiss="alert" aria-label="close">&times;</a>
        <strong>
            <?=Yii::$app->formatter->asDate($one->created_at, 'medium')?>
        </strong>
            <?=$one->content?>
    </div>
    <?php endforeach; ?>
</div>
