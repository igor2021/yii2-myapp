<?php

namespace modules\prod\models;

use Yii;

/**
 * This is the model class for table "prod_paper".
 *
 * @property integer $id
 * @property string $name
 *
 * @property ProdProductHasPaper[] $prodProductHasPapers
 */
class Paper extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'prod_paper';
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
    public function getProdProductHasPapers()
    {
        return $this->hasMany(ProdProductHasPaper::className(), ['paper_id' => 'id']);
    }
}
