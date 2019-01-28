<?php
/**
 * Created by PhpStorm.
 * User: john
 * Date: 15.11.2018
 * Time: 23:21
 */

use yii\helpers\Url;
use oboom\news\BaseAssetsBundle;
use oboom\gallery\widgets\GalleryWidgets;
use yii\widgets\ListView;
use yii\widgets\Pjax;
use yii\helpers\Html;
BaseAssetsBundle::register($this);
$c=-1;
?>

<section class="row news">
    <?if(!empty($data)):?>
        <?foreach ($data as $item) :?>
            <?++$c;?>
            <div class="col-md-6 item">
                <div class="<?=$c<$topItem ? "col-md-12" : "col-md-12" ?> ">
                    <div class="title">
                        <?= Html::a($item->title, "/news/{$item->category->seo->url}/{$item->seo->url}") ?>
                    </div>
                    <div class="newsSystem">
                        <?=Yii::$app->formatter->asDatetime($item->created_at, 'yyyy-MM-dd HH:mm');?>
                        <span class="views"><?=$item->views;?> <i class="icon ion-md-eye iconBase"></i></span>
                        <span class="comments"><?=$item->countComments;?> <i class="icon ion-md-chatboxes iconBase"></i></span>
                    </div>
                </div>
                <div class="<?=$c<$topItem ? "col-md-12" : "col-md-4" ?> image">
                    <?= GalleryWidgets::widget([
                        'model'=>$item,
                        'type'=>'news',
                        'params'=>[
                            'type'=>'showSingle',
                            'className'=>'image'
                        ],
                    ]); ?>
                </div>
                <div class="<?=$c<$topItem ? "col-md-12" : "col-md-8" ?>">
                    <div class="newsPreview">
                        <?=substr($item->preview,0,250);?>
                    </div>
                </div>
            </div>
        <?endforeach?>
    <?endif;?>
</section>
