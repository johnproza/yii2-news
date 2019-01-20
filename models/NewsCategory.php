<?php
/**
 * Created by PhpStorm.
 * User: john
 * Date: 20.01.2019
 * Time: 14:00
 */

namespace oboom\news\models;
use Yii;
use yii\behaviors\TimestampBehavior;

/**
 * This is the model class for table "news_category".
 *
 * @property int $id
 * @property string $title
 * @property int $created_at
 * @property int $status
 *
 * @property News[] $news
 */
class NewsCategory extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'news_category';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['title', 'created_at','seo_id'], 'required'],
            [['created_at', 'status'], 'integer'],
            [['title'], 'string', 'max' => 150],
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
            'created_at' => Yii::t('oboom.news', 'CreatedAt'),
            'status' => Yii::t('oboom.news', 'Status'),
        ];
    }

    public function behaviors()
    {
        return [
            [

                'class' => TimestampBehavior::className(),
                'updatedAtAttribute' => false,

            ],
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getNews()
    {
        return $this->hasMany(News::className(), ['category_id' => 'id']);
    }

    public function getSeo()
    {
        return $this->hasOne(Seo::className(), ['id' => 'seo_id']);

    }
}