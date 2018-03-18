<?php

namespace frontend\models\views;

use frontend\custom\CHtml;
use frontend\models\producto\Producto;
use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use yii\helpers\Url;

/**
 * Created by IntelliJ IDEA.
 * User: kor
 * Date: 06-12-16
 * Time: 15:42
 */
class ProductoSearch extends Producto
{

    public $id;

    public function rules()
    {
        // only fields in rules() are searchable
        return [
            [['pro_nombre', 'pro_tip_pro_id'], 'string'],
        ];
    }

    public function scenarios()
    {
        // bypass scenarios() implementation in the parent class
        return Model::scenarios();
    }

    /**
     * @return array
     */
    public function getColumns()
    {
        return [
            [
                'class' => 'yii\grid\SerialColumn',
            ],
            [
                'header' => 'Nombre',
                'attribute' => 'pro_nombre',
                'vAlign' => 'middle',
                'hAlign' => 'left',
            ],
            [
                'header' => 'Tipo Producto',
                'attribute' => 'pro_tip_pro_id',
                'vAlign' => 'middle',
                'hAlign' => 'left',
            ],
            [
                'vAlign' => 'middle',
                'hAlign' => 'center',
                'width' => '35px',
                'value' => function ($model) {
                    return CHtml::a(
                        '<span class="glyphicon glyphicon-trash button-fa"></span>',
                        Url::to(['producto/eliminar']),
                        [
                            'title' => Yii::t('app', 'Eliminar Producto'),
                            'data-confirm' => Yii::t('app', 'Desea eliminar realmente?'),
                            'data-method' => 'post',
                            'data-params' => ['pro_id' => $model->pro_id],
                            'data-pjax' => false
                        ]
                    );
                },
                'filterWidgetOptions' => [
                    'pluginOptions' => ['allowClear' => true],
                ],
                'filterInputOptions' => ['placeholder' => 'Any author'],
                'format' => 'raw',
            ],
        ];
    }

    public function search($params)
    {
        $query = $this->find()
            ->addSelect('pro_id AS id, pro_id, pro_nombre, pro_tip_pro_id');

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

        $dataProvider->pagination->pageSize = 10;

        // load the search form data and validate
        if (!($this->load($params) && $this->validate())) {
            return $dataProvider;
        }

        // adjust the query by adding the filters
        $query->andFilterWhere(['like', 'pro_nombre', $this->pro_nombre]);
        $query->andFilterWhere(['like', 'pro_tip_pro_id', $this->pro_tip_pro_id]);

        return $dataProvider;
    }
}