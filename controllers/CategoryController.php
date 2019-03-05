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
use yii\helpers\Json;
use yii\web\Controller;
use yii\data\ArrayDataProvider;
use oboom\news\models\Seo;
use oboom\news\models\NewsCategory;


class CategoryController extends Controller
{
    public function actionIndex($cat=null)
    {
        \yii\helpers\Url::remember();

        $query = NewsCategory::find()->all();
        $provider = new ArrayDataProvider([

            'allModels'=>$query,
            'pagination' => [
                'pageSize' => 20,
            ],
            'sort' => [
                'attributes' => [
                    'created_at' =>[
                        'label' => Yii::t('oboom.news', 'CreatedAt'),
                    ],
                ],
                'defaultOrder' => [ 'created_at'=> SORT_DESC]
            ],
        ]);


        return $this->render('index',[
            'items'=>$provider->getModels(),
            'sort'=>$provider->sort,
            'pages'=>$provider->pagination]);
    }


    public function actionCreate()
    {


        $cat = new NewsCategory();
        $seo = new Seo();

        if($cat->load(Yii::$app->request->post()) && $seo->load(Yii::$app->request->post())){

            $transaction = \Yii::$app->db->beginTransaction();
            try {
                if(!$seo->save())  $transaction->rollBack();
                $cat->seo_id = $seo->id;

                if($flag=$cat->save(false)) {
                    $transaction->commit();

                    return $this->goBack();
                }

                $transaction->rollBack();

            }catch (Exception $e) {
                $transaction->rollBack();
            }
        }


        return $this->render('create',['items'=>$cat,'seo'=>$seo]);
    }

    public function actionUpdate($id=null)
    {

        $news = NewsCategory::findOne($id);

        if($news->load(Yii::$app->request->post()) && $news->seo->load(Yii::$app->request->post())) {
            $transaction = \Yii::$app->db->beginTransaction();
            try {
                if($news->save() && $news->seo->save()){
                    $transaction->commit();
                    return $this->goBack();
                }

                $transaction->rollBack();

            }catch (Exception $e) {
                $transaction->rollBack();
            }



        }
        return $this->render('update', ['items'=>$news,'seo'=>$news->seo]);

    }

    public function actionRemove($id=null)
    {

        if(Yii::$app->request->isPost && !is_null($id)){
            $cat = MenuItems::findOne($id);
            if ($cat->delete()) {
                return $this->goBack();
            }
        }
        else {
            return $this->redirect(Yii::$app->request->referrer);
        }
    }

    //ajax update status of publication
    public function actionStatus($json=null)
    {

        if(Yii::$app->request->isAjax){
            $cat = Menu::findOne(Yii::$app->request->post(id));
            if ($cat->status == 0) {
                $cat->status =1;
            }
            else {
                $cat->status =0;
            }
            if ($cat->save()) {
                return $this->asJson([
                    'status' => true,
                ]);
            }
            else {
                return $this->asJson([
                    'status' => false,
                ]);
            }
        }
        else {
            return $this->asJson(['status'=>'Access denied']);
        }
    }

    //ajax update sort
    public function actionSort($json=null)
    {
        if(Yii::$app->request->isAjax){

            $json = Json::decode($json);
            //return Json::encode($json[0]);
            $i=-1;
            foreach ($json[0] as $data){
                ++$i;
                $item = MenuItems::findOne($data['id']);
                $item->sort = $i;
                $item->save();
            }

            return $this->asJson([
                'status' => Json::encode($json[0]),
            ]);
        }
        else {
            return $this->asJson(['status'=>'Access denied']);
        }
    }

    public static function Menu($id){
        return MenuItems::find()->joinWith('seo')->joinWith('menu')->where(['menu_items.status'=>1,'menu.id'=>$id , 'menu.status'=>1])->orderBy(['menu_items.sort'=>SORT_ASC])->asArray()->all();
    }

    protected function getByUrl($url){

        return Seo::find()->joinWith('items')->where(['seo.url'=>$url, 'menu_items.status'=>1])->asArray()->limit(1)->one();
    }
}

