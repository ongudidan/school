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
    public $globalSearch;
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['class_teacher_id', 'class_id', 'teacher_id'], 'integer'],
            ['globalSearch', 'safe'],
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

        $query->joinWith('teacher');
        $query->joinWith('class');


        // grid filtering conditions
        $query->andFilterWhere([
            'class_teacher_id' => $this->class_teacher_id,
            'class_id' => $this->class_id,
            // 'teacher_id' => $this->teacher_id,
        ]);

        // Filter by staff number
        $query->orFilterWhere(['like', 'classes.class_name', $this->globalSearch])
            ->orFilterWhere(['like', 'teachers.staff_no', $this->globalSearch]);


        return $dataProvider;
    }
}
