<?php

namespace common\models;

use Yii;
use yii\data\Pagination;

/**
 * This is the model class for table "article".
 *
 * @property int $id
 * @property string $title
 * @property string $body
 * @property int $category_id
 * @property int $status
 * @property int $created_by
 * @property int $updated_by
 * @property string $created_at
 * @property string $updated_at
 * @property string $deleted_at
 */
class Article extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'article';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['title', 'body', /*'status', 'created_by', 'updated_by', 'created_at', 'updated_at', 'deleted_at'*/], 'required'],
            [['body'], 'string'],
            [['category_id', 'status', 'created_by', 'updated_by'], 'integer'],
            [['created_at', 'updated_at', 'deleted_at'], 'safe'],
            [['title'], 'string', 'max' => 255],
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
            'body' => 'Описание',
            'category_id' => 'Category ID',
            'status' => 'Состояние',
            'created_by' => 'Created By',
            'updated_by' => 'Updated By',
            'created_at' => 'Created At',
            'updated_at' => 'Updated At',
            'deleted_at' => 'Deleted At',
        ];
    }

    public function pushArticle($type = 'create')
    {
        if (!$this->validate()) {
            return false;
        }

        $article = ($type == 'update') ?  Article::findOne($this->id) : new Article();
        $article->title = $this->title;
        $article->body = $this->body;
        $article->status = $this->status;
        $article->created_by = ($type == 'update') ? $article->created_by : $article->created_by = Yii::$app->user->id;
        $article->updated_by = Yii::$app->user->id;
        $article->created_at = ($type == 'update') ? $article->created_at : $article->created_at = date("Y-m-d H:i:s");
        $article->updated_at = date("Y-m-d H:i:s");


        return $article->save() ? $article : false;
    }

    public function getListArticles($status){
        $query = Article::find()->where(['article.status'=>$status])->orderBy(['id' => SORT_DESC]);
        $countQuery = clone $query;
        $pages = new Pagination(['totalCount' => $countQuery->count()]);
        $models = $query->offset($pages->offset)
            ->limit($pages->limit)
            ->all();

        return compact('models','pages' );
    }
    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCreatedBy()
    {
        return $this->hasOne(User::className(), ['id' => 'created_by']);
    }

}
