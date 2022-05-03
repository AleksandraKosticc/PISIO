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
                'attribute' => 'personFrom.lastname',
                'label' => Yii::t('app', 'Person From')
            ],
        [
                'attribute' => 'personTo.lastname',
                'label' => Yii::t('app', 'Person To')
            ],
        [
                'attribute' => 'locationFrom.lat_lon',
                'label' => Yii::t('app', 'Location From')
            ],
        [
                'attribute' => 'locationTo.lat_lon',
                'label' => Yii::t('app', 'Location To')
            ],
        [
            'class' => 'yii\grid\ActionColumn',
            'visibleButtons' => [
                'update' => function ($model) {
                    return \Yii::$app->user->can('employee');
                },
                'delete' => function ($model) {
                    return \Yii::$app->user->can('employee');
                },
            ],

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
