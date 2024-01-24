<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        DB::table('projects')->insert(
            [
                ['name' => 'Real Estate Web Application',],
                ['name' => 'Job Portal Web Application',]
            ]
        );

        DB::table('tasks')->insert([
            [
                'title' => "Define Project Requirements",
                'description' => "Gather and document detailed requirements for the real estate web application, including features like property listings, user authentication, search functionality, etc.",
                'priority' => 1,
                'project_id' => 1,
            ],
            [
                'title' => "Database Schema Design",
                'description' => "Design the database schema to store information about properties, users, transactions, and any other relevant data.",
                'priority' => 2,
                'project_id' => 1,
            ]
            ,[
                'title' => "Implement Job Search",
                'description' => "Develop a search feature allowing users to filter properties based on criteria such as location, price range, number of bedrooms, etc.",
                'priority' => 3,
                'project_id' => 2,
            ],
            [
                'title' => "Image Upload and Storage",
                'description' => "Develop a search feature allowing users to filter properties based on criteria such as location, price range, number of bedrooms, etc",
                'priority' => 3,
                'project_id' => 2,
            ]
        ]);

    }
}
