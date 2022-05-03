<div class="form-group" id="add-transition">
<?php
use kartik\grid\GridView;
use kartik\builder\TabularForm;
use yii\data\ArrayDataProvider;
use yii\helpers\Html;
use yii\widgets\Pjax;

$dataProvider = new ArrayDataProvider([
    'allModels' => $row,
    'pagination' => [
        'pageSize' => -1
    ]
]);
echo TabularForm::widget([
    'dataProvider' => $dataProvider,
    'formName' => 'Transition',
    'checkboxColumn' => false,
    'actionColumn' => false,
    'attributeDefaults' => [
        'type' => TabularForm::INPUT_TEXT,
    ],
    'attributes' => [
        "id" => ['type' => TabularForm::INPUT_HIDDEN, 'columnOptions' => ['hidden'=>true]],
        'date' => ['type' => TabularForm::INPUT_WIDGET,
            'widgetClass' => \kartik\datecontrol\DateControl::classname(),
            'options' => [
                'type' => \kartik\datecontrol\DateControl::FORMAT_DATETIME,
                'saveFormat' => 'php:Y-m-d H:i:s',
                'ajaxConversion' => true,
                'options' => [
                    'pluginOptions' => [
                        'placeholder' => Yii::t('app', 'Choose Date'),
                        'autoclose' => true,
                    ]
                ],
            ]
        ],
        'person_from_id' => [
            'label' => 'Person',
            'type' => TabularForm::INPUT_WIDGET,
            'widgetClass' => \kartik\widgets\Select2::className(),
            'options' => [
                'data' => \yii\helpers\ArrayHelper::map(\app\models\Person::find()->orderBy('lastname')->asArray()->all(), 'id', 'lastname'),
                'options' => ['placeholder' => Yii::t('app', 'Choose Person')],
            ],
            'columnOptions' => ['width' => '200px']
        ],
        'person_to_id' => [
            'label' => 'Person',
            'type' => TabularForm::INPUT_WIDGET,
            'widgetClass' => \kartik\widgets\Select2::className(),
            'options' => [
                'data' => \yii\helpers\ArrayHelper::map(\app\models\Person::find()->orderBy('lastname')->asArray()->all(), 'id', 'lastname'),
                'options' => ['placeholder' => Yii::t('app', 'Choose Person')],
            ],
            'columnOptions' => ['width' => '200px']
        ],
        'location_from_id' => [
            'label' => 'Location',
            'type' => TabularForm::INPUT_WIDGET,
            'widgetClass' => \kartik\widgets\Select2::className(),
            'options' => [
                'data' => \yii\helpers\ArrayHelper::map(\app\models\Location::find()->orderBy('lat_lon')->asArray()->all(), 'id', 'lat_lon'),
                'options' => ['placeholder' => Yii::t('app', 'Choose Location')],
            ],
            'columnOptions' => ['width' => '200px']
        ],
        'location_to_id' => [
            'label' => 'Location',
            'type' => TabularForm::INPUT_WIDGET,
            'widgetClass' => \kartik\widgets\Select2::className(),
            'options' => [
                'data' => \yii\helpers\ArrayHelper::map(\app\models\Location::find()->orderBy('lat_lon')->asArray()->all(), 'id', 'lat_lon'),
                'options' => ['placeholder' => Yii::t('app', 'Choose Location')],
            ],
            'columnOptions' => ['width' => '200px']
        ],
        'del' => [
            'type' => 'raw',
            'label' => '',
            'value' => function($model, $key) {
                return
                    Html::hiddenInput('Children[' . $key . '][id]', (!empty($model['id'])) ? $model['id'] : "") .
                    Html::a('<i class="glyphicon glyphicon-trash"></i>', '#', ['title' =>  Yii::t('app', 'Delete'), 'onClick' => 'delRowTransition(' . $key . '); return false;', 'id' => 'transition-del-btn']);
            },
        ],
    ],
    'gridSettings' => [
        'panel' => [
            'heading' => false,
            'type' => GridView::TYPE_DEFAULT,
            'before' => false,
            'footer' => false,
            'after' => Html::button('<i class="glyphicon glyphicon-plus"></i>' . Yii::t('app', 'Add Transition'), ['type' => 'button', 'class' => 'btn btn-success kv-batch-create', 'onClick' => 'addRowTransition()']),
        ]
    ]
]);
echo  "    </div>\n\n";
?>

