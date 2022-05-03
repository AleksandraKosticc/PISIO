<?php
namespace app\controllers\api;

use app\models\Transition;
use app\models\User;
use app\models\Person;
use app\models\Location;
use app\models\Item;
use Yii;
use yii\filters\VerbFilter;
use yii\helpers\ArrayHelper;
use yii\rest\Controller;
use yii\web\Response;
use yii\rest\ActiveController;

class TransitionController extends ActiveController {
    public $modelClass = 'app\models\Transition';

    public function actions()
    {
        $actions = parent::actions();

    $actions['index']['dataFilter'] = [
            'class' => 'yii\data\ActiveDataFilter',
            'searchModel' => 'app\models\ItemSearch'
        ];

        return $actions;
    }

    public function behaviors()
    {
        $behaviors = parent::behaviors();

        // uklonimo filter za Auth
        $auth = $behaviors['authenticator'];
        unset($behaviors['authenticator']);

        // dodamo CORS filter
        $behaviors['corsFilter'] = [
            'class' => \yii\filters\Cors::className(),
        ];

        // vratimo Auth filter
        $behaviors['authenticator'] = $auth;
        // osim za OPTIONS i GET na promjer (OPTIONS mora za CORS)
        $behaviors['authenticator']['except'] = ['options','get'];

        $behaviors['contentNegotiator']['formats']['text/html'] = Response::FORMAT_JSON;

        return $behaviors;
    }


    public function actionApplyTransition()
    {
        $due_transition = Transition::find()->where(['date' => date('Y-m-d')])->all();
        foreach ($due_transition as $transition ) {
            if ($item = Item::findOne($transition ['item'])) {
                $item->setAttributes(
                    [
                        'person_to_id' => $transition['person_to_id'],
                        'location_to_id' => $transition['location_to_id'],
		        'person_from_id' => $transition['person_from_id'],
                        'location_from_id' => $transition['location_from_id'],
                    ]
                );
                $item->save();
            }
        }
        return $this->asJson(['apply-transition' => 'done']);
    }

}

?>
