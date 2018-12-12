<?php

namespace app\models\search;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\tables\Comments;

/**
 * CommentsFilter represents the model behind the search form of `app\models\tables\Comments`.
 */
class CommentsFilter extends Comments {

    /**
     * {@inheritdoc}
     */
    public function rules() {
        return [
            [['id', 'user_id', 'task_id'], 'integer'],
            [['text', 'date_of_creation', 'file'], 'safe'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function scenarios() {
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
    public function search($params, $id = null) {
        $query = Comments::find();

        if ($id) {
            $dataProvider = new ActiveDataProvider([
                'query' => $query->where('task_id = '.$id),
                'pagination' => [
                    'pageSize' => '4',
                ]
            ]);
        }

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
            'pagination' => [
                'pageSize' => '4',
            ]
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
            'task_id' => $this->task_id,
            'date_of_creation' => $this->date_of_creation,
        ]);

        $query->andFilterWhere(['like', 'text', $this->text])
                ->andFilterWhere(['like', 'file', $this->file]);

        return $dataProvider;
    }

}
