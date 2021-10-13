<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class AdminAreaTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    function unauthenticated_users_cannot_see_admin_area()
    {
        $this->get(route('admin'))->assertStatus(404);
    }

    /** @test */
    function users_without_admin_role_cannot_see_admin_area()
    {
        $this->signIn();

        $this->get(route('admin'))->assertStatus(404);
    }

    /** @test */
    function users_with_admin_role_can_see_admin_area()
    {
        $this->signIn();

        auth()->user()->assignRole('admin');

        $this->get(route('admin'))->assertStatus(200);
    }
}
