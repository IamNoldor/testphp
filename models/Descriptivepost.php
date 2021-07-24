<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "descriptivepost".
 *
 * @property int $post_id
 * @property string $position_description
 * @property int $salary
 * @property string $starts_at
 * @property string $ends_at
 *
 * @property Post $post
 */
class Descriptivepost extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'descriptivepost';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['post_id', 'ends_at'], 'required'],
            [['post_id', 'salary'], 'integer'],
            ['salary', 'default', 'value' => ''],
            [['starts_at', 'ends_at'], 'safe'],
            [['position_description'], 'string', 'max' => 1024],
            [['post_id'], 'exist', 'skipOnError' => true, 'targetClass' => Post::className(), 'targetAttribute' => ['post_id' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'post_id' => 'Post ID',
            'position_description' => 'Position Description',
            'salary' => 'Salary',
            'starts_at' => 'Starts At',
            'ends_at' => 'Ends At',
        ];
    }

    /**
     * Gets query for [[Post]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getPost()
    {
        return $this->hasOne(Post::className(), ['id' => 'post_id']);
    }
}
