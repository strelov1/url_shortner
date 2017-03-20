<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "url_counter".
 *
 * @property integer $id
 * @property integer $value
 */
class UrlCounter extends \yii\db\ActiveRecord
{
    const URL_COUNTER = 1;
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'url_counter';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['value'], 'integer'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'value' => Yii::t('app', 'Value'),
        ];
    }

    public static function getCount()
    {
        $count = self::find()
            ->where(['id' => self::URL_COUNTER])
            ->limit(1)
            ->asArray()
            ->one();

        return !empty($count['value']) ? $count['value'] : false;
    }
}