<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "post".
 *
 * @property int $id
 * @property int $type
 * @property string $company_name
 * @property string $position
 *
 * @property Contactpost[] $contactposts
 * @property Descriptivepost[] $descriptiveposts
 * @property Postqueue[] $postqueues
 */
class Post extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'post';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['type', 'company_name', 'position'], 'required'],
            [['type'], 'string', 'max' => 50],
            [['company_name', 'position'], 'string', 'max' => 255],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'type' => 'Type',
            'company_name' => 'Company Name',
            'position' => 'Position',
        ];
    }

    /**
     * Gets query for [[Contactposts]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getContactposts()
    {
        return $this->hasMany(Contactpost::className(), ['post_id' => 'id']);
    }

    /**
     * Gets query for [[Descriptiveposts]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getDescriptiveposts()
    {
        return $this->hasMany(Descriptivepost::className(), ['post_id' => 'id']);
    }

    /**
     * Gets query for [[Postqueues]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getPostqueues()
    {
        return $this->hasMany(Postqueue::className(), ['post_id' => 'id']);
    }
}
