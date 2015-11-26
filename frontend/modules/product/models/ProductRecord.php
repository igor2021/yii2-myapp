<?php

namespace frontend\modules\product\models;

use Yii;
use yii\helpers\ArrayHelper;
use yii\helpers\VarDumper;
use yii\widgets\ActiveField;
use yii\web\MethodNotAllowedHttpException;

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
 * @property ProductCover $cover
 * @property ProductPaper $paper
 * @property ProductLanguage $language
 * 
 * @property ProductHasCover $productHasCover
 * @property ProductHasLanguage $productHasLanguage
 * @property ProductHasPaper $productHasPaper
 * 
 */
class ProductRecord extends \yii\db\ActiveRecord
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
        return $this->hasOne(ProductCategoryRecord::className(), ['id' => 'category_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCover()
    {
        return $this->hasOne(ProductCoverRecord::className(), ['id' => 'cover_id'])
            ->viaTable('product_has_cover', ['product_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getPaper()
    {
        return $this->hasOne(ProductPaperRecord::className(), ['id' => 'paper_id'])
            ->viaTable('product_has_paper', ['product_id' => 'id']);
    }
    
    /**
     * @return \yii\db\ActiveQuery
     */
    public function getLanguage()
    {
        return $this->hasOne(ProductLanguageRecord::className(), ['id' => 'language_id'])
        ->viaTable('product_has_language', ['product_id' => 'id']);
    }
    
    
    /**
     * @return \yii\db\ActiveQuery
     */
    public function getProductHasCover()
    {
        return $this->hasOne(ProductHasCoverRecord::className(), ['product_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getProductHasLanguage()
    {
        return $this->hasOne(ProductHasLanguageRecord::className(), ['product_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getProductHasPaper()
    {
        return $this->hasOne(ProductHasPaperRecord::className(), ['product_id' => 'id']);
    }
    
    /**
     * @return array(items, options) name-value/key-value pairs.
     * For use in ActiveField->dropDownList()
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
    
    /**
     * @return array(items, options) name-value/key-value pairs.
     * For use in ActiveField->dropDownList()
     */
    public function dropDownListCovers()
    {
        $records = ProductCoverRecord::find()->all();
        $items = ArrayHelper::map($records,'id','name');
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
        $records = ProductPaperRecord::find()->all();
        $items = ArrayHelper::map($records,'id','name');
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
        $records = ProductLanguageRecord::find()->all();
        $items = ArrayHelper::map($records,'id','name');
        $options = [
            'prompt' => 'Виберите язык...'
        ];
    
        return ['items' => $items, 'options' => $options];
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
