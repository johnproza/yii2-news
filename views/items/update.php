<?php
/**
 * Created by PhpStorm.
 * User: john
 * Date: 27.12.2018
 * Time: 19:32
 */
use yii\helpers\Html;
use oboom\news\BaseAssetsBundle;
use yii\bootstrap4\ActiveForm;
use yii\bootstrap4\Tabs;
use yii\jui\Sortable;
use oboom\gallery\widgets\GalleryWidgets;
$this->title = Yii::t('oboom.news', 'update');
BaseAssetsBundle::register($this);
?>
<div class="mainSection">
    <?php $form = ActiveForm::begin(['id' => 'newsItem',
            'enableClientValidation' => true,
            'options' => [
                'class' => 'form',
                'enctype' => 'multipart/form-data',
                'validateOnSubmit' => true,
            ]
        ]); ?>
    <?php echo Tabs::widget([
        'items' => [
            [
                'label' => 'Описание',
                'content' =>  $this->render('form/items', ['items' => $items, 'form'=> $form, 'category'=>$category]),
                'active' => true
            ],
            [
                'label' => 'Фото',
                'content' => GalleryWidgets::widget([
                    'model'=>$items,
                    'type'=>'news',
                    'max'=>5,
                    'params'=>[
                        'type'=>'multiple',
                        'className'=>'foto',
                        'aspectRatio'=>[16,9],
                    ],
                ])
            ],
            [
                'label' => 'SEO',
                'content' => $this->render('form/seo', ['seo' => $seo, 'form'=> $form]),
            ],

        ],
    ]); ?>
    <div class="form-group">
        <?= Html::submitButton('Сохранить', ['class' => 'btn btn-primary', 'name' => 'login-button']) ?>
        <?= Html::a('Отмена', Yii::$app->request->referrer, ['class'=>'btn btn-danger']) ?>
    </div>
    <?php ActiveForm::end(); ?>

</div>
