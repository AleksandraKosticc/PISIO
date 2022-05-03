<?php

use yii\helpers\Html;
use yii\widgets\DetailView;
use kartik\grid\GridView;

/* @var $this yii\web\View */
/* @var $model app\models\Location */

$this->title = $model->id;
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Locations'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="location-view">

    <div class="row">
        <div class="col-sm-9">
            <h2><?= Yii::t('app', 'Location').' '. Html::encode($this->title) ?></h2>
        </div>
    </div>

    <div class="row">
<?php 
    $gridColumn = [
        ['attribute' => 'id', 'visible' => false],
        'lat_lon',
        'description',
        [
                'attribute' => 'room.name',
                'label' => Yii::t('app', 'Room')
            ],
    ];
    echo DetailView::widget([
        'model' => $model,
        'attributes' => $gridColumn
    ]); 
?>
    </div>
    
    <div class="row">
<?php
if($providerItem->totalCount){
    $gridColumnItem = [
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
                'attribute' => 'status.name',
                'label' => Yii::t('app', 'Status')
            ],
                [
                'attribute' => 'type.name',
                'label' => Yii::t('app', 'Type')
            ],
    ];
    echo Gridview::widget([
        'dataProvider' => $providerItem,
        'panel' => [
            'type' => GridView::TYPE_PRIMARY,
            'heading' => Html::encode(Yii::t('app', 'Item')),
        ],
        'panelHeadingTemplate' => '<h4>{heading}</h4>{summary}',
        'toggleData' => false,
        'columns' => $gridColumnItem
    ]);
}
?>
    </div>
    
    <div class="row">
<?php
if($providerTransition->totalCount){
    $gridColumnTransition = [
        ['class' => 'yii\grid\SerialColumn'],
        ['attribute' => 'id', 'visible' => false],
        'date',
        [
                'attribute' => 'personFrom.title',
                'label' => Yii::t('app', 'Person From')
            ],
        [
                'attribute' => 'personTo.title',
                'label' => Yii::t('app', 'Person To')
            ],
        [
                'attribute' => 'item.name',
                'label' => Yii::t('app', 'Item')
            ],
                    ];
    echo Gridview::widget([
        'dataProvider' => $providerTransition,
        'panel' => [
            'type' => GridView::TYPE_PRIMARY,
            'heading' => Html::encode(Yii::t('app', 'Transition')),
        ],
        'panelHeadingTemplate' => '<h4>{heading}</h4>{summary}',
        'toggleData' => false,
        'columns' => $gridColumnTransition
    ]);
}
?>
    </div>
</div>
