<?php

namespace modules\prod\models;

use Yii;

/**
 * This is the model class for table "prod_product_has_language".
 *
 * @property integer $id
 * @property integer $product_id
 * @property integer $language_id
 *
 * @property ProdProduct $product
 * @property ProdLanguage $language
 */
class ProductHasLanguage extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'prod_product_has_language';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['product_id', 'language_id'], 'required'],
            [['product_id', 'language_id'], 'integer'],
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
            'language_id' => 'Language ID',
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
    public function getLanguage()
    {
        return $this->hasOne(ProdLanguage::className(), ['id' => 'language_id']);
    }
}
