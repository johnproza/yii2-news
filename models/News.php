<?php

namespace oboom\news\models;

use Yii;
use yii\behaviors\TimestampBehavior;
use oboom\comments\models\Comments;

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
    const EVENT_INCREMENT_VIEW='inc_view';
    const EVENT_COUNT_VIEWS='count_views';
    public $countComments=0;

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
            [['created_by', 'status', 'created_at', 'updated_at', 'category_id','views','comments'], 'integer'],
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
            'comments' => Yii::t('oboom.news', 'Comments'),
            'views' => Yii::t('oboom.news', 'Views'),
        ];
    }

    public function behaviors()
    {

        return [
            TimestampBehavior::className(),
            [
                'class' => 'oboom\gallery\behaviors\AttachGallery',
                'mainPathUpload'=>Yii::$app->params['uploadPath'].'/uploads',
                'mode'=>'multiple',
                'type' => 'news',
                'thumbSize'=>[
                    'x'=>600,
                    'y'=>480
                ]
            ],
        ];
    }

    public function init()
    {
        parent::init();
        $this->on(self::EVENT_INCREMENT_VIEW, [$this, 'incrementView']);
        $this->on(self::EVENT_COUNT_VIEWS, [$this, 'countViews']);
    }

    public function incrementView($event,$type="news"){
        $event->sender->views = ++$event->sender->views;
        $count = Comments::find()->where(['relatedTo'=>$type,'entityId'=>$event->sender->id])->count();
        $event->sender->countComments = $count ? $count : 0;
        $event->sender->save();
    }

    public function countViews($event,$type="news"){
        $count = Comments::find()->where(['relatedTo'=>$type,'entityId'=>$event->sender->id])->count();
        $event->sender->countComments = $count ? $count : 0;
        $event->sender->save();
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
        $data = News::find()->where(['category_id'=>$id,'status'=>1])->limit($limit)->all();
        foreach ($data as $item){
            $item->trigger(self::EVENT_COUNT_VIEWS);
        }
        return $data;
    }

    public static function getItem($cat=null,$item=null){
        $category = NewsCategory::find()->joinWith('seo')->where(['seo.url'=>$cat])->limit(1)->one();
        if(is_null($item)) {
            return News::find()->where(['category_id'=>$category->id,'status'=>1])->all();
        }
        else {

            return $itemInfo = News::find()->joinWith('seo')->where(['category_id'=>$category->id,'seo.url'=>$item,'status'=>1])->limit(1)->one();
        }
    }

    public static function getCat($cat=null){
        $category = NewsCategory::find()->joinWith('seo')->where(['seo.url'=>$cat])->limit(1)->one();
        if(!is_null($category)) {
            return $category;
        }
    }

}