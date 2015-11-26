<?php

namespace frontend\modules\product\models;

use Yii;
use yii\web\MethodNotAllowedHttpException;

/**
 * This is the model class for table "product_category".
 *
 * @property integer $id
 * @property string $name
 */
class ProductCategoryRecord extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'product_category';
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
            'name' => 'Категория',
        ];
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
