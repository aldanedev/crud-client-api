<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class CrudClientTest extends TestCase
{
    use RefreshDatabase;
    
    /** @test */   
    public function it_can_create_a_client()
    {   

        $user = \App\Models\User::factory()->create();
        $this->assertCount(0, $user->tokens);

        $this->actingAs($user);

        $response = $this->json('post', 'api/clients', [
            'name' => 'John A Doe',
            'email' => 'example@domain.com',
            'phone' => '123456789',
            'enrollment' => '123456789',
            'date_payment' => '2021-04-13',
        ]);
        
        $response->assertCreated();
        $this->assertDatabaseCount('clients', 1);

    }

    /** @test */
    public function it_can_list_clients()
    {       
        $user = \App\Models\User::factory()->create();
        $this->assertCount(0, $user->tokens);

        $this->actingAs($user);

        \App\Models\Client::factory()->count(2)->create();

        $response = $this->json('get', '/api/clients');
        $response->assertOk();
        $response->assertJsonCount(2);
        $this->assertDatabaseCount('clients', 2);
    }
    

    /** @test */
    public function it_can_update_a_client()
    {
        $user = \App\Models\User::factory()->create();
        $this->assertCount(0, $user->tokens);

        $this->actingAs($user);
        $client = \App\Models\Client::factory()->create();
        $response = $this->json('put', '/api/clients/' . $client->id, [
            'name' => 'John A Doe',
            'email' => 'example@domain.com',
            'phone' => '123456789',
            'enrollment' => '123456789',
            'date_payment' => '2021-04-13',
        ]);
        
        $response->assertOk();
        $response->assertJson([
            'name' => 'John A Doe',
            'email' => 'example@domain.com',
            'phone' => '123456789',
            'enrollment' => '123456789',
            'date_payment' => '2021-04-13',
        ]);
    }

   /** @test */
   public function it_can_delete_a_client()
   {
       $user = \App\Models\User::factory()->create();
       $this->assertCount(0, $user->tokens);

       $this->actingAs($user);
       $client = \App\Models\Client::factory()->create();
       $response = $this->json('delete', '/api/clients/' . $client->id);
       
       $response->assertNoContent();
       $this->assertDatabaseCount('clients', 0);
   }
}
