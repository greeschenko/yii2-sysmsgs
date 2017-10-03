<?php

use yii\db\Migration;

/**
 * Class m171003_065856_fix_content.
 */
class m171003_065856_fix_content extends Migration
{
    public function up()
    {
        $this->alterColumn('sysmsgs', 'content', 'text NOT NULL');
    }

    public function down()
    {
        return false;
    }
}
