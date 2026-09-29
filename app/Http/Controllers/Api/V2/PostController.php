<?php

namespace App\Http\Controllers\Api\V2;

use App\Http\Controllers\Controller;
use App\Http\Requests\PostRequest;
use App\Http\Resources\PostResource;
use App\Models\Post;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;

/**
 * @group Post Management V2
 *
 * API untuk mengelola data Post (Versi 2 - Mendukung pagination & metadata)
 */
class PostController extends Controller
{
    /**
     * Menampilkan daftar post dengan pagination (V2).
     *
     * @queryParam page int Halaman ke berapa. Example: 1
     * @queryParam per_page int Jumlah item per halaman. Example: 10
     *
     * @response 200 {
     *   "data": [...],
     *   "version": "v2",
     *   "meta": { ... }
     * }
     */
    public function index(): JsonResponse
    {
        $posts = Post::with('user')->latest()->paginate(request('per_page', 10));

        return response()->json([
            'version' => 'v2',
            'data' => PostResource::collection($posts),
            'pagination' => [
                'current_page' => $posts->currentPage(),
                'total_pages' => $posts->lastPage(),
                'total_items' => $posts->total(),
            ]
        ]);
    }

    /**
     * Membuat data post baru (V2).
     */
    public function store(PostRequest $request): JsonResponse
    {
        $data = $request->validated();
        if (empty($data['user_id']) && auth()->check()) {
            $data['user_id'] = auth()->id();
        }

        $post = Post::create($data);

        return response()->json([
            'version' => 'v2',
            'message' => 'Post created successfully',
            'data' => new PostResource($post->load('user')),
        ], 201);
    }

    /**
     * Mengambil satu post berdasarkan ID (V2).
     */
    public function show($id): JsonResponse
    {
        $post = Post::with('user')->find($id);

        if (! $post) {
            return response()->json([
                'version' => 'v2',
                'message' => 'Data post tidak ditemukan'
            ], 404);
        }

        return response()->json([
            'version' => 'v2',
            'data' => new PostResource($post),
        ]);
    }

    /**
     * Memperbarui post (V2).
     */
    public function update(PostRequest $request, $id): JsonResponse
    {
        $post = Post::find($id);

        if (! $post) {
            return response()->json([
                'version' => 'v2',
                'message' => 'Data post tidak ditemukan'
            ], 404);
        }

        $post->update($request->validated());

        return response()->json([
            'version' => 'v2',
            'message' => 'Post updated successfully',
            'data' => new PostResource($post->load('user')),
        ]);
    }

    /**
     * Menghapus post (V2).
     */
    public function destroy($id): JsonResponse
    {
        $post = Post::find($id);

        if (! $post) {
            return response()->json([
                'version' => 'v2',
                'message' => 'Data post tidak ditemukan'
            ], 404);
        }

        $post->delete();

        return response()->json([
            'version' => 'v2',
            'message' => 'Post berhasil dihapus'
        ], 200);
    }
}
