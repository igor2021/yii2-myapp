<?php

namespace modules\prod\models;

use Yii;
use yii\helpers\ArrayHelper;
use yii\widgets\ActiveField;

/**
 * This is the model class for table "prod_product".
 *
 * @property integer $id
 * @property integer $category_id
 * @property string $name
 * @property string $description
 * @property integer $created_at
 * @property integer $updated_at
 * @property integer $created_by
 * @property integer $updated_by
 *
 * @property Category $category
 * @property Cover $cover
 * @property Paper $paper
 * @property Language $language
 * @property ProductHasCover $prodProductHasCover
 * @property ProductHasLanguage $prodProductHasLanguage
 * @property ProductHasPaper $prodProductHasPaper
 */
class Product extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'prod_product';
    }
    
    /**
     * {@inheritDoc}
     * @see \yii\base\Component::behaviors()
     */
    public function behaviors()
    {
        return [
            'timestamp' => \yii\behaviors\TimestampBehavior::className(),
        ];
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
            [['name'], 'string', 'max' => 64],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'category_id' => 'Категория',
            'name' => 'Продукт',
            'description' => 'Описание',
            'created_at' => 'Создано',
            'updated_at' => 'Обновлено',
            'cover' => 'Обложка',
            'pape' => 'Бумага',
            'language' => 'Язык',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCategory()
    {
        return $this->hasOne(Category::className(), ['id' => 'category_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCover()
    {
        return $this->hasOne(Cover::className(), ['id' => 'cover_id'])
            ->viaTable('prod_product_has_cover', ['product_id' => 'id']);
    }
    
    /**
     * @return \yii\db\ActiveQuery
     */
    public function getPaper()
    {
        return $this->hasOne(Paper::className(), ['id' => 'paper_id'])
            ->viaTable('prod_product_has_paper', ['product_id' => 'id']);
    }
    
    /**
     * @return \yii\db\ActiveQuery
     */
    public function getLanguage()
    {
        return $this->hasOne(Language::className(), ['id' => 'language_id'])
            ->viaTable('prod_product_has_language', ['product_id' => 'id']);
    }
    
    /**
     * @return \yii\db\ActiveQuery
     */
    public function getProductHasCover()
    {
        return $this->hasOne(ProductHasCover::className(), ['product_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getProductHasLanguage()
    {
        return $this->hasOne(ProductHasLanguage::className(), ['product_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getProductHasPaper()
    {
        return $this->hasOne(ProductHasPaper::className(), ['product_id' => 'id']);
    }
    
    /**
     * @return array(items, options) name-value/key-value pairs.
     * For use in ActiveField->dropDownList()
     */
    public function dropDownListCategories()
    {
        $models = Category::find()->all();
        $items = ArrayHelper::map($models, 'id', 'name');
        $options = [
            'prompt' => 'Виберите категорию...'
        ];
    
        return ['items' => $items, 'options' => $options];
    }
    
    /**
     * @return array(items, options) name-value/key-value pairs.
     * For use in ActiveField->dropDownList()
     */
    public function dropDownListCovers()
    {
        $models = Cover::find()->all();
        $items = ArrayHelper::map($models, 'id', 'name');
        $options = [
            'prompt' => 'Виберите обложку...'
        ];
    
        return ['items' => $items, 'options' => $options];
    }
    
    /**
     * @return array(items, options) name-value/key-value pairs.
     * For use in ActiveField->dropDownList()
     */
    public function dropDownListPapers()
    {
        $models = Paper::find()->all();
        $items = ArrayHelper::map($models, 'id', 'name');
        $options = [
            'prompt' => 'Виберите бумагу...'
        ];
    
        return ['items' => $items, 'options' => $options];
    }
    
    /**
     * @return array(items, options) name-value/key-value pairs.
     * For ActiveField->dropDownList()
     */
    public function dropDownListLanguages()
    {
        $models = Language::find()->all();
        $items = ArrayHelper::map($models, 'id', 'name');
        $options = [
            'prompt' => 'Виберите язык...'
        ];
    
        return ['items' => $items, 'options' => $options];
    }
}
