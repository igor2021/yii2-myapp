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
 *
 * @property ProdCategory $category
 * @property ProdCover $cover
 * @property ProdPaper $paper
 * @property ProdLanguage $language
 * @property ProdProductHasCover $prodProductHasCover
 * @property ProdProductHasLanguage $prodProductHasLanguage
 * @property ProdProductHasPaper $prodProductHasPaper
 */
class Product extends \yii\db\ActiveRecord
{
	/**
	 * @var integer cover_id
	 * @var integer parer_id
	 * @var integer language_id
	 * For use in, for example, ActiveForm->field()
	 */
	public $cover_id;
	public $paper_id;
	public $language_id;
    
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
            'category_id' => 'Категория',
            'name' => 'Продукт',
            'description' => 'Описание',
            'created_at' => 'Создано',
            'updated_at' => 'Обновлено',
            'cover_id' => 'Обложка',
            'paper_id' => 'Бумага',
            'language_id' => 'Язык',
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
    public function getProdProductHasCover()
    {
        return $this->hasOne(ProdProductHasCover::className(), ['product_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getProdProductHasLanguage()
    {
        return $this->hasOne(ProdProductHasLanguage::className(), ['product_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getProdProductHasPaper()
    {
        return $this->hasOne(ProdProductHasPaper::className(), ['product_id' => 'id']);
    }
    
    /**
     * @return array(items, options) name-value/key-value pairs.
     * For use in ActiveField->dropDownList()
     */
    public function dropDownListCategories()
    {
        $models = Category::find()->all();
        $items = ArrayHelper::map($models,'id','name');
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
        $items = ArrayHelper::map($models,'id','name');
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
        $items = ArrayHelper::map($models,'id','name');
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
        $items = ArrayHelper::map($models,'id','name');
        $options = [
            'prompt' => 'Виберите язык...'
        ];
    
        return ['items' => $items, 'options' => $options];
    }
}
