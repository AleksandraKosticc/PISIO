<?php

use yii\helpers\Html;
use yii\widgets\DetailView;
use kartik\grid\GridView;

/* @var $this yii\web\View */
/* @var $model app\models\Transition */

$this->title = $model->id;
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Transitions'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="transition-view">

    <div class="row">
        <div class="col-sm-9">
            <h2><?= Yii::t('app', 'Transition').' '. Html::encode($this->title) ?></h2>
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
        'date',
        [
            'attribute' => 'personFrom.lastname',
            'label' => Yii::t('app', 'Person From'),
        ],
        [
            'attribute' => 'personTo.lastname',
            'label' => Yii::t('app', 'Person To'),
        ],
        [
            'attribute' => 'item.name',
            'label' => Yii::t('app', 'Item'),
        ],
        [
            'attribute' => 'locationFrom.lat_lon',
            'label' => Yii::t('app', 'Location From'),
        ],
        [
            'attribute' => 'locationTo.lat_lon',
            'label' => Yii::t('app', 'Location To'),
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
        'description',
        'room.name',
    ];
    echo DetailView::widget([
        'model' => $model->locationTo,
        'attributes' => $gridColumnLocation    ]);
    ?>
    <div class="row">
        <h4>Item<?= ' '. Html::encode($this->title) ?></h4>
    </div>
    <?php 
    $gridColumnItem = [
        ['attribute' => 'id', 'visible' => false],
        'inventory_number',
        'name',
        'description',
        'date',
        'price',
        'amortization',
        'person.lastname',
        'status.name',
        'location.lat_lon',
        'type.name',
    ];
    echo DetailView::widget([
        'model' => $model->item,
        'attributes' => $gridColumnItem    ]);
    ?>
    <div class="row">
        <h4>Location<?= ' '. Html::encode($this->title) ?></h4>
    </div>
    <?php 
    $gridColumnLocation = [
        ['attribute' => 'id', 'visible' => false],
        'lat_lon',
        'description',
        'room.name',
    ];
    echo DetailView::widget([
        'model' => $model->locationFrom,
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
        'model' => $model->personFrom,
        'attributes' => $gridColumnPerson    ]);
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
        'model' => $model->personTo,
        'attributes' => $gridColumnPerson    ]);
    ?>
</div>
