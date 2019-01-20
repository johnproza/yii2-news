<?php
/**
 * Created by PhpStorm.
 * User: john
 * Date: 27.12.2018
 * Time: 19:32
 */
use yii\helpers\Html;
use yii\helpers\ArrayHelper;
use oboom\comments\BackEndAssetsBundle;
use yii\widgets\LinkPager;
$this->title = \Yii::t('oboom.comments', 'title');
BackEndAssetsBundle::register($this);
use oboom\gallery\widgets\GalleryWidgets;
?>
<div id="app" class="mainSection list">
    <div class="col-md-12">
        <div class="systemBar">
            <?= Html::a(\Yii::t('oboom.news', 'Create'), '/news/items/create', ['class' => 'btn btn-success','data-pjax' => '0']) ?>

            <!--            <div class="col-md-5">-->
<!--                --><?//= Html::dropDownList('cats',$catId, ArrayHelper::map($cats,'id','name'),[
//                        'prompt' => ' -- Выберите категорию --',
//                        'class'=>'form-control',
//                        'id'=>'menuFilter']
//                );?>
<!--            </div>-->
        </div>
    </div>

    <div class="col-md-12">
        <table class="table comment">
            <thead>
            <tr>
                <th class="w50">#</th>
                <th class="w50"><?=\Yii::t('oboom.news', 'Title');?></th>
                <th class="w400 left"><?=\Yii::t('oboom.news', 'Preview');?></th>
                <th><?=$sort->link('created_at')?></th>
                <th><?=\Yii::t('oboom.news', 'UpdatedAt');?></th>
                <th><?=\Yii::t('oboom.news', 'CreatedBy');?></th>
                <th><?=$sort->link('category_id');?></th>
                <th><?=\Yii::t('oboom.news', 'Status');?></th>
                <th></th>
            </tr>
            </thead>
            <tbody>
            <?foreach ($items as $item) :?>
                <tr data-id="<?=$item-id;?>">
                    <td>
                        <?=$item->id;?>
                    </td>
                    <td>
                        <?= GalleryWidgets::widget([
                            'model'=>$item,
                            'type'=>'news',
                            'params'=>[
                                'type'=>'showSingle',
                                'className'=>'image'
                            ],
                        ]); ?>
                    </td>
                    <td class="left">
                        <p><?= Html::a($item->title, '/news/items/update?id='.$item->id) ?></p>
                        <?=substr($item->preview,0,150);?>
                    </td>

                    <td>
                        <?=Yii::$app->formatter->asDatetime($item->created_at, 'yyyy-MM-dd HH:mm');?>
                    </td>
                    <td>
                        <?=Yii::$app->formatter->asDatetime($item->updated_at, 'yyyy-MM-dd HH:mm');?>
                    <td>
                        <?=$item->author->username;?>
                    </td>

                    <td>
                        <?=$item->category->title;?>
                    </td>

                    <td class="centerItems">
                        <?if($item->status==1):?>
                            <span class="badge badge-success"><?=\Yii::t('oboom.comments', 'activeStatus');?></span>
                        <?elseif($item->status==0) :?>
                            <span class="badge badge-danger"><?=\Yii::t('oboom.comments', 'blockedStatus');?></span>
                        <?endif;?>
                    </td>
                    <td class="center">
                        <?= Html::a('<i class="icon ion-md-create iconBase"></i>', '/news/items/update?id='.$item->id) ?>
                        <?= Html::a('<i class="icon ion-md-close-circle-outline iconBase"></i>', '/news/items/remove?id='.$item->id,
                            ['data-confirm' => Yii::t('oboom.news', 'remove'),
                                'data-method' => 'post',
                                'data-pjax' => '1',]
                        ) ?>
                    </td>
                </tr>

            <?endforeach;?>

            </tbody>
        </table>

        <?php
        echo LinkPager::widget([
            'pagination' => $pages,
        ]);
        ?>
    </div>


</div>
