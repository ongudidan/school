<?php

namespace app\models;

use yii\behaviors\TimestampBehavior;
use yii\behaviors\BlameableBehavior;

use Yii;
use yii\db\Expression;

/**
 * This is the model class for table "teachers".
 *
 * @property int $teacher_id
 * @property int $user_id
 * @property string $first_name
 * @property string $last_name
 * @property string $staff_no
 * @property string $phone
 * @property string $email
 * @property int $dob
 * @property string $gender
 * @property string|null $address
 * @property int $created_at
 * @property int $updated_at
 *
 * @property Classes[] $classes
 * @property Subjects[] $subjects
 * @property TeacherSubject[] $teacherSubjects
 * @property Users $user
 */
class Teachers extends \yii\db\ActiveRecord
{
    public function behaviors()
    {
        return [
            [
                'class' => TimestampBehavior::class,
                'createdAtAttribute' => 'created_at',
                'updatedAtAttribute' => 'updated_at',
                // 'value' => new Expression('NOW()'),
            ],
        ];
    }
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'teachers';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['first_name', 'last_name', 'staff_no', 'phone', 'email', 'dob', 'gender'], 'required'],
            [['user_id', 'dob', 'created_at', 'updated_at'], 'integer'],
            [['address'], 'string'],
            [['first_name', 'last_name', 'staff_no', 'phone', 'email'], 'string', 'max' => 255],
            [['gender'], 'string', 'max' => 1],
            [['staff_no'], 'unique'],
            [['user_id'], 'exist', 'skipOnError' => true, 'targetClass' => Users::class, 'targetAttribute' => ['user_id' => 'user_id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'teacher_id' => 'Teacher ID',
            'user_id' => 'User ID',
            'first_name' => 'First Name',
            'last_name' => 'Last Name',
            'staff_no' => 'Staff No',
            'phone' => 'Phone',
            'email' => 'Email',
            'dob' => 'Dob',
            'gender' => 'Gender',
            'address' => 'Address',
            'created_at' => 'Created At',
            'updated_at' => 'Updated At',
        ];
    }

    public static function generateStaffId()
    {
        $year = date('Y');
        $prefix = 'TUM/';
        $yearPrefix = '/' . $year;

        $lastRecord = self::find()->orderBy(['teacher_id' => SORT_DESC])->one();
        $lastNumber = $lastRecord ? intval(substr($lastRecord->staff_no, 4, 5)) : 0;
        $newNumber = str_pad($lastNumber + 1, 5, '0', STR_PAD_LEFT);

        return $prefix . $newNumber . $yearPrefix;
    }



    /**
     * Gets query for [[Classes]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getClasses()
    {
        return $this->hasMany(Classes::class, ['teacher_id' => 'teacher_id']);
    }

    /**
     * Gets query for [[Subjects]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getSubjects()
    {
        return $this->hasMany(Subjects::class, ['subject_id' => 'subject_id'])->viaTable('teacher_subject', ['teacher_id' => 'teacher_id']);
    }

    /**
     * Gets query for [[TeacherSubjects]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getTeacherSubjects()
    {
        return $this->hasMany(TeacherSubject::class, ['teacher_id' => 'teacher_id']);
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
