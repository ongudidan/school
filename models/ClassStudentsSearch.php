<?php

namespace app\models;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\ClassStudents;

/**
 * ClassStudentsSearch represents the model behind the search form of `app\models\ClassStudents`.
 */
class ClassStudentsSearch extends ClassStudents
{
    public $globalSearch;
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['class_student_id', 'class_id', 'student_id'], 'integer'],
            [['globalSearch'], 'safe'],
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
        $query = ClassStudents::find();

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

        $query->joinWith('class');
        $query->joinWith('student');


        // grid filtering conditions
        $query->andFilterWhere([
            'class_student_id' => $this->class_student_id,
            'class_id' => $this->class_id,
            'student_id' => $this->student_id,
        ]);

        $query->orFilterWhere(['like', 'classes.class_name', $this->globalSearch])
        ->orFilterWhere(['like', 'students.student_no', $this->globalSearch]);

        return $dataProvider;
    }
}
