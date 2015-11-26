<?php

use yii\db\Schema;
use yii\db\Migration;

class m151124_174649_init_product_has_cover extends Migration
{
    public function up()
    {
        $this->execute('
            CREATE TABLE `product_has_cover` (
            	`id` INTEGER PRIMARY KEY AUTO_INCREMENT,
                `product_id` INTEGER NOT NULL,
            	`cover_id` INTEGER NOT NULL,
            	UNIQUE KEY (`product_id`),
                FOREIGN KEY (`product_id`) REFERENCES `product`(`id`) ON DELETE CASCADE ON UPDATE CASCADE,
            	FOREIGN KEY (`cover_id`) REFERENCES `product_cover`(`id`) ON DELETE CASCADE ON UPDATE CASCADE
            ) ENGINE=InnoDB DEFAULT CHARSET=utf8;
        ');
    }

    public function down()
    {
        $this->dropTable('product_has_cover');
        
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
