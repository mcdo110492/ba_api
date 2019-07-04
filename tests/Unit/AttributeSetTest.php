<?php

namespace Tests\Unit;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class AttributeSetTest extends TestCase
{
    use RefreshDatabase;
    /**
     * A basic unit test example.
     *
     * @return void
     */
    public function test_attributeSetShouldCreate()
    {
        $user = \factory(\App\User::class)->create([
            'username' => 'testadmin',
            'password' => bcrypt('testadmin'),
            'role' => 'admin'
        ]);

        $token = auth()->login($user);

        $data = \factory(\App\AttributeSet::class)->make()->toArray();

        $response = $this->withHeaders(['Authorization' => "Bearer $token"])
        ->json('POST', '/api/attribute/set', $data);

        $response->assertStatus(201)
        ->assertJsonStructure(['payload' => ['message','data']]);
       
    }

    public function test_attributeSetShouldUpdate()
    {
        $user = \factory(\App\User::class)->create([
            'username' => 'testadmin',
            'password' => bcrypt('testadmin'),
            'role' => 'admin'
        ]);

        $token = auth()->login($user);

        $attributeSet = \factory(\App\AttributeSet::class)->create();

        $data = \factory(\App\AttributeSet::class)->make()->toArray();

        $response = $this->withHeaders(['Authorization' => "Bearer $token"])
        ->json('PUT', "/api/attribute/set/$attributeSet->id", $data);

        $response->assertStatus(200)
        ->assertJsonStructure(['payload' => ['message','data']]);
       
    }

    public function test_attributeSetShouldGet()
    {
        

        $project = \factory(\App\AttributeSet::class, 3)->create();

    
        $response = $this->json('GET', "/api/attribute/set");

        $response->assertStatus(200)
        ->assertJsonStructure(['payload' => ['data']])
        ->assertJsonCount(3, 'payload.data');
       
    }
}
