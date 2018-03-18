<?php

namespace frontend\models\producto\query;

/**
 * This is the ActiveQuery class for [[\frontend\models\producto\Producto]].
 *
 * @see \frontend\models\producto\Producto
 */
class ProductoQuery extends \yii\db\ActiveQuery
{
    /*public function active()
    {
        return $this->andWhere('[[status]]=1');
    }*/

    /**
     * @inheritdoc
     * @return \frontend\models\producto\Producto[]|array
     */
    public function all($db = null)
    {
        return parent::all($db);
    }

    /**
     * @inheritdoc
     * @return \frontend\models\producto\Producto|array|null
     */
    public function one($db = null)
    {
        return parent::one($db);
    }

    /**
     * @inheritdoc
     * @return \frontend\models\producto\Producto[]|array
     */
    public function allPorSeccion($sec_id)
    {
        return parent::all();
    }
}
