<?php

it('returns a successful response', function () {
    $response = $this->get('/');

    $response->assertStatus(200);
});

it('can boot a Laravel application', function () {
    // This should not be null if Testbench is working
    expect(app())->toBeInstanceOf(\Illuminate\Foundation\Application::class);
});