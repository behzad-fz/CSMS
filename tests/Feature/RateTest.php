<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class RateTest extends TestCase
{
    /**
     *  test user gets not found error with 404 status code if the endpoint is missing .
     *
     * @return void
     */
    public function test_endpoint_not_found()
    {
        $this->post('wrong/rate/endpoint')->assertStatus(404);
    }

    /**
     *  test user gets success response with 200 status code if the endpoint is exposed.
     *
     * @return void
     */
    public function test_endpoint_exposed()
    {
        $this->post('/rate')->assertStatus(200);
    }
}
