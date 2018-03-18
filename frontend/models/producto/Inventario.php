<?php

namespace frontend\models\producto;

use Yii;

/**
 * This is the model class for table "PRO_Inventario".
 *
 * @property int $inv_pro_id
 * @property int $inv_sec_id
 * @property int $inv_cantidad
 *
 * @property Producto $producto
 * @property Seccion $seccion
 */
class Inventario extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'PRO_Inventario';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['inv_pro_id', 'inv_sec_id', 'inv_cantidad'], 'required'],
            [['inv_pro_id', 'inv_sec_id', 'inv_cantidad'], 'integer'],
            [['inv_pro_id', 'inv_sec_id'], 'unique', 'targetAttribute' => ['inv_pro_id', 'inv_sec_id']],
            [['inv_pro_id'], 'exist', 'skipOnError' => true, 'targetClass' => Producto::className(), 'targetAttribute' => ['inv_pro_id' => 'pro_id']],
            [['inv_sec_id'], 'exist', 'skipOnError' => true, 'targetClass' => Seccion::className(), 'targetAttribute' => ['inv_sec_id' => 'sec_id']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'inv_pro_id' => Yii::t('frontend', 'Inv Pro ID'),
            'inv_sec_id' => Yii::t('frontend', 'Inv Sec ID'),
            'inv_cantidad' => Yii::t('frontend', 'Inv Cantidad'),
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getProducto()
    {
        return $this->hasOne(Producto::className(), ['pro_id' => 'inv_pro_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getSeccion()
    {
        return $this->hasOne(Seccion::className(), ['sec_id' => 'inv_sec_id']);
    }

    /**
     * @inheritdoc
     * @return \frontend\models\producto\query\InventarioQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new \frontend\models\producto\query\InventarioQuery(get_called_class());
    }
}
