<?php

namespace Tests\Unit;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class ProjectsTest extends TestCase
{
    use RefreshDatabase;
    /**
     * A basic unit test example.
     *
     * @return void
     */
    public function test_projectShouldCreate()
    {
        $user = \factory(\App\User::class)->create([
            'username' => 'testadmin',
            'password' => bcrypt('testadmin'),
            'role' => 'admin'
        ]);

        $token = auth()->login($user);

        $data = [
            'code' => 'OR',
            'project' => 'Outdoor Research',
            'order' => 1
        ];

        $response = $this->withHeaders(['Authorization' => "Bearer $token"])
        ->json('POST', '/api/projects', $data);

        $response->assertStatus(201)
        ->assertJsonStructure(['payload' => ['message','data']]);
       
    }

    public function test_projectShouldUpdate()
    {
        $user = \factory(\App\User::class)->create([
            'username' => 'testadmin',
            'password' => bcrypt('testadmin'),
            'role' => 'admin'
        ]);

        $token = auth()->login($user);

        $project = \factory(\App\Projects::class)->create();

        $data = [
            'code' => 'OR',
            'project' => 'Outdoor Research',
            'order' => 2
        ];

        $response = $this->withHeaders(['Authorization' => "Bearer $token"])
        ->json('PUT', "/api/projects/$project->id", $data);

        $response->assertStatus(200)
        ->assertJsonStructure(['payload' => ['message','data']]);
       
    }

    public function test_projectShouldGet()
    {
        

        $project = \factory(\App\Projects::class, 3)->create();

    
        $response = $this->json('GET', "/api/projects");

        $response->assertStatus(200)
        ->assertJsonStructure(['payload' => ['data']])
        ->assertJsonCount(3, 'payload.data');
       
    }

    
}
