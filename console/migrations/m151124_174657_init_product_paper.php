<?php

use yii\db\Schema;
use yii\db\Migration;

class m151124_174657_init_product_paper extends Migration
{
    public function up()
    {
        $this->execute('
            CREATE TABLE `product_paper` (
            	`id` INTEGER PRIMARY KEY AUTO_INCREMENT,
            	`product_id` INTEGER NOT NULL,
            	`paper_id` INTEGER NOT NULL,
            	FOREIGN KEY product (`product_id`) REFERENCES `product`(`id`) ON DELETE CASCADE ON UPDATE CASCADE,
            	FOREIGN KEY product_prop_paper (`paper_id`) REFERENCES `product_prop_paper`(`id`) ON DELETE CASCADE ON UPDATE CASCADE
            ) ENGINE=InnoDB DEFAULT CHARSET=utf8;
        ');
    }

    public function down()
    {
        $this->dropTable('product_paper');

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
