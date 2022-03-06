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
        $this->json('POST', 'wrong/rate/endpoint')->assertStatus(404);
    }

    /**
     *  test user gets success response with 200 status code if the endpoint is exposed.
     *
     * @return void
     */
    public function test_endpoint_exposed()
    {
        $this->assertNotEquals(404, $this->json('POST','/rate')->getStatusCode());
    }

    /**
     *  test user gets validation error with 422 status code if input is not as expected.
     *
     * @return void
     */
    public function test_user_gets_validation_error_if_not_given_right_input()
    {
        $this->json('POST','/rate')
            ->assertStatus(422)
            ->assertJson([
                'message' => "The rate field is required. (and 8 more errors)",
                'errors' => [
                    "rate" => [
                        "The rate field is required."
                    ],
                        "rate.energy" => [
                        "The rate.energy field is required."
                    ],
                        "rate.time" => [
                        "The rate.time field is required."
                    ],
                        "rate.transaction" => [
                        "The rate.transaction field is required."
                    ],
                        "cdr" => [
                        "The cdr field is required."
                    ],
                        "cdr.meterStart" => [
                        "The cdr.meter start field is required."
                    ],
                        "cdr.timestampStart" => [
                        "The cdr.timestamp start field is required."
                    ],
                        "cdr.meterStop" => [
                        "The cdr.meter stop field is required."
                    ],
                        "cdr.timestampStop" => [
                        "The cdr.timestamp stop field is required."
                    ]
                ]
            ]);
    }
}
