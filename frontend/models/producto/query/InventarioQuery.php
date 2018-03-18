<?php

namespace frontend\models\producto\query;

/**
 * This is the ActiveQuery class for [[\frontend\models\producto\Inventario]].
 *
 * @see \frontend\models\producto\Inventario
 */
class InventarioQuery extends \yii\db\ActiveQuery
{
    /*public function active()
    {
        return $this->andWhere('[[status]]=1');
    }*/

    /**
     * @inheritdoc
     * @return \frontend\models\producto\Inventario[]|array
     */
    public function all($db = null)
    {
        return parent::all($db);
    }

    /**
     * @inheritdoc
     * @return \frontend\models\producto\Inventario|array|null
     */
    public function one($db = null)
    {
        return parent::one($db);
    }
}
