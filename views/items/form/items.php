<?php
/**
 * Created by PhpStorm.
 * User: john
 * Date: 10.11.2018
 * Time: 1:08
 */
use yii\helpers\ArrayHelper;
use \yii\helpers\Html;


?>
<div class="tabContent row">
    <div class="col-lg-12 col-md-12">
        <?= $form->field($items, 'title')->textInput(['autofocus' => true,'placeholder'=>\Yii::t('oboom.news', 'Title')])->label(false) ?>
    </div>

    <div class="col-lg-12 col-md-12">
        <?= $form->field($items, 'preview')->textarea(['placeholder'=>\Yii::t('oboom.news', 'Preview')])->label(false) ?>
    </div>
    <div class="col-lg-12 col-md-12">
        <?= $form->field($items, 'content')->textarea(['placeholder'=>\Yii::t('oboom.news', 'Desc')])->label(false) ?>
    </div>

    <div class="col-lg-12 col-md-12 category">

        <?= $form->field($items, 'category_id')
                ->dropDownList(ArrayHelper::map($category,'id','title'),
                                ['prompt' => ' -- Выберите категорию --'])
                ->label(false)?>

    </div>

    <div class="col-lg-12 col-md-12">
        <?= $form->field($items, 'status')
            ->radioList([1 => 'Опубликовано',
                         0 => 'Не опубликовано'])?>
    </div>
</div>