<?php

namespace modules\prod\models;

use Yii;

/**
 * This is the model class for table "prod_product_has_cover".
 *
 * @property integer $id
 * @property integer $product_id
 * @property integer $cover_id
 *
 * @property ProdProduct $product
 * @property ProdCover $cover
 */
class ProductHasCover extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'prod_product_has_cover';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['product_id', 'cover_id'], 'required'],
            [['product_id', 'cover_id'], 'integer'],
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
            'cover_id' => 'Cover ID',
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
    public function getCover()
    {
        return $this->hasOne(ProdCover::className(), ['id' => 'cover_id']);
    }
}
