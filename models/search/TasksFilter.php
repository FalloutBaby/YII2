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
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id', 'userIdCreated', 'userIdAssigned'], 'integer'],
            [['title', 'description', 'dateOfCreation', 'deadline'], 'safe'],
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
    public function search($params, $lastMonth = null)
    {
        $query = Tasks::find();
        if($lastMonth) {
        $dataProvider = new ActiveDataProvider([
            'query' => $query->where('deadline > LAST_DAY(CURDATE()) + INTERVAL 1 DAY - INTERVAL 1 MONTH')->andWhere('deadline < DATE_ADD(LAST_DAY(CURDATE()), INTERVAL 1 DAY)')->orderBy('deadline ASC'),
            'pagination' => [
                'pageSize' => '4',
            ]
        ]);
        }
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
            'userIdCreated' => $this->userIdCreated,
            'userIdAssigned' => $this->userIdAssigned,
            'dateOfCreation' => $this->dateOfCreation,
            'deadline' => $this->deadline,
        ]);

        $query->andFilterWhere(['like', 'title', $this->title])
            ->andFilterWhere(['like', 'description', $this->description]);

        return $dataProvider;
    }
}
