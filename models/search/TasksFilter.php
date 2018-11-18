<?php

namespace app\models\search;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\tables\Tasks;

/**
 * TasksFilter represents the model behind the search form of `app\models\tables\Tasks`.
 */
class TasksFilter extends Tasks
{    
    public $from_date;
    public $to_date;
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id', 'user_created', 'user_assigned'], 'integer'],
            [['title', 'description', 'created_at', 'deadline', 'from_date', 'to_date'], 'safe'],
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
    public function search($params, $askedQuery = null)
    {
        $query = Tasks::find();
        if($askedQuery == 'month') {
        $dataProvider = new ActiveDataProvider([
            'query' => $query->where('deadline > LAST_DAY(CURDATE()) + INTERVAL 1 DAY - INTERVAL 1 MONTH')->andWhere('deadline < DATE_ADD(LAST_DAY(CURDATE()), INTERVAL 1 DAY)')->orderBy('deadline ASC'),
            'pagination' => [
                'pageSize' => '4',
            ]
        ]);
        } elseif ($askedQuery) {
        $dataProvider = new ActiveDataProvider([
            'query' => $query->where(['user_assigned' => $askedQuery]),
            'pagination' => [
                'pageSize' => '4',
            ]
        ]);
        };
        $dataProvider = new ActiveDataProvider([
            'query' => $query->orderBy('deadline ASC'),
            'pagination' => [
                'pageSize' => '4',
            ],
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
            'user_created' => $this->user_created,
            'user_assigned' => $this->user_assigned,
            'created_at' => $this->created_at,
        ]);

        if($this->from_date){
            $query->andFilterWhere(['>=', 'deadline', $this->from_date])
            ->andFilterWhere(['<=', 'deadline', date("Y-m-d", strtotime("+1 month", strtotime($this->from_date)))]);
        }
        
        $query->andFilterWhere(['like', 'title', $this->title])
            ->andFilterWhere(['like', 'description', $this->description]);

        return $dataProvider;
    }
}
