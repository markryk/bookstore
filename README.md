# Bookstore API

Laravel Bookstore API that allows users to manage books. The API will support the following features:

- Retrieve a list of books
- Retrieve a single book
- Create a new book
- Update an existing book
- Delete a book

## Create the project
```
composer create-project laravel/laravel bookstore
cd bookstore
```

## Set up the database
Update the *.env* file with the database connection details
```
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=bookstore
DB_USERNAME=your_username
DB_PASSWORD=your_password
```

## Migrations
Create the migration for Books
```
php artisan make:migration create_books_table
```

In the newly created migration file, define the *books* table schema
```
public function up() {
    Schema::create(‘books’, function (Blueprint $table) {
        $table->id();
        $table->string(‘title’);
        $table->string(‘author’);
        $table->text(‘description’);
        $table->decimal(‘price’, 8, 2);
        $table->timestamps();
    });
}
```

Run the Migration
```
php artisan migrate
```

## Models
Create the Book Model
```
php artisan make:model Book
```

In the *Models/Book.php*
```
(...)
protected $fillable = ['title', 'author', 'description', 'price'];
(...)
```

## Controllers
Create the Book Controller
```
php artisan make:controller BookController
```

In the *BookController.php*, implement the CRUD operations
- index();
- show();
- store();
- update();
- destroy();

## API Resources
Create the Book Resource, to transform a single Book Model in JSON
```
php artisan make:resource BookResource
```

In the *BookResource.php*
- toArray(); (transforms the model into an array format that will be converted into JSON)

Create the BookCollection, to handle multiple BookResource instances
```
php artisan make:resource BookCollection
```

In the *BookCollection.php*
- toArray();

## Routes
In *bootstrap/app.php*, add the following line
```
(...)
web: __DIR__.'/../routes/web.php', //linha existente
api: __DIR__.'/../routes/api.php', //acrescentar essa linha
(...)
```

Create *api.php* in *routes/api.php* and define the routes
```
(...)
Route::apiResource('books', BookController::class);
(...)
```

## Testing the API
```
php artisan serve
```
The API will be available at http://127.0.0.1:8000/api/books

## Testing the API endpoints (Insomnia or Postman)
- GET /api/books - Retrieve all books
- GET /api/books/{id} - Retrieve a specific book
- POST /api/books - Create a new book
- PUT /api/books/{id} - Update an existing book
- DELETE /api/books/{id} - Delete a book