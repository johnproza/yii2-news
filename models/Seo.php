<?php

namespace oboom\news\models;

use Yii;

/**
 * This is the model class for table "seo".
 *
 * @property int $id
 * @property string $title
 * @property string $description
 * @property string $keywords
 * @property string $url
 *
 * @property CatalogCategory[] $catalogCategories
 * @property CatalogItems[] $catalogItems
 */
class Seo extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'seo';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['title'], 'string', 'max' => 90],
            [['description', 'keywords'], 'string', 'max' => 150],
            [['url'], 'string', 'max' => 200],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'title' => 'Заголовок',
            'description' => 'Описание',
            'keywords' => 'Ключевые слова',
            'url' => 'Url',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getNews()
    {
        return $this->hasOne(News::className(), ['seo_id' => 'id']);
    }

    public function getCategory()
    {
        return $this->hasOne(NewsCategory::className(), ['seo_id' => 'id']);
    }



}
