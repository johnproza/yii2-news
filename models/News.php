<?php

namespace oboom\news\models;

use Yii;
use yii\behaviors\TimestampBehavior;

/**
 * This is the model class for table "news".
 *
 * @property int $id
 * @property string $title
 * @property string $preview
 * @property string $content
 * @property int $created_by
 * @property int $status
 * @property int $created_at
 * @property int $updated_at
 * @property int $category_id
 *
 * @property NewsCategory $category
 */
class News extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'news';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['title', 'content', 'created_by','seo_id'], 'required'],
            [['content'], 'string'],
            [['created_by', 'status', 'created_at', 'updated_at', 'category_id'], 'integer'],
            [['title'], 'string', 'max' => 200],
            [['preview'], 'string', 'max' => 250],
            [['category_id'], 'exist', 'skipOnError' => true, 'targetClass' => NewsCategory::className(), 'targetAttribute' => ['category_id' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'title' => Yii::t('oboom.news', 'Title'),
            'preview' => Yii::t('oboom.news', 'Preview'),
            'content' => Yii::t('oboom.news', 'Desc'),
            'created_by' => Yii::t('oboom.news', 'CreatedBy'),
            'status' => Yii::t('oboom.news', 'Status'),
            'created_at' => Yii::t('oboom.news', 'CreatedAt'),
            'updated_at' => Yii::t('oboom.news', 'UpdatedAt'),
            'category_id' => Yii::t('oboom.news', 'Category'),
        ];
    }

    public function behaviors()
    {

        return [
            TimestampBehavior::className(),
            [
                'class' => 'oboom\gallery\behaviors\AttachGallery',
                'mainPathUpload'=>Yii::$app->params['uploadPath'].'/uploads',
                'mode'=>'single',
                'type' => 'news',
                'thumbSize'=>[
                    'x'=>640,
                    'y'=>480
                ]
            ],
        ];
    }


    public function getCategory()
    {
        return $this->hasOne(NewsCategory::className(), ['id' => 'category_id']);
    }

    public function getAuthor()
    {
        return $this->hasOne(Yii::$app->getModule('comments')->userIdentityClass, ['id' => 'created_by']);

    }

    public function getSeo()
    {
        return $this->hasOne(Seo::className(), ['id' => 'seo_id']);

    }

    public static function getNewsData($id,$limit){
        return News::find()->where(['category_id'=>$id,'status'=>1])->limit($limit)->all();
    }
}