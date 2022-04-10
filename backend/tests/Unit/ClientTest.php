<?php

namespace Tests\Unit;

use Tests\TestCase;

class ClientTest extends TestCase
{
    /**
     * Basic unit test API is working.
     *
     * @return void
     */
    public function test_api_status()
    {
        $this->get('api/clients')
            ->assertStatus(200);
    }

    /**
     * Test API basic response structure.
     *
     * @return void
     */
    public function test_api_response_basic_structure()
    {
        $this->get('/api/clients')
            ->assertJsonStructure([
                '*' => [
                    "id",
                    "created_at",
                    "updated_at",
                    "name",
                    "surname",
                    "latest_payment",
                ]
            ]);
    }

    /**
     * Test API response structure date filter.
     *
     * @return void
     */
    public function test_api_with_date_filter()
    {
        $response = $this->get('/api/clients?start_date=2020-01-01&end_date=2020-04-30');
        $response->assertJsonStructure([
            '*' => [
                "id",
                "created_at",
                "updated_at",
                "name",
                "surname",
                "latest_payment" => [
                    "id",
                    "created_at",
                    "updated_at",
                    "client_id",
                    "amount",
                ]
            ]
        ]);
    }
}
