<?php
    namespace App\Http\Resources;

    use Illuminate\Http\Resources\Json\ResourceCollection;

    class BookCollection extends ResourceCollection {
        public function toArray($request) {
            // Transform each book in the collection into a resource
            return $this->collection->transform(function ($book) {
                return [
                    'id' => $book->id,
                    'title' => $book->title,
                    'author' => $book->author,
                    'price' => $book->price,
                ];
            });
        }

        public function with($request) {
            // Adding custom metadata to the response
            return [
                'meta' => [
                    'total_books' => $this->collection->count(), //Count of books
                    'custom_message' => 'Books fetched successfully!', //Custom message
                ],
            ];
        }
    }
?>