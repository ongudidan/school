<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%seed_subjects}}`.
 */
class m240807_105643_create_seed_subjects_table extends Migration
{
       /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->insertFakeSubjects();
    }

    /**
     * Insert fake subjects into the `subjects` table.
     *
     * This method generates fake subject data and inserts it into the `subjects` table.
     */
    private function insertFakeSubjects()
    {
        $faker = \Faker\Factory::create();
        $subjects = [
            ['subject_name' => 'Mathematics', 'description' => $faker->sentence],
            ['subject_name' => 'English Language', 'description' => $faker->sentence],
            ['subject_name' => 'Science', 'description' => $faker->sentence],
            ['subject_name' => 'History', 'description' => $faker->sentence],
            ['subject_name' => 'Geography', 'description' => $faker->sentence],
            ['subject_name' => 'Art', 'description' => $faker->sentence],
            ['subject_name' => 'Physical Education', 'description' => $faker->sentence],
            ['subject_name' => 'Computer Science', 'description' => $faker->sentence],
        ];

        foreach ($subjects as $subject) {
            $this->insert(
                '{{%subjects}}',
                [
                    'subject_name' => $subject['subject_name'],
                    'description' => $subject['description'],
                    'created_at' => (new \DateTime())->format('Y-m-d H:i:s'),
                    'updated_at' => (new \DateTime())->format('Y-m-d H:i:s'),
                ]
            );
        }
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        // Optionally implement rollback logic if needed
        // For example, to delete the inserted records:
        // $this->delete('{{%subjects}}', ['subject_name' => ['Mathematics', 'English Language', 'Science', 'History', 'Geography', 'Art', 'Physical Education', 'Computer Science']]);
    }
}
