<?php

namespace Tests\Unit;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class AttributesTest extends TestCase
{
    use RefreshDatabase;
    /**
     * A basic unit test example.
     *
     * @return void
     */
    public function test_attributeShouldCreate()
    {
        $user = \factory(\App\User::class)->create([
            'username' => 'testadmin',
            'password' => bcrypt('testadmin'),
            'role' => 'admin'
        ]);

        $token = auth()->login($user);

        $data = [
            'attribute' => 'or_test_attr',
            'is_native' => false
        ];

        $response = $this->withHeaders(['Authorization' => "Bearer $token"])
        ->json('POST', '/api/attributes', $data);

        $response->assertStatus(201)
        ->assertJsonStructure(['payload' => ['message','data']]);
       
    }

    public function test_attributeShouldUpdate()
    {
        $user = \factory(\App\User::class)->create([
            'username' => 'testadmin',
            'password' => bcrypt('testadmin'),
            'role' => 'admin'
        ]);

        $token = auth()->login($user);

        $attribute = \factory(\App\Attributes::class)->create();

        $data = [
            'attribute' => 'or_test_attr_update',
            'is_native' => true
        ];

        $response = $this->withHeaders(['Authorization' => "Bearer $token"])
        ->json('PUT', "/api/attributes/$attribute->id", $data);

        $response->assertStatus(200)
        ->assertJsonStructure(['payload' => ['message','data']]);
       
    }

    public function test_attributeShouldGet()
    {
        

        $project = \factory(\App\Attributes::class, 3)->create();

    
        $response = $this->json('GET', "/api/attributes");

        $response->assertStatus(200)
        ->assertJsonStructure(['payload' => ['data']])
        ->assertJsonCount(3, 'payload.data');
       
    }
}
