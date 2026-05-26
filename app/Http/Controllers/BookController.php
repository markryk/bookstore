<?php
    namespace App\Http\Controllers;

    use App\Models\Book;
    use Illuminate\Http\Request;
    use App\Http\Resources\BookResource;
    use App\Http\Resources\BookCollection;

    class BookController extends Controller {
        public function index() {
            //return new BookCollection(Book::all());
            return new BookCollection(Book::paginate(5)); //Pagination example
        }

        public function show($id) {
            return new BookResource(Book::findOrFail($id));
        }

        public function store(Request $request) {
            $book = Book::create($request->validate([
                'title' => 'required|string|max:255',
                'author' => 'required|string|max:255',
                'description' => 'required|string',
                'price' => 'required|numeric',
            ]));
            return new BookResource($book);
        }

        public function update(Request $request, $id) {
            $book = Book::findOrFail($id);
            $book->update($request->validate([
                'title' => 'required|string|max:255',
                'author' => 'required|string|max:255',
                'description' => 'required|string',
                'price' => 'required|numeric',
            ]));
            return new BookResource($book);
        }

        public function destroy($id) {
            $book = Book::findOrFail($id);
            $book->delete();
            return response()->noContent();
        }
    }
?>