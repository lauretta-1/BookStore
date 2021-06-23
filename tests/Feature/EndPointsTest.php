<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class EndPointsTest extends TestCase
{
    use DatabaseMigrations;
    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function test_login()
    {
        $response = $this->post('/login');

        $response->assertStatus(200);
    }

    public function test_register(){
        $response = $this->post('/register');

        $response->assertStatus(200);
    }

    public function test_logout(){
        $response = $this->post('/logout');

        $response->assertStatus(200);
    }

    public function test_users_list(){
        $response = $this->get('/users');

        $response->assertStatus(200);
    }

    public function test_users_details(){
        $response = $this->get('/users/{user}');

        $response->assertStatus(200);
    }

    public function test_user_delete(){
        $response = $this->delete('/user/{user}');

        $response->assertStatus(200);
    }

    public function test_book_list(){
        $response = $this->get('/books');

        $response->assertStatus(200);
    }

    public function test_book_details(){
        $response = $this->get('/books/{book}');

        $response->assertStatus(200);
    }
    public function test_book_delete(){
        $response = $this->delete('/books/{book}');

        $response->assertStatus(200);
    }
}
