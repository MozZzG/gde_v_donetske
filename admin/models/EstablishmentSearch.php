<?php

namespace app\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\Establishment;

/**
 * EstablishmentSearch represents the model behind the search form about `app\models\Establishment`.
 */
class EstablishmentSearch extends Establishment
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['ID', 'SubcategoryID', 'Views', 'Likes', 'Comments', 'UserID'], 'integer'],
            [['Name', 'About', 'Text', 'Map', 'Video', 'Worktime', 'Phone', 'Address', 'Website', 'Field1Name', 'Field1Value', 'Field2Name', 'Field2Value', 'Photo1', 'Photo2', 'Photo3', 'Photo4', 'Photo5', 'Photo6', 'Photo7', 'Photo8', 'Photo9', 'Photo10'], 'safe'],
            [['Rating'], 'number'],
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
        $query = Establishment::find();

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
            'SubcategoryID' => $this->SubcategoryID,
            'Views' => $this->Views,
            'Likes' => $this->Likes,
            'Comments' => $this->Comments,
            'Rating' => $this->Rating,
            'UserID' => $this->UserID,
        ]);

        $query->andFilterWhere(['like', 'Name', $this->Name])
            ->andFilterWhere(['like', 'About', $this->About])
            ->andFilterWhere(['like', 'Text', $this->Text])
            ->andFilterWhere(['like', 'Map', $this->Map])
            ->andFilterWhere(['like', 'Video', $this->Video])
            ->andFilterWhere(['like', 'Worktime', $this->Worktime])
            ->andFilterWhere(['like', 'Phone', $this->Phone])
            ->andFilterWhere(['like', 'Address', $this->Address])
            ->andFilterWhere(['like', 'Website', $this->Website])
            ->andFilterWhere(['like', 'Field1Name', $this->Field1Name])
            ->andFilterWhere(['like', 'Field1Value', $this->Field1Value])
            ->andFilterWhere(['like', 'Field2Name', $this->Field2Name])
            ->andFilterWhere(['like', 'Field2Value', $this->Field2Value])
            ->andFilterWhere(['like', 'Photo1', $this->Photo1])
            ->andFilterWhere(['like', 'Photo2', $this->Photo2])
            ->andFilterWhere(['like', 'Photo3', $this->Photo3])
            ->andFilterWhere(['like', 'Photo4', $this->Photo4])
            ->andFilterWhere(['like', 'Photo5', $this->Photo5])
            ->andFilterWhere(['like', 'Photo6', $this->Photo6])
            ->andFilterWhere(['like', 'Photo7', $this->Photo7])
            ->andFilterWhere(['like', 'Photo8', $this->Photo8])
            ->andFilterWhere(['like', 'Photo9', $this->Photo9])
            ->andFilterWhere(['like', 'Photo10', $this->Photo10]);

        return $dataProvider;
    }
}
