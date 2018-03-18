<?php

use frontend\custom\CHtml;
use yii\data\ActiveDataProvider;

/* @var $this yii\web\View */
/* @var $dataProvider ActiveDataProvider */
/* @var $searchModel \yii\base\Model */
/* @var $gridColumns array */

$this->title = 'My Yii Application';

?>

<?= CHtml::gridView(Yii::t('app', 'Producto'), $dataProvider, $searchModel, $gridColumns); ?>