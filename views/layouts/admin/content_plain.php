<?php
use yii\widgets\Breadcrumbs;
use dmstr\widgets\Alert;

?>

<section class="content-header">
    <?php if (isset($this->blocks['content-header'])) { ?>
        <h1><?= $this->blocks['content-header'] ?></h1>
    <?php } else { ?>
        <h1>
            <?php
            if ($this->title !== null) {
                echo \yii\helpers\Html::encode($this->title);
            } else {
                echo \yii\helpers\Inflector::camel2words(
                    \yii\helpers\Inflector::id2camel($this->context->module->id)
                );
                echo ($this->context->module->id !== \Yii::$app->id) ? '<small>Module</small>' : '';
            } ?>
        </h1>
    <?php } ?>
</section>
<style>
    .wrapper section.content .box h1:first-child {display:none;}
    .wrapper section.content .box .box-body>div>p {padding-bottom: 1em;}
</style>
<section class="content">
    <?= Alert::widget() ?>
    <div class="shop-category-form">
        <div class="box">
            <div class="box-body">
                <?= $content ?>
            </div>
        </div>
    </div>
</section>
