<?php


namespace app\models\Files;

use yii\helpers\Json;


trait FileDeletion
{
    public function actionFileDelete($class_name, $model_id, $field_name)
    {
        $class = "\\app\\models\\" . $class_name;

        $tmp = new $class;

        if (method_exists($tmp, 'find')) {
            $model = $class::find()
                ->where(['id' => $model_id])
                ->one();

            if ($model) {
                if ($model->hasAttribute($field_name)) {
                    $model->$field_name = null;
                    if ($model->save()) {
                        return Json::encode(true);
                    }
                }
            }
        }

        return Json::encode(false);
    }
}