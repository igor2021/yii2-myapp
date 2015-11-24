<?php

use yii\db\Schema;
use yii\db\Migration;

class m151124_124045_init_product extends Migration
{
    public function up()
    {
        $this->execute('
            CREATE TABLE `product` (
                `id` INTEGER PRIMARY KEY AUTO_INCREMENT,
                `category_id` INTEGER NOT NULL,
                `name` VARCHAR(64) NOT NULL,
                `description` TEXT,
                `created_at` INTEGER,
                `updated_at` INTEGER,
                FOREIGN KEY (`category_id`) REFERENCES `product_category`(`id`) ON DELETE CASCADE ON UPDATE CASCADE
            ) ENGINE=InnoDB DEFAULT CHARSET=utf8;
        ');
    }

    public function down()
    {        
        $this->dropTable('product');
        
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
