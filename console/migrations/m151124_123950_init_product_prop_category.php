<?php

use yii\db\Schema;
use yii\db\Migration;

class m151124_123950_init_product_prop_category extends Migration
{
    public function up()
    {
        $this->execute('
            CREATE TABLE `product_prop_category` (
                `id` INTEGER PRIMARY KEY AUTO_INCREMENT,
                `name` VARCHAR(64) NOT NULL
            ) ENGINE=InnoDB DEFAULT CHARSET=utf8;
        ');
    }

    public function down()
    {
        $this->dropTable('product_prop_category');
        
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
