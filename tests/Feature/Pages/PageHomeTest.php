<?php

use App\Models\User;

it('loads Home page successfully', function () {
    // Arrange
    $response = $this->get('/');
    // Act & Assert
    $response->assertStatus(200);

});

it('shows login and register buttons when not logged in', function () {
    // Arrange
    $response = $this->get('/');
    // Act & Assert
    $response->assertSee('login')
        ->assertSee('register')
        ->assertDontSee('profile')
        ->assertDontSee('logout');
});

it('shows profile and logout buttons when logged in', function () {
    // Arrange
    $user = User::factory()->create();
    $this->actingAs($user);
    // Act
    $response = $this->get('/');
    // Assert
    $response->assertSee('profile')
        ->assertSee('logout')
        ->assertDontSee('login')
        ->assertDontSee('register');
});

it('shows posts when there are posts', function () {
    // Arrange
    $response = $this->get('/');
    // Act & Assert
    $response->assertSee('Posts');
});
