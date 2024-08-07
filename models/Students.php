<?php

namespace app\models;

use Yii;
use yii\behaviors\TimestampBehavior;

/**
 * This is the model class for table "students".
 *
 * @property int $student_id
 * @property int $user_id
 * @property string $first_name
 * @property string $last_name
 * @property string $student_no
 * @property int $dob
 * @property string $gender
 * @property string|null $address
 * @property int|null $class_id
 * @property int $created_at
 * @property int $updated_at
 *
 * @property Attendance[] $attendances
 * @property Enrollments[] $enrollments
 * @property Grades[] $grades
 * @property Users $user
 */
class Students extends \yii\db\ActiveRecord
{
    // Define gender options
    const GENDER_MALE = 'Male';
    const GENDER_FEMALE = 'Female';

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
        return 'students';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['user_id', 'first_name', 'last_name', 'student_no', 'dob', 'gender'], 'required'],
            [['user_id', 'dob', 'class_id', 'created_at', 'updated_at'], 'integer'],
            [['address'], 'string'],
            [['first_name', 'last_name', 'student_no'], 'string', 'max' => 255],
            [['gender'], 'string'],
            [['user_id'], 'exist', 'skipOnError' => true, 'targetClass' => Users::class, 'targetAttribute' => ['user_id' => 'user_id']],
        ];
    }

    /**
     * Returns an array of gender options.
     * @return array
     */
    public static function getGenderOptions()
    {
        return [
            self::GENDER_MALE => 'Male',
            self::GENDER_FEMALE => 'Female',
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'student_id' => 'Student ID',
            'user_id' => 'User ID',
            'first_name' => 'First Name',
            'last_name' => 'Last Name',
            'student_no' => 'Student No',
            'dob' => 'Dob',
            'gender' => 'Gender',
            'address' => 'Address',
            'created_at' => 'Created At',
            'updated_at' => 'Updated At',
        ];
    }

    public static function generateStudentId()
    {
        $year = date('Y');
        $prefix = 'STD/';
        $yearPrefix = '/' . $year;

        $lastRecord = self::find()->orderBy(['student_id' => SORT_DESC])->one();
        $lastNumber = $lastRecord ? intval(substr($lastRecord->student_no, 4, 5)) : 0;
        $newNumber = str_pad($lastNumber + 1, 5, '0', STR_PAD_LEFT);

        return $prefix . $newNumber . $yearPrefix;
    }

    /**
     * Gets query for [[Attendances]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getAttendances()
    {
        return $this->hasMany(Attendance::class, ['student_id' => 'student_id']);
    }

    /**
     * Gets query for [[Enrollments]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getEnrollments()
    {
        return $this->hasMany(Enrollments::class, ['student_id' => 'student_id']);
    }

    /**
     * Gets query for [[Grades]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getGrades()
    {
        return $this->hasMany(Grades::class, ['student_id' => 'student_id']);
    }

    /**
     * Gets query for [[User]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getUser()
    {
        return $this->hasOne(Users::class, ['user_id' => 'user_id']);
    }
}
