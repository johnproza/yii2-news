<?php
/**
 * Created by PhpStorm.
 * User: john
 * Date: 15.11.2018
 * Time: 23:07
 */

namespace oboom\comments\widgets;
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
    public $model = null;
    public $relatedTo = null;
    public $entity = null;
    public $entityId = null;
    public $react = true;
    public $params = [
        'view'=>null,
        'template' => 'index',
        'showTop' => true,
        'limit'=>10,
    ];

    protected $encryptedEntity = null;



    public function init(){
        parent::init();
        if ($this->model!=null && $this->relatedTo!=null){
            $this->entity = hash('crc32', get_class($this->model));
            $this->entityId = $this->model->id;
            $this->encryptedEntity = $this->encrypted();

            if($this->react){
               $this->params = [
                   'view'=>null,
                   'template' => 'react/index',
                   'showTop' => true,
                   'limit'=>10,
               ];
            }
        }
        else {

            throw new \ErrorException('menuId is required attribute');
        }
    }



    public function run(){


         return $this->render($this->params['template'],
                    ['encryptedEntity'=>$this->encryptedEntity,

                    ]);
        }


    protected function getCommentData()
    {

    }

}