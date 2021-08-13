# BookApi

BookApi is a REST API made using [Laravel](https://laravel.com/) that is a CRUD of Books and Authors

## Installation

To configure environment variables you will use the .env file

To install you will need to have [mysql](https://mysql.com/),[php](https://php.net/), [composer](https://getcomposer.org/), then when you pull this project go to it's root folder and run the following commands.

```bash
composer install
php artisan serve
```

## Usage
|  PATH| HTTP METHOD| Description|
| ---------------- | ----- | -------------------- |
| /api/author      | POST  | Create new Author    |
| /api/author/1    | PATCH | Update Author        |
| /api/author/list | GET   | Show all Authors     | 
| /api/author/1    | GET   | Show Author by Id    | 
| /api/author/1    | DELETE| DELETE Author by Id  |  
| /api/book        | POST  | Create new Book      |
| /api/book/1      | PATCH | Update Book          |
| /api/book/list   | GET   | Show all Books       | 
| /api/book/1      | GET   | Show Book Info by Id | 
| /api/book/1      | DELETE| DELETE Book by Id    |

## Request Examples
### GET /api/author/list[LISTAUTHORS]
### GET /api/author/{author}[GETAUTHORBYID]
### POST /api/author[CREATEAUTHOR]
```
{
	"name": "Author Zinx",
	"birthdate": "2021-05-03"
}
```
### PATCH /api/author/{author}[UPDATEAUTHOR]
```
{
	"name": "Author Zinx",
	"birthdate": "2021-05-03"
}
```
### DELETE /api/author/{author}[DELETEAUTHOR]

### GET /api/book/list[LISTBOOKS]
### GET /api/book/{book}[GETBOOKBYID]
### POST /api/book[CREATEBOOK]
```
{
	"title": "Books",
	"launchDate": "2021-05-03",
	"author": 2
}
```
### PATCH /api/book/{book}[UPDATEBOOK]
```
{
	"title": "Books",
	"launchDate": "2021-05-03",
	"author": 2
}
```
### DELETE /api/book/{book}[DELETEBOOK]

## Responses

* When successfully it will return code 200
* When not found it will return code 404
* When one part of the request isn't found it will return code 403
* When it's a create request it returns the id and detail about the request

### Postman

If you want to use [POSTMAN](https://www.postman.com/) to perform the API calls.
Here is one [example with a collection](bookApi-Laravel.postman_collection.json) to import.