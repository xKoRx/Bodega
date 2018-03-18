<?php
/**
 * Created by IntelliJ IDEA.
 * User: kor
 * Date: 3/17/18
 * Time: 7:51 PM
 */

namespace frontend\custom;

use kartik\grid\GridView;
use Yii;
use yii\helpers\Html;
use yii\helpers\Url;

class CHtml extends Html
{
    public static function gridView ($titulo, $dataProvider, $searchModel, $gridColumns) {
        $bordered = true;
        $striped = true;
        $condensed = true;
        $responsive = true;
        $hover = true;
        $pageSummary = false;
        $heading = '<i class="glyphicon glyphicon-list"></i> ' . $titulo;
        $exportConfig = true;
        $contentBeforeGrid = '';//'<div class="separator"></div>';
        $contentAfterGrid = '';
        $panelBefore = ''; //'<em>* Resize table columns just like a spreadsheet by dragging the column edges.</em>';
        $panelAfter = '';//'<em>* The page summary displays SUM for first 3 amount columns and AVG for the last.</em>';

        return GridView::widget([
            'dataProvider'     => $dataProvider,
            'filterModel'      => $searchModel,
            'columns'          => $gridColumns,
            'tableOptions'     => [
                'class' => 'grilla',
            ],
            'containerOptions' => ['style' => 'overflow: auto'], // only set when $responsive = false
            'headerRowOptions' => ['class' => 'kartik-sheet-style'],
            'filterRowOptions' => ['class' => 'kartik-sheet-style'],
            'pjax'             => true, // pjax is set to always true for this demo
            'pjaxSettings'     => [
                'neverTimeout' => true,
                'beforeGrid'   => $contentBeforeGrid,
                'afterGrid'    => $contentAfterGrid,
            ],
            // set your toolbar
            'toolbar'          => [
                [
                    'content' => CHtml::a('<i class="glyphicon glyphicon-plus"></i>', ['producto/ingresar'],
                            ['class' => 'btn btn-default'])

                        . CHtml::a('<i class="glyphicon glyphicon-repeat"></i>', [Yii::$app->controller->action->id],
                            ['data-pjax' => 0, 'class' => 'btn btn-default', 'title' => Yii::t('app', 'Reset Grid')]),
                ],
                '{toggleData}',
                '{export}',
            ],

            // set export properties
            'export'           => [
                'fontAwesome'      => true,
                'showConfirmAlert' => false,
                'target'           => GridView::TARGET_BLANK,
            ],

            // parameters from the demo form
            'bordered'         => $bordered,
            'striped'          => $striped,
            'condensed'        => $condensed,
            'responsive'       => $responsive,
            'hover'            => $hover,
            'showPageSummary'  => $pageSummary,
            'panel'            => [
                'type'          => GridView::TYPE_SUCCESS,
                'heading'       => $heading,
                'before'        => $panelBefore,
                'after'         => $panelAfter,
                'beforeOptions' => ['class' => 'kv-panel-before'],
                'afterOptions'  => ['class' => 'kv-panel-after'],
            ],
            'persistResize'    => false,
            'exportConfig'     => $exportConfig,
            'resizeStorageKey' => Yii::$app->user->id,
        ]);
    }
}