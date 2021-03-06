<?php

namespace app\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\Newspartner;

/**
 * NewspartnerSearch represents the model behind the search form about `app\models\Newspartner`.
 */
class NewspartnerSearch extends Newspartner
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['ID', 'EstablishmentID', 'Views', 'Grey'], 'integer'],
            [['Name', 'About', 'Text', 'Photo', 'Date'], 'safe'],
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
        $query = Newspartner::find();

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

        $this->load($params);

        if (!$this->validate()) {
            // uncomment the following line if you do not want to return any records when validation fails
            // $query->where('0=1');
            return $dataProvider;
        }

        $query->andFilterWhere([
            'ID' => $this->ID,
            'EstablishmentID' => $this->EstablishmentID,
            'Date' => $this->Date,
            'Views' => $this->Views,
            'Grey' => $this->Grey,
        ]);

        $query->andFilterWhere(['like', 'Name', $this->Name])
            ->andFilterWhere(['like', 'About', $this->About])
            ->andFilterWhere(['like', 'Text', $this->Text])
            ->andFilterWhere(['like', 'Photo', $this->Photo]);

        return $dataProvider;
    }
}
