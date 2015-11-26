<?php

namespace frontend\modules\product\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use frontend\modules\product\models\ProductRecord;
use yii\helpers\VarDumper;

/**
 * ProductRecordSearch represents the model behind the search form about `frontend\modules\product\models\ProductRecord`.
 */
class ProductRecordSearch extends ProductRecord
{
    /** 
     * @var string query. For use for search query.
     * @var string category
     * @var string cover
     * @var string paper
     * @var string language
     */
    public $search;
    public $category;
    public $cover;
    public $paper;
    public $language;
    
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'category_id', 'created_at', 'updated_at'], 'integer'],
            [['name', 'description', 'category', 'cover', 'paper', 'language', 'search'], 'safe'],
        ];
    }
    
    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'search' => 'Поиск',
        ];
    }

    /**
     * @inheritdoc
     */
    public function scenarios()
    {
        // bypass scenarios() implementation in the parent class
        return Model::scenarios();
    }

    /**
     * Creates data provider instance with search query applied
     *
     * @param array $params
     *
     * @return ActiveDataProvider
     */
    public function search($params)
    {
        $query = ProductRecord::find();
        
        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);
        
        $this->load($params);
        
        if (!$this->validate()) {
            // uncomment the following line if you do not want to return any records when validation fails
            // $query->where('0=1');
            return $dataProvider;
        }
        
        $query->joinWith('category');
        $dataProvider->sort->attributes['category'] = [
            'asc' => ['product_category.name' => SORT_ASC],
            'desc' => ['product_category.name' => SORT_DESC]
        ];
        
        $query->joinWith('cover');
        $dataProvider->sort->attributes['cover'] = [
            'asc' => ['product_cover.name' => SORT_ASC],
            'desc' => ['product_cover.name' => SORT_DESC]
        ];
        
        $query->joinWith('paper');
        $dataProvider->sort->attributes['paper'] = [
            'asc' => ['product_paper.name' => SORT_ASC],
            'desc' => ['product_paper.name' => SORT_DESC]
        ];

        $query->joinWith('language');
        $dataProvider->sort->attributes['language'] = [
            'asc' => ['product_language.name' => SORT_ASC],
            'desc' => ['product_language.name' => SORT_DESC]
        ];
        
        $query->andFilterWhere([
            'id' => $this->id,
            'category_id' => $this->category_id,
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
        ]);

        $query->andFilterWhere(['like', 'product.name', $this->name])
            ->andFilterWhere(['like', 'product.description', $this->description]);
        
        /* Addition conditions/filters */
        do {
            if ( $this->search ) {
                $query->orFilterWhere(['like', 'product.name', $this->search])
                    ->orFilterWhere(['like', 'product.description', $this->search])
                    ->orFilterWhere(['like', 'product_category.name', $this->search])
                    ->orFilterWhere(['like', 'product_cover.name', $this->search])
                    ->orFilterWhere(['like', 'product_paper.name', $this->search])
                    ->orFilterWhere(['like', 'product_language.name', $this->search]);
                
                 goto OUT;
            }
            if ( $this->category ) {
                $query->andWhere(['like', 'product_category.name', $this->category]);
            }
            if ( $this->cover ) {
                $query->andWhere(['like', 'product_cover.name', $this->cover]);
            }
            if ( $this->paper ) {
                $query->andWhere(['like', 'product_paper.name', $this->paper]);
            }
            if ( $this->language ) {
                $query->andWhere(['like', 'product_language.name', $this->language]);
            }
        } while(0);
        
        OUT:
        
        return $dataProvider;
    }
}
