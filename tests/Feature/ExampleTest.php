<?php

test('the application returns a successful response', function () {
    $response = $this->get('/');

    $response->assertStatus(200)
        ->assertSee('Kirim sedikit')
        ->assertSee('Si Penjaga Malam')
        ->assertSee('Si Raksasa Hutan')
        ->assertSee('Si Hiu Santai');
});
