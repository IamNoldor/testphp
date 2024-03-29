<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "postqueue".
 *
 * @property int $id
 * @property int $post_id
 * @property string $post_at
 * @property string $notification_sent_at
 *
 * @property Post $post
 */
class Postqueue extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'postqueue';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        $now = date('Y-m-d');
        return [
            [['post_id', 'post_at'], 'required'],
            ['post_at', 'default', 'value' => $now],
            [['post_id'], 'integer'],
            [['post_at', 'notification_sent_at'], 'safe'],
            [['post_id'], 'exist', 'skipOnError' => true, 'targetClass' => Post::className(), 'targetAttribute' => ['post_id' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'post_id' => 'Post ID',
            'post_at' => 'Post At',
            'notification_sent_at' => 'Notification Sent At',
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
