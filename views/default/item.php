<?php
$this->title = $data->seo->title ? $data->seo->title : "Компания {$data->title}";
$this->registerMetaTag([
    'name' => 'description',
    'content' => $data->seo->description
]);

use oboom\gallery\widgets\GalleryWidgets;
use oboom\comments\widgets\Comments;
?>
<div class="row news newsItem">
    <div class="col-md-12">
        <div class="title">
            <h1><?=$data->title;?></h1>
            <?= GalleryWidgets::widget([
                'model'=>$data,
                'type'=>'news',
                'params'=>[
                    'type'=>'showSingle',
                    'className'=>'image'
                ],
            ]); ?>
            <div class="newsSystem">
                <?=Yii::$app->formatter->asDatetime($data->created_at, 'yyyy-MM-dd HH:mm');?>
                <span class="views"><?=$data->views;?> <i class="icon ion-md-eye iconBase"></i></span>
                <span class="comments"><?=$data->countComments;?> <i class="icon ion-md-chatboxes iconBase"></i></span>
            </div>
        </div>
    </div>
    <div class="col-md-12">


        <div class="content">
            <?=$data->content;?>

        </div>
        <?if($data->comments):?>
            <?=Comments::widget([
                'model' => $data,
                'relatedTo' =>'news',
            ]); ?>
        <?endif;?>
    </div>
</div>
