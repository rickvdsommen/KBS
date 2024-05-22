<?php

namespace Database\Seeders;
use App\Models\Degree;
use App\Models\Project;
use App\Models\Course;
use App\Models\Skill;
use App\Models\Agenda;
use App\Models\Device;
use App\Models\Tag;
use App\Models\ProjectTag;
use App\Models\Category;
use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // User::factory(10)->create();

        User::factory()->create([
            'name' => 'Test Gebruiker',
            'email' => 'test@example.com',
            'birthday' => '1998-05-13',
            'function' => 'Medewerker',
            'phone' => '+31600000000',
            'bio' => 'Hallo, ik ben een test gebruiker!',
        ]);
        Degree::factory()->create([
            'email' => 'test@example.com',
            'school' => 'Avans hogeschool Asociate Degree',
            'degree' => 'Informatica',
            'experienceYears' => '2',
            'year' => '2',
            'description' => 'Dit is mijn laatste jaar voor informatica'

        ]);
        Project::factory()->create([
            'projectName' => 'Aquathermie',
            'phaseName' => 'Ontwerp fase',
            'description' => 'In dit project willen we het temperatuur volgen van de water en nog veel meer!',
            'status' => 'Lopend',
            'startingDate' => '2024-05-13',
            'projectLeader' => 'The Leader',
            'categorie' => 'Natuur',
            'productOwner' => 'Bertus Rosier',

        ]);
        Course::factory()->create([
            'email' => 'test@example.com',
            'courseName' => 'Lean Orange Belt',
            'description' => 'Ik kan bedrijven helpen met hun processen!',

        ]);
        Agenda::factory()->create([
            'email' => 'test@example.com',
            'datetime' => '2008-11-11',
            'title' => 'Afspraak bij de kapper',
            'personalStatus' => 'Bezet',
            'description' => 'Kapper voor een uur.',
            'location' => 'Kapper Rayan',


        ]);
        Skill::factory()->create([
            'email' => 'test@example.com',
            'skillname' => 'solderen',
            'skillExperience' => '4',
            'description' => 'Machines solderen zoals Arduino en pijpen.',
        ]);
        Tag::factory()->create([
            'tag' => 'Arduino',
        ]);
        Category::factory()->create([
            'category' => 'Boei',
        ]);
        Device::factory()->create([
            'deviceId' => '1214551',
            'time' => '17:00:00',
            'status' => 'offline',
            'email' => 'test@example.com',
        ]);

        ProjectTag::factory()->create([
            'project_id' => 1,
            'tag_id' => 1,
        ]);

        
    }
}
