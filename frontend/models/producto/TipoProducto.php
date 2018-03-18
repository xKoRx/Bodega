<?php

namespace frontend\models\producto;

use Yii;

/**
 * This is the model class for table "PRO_TipoProducto".
 *
 * @property int $tip_pro_id
 * @property string $tip_pro_nombre
 *
 * @property Producto[] $productos
 */
class TipoProducto extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'PRO_TipoProducto';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['tip_pro_nombre'], 'required'],
            [['tip_pro_nombre'], 'string', 'max' => 45],
            [['tip_pro_nombre'], 'unique'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'tip_pro_id' => Yii::t('frontend', 'Tip Pro ID'),
            'tip_pro_nombre' => Yii::t('frontend', 'Tip Pro Nombre'),
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getProductos()
    {
        return $this->hasMany(Producto::className(), ['pro_tip_pro_id' => 'tip_pro_nombre']);
    }

    /**
     * @inheritdoc
     * @return \frontend\models\producto\query\TipoProductoQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new \frontend\models\producto\query\TipoProductoQuery(get_called_class());
    }
}
