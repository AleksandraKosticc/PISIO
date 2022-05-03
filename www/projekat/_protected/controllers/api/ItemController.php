<?php
namespace app\controllers\api;

use app\models\Item;
use app\models\User;
use app\models\Status;
use app\models\Type;
use app\models\Location;
use Yii;
use yii\filters\VerbFilter;
use yii\helpers\ArrayHelper;
use yii\rest\Controller;
use yii\web\Response;
use yii\rest\ActiveController;

class ItemController extends ActiveController {
    public $modelClass = 'app\models\Item';

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
}

?>
