<?php

namespace oboom\news;

use Yii;
use yii\helpers\Inflector;


class Module extends \yii\base\Module
{
    /**
     * @inheritdoc
     */
    public $defaultRoute = 'items';
    public $userIdentityClass;
    public $commentModelClass = 'oboom\news\models\Comments';
    public $controllerNamespace = 'oboom\news\controllers';
    public $mainLayout = '@oboom/news/views/layouts/main.php';

    public function init()
    {
        parent::init();
        if ($this->userIdentityClass === null) {
            $this->userIdentityClass = Yii::$app->getUser()->identityClass;
        }
    }
}
