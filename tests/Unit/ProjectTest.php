<?php

namespace Tests\Unit;

use Tests\TestCase;
use App\Models\Project;
use Illuminate\Foundation\Testing\RefreshDatabase;

class ProjectTest extends TestCase
{
    use RefreshDatabase;

    /**
     * Test creating a project.
     *
     * @return void
     */
    public function testCreateProject()
    {
        $projectData = [
            'projectname' => 'Test Project',
            'phaseName' => 'Initial Phase',
            'description' => 'This is a test project description.',
            'status' => 'Planning',
            'startingDate' => '2024-06-01',
            'projectLeader' => 'John Doe',
            'productOwner' => 'Jane Doe',
        ];

        // Create a new project
        $project = Project::create($projectData);

        // Assert that the project was created successfully and has an ID
        $this->assertDatabaseHas('projects', ['id' => $project->id]);

        // Output the ID of the created project
        $this->assertTrue(isset($project->id), 'Project ID: ' . $project->id);
    }

    /**
     * Test updating a project.
     *
     * @return void
     */
    public function testUpdateProject()
    {
        // Create a new project
        $project = Project::factory()->create();

        $updatedData = [
            'projectname' => 'Updated Project',
            'phaseName' => 'Updated Phase',
            'description' => 'Updated description.',
            'status' => 'In Progress',
            'startingDate' => '2024-06-02',
            'projectLeader' => 'Updated Leader',
            'productOwner' => 'Updated Owner',
        ];

        // Update the project
        $project->update($updatedData);

        // Assert that the project was updated successfully and still has the same ID
        $this->assertDatabaseHas('projects', ['id' => $project->id] + $updatedData);

        // Output the ID of the updated project
        $this->assertTrue(isset($project->id), 'Project ID: ' . $project->id);
    }

    /**
     * Test deleting a project.
     *
     * @return void
     */
    public function testDeleteProject()
    {
        // Create a new project
        $project = Project::factory()->create();

        // Store the ID of the project
        $projectId = $project->id;

        // Delete the project
        $project->delete();

        // Assert that the project was deleted successfully and has the expected ID
        $this->assertDatabaseMissing('projects', ['id' => $projectId]);
    }

    /**
     * Test reading a project.
     *
     * @return void
     */
    public function testReadProject()
    {
        // Create a new project
        $project = Project::factory()->create();

        // Retrieve the project from the database
        $retrievedProject = Project::find($project->id);

        // Assert that the project was retrieved successfully and has the expected ID
        $this->assertNotNull($retrievedProject);
        $this->assertSame($project->id, $retrievedProject->id);
        // Output the ID of the retrieved project
        $this->assertTrue(isset($retrievedProject->id), 'Project ID: ' . $retrievedProject->id);
    }
}
