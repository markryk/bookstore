<?php
    namespace App\Http\Resources;

    use Illuminate\Http\Resources\Json\JsonResource;

    class BookResource extends JsonResource {
        public function toArray($request) {
            $data = [
                'id' => $this->id,
                'title' => $this->title,
                'author' => $this->author,
                'description' => $this->description,
                'price' => $this->price,
                'created_at' => $this->created_at,
                'updated_at' => $this->updated_at,
            ];

            if ($request->user() && $request->user()->isAdmin()) {
                $data['admin_notes'] = $this->admin_notes; // Only include for admin users
            }

            return $data;
        }

        public function with($request) {
            //Add metadata to the individual resource
            return [
                'meta' => [
                    'message' => 'Book details fetched successfully!',
                ],
            ];
        }
    }
?>