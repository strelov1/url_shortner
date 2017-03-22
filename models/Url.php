<?php

namespace app\models;

use app\behaviors\CounterBehavior;
use app\behaviors\ExpiredBehavior;
use Yii;

/**
 * This is the model class for table "url".
 *
 * @property integer $id
 * @property integer $counter
 * @property string $long_url
 * @property string $short_url
 * @property integer $expired_at
 */
class Url extends \yii\db\ActiveRecord
{

    public function behaviors()
    {
        return [
            ExpiredBehavior::className(),
            // Counter for url-shorter with Counter
            // CounterBehavior::className(),
        ];
    }

    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'url';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['long_url', 'short_url'], 'required'],
            [['expired_at', 'counter'], 'integer'],
            [['long_url', 'short_url'], 'string', 'max' => 255],
            [['long_url'], 'unique'],
            [['short_url'], 'unique'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'counter' => Yii::t('app', 'Counter'),
            'long_url' => Yii::t('app', 'Long Url'),
            'short_url' => Yii::t('app', 'Short Url'),
            'expired_at' => Yii::t('app', 'Expired At'),
        ];
    }

    /**
     * @return bool
     */
    public function isExpired()
    {
        return $this->expired_at < time();
    }

    /**
     * Counter redirect
     * @return bool
     */
    public function counted()
    {
        if ($this->counter === null) {
            $this->counter = 1;
            return $this->save(false);
        } else {
            return $this->updateCounters(['counter' => 1]);
        }
    }

    /**
     * @inheritdoc
     * @return UrlQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new UrlQuery(get_called_class());
    }
}
