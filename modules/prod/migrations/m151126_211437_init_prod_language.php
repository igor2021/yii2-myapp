<?php

use yii\db\Schema;
use yii\db\Migration;

class m151126_211437_init_prod_language extends Migration
{
    public function up()
    {
    	$this->execute('
            CREATE TABLE `prod_language` (
                `id` INTEGER PRIMARY KEY AUTO_INCREMENT,
                `name` VARCHAR(64) NOT NULL
            ) ENGINE=InnoDB DEFAULT CHARSET=utf8;
        ');
    }

    public function down()
    {
        $this->dropTable('prod_language');
        
        return true;
    }

    /*
    // Use safeUp/safeDown to run migration code within a transaction
    public function safeUp()
    {
    }

    public function safeDown()
    {
    }
    */
}
