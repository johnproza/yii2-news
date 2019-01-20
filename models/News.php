<?php

namespace oboom\news\models;

use Yii;

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
            [['title', 'content', 'created_by'], 'required'],
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
            'title' => 'Title',
            'preview' => 'Preview',
            'content' => 'Content',
            'created_by' => 'Created By',
            'status' => 'Status',
            'created_at' => 'Created At',
            'updated_at' => 'Updated At',
            'category_id' => 'Category ID',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCategory()
    {
        return $this->hasOne(NewsCategory::className(), ['id' => 'category_id']);
    }
}