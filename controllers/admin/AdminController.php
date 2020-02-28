<?php


namespace app\controllers\admin;

use app\models\Category;
use Yii;
use yii\web\Controller;
use app\models\User;

class AdminController extends Controller
{
    /* Set layout for AdminPanel pages */
    public $layout = 'admin/main';

    public function beforeAction($action)
    {
        //check user rights
        $user = Yii::$app->user;

        if ($user->isGuest){
            return $this->goHome();
        }

        /*if (!$user->identity->isAdmin()) {
            return $this->goHome();
        }*/

        return parent::beforeAction($action);
    }
}