<?php

namespace Tests\Unit;

use Tests\TestCase;
use App\Models\Tag;
use Illuminate\Foundation\Testing\RefreshDatabase;

class TagTest extends TestCase
{
    use RefreshDatabase;

    /**
     * Test creating a tag.
     *
     * @return void
     */
    public function testCreateTag()
    {
        $tagData = [
            'tag' => 'Test Tag',
        ];

        // Create a new tag
        $tag = Tag::create($tagData);

        // Assert that the tag was created successfully and has an ID
        $this->assertDatabaseHas('tags', ['id' => $tag->id]);

        // Output the ID of the created tag
        $this->assertTrue(isset($tag->id), 'Tag ID: ' . $tag->id);
    }

    /**
     * Test updating a tag.
     *
     * @return void
     */
    public function testUpdateTag()
    {
        // Create a new tag
        $tag = Tag::factory()->create(['tag' => 'Old Tag']);

        $updatedData = [
            'tag' => 'Updated Tag',
        ];

        // Update the tag
        $tag->update($updatedData);

        // Assert that the tag was updated successfully and still has the same ID
        $this->assertDatabaseHas('tags', ['id' => $tag->id] + $updatedData);

        // Output the ID of the updated tag
        $this->assertTrue(isset($tag->id), 'Tag ID: ' . $tag->id);
    }

/**
 * Test deleting a tag.
 *
 * @return void
 */
public function testDeleteTag()
{
    // Create a new tag
    $tag = Tag::factory()->create();

    // Delete the tag
    $tag->delete();

    // Assert that the tag was deleted successfully
    $this->assertDatabaseMissing('tags', ['id' => $tag->id]);
}
/**
 * Test reading a tag.
 *
 * @return void
 */
public function testReadTag()
{
    // Create a new tag
    $tag = Tag::factory()->create();

    // Retrieve the tag from the database
    $retrievedTag = Tag::find($tag->id);

    // Assert that the tag was retrieved successfully
    $this->assertNotNull($retrievedTag, 'Failed to retrieve the tag.');

    // Check if the retrieved tag matches the expected tag
    $this->assertEquals($tag->id, $retrievedTag->id, 'Retrieved tag ID does not match.');
    $this->assertEquals($tag->tag, $retrievedTag->tag, 'Retrieved tag name does not match.');
}

}
