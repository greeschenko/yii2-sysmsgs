<?php

use yii\db\Migration;

class m170422_163140_add_group extends Migration
{
    public function up()
    {
        $this->addColumn('sysmsgs', 'group', 'varchar(30) NULL');
    }

    public function down()
    {
        $this->dropColumn('sysmsgs', 'group');
    }
}
