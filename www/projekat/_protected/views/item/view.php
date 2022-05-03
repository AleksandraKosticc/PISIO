<?php

use yii\helpers\Html;
use yii\widgets\DetailView;
use kartik\grid\GridView;

/* @var $this yii\web\View */
/* @var $model app\models\Item */

$this->title = $model->name;
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Items'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="item-view">

    <div class="row">
        <div class="col-sm-9">
            <h2><?= Yii::t('app', 'Item').' '. Html::encode($this->title) ?></h2>
        </div>
        <div class="col-sm-3" style="margin-top: 15px">
<?=             
             Html::a('<i class="fa glyphicon glyphicon-hand-up"></i> ' . Yii::t('app', 'PDF'), 
                ['pdf', 'id' => $model->id, 'status_id' => $model->status_id, 'type_id' => $model->type_id],
                [
                    'class' => 'btn btn-danger',
                    'target' => '_blank',
                    'data-toggle' => 'tooltip',
                    'title' => Yii::t('app', 'Will open the generated PDF file in a new window')
                ]
            )?>
            <?php if (Yii::$app->user->can('employee'))
            	echo Html::a(Yii::t('app', 'Update'), ['update', 'id' => $model->id, 'status_id' => $model->status_id, 'type_id' => $model->type_id], ['class' => 'btn btn-primary']);
            ?>
            <?php if (Yii::$app->user->can('employee'))
	    	echo Html::a(Yii::t('app', 'Delete'), ['delete', 'id' => $model->id, 'status_id' => $model->status_id, 'type_id' => $model->type_id], [
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
        'inventory_number',
        'name',
        'description:ntext',
        'date',
        'price',
        'amortization',
        [
            'attribute' => 'person.lastname',
            'label' => Yii::t('app', 'Person'),
        ],
        [
            'attribute' => 'status.name',
            'label' => Yii::t('app', 'Status'),
        ],
        [
            'attribute' => 'location.lat_lon',
            'label' => Yii::t('app', 'Location'),
        ],
        [
            'attribute' => 'type.name',
            'label' => Yii::t('app', 'Type'),
        ],
    ];
    echo DetailView::widget([
        'model' => $model,
        'attributes' => $gridColumn
    ]);
?>
    </div>
    <div class="row">
        <h4>Location<?= ' '. Html::encode($this->title) ?></h4>
    </div>
    <?php 
    $gridColumnLocation = [
        ['attribute' => 'id', 'visible' => false],
        'lat_lon',
        'description:ntext',
        'room.name',
    ];
    echo DetailView::widget([
        'model' => $model->location,
        'attributes' => $gridColumnLocation    ]);
    ?>
    <div class="row">
        <h4>Person<?= ' '. Html::encode($this->title) ?></h4>
    </div>
    <?php 
    $gridColumnPerson = [
        ['attribute' => 'id', 'visible' => false],
        'lastname',
        'firstname',
        'title',
        'jmbg',
        'profession',
        'contact',
    ];
    echo DetailView::widget([
        'model' => $model->person,
        'attributes' => $gridColumnPerson    ]);
    ?>
    <div class="row">
        <h4>Status<?= ' '. Html::encode($this->title) ?></h4>
    </div>
    <?php 
    $gridColumnStatus = [
        ['attribute' => 'id', 'visible' => false],
        'name',
        'description:ntext',
    ];
    echo DetailView::widget([
        'model' => $model->status,
        'attributes' => $gridColumnStatus    ]);
    ?>
    <div class="row">
        <h4>Type<?= ' '. Html::encode($this->title) ?></h4>
    </div>
    <?php 
    $gridColumnType = [
        ['attribute' => 'id', 'visible' => false],
        'name',
        'description:ntext',
    ];
    echo DetailView::widget([
        'model' => $model->type,
        'attributes' => $gridColumnType    ]);
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
