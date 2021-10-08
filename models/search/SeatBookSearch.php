<?php

namespace app\models\search;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\SeatBook;

/**
 * SeatBookSearch represents the model behind the search form of `app\models\SeatBook`.
 */
class SeatBookSearch extends SeatBook
{
    public string $employeeEmail = '';
    public string $officeName = '';

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id', 'employee_id', 'seat_id', 'seat_book_time_slot_id'], 'integer'],
            [['employeeEmail', 'officeName', 'booking_date', 'created_at', 'updated_at'], 'safe'],
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
        $query = SeatBook::find();

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
        
        $query->innerJoin('employees', 'seats_book.employee_id = employees.id');
        
        $query->innerJoin('seats', 'seats_book.seat_id = seats.id');
        $query->innerJoin('offices', 'seats.office_id = offices.id');

        // grid filtering conditions
        $query->andFilterWhere([
            'id' => $this->id,
            'employee_id' => $this->employee_id,
            'booking_date' => $this->booking_date,
            'seat_id' => $this->seat_id,
            'seat_book_time_slot_id' => $this->seat_book_time_slot_id,
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
        ]);
        $query->andFilterWhere(['like', 'employees.email', $this->employeeEmail]);
        $query->andFilterWhere(['like', 'offices.office_name', $this->officeName]);

        return $dataProvider;
    }
}