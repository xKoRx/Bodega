<?php

namespace frontend\models\producto;

use Yii;

/**
 * This is the model class for table "PRO_Producto".
 *
 * @property int $pro_id
 * @property string $pro_nombre
 * @property int $pro_tip_pro_id
 *
 * @property Inventario[] $inventarios
 * @property Seccion[] $secciones
 * @property TipoProducto $tipoProducto
 */
class Producto extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'PRO_Producto';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['pro_nombre', 'pro_tip_pro_id'], 'required'],
            [['pro_tip_pro_id'], 'integer'],
            [['pro_nombre'], 'string', 'max' => 45],
            [['pro_nombre'], 'unique'],
            [['pro_tip_pro_id'], 'exist', 'skipOnError' => true, 'targetClass' => TipoProducto::className(), 'targetAttribute' => ['pro_tip_pro_id' => 'tip_pro_id']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'pro_id' => Yii::t('app', 'Pro ID'),
            'pro_nombre' => Yii::t('app', 'Nombre Producto'),
            'pro_tip_pro_id' => Yii::t('app', 'Tipo Producto'),
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getInventarios()
    {
        return $this->hasMany(Inventario::className(), ['inv_pro_id' => 'pro_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getSecciones()
    {
        return $this->hasMany(Seccion::className(), ['sec_id' => 'inv_sec_id'])->viaTable('PRO_Inventario', ['inv_pro_id' => 'pro_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getTipoProducto()
    {
        return $this->hasOne(TipoProducto::className(), ['tip_pro_id' => 'pro_tip_pro_id']);
    }

    /**
     * @inheritdoc
     * @return \frontend\models\producto\query\ProductoQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new \frontend\models\producto\query\ProductoQuery(get_called_class());
    }
}
