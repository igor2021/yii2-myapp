<?php

use yii\db\Schema;
use yii\db\Migration;

class m151127_093558_extend_prod_product extends Migration
{
    public function up()
    {
        $this->addColumn('prod_product', 'created_by', 'integer');
        $this->addColumn('prod_product', 'updated_by', 'integer');
        
        $this->addForeignKey('prod_product_created_by', 'prod_product', 'created_by', 'user', 'id');
        $this->addForeignKey('prod_product_updated_by', 'prod_product', 'updated_by', 'user', 'id');
    }

    public function down()
    {
        $this->dropForeignKey('prod_product_created_by', 'prod_product');
        $this->dropForeignKey('prod_product_created_by', 'prod_product');
        
        $this->dropColumn('prod_product', 'created_by', 'integer');
        $this->dropColumn('prod_product', 'updated_by', 'integer');
        
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
