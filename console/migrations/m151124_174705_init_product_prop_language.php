<?php

use yii\db\Schema;
use yii\db\Migration;

class m151124_174705_init_product_prop_language extends Migration
{
    public function up()
    {
        $this->execute('
            CREATE TABLE `product_prop_language` (
            	`product_id` INTEGER NOT NULL,
            	`language_id` INTEGER NOT NULL,
            	PRIMARY KEY (`product_id`),
                FOREIGN KEY (`product_id`) REFERENCES `product`(`id`) ON DELETE CASCADE ON UPDATE CASCADE,
            	FOREIGN KEY (`language_id`) REFERENCES `product_language`(`id`) ON DELETE CASCADE ON UPDATE CASCADE
            ) ENGINE=InnoDB DEFAULT CHARSET=utf8;
        ');
    }

    public function down()
    {
        $this->dropTable('product_prop_language');

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
