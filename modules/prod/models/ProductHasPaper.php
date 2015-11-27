<?php

namespace modules\prod\models;

use Yii;

/**
 * This is the model class for table "prod_product_has_paper".
 *
 * @property integer $id
 * @property integer $product_id
 * @property integer $paper_id
 *
 * @property ProdProduct $product
 * @property ProdPaper $paper
 */
class ProductHasPaper extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'prod_product_has_paper';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['product_id', 'paper_id'], 'required'],
            [['product_id', 'paper_id'], 'integer'],
            [['product_id'], 'unique']
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'product_id' => 'Product ID',
            'paper_id' => 'Paper ID',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getProduct()
    {
        return $this->hasOne(ProdProduct::className(), ['id' => 'product_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getPaper()
    {
        return $this->hasOne(ProdPaper::className(), ['id' => 'paper_id']);
    }
}
