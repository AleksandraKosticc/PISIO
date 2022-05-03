<?php

use yii\helpers\Html;
use yii\widgets\DetailView;
use kartik\grid\GridView;

/* @var $this yii\web\View */
/* @var $model app\models\Transition */

?>
<div class="transition-view">

    <div class="row">
        <div class="col-sm-9">
            <h2><?= Html::encode($model->id) ?></h2>
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
</div>