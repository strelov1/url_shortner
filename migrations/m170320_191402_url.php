<?php

use yii\db\Migration;

class m170320_191402_url extends Migration
{
    public function up()
    {
        $this->createTable('{{%url}}', [
            'id' => $this->primaryKey(),
            'long_url' => $this->string()->notNull()->unique(),
            'short_url' => $this->string()->notNull()->unique(),
            'expired_at' => $this->integer()->notNull(),
        ]);
    }

    public function down()
    {
        echo "m170320_191402_url cannot be reverted.\n";

        return false;
    }
}
