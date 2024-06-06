<?php

namespace Tests\Unit;

use Tests\TestCase;
use App\Models\Category;
use Illuminate\Foundation\Testing\RefreshDatabase;

class CategoryTest extends TestCase
{
    use RefreshDatabase;

    /**
     * Test creating a category.
     *
     * @return void
     */
    public function testCreateCategory()
    {
        $categoryData = [
            'category' => 'Test Category',
        ];

        // Create a new category
        $category = Category::create($categoryData);

        // Assert that the category was created successfully and has an ID
        $this->assertDatabaseHas('categories', ['id' => $category->id]);

        // Output the ID of the created category
        $this->assertTrue(isset($category->id), 'Category ID: ' . $category->id);
    }

    /**
     * Test updating a category.
     *
     * @return void
     */
    public function testUpdateCategory()
    {
        // Create a new category
        $category = Category::factory()->create(['category' => 'Old Category']);

        $updatedData = [
            'category' => 'Updated Category',
        ];

        // Update the category
        $category->update($updatedData);

        // Assert that the category was updated successfully and still has the same ID
        $this->assertDatabaseHas('categories', ['id' => $category->id] + $updatedData);

        // Output the ID of the updated category
        $this->assertTrue(isset($category->id), 'Category ID: ' . $category->id);
    }

    /**
     * Test deleting a category.
     *
     * @return void
     */
    public function testDeleteCategory()
    {
        // Create a new category
        $category = Category::factory()->create();

        // Delete the category
        $category->delete();

        // Assert that the category was deleted successfully
        $this->assertDatabaseMissing('categories', ['id' => $category->id]);
    }

    /**
     * Test reading a category.
     *
     * @return void
     */
    public function testReadCategory()
    {
        // Create a new category
        $category = Category::factory()->create();

        // Retrieve the category from the database
        $retrievedCategory = Category::find($category->id);

        // Assert that the category was retrieved successfully
        $this->assertNotNull($retrievedCategory, 'Failed to retrieve the category.');

        // Check if the retrieved category matches the expected category
        $this->assertEquals($category->id, $retrievedCategory->id, 'Retrieved category ID does not match.');
        $this->assertEquals($category->category, $retrievedCategory->category, 'Retrieved category name does not match.');
    }
}
