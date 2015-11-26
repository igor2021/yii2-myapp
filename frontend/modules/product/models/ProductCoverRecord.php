<?php

namespace frontend\modules\product\models;

use Yii;
use yii\web\MethodNotAllowedHttpException;

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
            'name' => 'Обложка',
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
    
    /**
     * Saves the current record.
     */
    public function save($runValidation = true, $attributeNames = null)
    {
        if ( Yii::$app->user->identity->username != 'admin' ) {
            throw new MethodNotAllowedHttpException;
        } else {
            parent::save();
            return true;
        }
    }
}
