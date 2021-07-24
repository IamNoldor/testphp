<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "contactpost".
 *
 * @property int $post_id
 * @property string $contact_name
 * @property string $contact_email
 *
 * @property Post $post
 */
class Contactpost extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'contactpost';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['post_id', 'contact_email'], 'required'],
            ['contact_email', 'email'],
            [['post_id'], 'integer'],
            [['contact_name', 'contact_email'], 'string', 'max' => 255],
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
            'contact_name' => 'Contact Name',
            'contact_email' => 'Contact Email',
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
