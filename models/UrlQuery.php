<?php

namespace app\models;

/**
 * This is the ActiveQuery class for [[Url]].
 *
 * @see Url
 */
class UrlQuery extends \yii\db\ActiveQuery
{

    /**
     * @inheritdoc
     * @return Url[]|array
     */
    public function all($db = null)
    {
        return parent::all($db);
    }

    /**
     * @inheritdoc
     * @return Url|array|null
     */
    public function one($db = null)
    {
        return parent::one($db);
    }

    /**
     * @param $hash
     * @return $this
     */
    public function matchUrl($hash)
    {
        return $this->where(['short_url' => $hash]);
    }

    /**
     * @return $this
     */
    public function notExpired()
    {
        return $this->where(['>', 'expired_at', time()]);
    }
}
