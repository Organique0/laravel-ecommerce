<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CategorySeeder extends Seeder
{
  /**
   * Run the database seeds.
   */
  public function run(): void
  {
    $categories = [
      // Parent Category: Electronics
      [
        'name' => 'Electronics',
        'department_id' => 1,
        'parent_id' => null,
        'active' => true,
        'created_at' => now(),
        'updated_at' => now(),
      ],
      [
        'name' => 'Mobile Phones',
        'department_id' => 1,
        'parent_id' => 1, // Parent is Electronics
        'active' => true,
        'created_at' => now(),
        'updated_at' => now(),
      ],
      [
        'name' => 'Laptops',
        'department_id' => 1,
        'parent_id' => 1, // Parent is Electronics
        'active' => true,
        'created_at' => now(),
        'updated_at' => now(),
      ],
      [
        'name' => 'Smart Watches',
        'department_id' => 1,
        'parent_id' => 1, // Parent is Electronics
        'active' => true,
        'created_at' => now(),
        'updated_at' => now(),
      ],
      // Parent Category: Clothing
      [
        'name' => 'Clothing',
        'department_id' => 2,
        'parent_id' => null,
        'active' => true,
        'created_at' => now(),
        'updated_at' => now(),
      ],
      [
        'name' => 'Men\'s Clothing',
        'department_id' => 2,
        'parent_id' => 5, // Parent is Clothing
        'active' => true,
        'created_at' => now(),
        'updated_at' => now(),
      ],
      [
        'name' => 'Women\'s Clothing',
        'department_id' => 2,
        'parent_id' => 5, // Parent is Clothing
        'active' => true,
        'created_at' => now(),
        'updated_at' => now(),
      ],
      [
        'name' => 'Kids\' Clothing',
        'department_id' => 2,
        'parent_id' => 5, // Parent is Clothing
        'active' => true,
        'created_at' => now(),
        'updated_at' => now(),
      ],
      // Parent Category: Home & Kitchen
      [
        'name' => 'Home & Kitchen',
        'department_id' => 3,
        'parent_id' => null,
        'active' => true,
        'created_at' => now(),
        'updated_at' => now(),
      ],
      [
        'name' => 'Furniture',
        'department_id' => 3,
        'parent_id' => 9, // Parent is Home & Kitchen
        'active' => true,
        'created_at' => now(),
        'updated_at' => now(),
      ],
      [
        'name' => 'Kitchen Appliances',
        'department_id' => 3,
        'parent_id' => 9, // Parent is Home & Kitchen
        'active' => true,
        'created_at' => now(),
        'updated_at' => now(),
      ],
      [
        'name' => 'Decor',
        'department_id' => 3,
        'parent_id' => 9, // Parent is Home & Kitchen
        'active' => true,
        'created_at' => now(),
        'updated_at' => now(),
      ],
      // Parent Category: Books
      [
        'name' => 'Books',
        'department_id' => 4,
        'parent_id' => null,
        'active' => true,
        'created_at' => now(),
        'updated_at' => now(),
      ],
      [
        'name' => 'Fiction',
        'department_id' => 4,
        'parent_id' => 13, // Parent is Books
        'active' => true,
        'created_at' => now(),
        'updated_at' => now(),
      ],
      [
        'name' => 'Non-Fiction',
        'department_id' => 4,
        'parent_id' => 13, // Parent is Books
        'active' => true,
        'created_at' => now(),
        'updated_at' => now(),
      ],
      [
        'name' => 'Children\'s Books',
        'department_id' => 4,
        'parent_id' => 13, // Parent is Books
        'active' => true,
        'created_at' => now(),
        'updated_at' => now(),
      ],
    ];
    DB::table('categories')->insert($categories);
  }
}
