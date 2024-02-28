<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Category;

class CategoriesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    private $category;

    public function __construct(Category $category){
        $this->category = $category;
    }

    public function run(): void
    {
        $categories = [
            [
                'name' => 'Theatre',
                'created_at' => NOW(),
                'updated_at' => NOW()
            ],
            [
                'name' => 'Health & Wellness',
                'created_at' => NOW(),
                'updated_at' => NOW()
            ],
            [
                'name' => 'Hobbies',
                'created_at' => NOW(),
                'updated_at' => NOW()
            ]
        ];

        $this->category->insert($categories);
    }
}
