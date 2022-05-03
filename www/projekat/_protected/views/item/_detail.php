<?php

use yii\helpers\Html;
use yii\widgets\DetailView;
use kartik\grid\GridView;

/* @var $this yii\web\View */
/* @var $model app\models\Item */

?>
<div class="item-view">

    <div class="row">
        <div class="col-sm-9">
            <h2><?= Html::encode($model->name) ?></h2>
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
</div>