<?php

namespace frontend\modules\product\models;

use Yii;
use yii\web\MethodNotAllowedHttpException;

/**
 * This is the model class for table "product_paper".
 *
 * @property integer $id
 * @property string $name
 *
 * @property ProductPropPaper[] $productPropPapers
 */
class ProductPaperRecord extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'product_paper';
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
            'name' => 'Бумага',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getProductPropPapers()
    {
        return $this->hasMany(ProductPropPaper::className(), ['paper_id' => 'id']);
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
