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
        <?= $form->field($items, 'status')
            ->radioList([1 => 'Опубликовано',
                         0 => 'Не опубликовано'])?>
    </div>
</div>