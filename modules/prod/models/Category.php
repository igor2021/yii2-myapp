<?php

namespace modules\prod\models;

use Yii;

/**
 * This is the model class for table "prod_category".
 *
 * @property integer $id
 * @property string $name
 *
 * @property ProdProduct[] $prodProducts
 */
class Category extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'prod_category';
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
    public function getProdProducts()
    {
        return $this->hasMany(ProdProduct::className(), ['category_id' => 'id']);
    }
}
