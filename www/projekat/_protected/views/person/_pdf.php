<?php

use yii\helpers\Html;
use yii\widgets\DetailView;
use kartik\grid\GridView;

/* @var $this yii\web\View */
/* @var $model app\models\Person */

$this->title = $model->title;
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'People'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="person-view">

    <div class="row">
        <div class="col-sm-9">
            <h2><?= Yii::t('app', 'Person').' '. Html::encode($this->title) ?></h2>
        </div>
    </div>

    <div class="row">
<?php 
    $gridColumn = [
        ['attribute' => 'id', 'visible' => false],
        'lastname',
        'firstname',
        'title',
        'jmbg',
        'profession',
        'contact',
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
                'attribute' => 'status.name',
                'label' => Yii::t('app', 'Status')
            ],
        [
                'attribute' => 'location.id',
                'label' => Yii::t('app', 'Location')
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
