<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "class_teachers".
 *
 * @property int $class_teahers_id
 * @property int|null $class_id
 * @property int|null $teacher_id
 *
 * @property Classes $class
 * @property Teachers $teacher
 */
class ClassTeachers extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'class_teachers';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['class_id', 'teacher_id'], 'integer'],
            [['class_id', 'teacher_id'], 'required'],
            [['teacher_id'], 'exist', 'skipOnError' => true, 'targetClass' => Teachers::class, 'targetAttribute' => ['teacher_id' => 'teacher_id']],
            [['class_id'], 'exist', 'skipOnError' => true, 'targetClass' => Classes::class, 'targetAttribute' => ['class_id' => 'class_id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'class_teacher_id' => 'Class Teahers ID',
            'class_id' => 'Class ID',
            'teacher_id' => 'Teacher ID',
        ];
    }

    /**
     * Gets query for [[Class]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getClass()
    {
        return $this->hasOne(Classes::class, ['class_id' => 'class_id']);
    }

    /**
     * Gets query for [[Teacher]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getTeacher()
    {
        return $this->hasOne(Teachers::class, ['teacher_id' => 'teacher_id']);
    }
}
