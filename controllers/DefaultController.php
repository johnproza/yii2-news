<?php
/**
 * Created by PhpStorm.
 * User: john
 * Date: 12.11.2018
 * Time: 12:59
 */

namespace oboom\news\controllers;
use oboom\news\models\News;
use Yii;
use yii\web\Controller;
use yii\data\ArrayDataProvider;


class DefaultController extends Controller
{



    public function actionIndex($cat=null,$item=null){
        $items = News::getItem($cat,$item);
        $category = News::getCat($cat);
        if(count($items)==1){
            $items->trigger(News::EVENT_INCREMENT_VIEW);
            return $this->render('item',['data'=>$items]);
        }

        $provider = new ArrayDataProvider([
            'allModels'=>$items,
            'sort' => [
                'attributes' => [
//                    'id',
//                    'item.top',
                ],

                //'defaultOrder' => [ 'item.top'=> SORT_DESC , 'id' => SORT_DESC ]
            ],
            'pagination' => [
                'pageSize' => 20,
                'forcePageParam' => true,
            ],

        ]);


        return $this->render('list',[
            'data'=>$provider->getModels(),
            'cat'=>$category,
            'pages'=>$provider->pagination]);

    }

}

