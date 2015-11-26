<?php

namespace frontend\modules\product\models;

use Yii;
use yii\web\MethodNotAllowedHttpException;

/**
 * This is the model class for table "product_has_paper".
 *
 * @property integer $id
 * @property integer $product_id
 * @property integer $paper_id
 *
 * @property Product $product
 * @property ProductPaper $paper
 */
class ProductHasPaperRecord extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'product_has_paper';
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
        return $this->hasOne(Product::className(), ['id' => 'product_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getPaper()
    {
        return $this->hasOne(ProductPaper::className(), ['id' => 'paper_id']);
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
