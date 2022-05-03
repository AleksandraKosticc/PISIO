<?php

use yii\helpers\Html;
use yii\widgets\DetailView;
use kartik\grid\GridView;

/* @var $this yii\web\View */
/* @var $model app\models\Location */

$this->title = $model->lat_lon;
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Locations'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="location-view">

    <div class="row">
        <div class="col-sm-9">
            <h2><?= Yii::t('app', 'Location').' '. Html::encode($this->title) ?></h2>
        </div>
        <div class="col-sm-3" style="margin-top: 15px">
<?=             
             Html::a('<i class="fa glyphicon glyphicon-hand-up"></i> ' . Yii::t('app', 'PDF'), 
                ['pdf', 'id' => $model->id],
                [
                    'class' => 'btn btn-danger',
                    'target' => '_blank',
                    'data-toggle' => 'tooltip',
                    'title' => Yii::t('app', 'Will open the generated PDF file in a new window')
                ]
            )?>
            <?php if (Yii::$app->user->can('employee'))
            	echo Html::a(Yii::t('app', 'Update'), ['update', 'id' => $model->id], ['class' => 'btn btn-primary']); 
	    ?>
            <?php if (Yii::$app->user->can('employee'))
		echo Html::a(Yii::t('app', 'Delete'), ['delete', 'id' => $model->id], [
                'class' => 'btn btn-danger',
                'data' => [
                    'confirm' => Yii::t('app', 'Are you sure you want to delete this item?'),
                    'method' => 'post',
                ],
            ]);
            ?>
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
            'label' => Yii::t('app', 'Room'),
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
                'attribute' => 'person.lastname',
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
        'pjax' => true,
        'pjaxSettings' => ['options' => ['id' => 'kv-pjax-container-item']],
        'panel' => [
            'type' => GridView::TYPE_PRIMARY,
            'heading' => '<span class="glyphicon glyphicon-book"></span> ' . Html::encode(Yii::t('app', 'Item')),
        ],
        'columns' => $gridColumnItem
    ]);
}
?>

    </div>
    <div class="row">
        <h4>Room<?= ' '. Html::encode($this->title) ?></h4>
    </div>
    <?php 
    $gridColumnRoom = [
        ['attribute' => 'id', 'visible' => false],
        'number',
        'name',
        'description',
        'building.name',
    ];
    echo DetailView::widget([
        'model' => $model->room,
        'attributes' => $gridColumnRoom    ]);
    ?>
    
    <div class="row">
<?php
if($providerTransition->totalCount){
    $gridColumnTransition = [
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
                'attribute' => 'item.name',
                'label' => Yii::t('app', 'Item')
            ],
                            ];
    echo Gridview::widget([
        'dataProvider' => $providerTransition,
        'pjax' => true,
        'pjaxSettings' => ['options' => ['id' => 'kv-pjax-container-transition']],
        'panel' => [
            'type' => GridView::TYPE_PRIMARY,
            'heading' => '<span class="glyphicon glyphicon-book"></span> ' . Html::encode(Yii::t('app', 'Transition')),
        ],
        'columns' => $gridColumnTransition
    ]);
}
?>

    </div>
</div>
