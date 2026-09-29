<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use App\Http\Requests\PostRequest;
use App\Http\Resources\PostResource;
use App\Models\Post;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;

/**
 * @group Post Management V1
 *
 * API untuk mengelola data Post (Versi 1)
 */
class PostController extends Controller
{
    /**
     * Menampilkan daftar semua post.
     *
     * @response 200 {
     *   "data": [
     *     {
     *       "id": 1,
     *       "title": "Judul Post",
     *       "body": "Isi konten post...",
     *       "author": "Kamal",
     *       "created_at": "2026-09-22T08:00:00Z"
     *     }
     *   ]
     * }
     */
    public function index(): AnonymousResourceCollection
    {
        $posts = Post::with('user')->latest()->get();
        return PostResource::collection($posts);
    }

    /**
     * Membuat data post baru.
     *
     * @bodyParam title string required Judul postingan (harus unik).
     * @bodyParam body string required Konten lengkap postingan.
     * @bodyParam user_id int ID author pemilik post.
     *
     * @response 201 {
     *   "data": {
     *     "id": 1,
     *     "title": "Judul Post Baru",
     *     "body": "Konten...",
     *     "author": "Kamal"
     *   }
     * }
     * @response 422 {
     *   "message": "The title has already been taken."
     * }
     */
    public function store(PostRequest $request): JsonResponse
    {
        $data = $request->validated();
        if (empty($data['user_id']) && auth()->check()) {
            $data['user_id'] = auth()->id();
        }

        $post = Post::create($data);

        return (new PostResource($post->load('user')))
            ->response()
            ->setStatusCode(201);
    }

    /**
     * Mengambil satu data post berdasarkan ID.
     *
     * @urlParam id int required ID dari post.
     *
     * @response 200 {
     *   "data": {
     *     "id": 1,
     *     "title": "Judul Post",
     *     "body": "Konten...",
     *     "author": "Kamal"
     *   }
     * }
     * @response 404 {
     *   "message": "Data post tidak ditemukan"
     * }
     */
    public function show($id): JsonResponse|PostResource
    {
        $post = Post::with('user')->find($id);

        if (! $post) {
            return response()->json([
                'message' => 'Data post tidak ditemukan'
            ], 404);
        }

        return new PostResource($post);
    }

    /**
     * Memperbarui data post berdasarkan ID.
     *
     * @urlParam id int required ID post yang ingin diubah.
     * @bodyParam title string Judul baru (harus unik).
     * @bodyParam body string Isi konten baru.
     *
     * @response 200 {
     *   "data": {
     *     "id": 1,
     *     "title": "Judul Baru",
     *     "body": "Konten baru..."
     *   }
     * }
     * @response 404 { "message": "Data post tidak ditemukan" }
     * @response 422 { "message": "The title has already been taken." }
     */
    public function update(PostRequest $request, $id): JsonResponse|PostResource
    {
        $post = Post::find($id);

        if (! $post) {
            return response()->json([
                'message' => 'Data post tidak ditemukan'
            ], 404);
        }

        $post->update($request->validated());

        return new PostResource($post->load('user'));
    }

    /**
     * Menghapus data post berdasarkan ID.
     *
     * @urlParam id int required ID post yang ingin dihapus.
     *
     * @response 200 { "message": "Post berhasil dihapus" }
     * @response 404 { "message": "Data post tidak ditemukan" }
     */
    public function destroy($id): JsonResponse
    {
        $post = Post::find($id);

        if (! $post) {
            return response()->json([
                'message' => 'Data post tidak ditemukan'
            ], 404);
        }

        $post->delete();

        return response()->json([
            'message' => 'Post berhasil dihapus'
        ], 200);
    }

    /**
     * Mengambil post terbaru.
     *
     * @response 200 {
     *   "data": { ... }
     * }
     */
    public function latest(): JsonResponse|PostResource
    {
        $post = Post::with('user')->latest()->first();

        if (! $post) {
            return response()->json([
                'message' => 'Belum ada post tersedia'
            ], 404);
        }

        return new PostResource($post);
    }
}
