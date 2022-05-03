<?php
use kartik\grid\GridView;
use yii\data\ArrayDataProvider;

    $dataProvider = new ArrayDataProvider([
        'allModels' => $model->items,
        'key' => function($model){
            return ['id' => $model->id, 'status_id' => $model->status_id, 'type_id' => $model->type_id];
        }
    ]);
    $gridColumns = [
        ['class' => 'yii\grid\SerialColumn'],
        ['attribute' => 'id', 'visible' => false],
        'inventory_number',
        'name',
        'description:ntext',
        'date',
        'price',
        'amortization',
        [
                'attribute' => 'person.title',
                'label' => Yii::t('app', 'Person')
            ],
        [
                'attribute' => 'location.id',
                'label' => Yii::t('app', 'Location')
            ],
        [
                'attribute' => 'type.name',
                'label' => Yii::t('app', 'Type')
            ],
        [
            'class' => 'yii\grid\ActionColumn',
            'controller' => 'item'
        ],
    ];
    
    echo GridView::widget([
        'dataProvider' => $dataProvider,
        'columns' => $gridColumns,
        'containerOptions' => ['style' => 'overflow: auto'],
        'pjax' => true,
        'beforeHeader' => [
            [
                'options' => ['class' => 'skip-export']
            ]
        ],
        'export' => [
            'fontAwesome' => true
        ],
        'bordered' => true,
        'striped' => true,
        'condensed' => true,
        'responsive' => true,
        'hover' => true,
        'showPageSummary' => false,
        'persistResize' => false,
    ]);
