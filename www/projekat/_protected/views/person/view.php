<?php

use yii\helpers\Html;
use yii\widgets\DetailView;
use kartik\grid\GridView;

/* @var $this yii\web\View */
/* @var $model app\models\Person */

$this->title = $model->lastname;
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'People'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="person-view">

    <div class="row">
        <div class="col-sm-9">
            <h2><?= Yii::t('app', 'Person').' '. Html::encode($this->title) ?></h2>
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
                'attribute' => 'location.lat_lon',
                'label' => Yii::t('app', 'Location')
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
                'attribute' => 'locationFrom.lat_lon',
                'label' => Yii::t('app', 'Location From')
            ],
            [
                'attribute' => 'locationTo.lat_lon',
                'label' => Yii::t('app', 'Location To')
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
