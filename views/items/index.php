<?php
/**
 * Created by PhpStorm.
 * User: john
 * Date: 27.12.2018
 * Time: 19:32
 */
use yii\helpers\Html;
use yii\helpers\ArrayHelper;
use oboom\news\BaseAssetsBundle;
use yii\widgets\LinkPager;
use oboom\gallery\widgets\GalleryWidgets;
$this->title = \Yii::t('oboom.comments', 'title');
BaseAssetsBundle::register($this);
?>
<div id="app" class="mainSection row">
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

    <div class="col-md-12 table-responsive">
        <table class="table table-bordered table-hover newsTable">
            <thead>
            <tr>
                <th scope="col" class="w50">#</th>
                <th scope="col" class="w50"><?=\Yii::t('oboom.news', 'Title');?></th>
                <th scope="col" class="w400 left"><?=\Yii::t('oboom.news', 'Preview');?></th>
                <th scope="col" ><?=$sort->link('created_at')?></th>
                <th scope="col"><?=\Yii::t('oboom.news', 'UpdatedAt');?></th>
                <th scope="col"><?=\Yii::t('oboom.news', 'CreatedBy');?></th>
                <th scope="col"><?=$sort->link('category_id');?></th>
                <th scope="col"><?=\Yii::t('oboom.news', 'Views');?></th>
                <th scope="col"><?=\Yii::t('oboom.news', 'Comments');?></th>
                <th scope="col"><?=\Yii::t('oboom.news', 'Status');?></th>
                <th scope="col"></th>
            </tr>
            </thead>
            <tbody>
            <?foreach ($items as $item) :?>
                <tr data-id="<?=$item-id;?>">
                    <th scope="row">
                        <?=$item->id;?>
                    </th>
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
                    <td>
                        <?=$item->views;?>
                    </td>

                    <td class="centerItems">
                        <?if($item->comments==1):?>
                            <span class="badge badge-success"><?=\Yii::t('oboom.news', 'CommentsStatusA');?></span>
                        <?elseif($item->comments==0) :?>
                            <span class="badge badge-danger"><?=\Yii::t('oboom.news', 'CommentsStatusB');?></span>
                        <?endif;?>
                    </td>
                    <td class="centerItems">
                        <?if($item->status==1):?>
                            <span class="badge badge-success"><?=\Yii::t('oboom.news', 'activeStatus');?></span>
                        <?elseif($item->status==0) :?>
                            <span class="badge badge-danger"><?=\Yii::t('oboom.news', 'blockedStatus');?></span>
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
