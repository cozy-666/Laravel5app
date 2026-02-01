<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class TasksTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $tasks = [
            [
                'task_name' => '日本時刻テスト',
                'due_date' => '2024-07-13 00:00:00',
                'is_deleted' => false,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            // [
            //     'task_name' => 'Task 2',
            //     'due_date' => '2024-07-14 00:00:00',
            //     'is_deleted' => false,
            //     'created_at' => now(),
            //     'updated_at' => now(),
            // ],
            // [
            //     'task_name' => 'Task 3',
            //     'due_date' => '2024-07-15 00:00:00',
            //     'is_deleted' => false,
            //     'created_at' => now(),
            //     'updated_at' => now(),
            // ],
        ];

        foreach ($tasks as $task) {
            \App\Models\Task::create($task);
        }
    }
}
