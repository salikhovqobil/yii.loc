<?php

/** @var yii\web\View $this */

use yii\helpers\Html;

$this->title = Yii::t('app', 'About');
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="site-about">
    <h1><?= Html::encode($this->title) ?></h1>

    <p><?php echo Yii::t('app', 'Hello World!') ?></p>
    <p><?php echo Yii::t('app', 'Hello', '{}') ?></p>

    <code><?= __FILE__ ?></code>
</div>
