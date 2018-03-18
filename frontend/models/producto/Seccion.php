<?php

namespace frontend\models\producto;

use Yii;

/**
 * This is the model class for table "PRO_Seccion".
 *
 * @property int $sec_id
 * @property string $sec_nombre
 *
 * @property Inventario[] $inventarios
 * @property Producto[] $productos
 */
class Seccion extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'PRO_Seccion';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['sec_nombre'], 'string', 'max' => 45],
            [['sec_nombre'], 'unique'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'sec_id' => Yii::t('frontend', 'ID'),
            'sec_nombre' => Yii::t('frontend', 'Sec Nombre'),
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getInventarios()
    {
        return $this->hasMany(Inventario::className(), ['inv_sec_id' => 'sec_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getProductos()
    {
        return $this->hasMany(Producto::className(), ['pro_id' => 'inv_pro_id'])->viaTable('PRO_Inventario', ['inv_sec_id' => 'sec_id']);
    }

    /**
     * @inheritdoc
     * @return \frontend\models\producto\query\SeccionQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new \frontend\models\producto\query\SeccionQuery(get_called_class());
    }
}
