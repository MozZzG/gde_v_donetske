<?php

namespace app\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\Event;

/**
 * EventSearch represents the model behind the search form about `app\models\Event`.
 */
class EventSearch extends Event
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['ID', 'CategoryeventID', 'SubcategoryeventID', 'EstablishmentID', 'IndexTop'], 'integer'],
            [['Photo', 'Date', 'Name', 'Place', 'Time', 'Contacts'], 'safe'],
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
        $query = Event::find();

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
            'Date' => $this->Date,
            'CategoryeventID' => $this->CategoryeventID,
            'SubcategoryeventID' => $this->SubcategoryeventID,
            'EstablishmentID' => $this->EstablishmentID,
            'IndexTop' => $this->IndexTop,
        ]);

        $query->andFilterWhere(['like', 'Photo', $this->Photo])
            ->andFilterWhere(['like', 'Name', $this->Name])
            ->andFilterWhere(['like', 'Place', $this->Place])
            ->andFilterWhere(['like', 'Time', $this->Time])
            ->andFilterWhere(['like', 'Contacts', $this->Contacts]);

        return $dataProvider;
    }
}
