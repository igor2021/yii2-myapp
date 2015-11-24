<?php

namespace frontend\modules\product\models;

use Yii;

/**
 * This is the model class for table "property".
 *
 * @property integer $id
 * @property string $name
 *
 * @property ProductProperty[] $productProperties
 */
class PropertyRecord extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'property';
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
    public function getProductProperties()
    {
        return $this->hasMany(ProductProperty::className(), ['property_id' => 'id']);
    }
}
