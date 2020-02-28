<?php


namespace app\controllers;


use Yii;
use app\models\Language\Language;
use yii\web\Controller;

class LanguageController extends Controller
{

    /**
     * Change language and go back
     * @param $lang
     * @return \yii\web\Response
     */
    public function actionIndex($lang)
    {
        $language = Language::getInstance();
        $language->setLanguage($lang);
        return $this->goBack(Yii::$app->request->referrer);
    }
}