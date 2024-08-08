<?php

namespace app\models;

use Yii;
use yii\behaviors\TimestampBehavior;

/**
 * This is the model class for table "attendance".
 *
 * @property int $attendance_id
 * @property int $student_id
 * @property int $class_id
 * @property int $date
 * @property string $status
 * @property int $created_at
 * @property int $updated_at
 *
 * @property Classes $class
 * @property Students $student
 */
class Attendance extends \yii\db\ActiveRecord
{
    public function behaviors()
    {
        return [
            [
                'class' => TimestampBehavior::class,
                'createdAtAttribute' => 'created_at',
                'updatedAtAttribute' => 'updated_at',
            ],
        ];
    }
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'attendance';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['student_id', 'class_id', 'date', 'status'], 'required'],
            [['student_id', 'class_id', 'date', 'created_at', 'updated_at'], 'integer'],
            [['status'], 'string', 'max' => 255],
            [['student_id'], 'exist', 'skipOnError' => true, 'targetClass' => Students::class, 'targetAttribute' => ['student_id' => 'student_id']],
            [['class_id'], 'exist', 'skipOnError' => true, 'targetClass' => Classes::class, 'targetAttribute' => ['class_id' => 'class_id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'attendance_id' => 'Attendance ID',
            'student_id' => 'Student ID',
            'class_id' => 'Class ID',
            'date' => 'Date',
            'status' => 'Status',
            'created_at' => 'Created At',
            'updated_at' => 'Updated At',
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
     * Gets query for [[Student]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getStudent()
    {
        return $this->hasOne(Students::class, ['student_id' => 'student_id']);
    }
}
