<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class ExampleTest extends TestCase
{
    use RefreshDatabase;
    /**
     * A basic test example.
     *
     * @return void
     */

    /** @test */
    function index_does_not_crash_with_seeded_database()
    {
        $this->seed();

        $response = $this->get('/');

        $response->assertStatus(200);
    }

    /** @test */
    function index_does_not_crash_with_no_data_in_database()
    {
        $response = $this->get('/');

        $response->assertStatus(200);
    }
}
