<?php

namespace app\controllers\api;

use app\models\LoginForm;
use app\models\User;
use Yii;
use yii\filters\VerbFilter;
use yii\rest\Controller;
use yii\web\Response;

class UserController extends Controller
{
    public $enableCsrfValidation = false;

    public function behaviors()
    {
        return [
            'corsFilter' => [
                'class' => \yii\filters\Cors::className(),
            ],
            'access' => [
                'class' => 'yii\filters\ContentNegotiator',
//                'only' => ['auth','index'],
                'formats' => [
                    'application/json' => Response::FORMAT_JSON
                ],
            ],
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'auth' => ['POST', 'OPTIONS'],
                    'index' => ['GET'],
                ],
            ],
        ];
    }

    public function actionAuth()
    {
        $request = Yii::$app->request->getBodyParams();
        if (($username = $request['username']) !== null && ($password = $request['password']) !== null) {
            $user = User::findByUsername($username);
            if ($user && $user->validatePassword($password)) {
                return $this->asJson(['status' => 200, 'access_token' => $user->auth_key]);
            }

        }
        return $this->asJson(['status' => 403, 'Greska' => 'greska']);
    }

    public function actionGetAccessKey($username = null, $password = null)
    {
        if (!$username) { // ako nema u GET probamo iz POST
            $username = Yii::$app->request->post('username');
            $password = Yii::$app->request->post('password');
        }
        if (!$username) { // ako nema u POST probamo u HTTP headers (HTTP Basic Auth)
            if (isset($_SERVER['PHP_AUTH_USER'])) $username = $_SERVER['PHP_AUTH_USER'];
            if ($username && isset($_SERVER['PHP_AUTH_PW'])) $password = $_SERVER['PHP_AUTH_PW'];
        }

        if ($username && $user = User::findByUsername($username)) {
            if ($user && $password && $user->validatePassword($password)) {
                // ovdje smo prosli login uspjesno i mozemo da vratimo auth_key ili slicno
                return $user->auth_key; 
                // return "<pre>\n".print_r($user,true)."</pre>"; 
            }

        }

        return false;
    }
}
