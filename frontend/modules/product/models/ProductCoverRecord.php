<?php

namespace frontend\modules\product\models;

use Yii;

/**
 * This is the model class for table "product_cover".
 *
 * @property integer $id
 * @property string $name
 *
 * @property Product[] $products
 * @property ProductPropCover[] $productPropCovers
 */
class ProductCoverRecord extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'product_cover';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['name'], 'required'],
            [['name'], 'string', 'max' => 64]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'name' => 'Name',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getProducts()
    {
        return $this->hasMany(Product::className(), ['category_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getProductPropCovers()
    {
        return $this->hasMany(ProductPropCover::className(), ['cover_id' => 'id']);
    }
}
