<?php

namespace app\components;


use Yii;
use yii\base\BaseObject;
use yii\web\UrlRuleInterface;

class CatalogUrlRule extends BaseObject implements UrlRuleInterface
{
    public function createUrl($manager, $route, $params)
    {
        switch ($route) {
            case 'site/something':
                if (isset($params['id'])) {
                    return "/something";
                }
                break;
        }

        return false;
    }

    public function parseRequest($manager, $request)
    {
        $pathInfo = $request->getPathInfo();

        if (preg_match('%^(([\w-\$]+(\/)?)+)$%', $pathInfo, $matches)) {
            $pathParts = explode("/", $pathInfo);

            $lastPart = array_pop($pathParts);
            if($lastPart != "") {
                $pathParts[] = $lastPart;
            }

            if(count($pathParts) == 1) {

            } else if (count($pathParts) == 2) {

            } else if (count($pathParts) == 3) {
                $thirdSlug = array_pop($pathParts);
                $secondSlug = array_pop($pathParts);
                $firstSlug = array_pop($pathParts);
            }
        }

        return false;
    }
}