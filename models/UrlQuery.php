<?php

namespace app\models;

/**
 * This is the ActiveQuery class for [[Url]].
 *
 * @see Url
 */
class UrlQuery extends \yii\db\ActiveQuery
{
    /*public function active()
    {
        return $this->andWhere('[[status]]=1');
    }*/

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
}
