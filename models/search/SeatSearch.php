<?php

namespace app\models\search;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\Seat;

/**
 * SeatSearch represents the model behind the search form of `app\models\Seat`.
 */
class SeatSearch extends Seat
{
    public string $officeName = '';

    /**
     * {@inheritdoc}
     */
    public function rules(): array
    {
        return [
            [['id', 'office_id', 'office_seat_id'], 'integer'],
            [['officeName', 'created_at', 'updated_at'], 'safe'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function scenarios(): array
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
    public function search($params): ActiveDataProvider
    {
        $query = Seat::find();

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
        
        $query->innerJoin('offices', 'seats.office_id = offices.id');

        // grid filtering conditions
        $query->andFilterWhere([
            'id' => $this->id,
            'office_id' => $this->office_id,
            'office_seat_id' => $this->office_seat_id,
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
        ]);
        $query->andFilterWhere(['like', 'offices.office_name', $this->officeName]);

        return $dataProvider;
    }
}
