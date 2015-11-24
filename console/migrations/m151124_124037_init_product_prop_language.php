<?php

use yii\db\Schema;
use yii\db\Migration;

class m151124_124037_init_product_prop_language extends Migration
{
    public function up()
    {
        $this->execute('
            CREATE TABLE `product_prop_language` (
                `id` INTEGER PRIMARY KEY AUTO_INCREMENT,
                `name` VARCHAR(64) NOT NULL
            ) ENGINE=InnoDB DEFAULT CHARSET=utf8;
        ');
    }

    public function down()
    {
        $this->dropTable('product_prop_language');
        
        return false;
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
