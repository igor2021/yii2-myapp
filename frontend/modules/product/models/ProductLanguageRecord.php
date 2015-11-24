<?php

namespace frontend\modules\product\models;

use Yii;

/**
 * This is the model class for table "product_language".
 *
 * @property integer $id
 * @property string $name
 *
 * @property ProductPropLanguage[] $productPropLanguages
 */
class ProductLanguageRecord extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'product_language';
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
    public function getProductPropLanguages()
    {
        return $this->hasMany(ProductPropLanguage::className(), ['language_id' => 'id']);
    }
}
