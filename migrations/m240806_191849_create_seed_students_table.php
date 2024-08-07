<?php

use app\models\Students;
use app\models\Users;
use yii\db\Migration;

/**
 * Handles the creation of table `{{%seed_students}}`.
 */
class m240806_191849_create_seed_students_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->insertFakeUsers();
        $this->insertFakeStudents();
    }

    /**
     * Generate a unique student number.
     *
     * @return string The generated student number.
     */
    public static function generateStudentNo()
    {
        $year = date('Y');
        $prefix = 'STD/';
        $yearPrefix = '/' . $year;

        $lastRecord = Students::find()->orderBy(['student_id' => SORT_DESC])->one();
        $lastNumber = $lastRecord ? intval(substr($lastRecord->student_no, 4, 5)) : 0;
        $newNumber = str_pad($lastNumber + 1, 5, '0', STR_PAD_LEFT);

        return $prefix . $newNumber . $yearPrefix;
    }

    /**
     * Insert fake users into the `users` table.
     *
     * This method generates fake user data and inserts it into the `users` table.
     */
    private function insertFakeUsers()
    {
        $faker = \Faker\Factory::create();
        for ($i = 0; $i < 10; $i++) {
            $password = Yii::$app->security->generatePasswordHash($faker->password); // Use a generated password instead of student number
            $this->insert(
                'users',
                [
                    'username' => $faker->userName,
                    'password' => $password,
                    'created_at' => $faker->dateTimeThisYear()->format('Y-m-d H:i:s'), // Use dateTimeThisYear for recent timestamps
                    'updated_at' => $faker->dateTimeThisYear()->format('Y-m-d H:i:s'), // Use the same as created_at
                ]
            );
        }
    }

    /**
     * Insert fake students into the `students` table.
     *
     * This method generates fake student data and inserts it into the `students` table.
     */
    private function insertFakeStudents()
    {
        $faker = \Faker\Factory::create();
        $users = Users::find()->all(); // Fetch all users once before the loop
        $userCount = count($users); // Count of users to avoid out of bounds errors

        for ($i = 0; $i < 10; $i++) {
            // Check if we have enough users; otherwise, use a modulo or handle accordingly
            $userIndex = $i % $userCount;
            $user = $users[$userIndex];

            $this->insert(
                'students',
                [
                    'first_name' => $faker->firstName, // Use firstName for better differentiation
                    'last_name' => $faker->lastName, // Use lastName for better differentiation
                    'user_id' => $user->user_id,
                    'student_no' => self::generateStudentNo(), // Use static method call
                    'dob' => $faker->date('Y-m-d'), // Ensure date format
                    'gender' => $faker->randomElement(['Male', 'Female']), // Use randomElement for gender
                    'address' => $faker->address,
                    'created_at' => $faker->dateTimeThisYear()->format('Y-m-d H:i:s'), // Use dateTimeThisYear for recent timestamps
                    'updated_at' => $faker->dateTimeThisYear()->format('Y-m-d H:i:s'), // Same as created_at
                ]
            );
        }
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        // Optionally implement rollback logic
        $this->delete('students'); // Remove all students
        $this->delete('users'); // Remove all users
    }
}
