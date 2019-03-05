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
$this->title = \Yii::t('oboom.comments', 'title');
BaseAssetsBundle::register($this);
use oboom\gallery\widgets\GalleryWidgets;
?>
<div id="app" class="mainSection row">
    <div class="col-md-12">
        <div class="systemBar">

            <?= Html::a(Yii::t('oboom.news', 'Create'), '/news/category/create', ['class' => 'btn btn-success','data-pjax' => '0']) ?>

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
                <th class="w50">#</th>
                <th class="w400 left"><?=Yii::t('oboom.news', 'Title');?></th>
                <th><?=$sort->link('created_at')?></th>
                <th><?=Yii::t('oboom.news', 'Status');?></th>
                <th></th>
            </tr>
            </thead>
            <tbody>
            <?foreach ($items as $item) :?>
                <tr data-id="<?=$item-id;?>">
                    <td>
                        <?=$item->id;?>
                    </td>
                    <td class="left">
                        <?= Html::a($item->title, '/news/category/update?id='.$item->id) ?>
                    </td>
                    <td>
                        <?=Yii::$app->formatter->asDatetime($item->created_at, 'yyyy-MM-dd HH:mm');?>
                    </td>

                    <td class="centerItems">
                        <?if($item->status==1):?>
                            <span class="badge badge-success"><?=\Yii::t('oboom.comments', 'activeStatus');?></span>
                        <?elseif($item->status==0) :?>
                            <span class="badge badge-danger"><?=\Yii::t('oboom.comments', 'blockedStatus');?></span>
                        <?endif;?>
                    </td>
                    <td class="center">
                        <?= Html::a('<i class="icon ion-md-create iconBase"></i>', '/news/category/update?id='.$item->id) ?>
                        <?= Html::a('<i class="icon ion-md-close-circle-outline iconBase"></i>', '/news/category/remove?id='.$item->id,
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
