<?php

namespace Tests\Unit;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class AuthorsApiTest extends TestCase
{
    private static $authorInsertedId;

    /**
     *
     * @return void
     */
    public function test_authorInsertError()
    {
        $data = [
            'name' => 'Hi',
            'birthdate' => $this->faker->date,
        ];
        $response = $this->post('/api/author', $data);
        $response->assertForbidden();
    }

    /**
     *
     * @return void
     */
    public function test_authorListStatus()
    {
        $response = $this->get('/api/author/list');

        $response->assertOk();
    }

    /**
     *
     * @return void
     */
    public function test_authorInsert()
    {
        $data = [
            'name' => $this->faker->name,
            'birthdate' => $this->faker->date,
        ];
        $response = $this->post('/api/author', $data);
        $response->assertCreated();
        $response->assertJson(['info' => $data]);
        $insertResponse = $response->decodeResponseJson();
        self::$authorInsertedId = $insertResponse['info']['id'];
    }

    /**
     *
     * @return void
     */
    public function test_authorEdit()
    {
        $data = [
            'name' => $this->faker->name,
            'birthdate' => $this->faker->date,
        ];
        $response = $this->patch('/api/author/' . self::$authorInsertedId, $data);
        $response->assertOk();
        $response->assertJson(['info' => $data]);
    }

    /**
     *
     * @return void
     */
    public function test_authorListContains()
    {
        $response = $this->get('/api/author/list');
        $response->assertOk();
        $authorList = $response->decodeResponseJson();
        $authorFiltered = array_filter($authorList['list'], function ($eachAuthor) {
            return $eachAuthor['id'] == self::$authorInsertedId;
        });
        $this->assertTrue(count($authorFiltered) > 0);
    }

    /**
     *
     * @return void
     */
    public function test_authorDelete()
    {
        $response = $this->delete('/api/author/' . self::$authorInsertedId);
        $response->assertOk();
    }
}
