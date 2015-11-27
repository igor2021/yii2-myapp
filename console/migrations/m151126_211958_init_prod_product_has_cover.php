<?php

use yii\db\Schema;
use yii\db\Migration;

class m151126_211958_init_prod_product_has_cover extends Migration
{
    public function up()
    {
    	$this->execute('
            CREATE TABLE `prod_product_has_cover` (
            	`id` INTEGER PRIMARY KEY AUTO_INCREMENT,
                `product_id` INTEGER NOT NULL,
            	`cover_id` INTEGER NOT NULL,
            	UNIQUE KEY (`product_id`),
                FOREIGN KEY (`product_id`) REFERENCES `prod_product`(`id`) ON DELETE CASCADE ON UPDATE CASCADE,
            	FOREIGN KEY (`cover_id`) REFERENCES `prod_cover`(`id`) ON DELETE CASCADE ON UPDATE CASCADE
            ) ENGINE=InnoDB DEFAULT CHARSET=utf8;
        ');
    }

    public function down()
    {
        $this->dropTable('prod_product_has_cover');
        
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
