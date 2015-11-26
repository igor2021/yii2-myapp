<?php

namespace frontend\modules\product\models;

use Yii;
use yii\web\MethodNotAllowedHttpException;

/**
 * This is the model class for table "product_has_language".
 *
 * @property integer $id
 * @property integer $product_id
 * @property integer $language_id
 *
 * @property Product $product
 * @property ProductLanguage $language
 */
class ProductHasLanguageRecord extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'product_has_language';
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
        return $this->hasOne(Product::className(), ['id' => 'product_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getLanguage()
    {
        return $this->hasOne(ProductLanguage::className(), ['id' => 'language_id']);
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
    
    /**
     * Deletes the table row corresponding to this active record.
     *
     */
    public function delete()
    {
        if ( Yii::$app->user->identity->username != 'admin' ) {
            throw new MethodNotAllowedHttpException;
        } else {
            parent::delete();
            return true;
        }
    }
}
