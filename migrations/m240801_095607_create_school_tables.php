<?php

use yii\db\Migration;

/**
 * Class m240801_095607_create_school_tables
 */
class m240801_095607_create_school_tables extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        // Create users table
        $this->createTable('{{%users}}', [
            'user_id' => $this->primaryKey(),
            'username' => $this->string()->notNull(),
            'password' => $this->string()->notNull(),
            'created_at' => $this->integer()->notNull()->defaultValue(time()),
            'updated_at' => $this->integer()->notNull()->defaultValue(time()),
        ]);

        // Create subjects table
        $this->createTable('{{%subjects}}', [
            'subject_id' => $this->primaryKey(),
            'subject_name' => $this->string()->notNull(),
            'description' => $this->string()->notNull(),
            'created_at' => $this->integer()->notNull()->defaultValue(time()),
            'updated_at' => $this->integer()->notNull()->defaultValue(time()),
        ]);

        // Create teachers table
        $this->createTable('{{%teachers}}', [
            'teacher_id' => $this->primaryKey(),
            'user_id' => $this->integer()->notNull()->unique(),
            'first_name' => $this->string()->notNull(),
            'last_name' => $this->string()->notNull(),
            'staff_no' => $this->string()->notNull()->unique(),
            'phone' => $this->string()->notNull(),
            'email' => $this->string()->notNull(),
            'dob' => $this->integer()->notNull(),
            'gender' => $this->string(20)->notNull(),
            'address' => $this->text(),
            'created_at' => $this->integer()->notNull()->defaultValue(time()),
            'updated_at' => $this->integer()->notNull()->defaultValue(time()),
            'FOREIGN KEY ([[user_id]]) REFERENCES {{%users}} ([[user_id]])' .
                $this->buildFkClause('ON DELETE CASCADE', 'ON UPDATE CASCADE'),
        ]);

        // Create teacher_subject junction table
        $this->createTable('{{%teacher_subjects}}', [
            'teacher_subject_id' => $this->primaryKey(),
            'teacher_id' => $this->integer()->notNull(),
            'subject_id' => $this->integer()->notNull(),
            'FOREIGN KEY ([[teacher_id]]) REFERENCES {{%teachers}} ([[teacher_id]])' .
                $this->buildFkClause('ON DELETE CASCADE', 'ON UPDATE CASCADE'),
            'FOREIGN KEY ([[subject_id]]) REFERENCES {{%subjects}} ([[subject_id]])' .
                $this->buildFkClause('ON DELETE CASCADE', 'ON UPDATE CASCADE'),
        ]);

        // Create classes table
        $this->createTable('{{%classes}}', [
            'class_id' => $this->primaryKey(),
            'class_name' => $this->string()->notNull(),
            'description' => $this->string()->notNull(),
            'created_at' => $this->integer()->notNull()->defaultValue(time()),
            'updated_at' => $this->integer()->notNull()->defaultValue(time()),
        ]);

        // Create students table
        $this->createTable('{{%students}}', [
            'student_id' => $this->primaryKey(),
            'user_id' => $this->integer()->notNull(),
            'first_name' => $this->string()->notNull(),
            'last_name' => $this->string()->notNull(),
            'student_no' => $this->string()->notNull(),
            'dob' => $this->integer()->notNull(),
            'gender' => $this->string(20)->notNull(),
            'address' => $this->text(),
            'class_id' => $this->integer(),
            'created_at' => $this->integer()->notNull()->defaultValue(time()),
            'updated_at' => $this->integer()->notNull()->defaultValue(time()),
            'FOREIGN KEY ([[user_id]]) REFERENCES {{%users}} ([[user_id]])' .
                $this->buildFkClause('ON DELETE CASCADE', 'ON UPDATE CASCADE'),
            'FOREIGN KEY ([[class_id]]) REFERENCES {{%classes}} ([[class_id]])' .
                $this->buildFkClause('ON DELETE SET NULL', 'ON UPDATE CASCADE'),
        ]);

        // Create class_students table
        $this->createTable('{{%class_students}}', [
            'class_student_id' => $this->primaryKey(),
            'class_id' => $this->integer()->notNull(),
            'student_id' => $this->integer()->notNull(),
            'FOREIGN KEY ([[student_id]]) REFERENCES {{%students}} ([[student_id]])' .
                $this->buildFkClause('ON DELETE CASCADE', 'ON UPDATE CASCADE'),
            'FOREIGN KEY ([[class_id]]) REFERENCES {{%classes}} ([[class_id]])' .
                $this->buildFkClause('ON DELETE CASCADE', 'ON UPDATE CASCADE'),
        ]);

        // Create class_teachers table
        $this->createTable('{{%class_teachers}}', [
            'class_teacher_id' => $this->primaryKey(),
            'class_id' => $this->integer()->notNull(),
            'teacher_id' => $this->integer()->notNull(),
            'FOREIGN KEY ([[teacher_id]]) REFERENCES {{%teachers}} ([[teacher_id]])' .
                $this->buildFkClause('ON DELETE CASCADE', 'ON UPDATE CASCADE'),
            'FOREIGN KEY ([[class_id]]) REFERENCES {{%classes}} ([[class_id]])' .
                $this->buildFkClause('ON DELETE CASCADE', 'ON UPDATE CASCADE'),
        ]);

        // Create courses table
        $this->createTable('{{%courses}}', [
            'course_id' => $this->primaryKey(),
            'course_name' => $this->string()->notNull(),
            'description' => $this->text(),
            'created_at' => $this->integer()->notNull()->defaultValue(time()),
            'updated_at' => $this->integer()->notNull()->defaultValue(time()),
        ]);

        // Create enrollments table
        $this->createTable('{{%enrollments}}', [
            'enrollment_id' => $this->primaryKey(),
            'student_id' => $this->integer()->notNull(),
            'course_id' => $this->integer()->notNull(),
            'enrolled_at' => $this->integer()->notNull()->defaultValue(time()),
            'FOREIGN KEY ([[student_id]]) REFERENCES {{%students}} ([[student_id]])' .
                $this->buildFkClause('ON DELETE CASCADE', 'ON UPDATE CASCADE'),
            'FOREIGN KEY ([[course_id]]) REFERENCES {{%courses}} ([[course_id]])' .
                $this->buildFkClause('ON DELETE CASCADE', 'ON UPDATE CASCADE'),
        ]);

        // Create attendance table
        $this->createTable('{{%attendance}}', [
            'attendance_id' => $this->primaryKey(),
            'student_id' => $this->integer()->notNull(),
            'class_id' => $this->integer()->notNull(),
            'date' => $this->integer()->notNull(),
            'status' => $this->string(1)->notNull(),
            'created_at' => $this->integer()->notNull()->defaultValue(time()),
            'updated_at' => $this->integer()->notNull()->defaultValue(time()),
            'FOREIGN KEY ([[student_id]]) REFERENCES {{%students}} ([[student_id]])' .
                $this->buildFkClause('ON DELETE CASCADE', 'ON UPDATE CASCADE'),
            'FOREIGN KEY ([[class_id]]) REFERENCES {{%classes}} ([[class_id]])' .
                $this->buildFkClause('ON DELETE CASCADE', 'ON UPDATE CASCADE'),
        ]);

        // Create grades table
        $this->createTable('{{%grades}}', [
            'grade_id' => $this->primaryKey(),
            'student_id' => $this->integer()->notNull(),
            'subject_id' => $this->integer()->notNull(),
            'marks' => $this->integer()->notNull(),
            'grade' => $this->string()->notNull(),
            'created_at' => $this->integer()->notNull()->defaultValue(time()),
            'updated_at' => $this->integer()->notNull()->defaultValue(time()),
            'FOREIGN KEY ([[student_id]]) REFERENCES {{%students}} ([[student_id]])' .
                $this->buildFkClause('ON DELETE CASCADE', 'ON UPDATE CASCADE'),
            'FOREIGN KEY ([[subject_id]]) REFERENCES {{%subjects}} ([[subject_id]])' .
                $this->buildFkClause('ON DELETE CASCADE', 'ON UPDATE CASCADE'),
        ]);

        // Create RBAC tables in correct order
        $this->createTable('{{%auth_rule}}', [
            'name' => $this->string(64)->notNull(),
            'data' => $this->text(),
            'created_at' => $this->integer(),
            'updated_at' => $this->integer(),
            'PRIMARY KEY (name)',
        ]);

        $this->createTable('{{%auth_item}}', [
            'name' => $this->string(64)->notNull(),
            'type' => $this->integer()->notNull(),
            'description' => $this->text(),
            'rule_name' => $this->string(64),
            'data' => $this->text(),
            'created_at' => $this->integer(),
            'updated_at' => $this->integer(),
            'PRIMARY KEY (name)',
            'KEY rule_name (rule_name)',
            'KEY type (type)',
        ]);

        $this->createTable('{{%auth_item_child}}', [
            'parent' => $this->string(64)->notNull(),
            'child' => $this->string(64)->notNull(),
            'PRIMARY KEY (parent, child)',
            'KEY child (child)',
            'FOREIGN KEY ([[parent]]) REFERENCES {{%auth_item}} ([[name]])' .
                $this->buildFkClause('ON DELETE CASCADE', 'ON UPDATE CASCADE'),
            'FOREIGN KEY ([[child]]) REFERENCES {{%auth_item}} ([[name]])' .
                $this->buildFkClause('ON DELETE CASCADE', 'ON UPDATE CASCADE'),
        ]);

        $this->createTable('{{%auth_assignment}}', [
            'item_name' => $this->string(64)->notNull(),
            'user_id' => $this->string(64)->notNull(),
            'created_at' => $this->integer(),
            'PRIMARY KEY (item_name, user_id)',
            'FOREIGN KEY ([[item_name]]) REFERENCES {{%auth_item}} ([[name]])' .
                $this->buildFkClause('ON DELETE CASCADE', 'ON UPDATE CASCADE'),
        ]);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        // Drop RBAC tables
        $this->dropTable('{{%auth_item_child}}');
        $this->dropTable('{{%auth_rule}}');
        $this->dropTable('{{%auth_item}}');
        $this->dropTable('{{%auth_assignment}}');

        // Drop other tables
        $this->dropTable('{{%grades}}');
        $this->dropTable('{{%attendance}}');
        $this->dropTable('{{%enrollments}}');
        $this->dropTable('{{%courses}}');
        $this->dropTable('{{%class_teachers}}');
        $this->dropTable('{{%class_students}}');
        $this->dropTable('{{%students}}');
        $this->dropTable('{{%classes}}');
        $this->dropTable('{{%teacher_subject}}');
        $this->dropTable('{{%teachers}}');
        $this->dropTable('{{%subjects}}');
        $this->dropTable('{{%users}}');
    }

    protected function buildFkClause($delete = '', $update = '')
    {
        return implode(' ', ['', $delete, $update]);
    }
}
