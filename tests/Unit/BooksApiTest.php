<?php

namespace Tests\Unit;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class BooksApiTest extends TestCase
{
    private static $bookInsertedId;

    /**
     * 
     * @return int
     */
    private function getLastAuthorId(): int
    {
        $response = $this->get('/api/author/list');
        $response->assertOk();
        $bookList = $response->decodeResponseJson()['list'];
        $lastBookIndex = array_key_last($bookList);
        return $bookList[$lastBookIndex]['id'];
    }

    /**
     *
     * @return void
     */
    public function test_BookInsertError()
    {
        $data = [
            'title' => 'Hi',
            'launchDate' => $this->faker->date,
            'author' => $this->getLastAuthorId(),
        ];
        $response = $this->post('/api/book', $data);
        $response->assertForbidden();
    }

    /**
     *
     * @return void
     */
    public function test_bookListStatus()
    {
        $response = $this->get('/api/book/list');

        $response->assertOk();
    }

    /**
     *
     * @return void
     */
    public function test_bookInsert()
    {
        $data = [
            'title' => $this->faker->name,
            'launchDate' => $this->faker->date,
            'author' => $this->getLastAuthorId(),
        ];
        $response = $this->post('/api/book', $data);
        $response->assertCreated();
        $jsonToAssert = $data;
        $jsonToAssert['author'] = array('id' => $data['author']);
        $response->assertJson(['info' => $jsonToAssert]);
        $insertResponse = $response->decodeResponseJson();
        self::$bookInsertedId = $insertResponse['info']['id'];
    }

    /**
     *
     * @return void
     */
    public function test_bookEdit()
    {
        $data = [
            'title' => $this->faker->name,
            'launchDate' => $this->faker->date,
            'author' => $this->getLastAuthorId(),
        ];
        $response = $this->patch('/api/book/' . self::$bookInsertedId, $data);
        $response->assertOk();
        $jsonToAssert = $data;
        $jsonToAssert['author'] = array('id' => $data['author']);
        $response->assertJson(['info' => $jsonToAssert]);
    }

    /**
     *
     * @return void
     */
    public function test_bookListContains()
    {
        $response = $this->get('/api/book/list');
        $response->assertOk();
        $bookList = $response->decodeResponseJson();
        $bookFiltered = array_filter($bookList['list'], function ($eachAuthor) {
            return $eachAuthor['id'] == self::$bookInsertedId;
        });
        $this->assertTrue(count($bookFiltered) > 0);
    }

    /**
     *
     * @return void
     */
    public function test_bookDelete()
    {
        $response = $this->delete('/api/book/' . self::$bookInsertedId);
        $response->assertOk();
    }
}
