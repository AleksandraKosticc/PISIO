<?php
use kartik\grid\GridView;
use yii\data\ArrayDataProvider;

    $dataProvider = new ArrayDataProvider([
        'allModels' => $model->transitions,
        'key' => 'id'
    ]);
    $gridColumns = [
        ['class' => 'yii\grid\SerialColumn'],
        ['attribute' => 'id', 'visible' => false],
        'date',
                [
                'attribute' => 'item.name',
                'label' => Yii::t('app', 'Item')
            ],
        [
                'attribute' => 'locationFrom.id',
                'label' => Yii::t('app', 'Location From')
            ],
        [
                'attribute' => 'locationTo.id',
                'label' => Yii::t('app', 'Location To')
            ],
        [
            'class' => 'yii\grid\ActionColumn',
            'controller' => 'transition'
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
