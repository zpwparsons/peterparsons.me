<?php

use App\Models\User;
use Symfony\Component\HttpFoundation\Response;

it('can create personal access tokens', function () {
    $user = User::factory()->create();

    $this
        ->postJson(route('api.tokens.store'), [
            'email' => $user->email,
            'password' => 'password',
            'device_name' => 'Testing',
        ])
        ->assertOk()
        ->assertJsonStructure(['token']);
});

it('does not create a personal access token if an invalid email was provided', function () {
    $this
        ->postJson(route('api.tokens.store'), [
            'email' => 'foo@example.com',
            'password' => 'password',
            'device_name' => 'Testing',
        ])
        ->assertStatus(Response::HTTP_UNPROCESSABLE_ENTITY)
        ->assertJson([
            'message' => 'The provided credentials are incorrect.',
        ]);
});

it('does not create a personal access token if an invalid password was provided', function () {
    $user = User::factory()->create();

    $this
        ->postJson(route('api.tokens.store'), [
            'email' => $user->email,
            'password' => 'invalid_password',
            'device_name' => 'Testing',
        ])
        ->assertStatus(Response::HTTP_UNPROCESSABLE_ENTITY)
        ->assertJson([
            'message' => 'The provided credentials are incorrect.',
        ]);
});

test('the email is required', function () {
    $this
        ->postJson(route('api.tokens.store'), [
            'password' => 'password',
            'device_name' => 'Testing',
        ])
        ->assertStatus(Response::HTTP_UNPROCESSABLE_ENTITY)
        ->assertJson([
            'message' => 'The email field is required.',
        ]);
});

test('the email must be a valid email address', function () {
    $this
        ->postJson(route('api.tokens.store'), [
            'email' => 'invalid email',
            'password' => 'password',
            'device_name' => 'Testing',
        ])
        ->assertStatus(Response::HTTP_UNPROCESSABLE_ENTITY)
        ->assertJson([
            'message' => 'The email field must be a valid email address.',
        ]);
});

test('the password is required', function () {
    $user = User::factory()->create();

    $this
        ->postJson(route('api.tokens.store'), [
            'email' => $user->email,
            'device_name' => 'Testing',
        ])
        ->assertStatus(Response::HTTP_UNPROCESSABLE_ENTITY)
        ->assertJson([
            'message' => 'The password field is required.',
        ]);
});

test('the device name is required', function () {
    $user = User::factory()->create();

    $this
        ->postJson(route('api.tokens.store'), [
            'email' => $user->email,
            'password' => 'password',
        ])
        ->assertStatus(Response::HTTP_UNPROCESSABLE_ENTITY)
        ->assertJson([
            'message' => 'The device name field is required.',
        ]);
});
