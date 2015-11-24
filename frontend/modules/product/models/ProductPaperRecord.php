<?php

namespace frontend\modules\product\models;

use Yii;

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
            'name' => 'Name',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getProductPropPapers()
    {
        return $this->hasMany(ProductPropPaper::className(), ['paper_id' => 'id']);
    }
}
