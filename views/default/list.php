<?php
$this->title = $cat->seo->title ? $cat->seo->title : "Новости из мира {$cat->title}";
$this->registerMetaTag([
    'name' => 'description',
    'content' => $cat->seo->description
]);

use oboom\gallery\widgets\GalleryWidgets;
use yii\widgets\LinkPager;
?>
<div class="row news newsItem">
    <?foreach ($data as $item) :?>
    <div class="col-md-12">
        <div class="title">
            <h1><?=$item->title;?></h1>
            <?= GalleryWidgets::widget([
                'model'=>$item,
                'type'=>'news',
                'params'=>[
                    'type'=>'showSingle',
                    'className'=>'image'
                ],
            ]); ?>
            <div class="newsSystem">
                <?=Yii::$app->formatter->asDatetime($item->created_at, 'yyyy-MM-dd HH:mm');?>
                <span class="views"><?=$item->views;?> <i class="icon ion-md-eye iconBase"></i></span>
                <span class="comments"><?=$item->countComments;?> <i class="icon ion-md-chatboxes iconBase"></i></span>
            </div>
        </div>
        <div class="preview">
            <?=$item->preview;?>
        </div>
    </div>
    <?endforeach;?>
    <div class="col-md-12">
        <?php
            echo LinkPager::widget([
                'pagination' => $pages,
            ]);
        ?>
    </div>
</div>
