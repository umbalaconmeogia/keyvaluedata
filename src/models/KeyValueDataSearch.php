<?php

namespace umbalaconmeogia\keyvaluedata\models;

use yii\base\Model;
use yii\data\ActiveDataProvider;

/**
 * KeyValueDataSearch represents the model behind the search form of `KeyValueData`.
 */
class KeyValueDataSearch extends KeyValueData
{
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id', 'data_status', 'created_by', 'created_at', 'updated_by', 'updated_at'], 'integer'],
            [['category', 'key', 'value'], 'safe'],
        ];
    }

    /**
     * {@inheritdoc}
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
        $query = KeyValueData::find();

        // add conditions that should always apply here

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

        $this->load($params);

        if (!$this->validate()) {
            // uncomment the following line if you do not want to return any records when validation fails
            // $query->where('0=1');
            return $dataProvider;
        }

        // if ($this->category == self::SELECT_CATEGORY) {
        //     $query->andWhere('category IS NULL');
        // } else if ($this->category !== self::SELECT_CATEGORY) {
        //     $query->andFilterWhere(['like', 'category', $this->category]);
        // }

        // grid filtering conditions
        $query->andFilterWhere([
            'id' => $this->id,
            'data_status' => $this->data_status,
            'created_by' => $this->created_by,
            'created_at' => $this->created_at,
            'updated_by' => $this->updated_by,
            'updated_at' => $this->updated_at,
        ]);

        $query->andFilterWhere(['like', 'category', $this->category]);
        $query->andFilterWhere(['like', 'key', $this->key])
            ->andFilterWhere(['like', 'value', $this->value]);

        return $dataProvider;
    }

    /**
     * Creates data provider instance with search query applied
     *
     * @param array $params
     *
     * @return ActiveDataProvider
     */
    public function searchCategory($params)
    {
        $queryCountCategoryElement = KeyValueData::find()
            ->select(['category', 'count' => new \yii\db\Expression('COUNT(*)')])
            ->groupBy('category');
        $query = KeyValueData::find()
        ->select(['kv1.*', 'kv2.count'])
        ->from(['kv1' => 'key_value_data'])
        ->leftJoin(['kv2' => $queryCountCategoryElement], 'kv1.key = kv2.category')
        ->andWhere(['kv1.category' => static::SELECT_CATEGORY]);

        // $query = KeyValueData::find()
        //         ->select(['kv1.id', 'kv1.category', 'kv1.value', 'count' => new \yii\db\Expression('COUNT(*)')])
        //         ->from(['kv1' => 'key_value_data'])
        //         ->leftJoin(['kv2' => 'key_value_data'], 'kv1.key = kv2.category')
        //         ->andWhere(['kv1.category' => static::SELECT_CATEGORY])
        //         ->groupBy('kv2.category');

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
            'pagination' => FALSE,
        ]);

        $this->load($params);

        if (!$this->validate()) {
            // uncomment the following line if you do not want to return any records when validation fails
            // $query->where('0=1');
            return $dataProvider;
        }

        return $dataProvider;
    }
}
