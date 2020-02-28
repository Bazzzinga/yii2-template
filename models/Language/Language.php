<?php


namespace app\models\Language;

use Yii;

/**
 * Class Language
 * @package app\models\Language
 */
final class Language
{
    const LANGUAGE_RU = 'ru';
    const LANGUAGE_EN = 'en';

    private $currentLanguage = '';

    private static $cookieKey = 'lng';
    private static $cookieLifetime = 31536000; //1 year

    /**
     * @var null|Language
     */
    private static $_instance = null;

    private function __construct()
    {
    }

    private function __clone()
    {
    }

    private function __wakeup()
    {
    }

    /**
     * @return Language
     */
    public static function getInstance()
    {
        if (!static::$_instance) {
            static::$_instance = new self();
            static::$_instance->loadLanguage();
        }

        return static::$_instance;
    }

    /**
     * @return string
     */
    public function currentLanguage()
    {
        return $this->currentLanguage;
    }

    /**
     * @param $lang
     * @return bool
     */
    public function setLanguage($lang)
    {

        if (in_array($lang, [
                self::LANGUAGE_RU,
                self::LANGUAGE_EN
            ])) {

            $this->currentLanguage = $lang;
            $this->saveLanguage();
            return true;
        }

        return false;
    }

    /**
     * Save current language to cookie
     */
    private function saveLanguage()
    {
        Yii::$app->response->cookies->add(new \yii\web\Cookie([
            'name' => static::$cookieKey,
            'value' => $this->currentLanguage,
            'expire' => time() + static::$cookieLifetime,
            'path' => '/',
            //'secure' => true, //TODO: turn on if HTTPS
        ]));
    }

    /**
     * Load language from cookie
     */
    private function loadLanguage()
    {
        $language = Yii::$app->request->cookies->getValue(static::$cookieKey);
        if (!$language) {
            $language = Language::LANGUAGE_RU;
        }
        $this->setLanguage($language);
    }


}