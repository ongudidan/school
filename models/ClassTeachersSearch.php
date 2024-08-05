<?php

namespace app\models;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\ClassTeachers;

/**
 * ClassTeachersSearch represents the model behind the search form of `app\models\ClassTeachers`.
 */
class ClassTeachersSearch extends ClassTeachers
{
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['class_teahers_id', 'class_id', 'teacher_id'], 'integer'],
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
        $query = ClassTeachers::find();

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
            'class_teahers_id' => $this->class_teahers_id,
            'class_id' => $this->class_id,
            'teacher_id' => $this->teacher_id,
        ]);

        return $dataProvider;
    }
}
