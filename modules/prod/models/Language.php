<?php

namespace modules\prod\models;

use Yii;

/**
 * This is the model class for table "prod_language".
 *
 * @property integer $id
 * @property string $name
 *
 * @property ProdProductHasLanguage[] $prodProductHasLanguages
 */
class Language extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'prod_language';
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
    public function getProdProductHasLanguages()
    {
        return $this->hasMany(ProdProductHasLanguage::className(), ['language_id' => 'id']);
    }
}
