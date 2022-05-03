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
    </div>

    <div class="row">
<?php 
    $gridColumn = [
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
        [
                'attribute' => 'locationFrom.id',
                'label' => Yii::t('app', 'Location From')
            ],
        [
                'attribute' => 'locationTo.id',
                'label' => Yii::t('app', 'Location To')
            ],
    ];
    echo DetailView::widget([
        'model' => $model,
        'attributes' => $gridColumn
    ]); 
?>
    </div>
</div>
