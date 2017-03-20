<?php

use yii\db\Migration;

class m170320_203223_url_counter extends Migration
{
    public function up()
    {
        $this->createTable('{{%url_counter}}', [
            'id' => $this->primaryKey(),
            'value' => $this->integer()->unsigned()
        ]);

        Yii::$app->db->createCommand()->insert('url_counter', [
            'value' => 0
        ])->execute();
    }

    public function down()
    {
        echo "m170320_203223_url_counter cannot be reverted.\n";
        return false;
    }
}
