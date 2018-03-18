<?php

namespace frontend\models\perfilamiento\query;

/**
 * This is the ActiveQuery class for [[\frontend\models\perfilamiento\Perfil]].
 *
 * @see \frontend\models\perfilamiento\Perfil
 */
class PerfilQuery extends \yii\db\ActiveQuery
{
    /*public function active()
    {
        return $this->andWhere('[[status]]=1');
    }*/

    /**
     * @inheritdoc
     * @return \frontend\models\perfilamiento\Perfil[]|array
     */
    public function all($db = null)
    {
        return parent::all($db);
    }

    /**
     * @inheritdoc
     * @return \frontend\models\perfilamiento\Perfil|array|null
     */
    public function one($db = null)
    {
        return parent::one($db);
    }
}
