<?php


namespace app\models\Files;

use Yii;
use yii\base\Behavior;
use yii\helpers\ArrayHelper;
use yii\web\UploadedFile;

class FileUploadBehavior extends Behavior
{
    private static $uploadPath = '';

    private $uploadData = [];
    private $uploadPaths = [];

    public function init()
    {
        static::$uploadPath = Yii::$app->basePath . '/web/uploads/';
    }

    public function uploadOnCreate($uploadName, $fieldName)
    {
        $model = $this->owner;
        if ($model->hasAttribute($fieldName) && property_exists($model, $uploadName)) {
            $this->uploadData[$uploadName] = UploadedFile::getInstance($model, $uploadName);
            $model->$fieldName = "";

            if($this->uploadData[$uploadName] != null) {
                $extArray = explode(".", $this->uploadData[$uploadName]->name);
                $ext = end($extArray);
                $newName = Yii::$app->security->generateRandomString() . ".{$ext}";
                $model->$fieldName = '/uploads/' . $newName;
                $this->uploadPaths[$uploadName] = static::$uploadPath . $newName;
            }
        }
    }

    public function uploadOnUpdate($uploadName, $fieldName)
    {
        $model = $this->owner;
        if ($model->hasAttribute($fieldName) && property_exists($model, $uploadName)) {
            $this->uploadData[$uploadName] = UploadedFile::getInstance($model, $uploadName);
            if($this->uploadData[$uploadName] != null) {
                $extArray = explode(".", $this->uploadData[$uploadName]->name);
                $ext = end($extArray);
                $newName = Yii::$app->security->generateRandomString() . ".{$ext}";
                $model->$fieldName = '/uploads/' . $newName;
                $this->uploadPaths[$uploadName] = static::$uploadPath . $newName;
            }
        }
    }

    public function uploadSave($uploadName, $fieldName)
    {
        $model = $this->owner;
        if ($model->hasAttribute($fieldName) &&
            property_exists($model, $uploadName) &&
            ArrayHelper::keyExists($uploadName, $this->uploadData) &&
            ($this->uploadData[$uploadName] != null)) {
            $this->uploadData[$uploadName]->saveAs($this->uploadPaths[$uploadName]);
        }
    }
}