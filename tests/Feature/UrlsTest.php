<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class UrlsTest extends TestCase
{
    private $base_url = 'http://localhost:8000/';

    /**
     * Redirect test.
     *
     * @return void
     */
    public function testOrderRoute()
    {
        $response = $this->get($this->base_url . 'orders');
        $response->assertStatus(200);
    }

    /**
     * Redirect test.
     *
     * @return void
     */
    public function testRedirect()
    {
        $response = $this->get($this->base_url);
        $response->assertRedirect($this->base_url . 'orders');
    }
}
