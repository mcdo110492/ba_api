<?php

namespace Tests\Unit;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class AttributeSetAttributesTest extends TestCase
{
    use RefreshDatabase;
    /**
     * A basic unit test example.
     *
     * @return void
     */
    public function test_attributeSetAttributesShouldCreate()
    {
        $user = \factory(\App\User::class)->create([
            'username' => 'testadmin',
            'password' => bcrypt('testadmin'),
            'role' => 'admin'
        ]);

        $token = auth()->login($user);

        $data = \factory(\App\AttributeSetAttributes::class)->make()->toArray();

        $response = $this->withHeaders(['Authorization' => "Bearer $token"])
        ->json('POST', '/api/attribute/set/attributes', $data);
        

        $response->assertStatus(201)
        ->assertJsonStructure(['payload' => ['message','data']]);
       
    }

    public function test_attributeSetAttributesShouldUpdate()
    {
        $user = \factory(\App\User::class)->create([
            'username' => 'testadmin',
            'password' => bcrypt('testadmin'),
            'role' => 'admin'
        ]);

        $token = auth()->login($user);

        $attributeSetAttributes = \factory(\App\AttributeSetAttributes::class)->create();

        $data = \factory(\App\AttributeSetAttributes::class)->make()->toArray();

        $response = $this->withHeaders(['Authorization' => "Bearer $token"])
        ->json('PUT', "/api/attribute/set/attributes/$attributeSetAttributes->id", $data);

        $response->assertStatus(200)
        ->assertJsonStructure(['payload' => ['message','data']]);
       
    }

    public function test_attributeSetAttributesShouldGetBySet()
    {
        
        $attributeSet = \factory(\App\AttributeSet::class)->create();

        $set = \factory(\App\AttributeSetAttributes::class, 3)->create([
            'set_id' => $attributeSet->id
        ]);

    
        $response = $this->json('GET', "/api/attribute/set/attributes/$attributeSet->id");

        $response->assertStatus(200)
        ->assertJsonStructure(['payload' => ['data']])
        ->assertJsonCount(3, 'payload.data');
       
    }

    public function test_uniqueValidatorAttributeSetAttributes()
    {
        $user = \factory(\App\User::class)->create([
            'username' => 'testadmin',
            'password' => bcrypt('testadmin'),
            'role' => 'admin'
        ]);

        $token = auth()->login($user);


        $create = \factory(\App\AttributeSetAttributes::class)->create();

        $data = \factory(\App\AttributeSetAttributes::class)->make([
            'set_id' => $create->set_id,
            'attr_id' => $create->attr_id
        ])->toArray();

        $response = $this->withHeaders(['Authorization' => "Bearer $token"])
        ->json('POST', '/api/attribute/set/attributes', $data);


        $response->assertStatus(422);

    }
}
