<?php

namespace app\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\Transition;

/**
 * app\models\TransitionSearch represents the model behind the search form about `app\models\Transition`.
 */
 class TransitionSearch extends Transition
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'person_from_id', 'person_to_id', 'item_id', 'location_from_id', 'location_to_id'], 'integer'],
            [['date'], 'safe'],
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
        $query = Transition::find();

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
            'id' => $this->id,
            'date' => $this->date,
            'person_from_id' => $this->person_from_id,
            'person_to_id' => $this->person_to_id,
            'item_id' => $this->item_id,
            'location_from_id' => $this->location_from_id,
            'location_to_id' => $this->location_to_id,
        ]);

        return $dataProvider;
    }
}
