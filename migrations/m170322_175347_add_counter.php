<?php

use yii\db\Migration;

class m170322_175347_add_counter extends Migration
{
    public function up()
    {
        $this->addColumn('url','counter', $this->integer()->unsigned());
    }

    public function down()
    {
        echo "m170322_175347_add_counter cannot be reverted.\n";

        return false;
    }
}
