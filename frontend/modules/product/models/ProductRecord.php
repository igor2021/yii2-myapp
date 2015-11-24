<?php

namespace frontend\modules\product\models;

use Yii;
use frontend\modules\product\models\ProductCategoryRecord;
use yii\helpers\ArrayHelper;
use yii\helpers\VarDumper;
use yii\widgets\ActiveField;

/**
 * This is the model class for table "product".
 *
 * @property integer $id
 * @property integer $category_id
 * @property string $name
 * @property string $description
 * @property integer $created_at
 * @property integer $updated_at
 *
 * @property ProductCategory $category
 * @property ProductPropCover $productPropCover
 * @property ProductPropLanguage $productPropLanguage
 * @property ProductPropPaper $productPropPaper
 */
class ProductRecord extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'product';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['category_id', 'name'], 'required'],
            [['category_id', 'created_at', 'updated_at'], 'integer'],
            [['description'], 'string'],
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
            'category_id' => 'Category ID',
            'name' => 'Name',
            'description' => 'Description',
            'created_at' => 'Created At',
            'updated_at' => 'Updated At',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCategory()
    {
        return $this->hasOne(ProductCategory::className(), ['id' => 'category_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getProductPropCover()
    {
        return $this->hasOne(ProductPropCover::className(), ['product_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getProductPropLanguage()
    {
        return $this->hasOne(ProductPropLanguage::className(), ['product_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getProductPropPaper()
    {
        return $this->hasOne(ProductPropPaper::className(), ['product_id' => 'id']);
    }
    

    /**
     * @return array(items, options) name-value/key-value pairs.
     * For ActiveField->dropDownList()
     */
    public function dropDownListCategories()
    {
        $records = ProductCategoryRecord::find()->all();
        $items = ArrayHelper::map($records,'id','name');
        $options = [
            'prompt' => 'Виберите категорию...'
        ];
        
        return ['items' => $items, 'options' => $options];
        
    }
}
