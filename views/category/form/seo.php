<?php
/**
 * Created by PhpStorm.
 * User: john
 * Date: 10.11.2018
 * Time: 1:08
 */


?>
<div class="tabContent row">
    <div class="col-lg-12 col-md-12">
        <?= $form->field($seo, 'title')->textInput(['autofocus' => true,'placeholder'=>'Заголовок'])->label(false) ?>
    </div>

    <div class="col-lg-12 col-md-12">
        <?= $form->field($seo, 'url')->textInput(['placeholder'=>'URL'])->label(false) ?>
    </div>

    <div class="col-lg-6 col-md-6">
        <?= $form->field($seo, 'description')->textarea(['placeholder'=>'Описание'])->label(false) ?>
    </div>

    <div class="col-lg-6 col-md-6">
        <?= $form->field($seo, 'keywords')->textarea(['placeholder'=>'Ключевые слова'])->label(false) ?>
    </div>
</div>



