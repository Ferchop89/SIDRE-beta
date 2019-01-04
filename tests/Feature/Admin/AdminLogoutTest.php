<?php

namespace Tests\Feature\Admin;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class AdminLogoutTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    function an_admin_can_logout(){

        //Having / Given / Arrange
        $admin = $this->createAdmin();
        auth('admin')->login($admin);
        $this->assertAuthenticated('admin');

        //When / Act
        $response = $this->post('admin/logout');

        // Then / Assert
        $response->assertRedirect('/');
        $this->assertGuest('admin');
    }

    /** @test */
    function logging_out_as_an_admin_does_not_terminate_the_user_session(){

        //Having / Given / Arrange
        $admin = $this->createAdmin();
        $user = $this->createUser();

        auth('admin')->login($admin);
        auth('web')->login($user);

        $adminSessionName = auth('admin')->getName();
        $webSessionName = auth('web')->getName();

        $this->assertAuthenticated('admin');
        $this->assertAuthenticated('web');

        //When / Act
        $response = $this->post('admin/logout');

        // Then / Assert
        $response->assertRedirect('/')
            ->assertSessionHas($webSessionName)
            ->assertSessionMissing($adminSessionName);

        $this->assertGuest('admin');
        $this->assertAuthenticated('web');

    }
}
