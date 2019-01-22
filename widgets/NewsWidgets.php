<?php
/**
 * Created by PhpStorm.
 * User: john
 * Date: 15.11.2018
 * Time: 23:07
 */

namespace oboom\news\widgets;
use oboom\news\models\News;
use Yii;
use yii\base\Widget;
use yii\helpers\Html;
use yii\helpers\Json;


class NewsWidgets extends Widget
{

    /*
     *      $template -> path to your template | default 'menu' | yii2-menu/widgets/views/menu.php
     *      $data -> values from DataBase
     *      $type -> base css style type of menu (horizontal-menu | vertical-menu)
     *      $menuId -> id value menu table from DataBase (table 'menu')
     *      $className -> personal user css styles for customize menu
     */

    public $showTop = true;
    public $categoryId = 0;
    public $params = [
        'template' => 'index',
        'limit'=>10,
        'topItem'=> 4
    ];




    public function init(){
        parent::init();
//        if ($this->model!=null && $this->relatedTo!=null){
//            $this->entity = hash('crc32', get_class($this->model));
//            $this->entityId = $this->model->id;
//            $this->encryptedEntity = $this->encrypted();
//
//            if($this->react){
//               $this->params = [
//                   'view'=>null,
//                   'template' => 'react/index',
//                   'showTop' => true,
//                   'limit'=>10,
//               ];
//            }
//        }
//        else {
//
//            throw new \ErrorException('menuId is required attribute');
//        }
    }



    public function run(){


         return $this->render($this->showTop ? $this->params['template'] : 'default',
                    [ 'data'=>$this->getNewsData(),
                      'topItem'=>$this->params['topItem']
                    ]);
        }


    protected function getNewsData()
    {
        return News::getNewsData($this->categoryId,$this->params['limit']);
    }

}