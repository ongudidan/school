<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%seed_classes}}`.
 */
class m240807_062947_create_seed_classes_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->insertFakeClasses();
    }

    private function insertFakeClasses()
    {
        // Get the current timestamp
        $currentTimestamp = date('Y-m-d H:i:s');

        // Define an array of classes to be inserted along with descriptions and created_at timestamp
        $classes = [
            ['class_name' => 'Class 1', 'description' => 'This is the first class.', 'created_at' => $currentTimestamp],
            ['class_name' => 'Class 2', 'description' => 'This is the second class.', 'created_at' => $currentTimestamp],
            ['class_name' => 'Class 3', 'description' => 'This is the third class.', 'created_at' => $currentTimestamp],
            ['class_name' => 'Class 4', 'description' => 'This is the fourth class.', 'created_at' => $currentTimestamp],
            ['class_name' => 'Class 5', 'description' => 'This is the fifth class.', 'created_at' => $currentTimestamp],
            ['class_name' => 'Class 6', 'description' => 'This is the sixth class.', 'created_at' => $currentTimestamp],
            ['class_name' => 'Class 7', 'description' => 'This is the seventh class.', 'created_at' => $currentTimestamp],
            ['class_name' => 'Class 8', 'description' => 'This is the eighth class.', 'created_at' => $currentTimestamp],
        ];

        // Iterate over the classes array and insert each class into the `classes` table
        foreach ($classes as $class) {
            $this->insert('{{%classes}}', $class);
        }
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('{{%seed_classes}}');
    }
}
