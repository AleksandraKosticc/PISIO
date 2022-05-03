<?php
namespace app\controllers\api;

use app\models\Building;
use Yii;
use yii\filters\VerbFilter;
use yii\helpers\ArrayHelper;
use yii\rest\Controller;
use yii\web\Response;
use yii\rest\ActiveController;

class BuildingController extends ActiveController {
    public $modelClass = 'app\models\Building';

    public function actions()
    {
        $actions = parent::actions();

    $actions['index']['dataFilter'] = [
            'class' => 'yii\data\ActiveDataFilter',
            'searchModel' => 'app\models\BuildingSearch'
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
}

?>
