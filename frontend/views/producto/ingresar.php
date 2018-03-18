<?php

use frontend\custom\CHtml;

/* @var $this yii\web\View */
/* @var $producto \frontend\models\producto\Producto */

$this->title = 'My Yii Application';

?>

<?= CHtml::beginForm(['/producto/crear'], 'post', ['id' => 'productoForm']); ?>

    <div class="col-md-6 text-left">
        <label class="titulo"><?= $producto->attributeLabels()['pro_nombre'] ?></label>
    </div>
    <div class="col-md-6">
        <?= CHtml::input('text', 'producto[pro_nombre]', null, ['class' => 'form-control form-control-correccion']); ?>
    </div>

    <div class="col-md-6 text-left">
        <label class="titulo"><?= $producto->attributeLabels()['pro_tip_pro_id'] ?></label>
    </div>
    <div class="col-md-6">
        <?= CHtml::input('text', 'producto[pro_tip_pro_id]', null, ['class' => 'form-control form-control-correccion']); ?>
    </div>

    <div class="col-md-12 text-center">
        <?= CHtml::submitButton('Guardar', ['id' => 'btnSave']); ?>
    </div>

<?= CHtml::endForm(); ?>