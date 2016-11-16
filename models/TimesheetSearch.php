<?php

namespace app\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\Timesheet;

/**
 * TimesheetSearch represents the model behind the search form about `app\models\Timesheet`.
 */
class TimesheetSearch extends Timesheet
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'user_id'], 'integer'],
            [['project', 'description', 'hours', 'status', 'total', 'estimate', 'created_dt'], 'safe'],
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
        $query = Timesheet::find();

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

        // grid filtering conditions
        $query->andFilterWhere([
            'id' => $this->id,
            'user_id' => $this->user_id,
            'created_dt' => $this->created_dt,
        ]);

        $query->andFilterWhere(['like', 'project', $this->project])
            ->andFilterWhere(['like', 'description', $this->description])
            ->andFilterWhere(['like', 'hours', $this->hours])
            ->andFilterWhere(['like', 'status', $this->status])
            ->andFilterWhere(['like', 'total', $this->total])
            ->andFilterWhere(['like', 'estimate', $this->estimate]);

        return $dataProvider;
    }
}
