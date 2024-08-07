<?php

use app\models\Teachers;
use app\models\Users;
use yii\db\Migration;

/**
 * Handles the creation of table `{{%seed_teachers}}`.
 */
class m240806_164953_create_seed_teachers_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->insertFakeUsers();
        $this->insertFakeTeachers();

    }

    public static function generateStaffId()
    {
        $year = date('Y');
        $prefix = 'TUM/';
        $yearPrefix = '/' . $year;

        $lastRecord = Teachers::find()->orderBy(['teacher_id' => SORT_DESC])->one();
        $lastNumber = $lastRecord ? intval(substr($lastRecord->staff_no, 4, 5)) : 0;
        $newNumber = str_pad($lastNumber + 1, 5, '0', STR_PAD_LEFT);

        return $prefix . $newNumber . $yearPrefix;
    }

    private function insertFakeUsers(){

        $faker = \Faker\Factory::create();
        for ($i = 0; $i < 10; $i++){
            $password = Yii::$app->security->generatePasswordHash($this->generateStaffId());
            $this->insert(
                'users',
                [
                    'username' => $this->generateStaffId(),
                    'password' => $password,
                    'created_at' => $faker->date,
                    'updated_at' => (int)$faker->date
                ]
            );
        }
    }

    private function insertFakeTeachers()
    {
        $faker = \Faker\Factory::create();
        $users = Users::find()->all(); // Fetch all users once before the loop
        $userCount = count($users); // Count of users to avoid out of bounds errors
    
        for ($i = 0; $i < 10; $i++) {
            // Check if we have enough users; otherwise, use a modulo or handle accordingly
            $userIndex = $i % $userCount;
            $user = $users[$userIndex];
            
            $this->insert(
                'teachers',
                [
                    'first_name' => $faker->firstName, // Use firstName for better distinction
                    'last_name' => $faker->lastName, // Use lastName for better distinction
                    'user_id' => $user->user_id,
                    'staff_no' => $this->generateStaffId(),
                    'phone' => $faker->phoneNumber,
                    'email' => $faker->email,
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
        // $this->dropTable('{{%seed_teachers}}');
        return false;
    }
}
