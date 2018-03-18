<?php

namespace frontend\models\perfilamiento;

use Yii;

/**
 * This is the model class for table "PER_Perfil".
 *
 * @property int $per_id
 * @property string $per_nombre
 */
class Perfil extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'PER_Perfil';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['per_nombre'], 'required'],
            [['per_nombre'], 'string', 'max' => 45],
            [['per_nombre'], 'unique'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'per_id' => Yii::t('frontend', 'Per ID'),
            'per_nombre' => Yii::t('frontend', 'Per Nombre'),
        ];
    }

    /**
     * @inheritdoc
     * @return \frontend\models\perfilamiento\query\PerfilQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new \frontend\models\perfilamiento\query\PerfilQuery(get_called_class());
    }
}
