<?php


namespace app\models\Language;


use yii\base\Behavior;

/**
 * Class LanguageBehavior
 * @package app\models\Language
 */
class LanguageBehavior extends Behavior
{
    /**
     * @param $name
     * @return mixed|string
     */
    public function translated($name)
    {
        $_language = Language::getInstance();
        $language = $_language->currentLanguage();
        $model = $this->owner;

        $attribute = $name . '_' . $language;
        if ($model->hasAttribute($attribute)) {
            return $model->$attribute;
        }

        return '';
    }
}