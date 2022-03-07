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

    /**
     *  test user gets validation error with 422 status code if input start time is greater than end time.
     *
     * @return void
     */
    public function test_user_gets_validation_error_if_start_time_is_greater_than_end_time()
    {
        $input = [
            "rate" => [
                "energy" => 0.3,
                "time" => 2,
                "transaction"=>  1
            ],
            "cdr" => [
                "meterStart" => 1204307,
                "timestampStart" => "2021-04-05T10:04:00Z",
                "meterStop" => 1215230,
                "timestampStop" => "2000-01-01T00:00:01Z"
            ]
        ];

        $this->json('POST','/rate', $input)
            ->assertStatus(422)
            ->assertJson([
                 'message' => "The cdr.timestamp stop must be a date after or equal to cdr.timestamp start.",
                 'errors' => [
                     "cdr.timestampStop" => [
                         "The cdr.timestamp stop must be a date after or equal to cdr.timestamp start."
                     ],
                 ]
             ]);
    }

    /**
     *  test user gets validation error with 422 status code if input start meter is greater than end meter.
     *
     * @return void
     */
    public function test_user_gets_validation_error_if_start_meter_is_greater_than_end_meter()
    {
        $input = [
            "rate" => [
                "energy" => 0.3,
                "time" => 2,
                "transaction"=>  1
            ],
            "cdr" => [
                "meterStart" => 1204307,
                "timestampStart" => "2021-04-05T10:04:00Z",
                "meterStop" => 1,
                "timestampStop" => "2021-04-05T11:27:00Z"
            ]
        ];

        $this->json('POST','/rate', $input)
            ->assertStatus(422)
            ->assertJson([
                 'message' => "The cdr.meter stop must be greater than 1204307.",
                 'errors' => [
                     "cdr.meterStop" => [
                         "The cdr.meter stop must be greater than 1204307."
                     ],
                 ]
             ]);
    }

    /**
     *  test user gets a detailed receipt given correct input.
     *
     * @return void
     */
    public function test_user_gets_detailed_receipt_given_correct_input()
    {
        $input = [
            "rate" => [
                "energy" => 0.3,
                "time" => 2,
                "transaction"=>  1
            ],
            "cdr" => [
                "meterStart" => 1204307,
                "timestampStart" => "2021-04-05T10:04:00Z",
                "meterStop" => 1215230,
                "timestampStop" => "2021-04-05T11:27:00Z"
            ]
        ];

        $this->json('POST','/rate', $input)
            ->assertStatus(200)
            ->assertJsonStructure([
                "overall",
                "components" => [
                    "energy",
                    "time",
                    "transaction"
                ]
            ]);
    }
}
