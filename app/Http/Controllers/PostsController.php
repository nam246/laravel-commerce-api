<?php

namespace App\Http\Controllers;

use App\Http\Requests\Posts\StorePostsRequest;
use App\Http\Requests\Posts\UpdatePostsRequest;
use App\Models\Posts;
use Illuminate\Http\Request;

class PostsController extends Controller
{
    /**
     * Display a listing of the resource.
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function index(Request $request)
    {
        $query = Posts::query();

        // Thêm relationship với category
        $query->with('category');

        // Filter theo category
        if ($request->has('category_id')) {
            $query->where('post_category_id', $request->category_id);
        }

        // Filter theo trạng thái publish
        if ($request->has('publish')) {
            $query->where('publish', $request->publish);
        }

        // Search theo title hoặc description
        if ($request->has('search')) {
            $search = $request->search;
            $query->where(function ($q) use ($search) {
                $q->where('title', 'like', "%{$search}%")
                    ->orWhere('description', 'like', "%{$search}%");
            });
        }

        // Sắp xếp
        $sortBy = $request->input('sort_by', 'created_at'); // Mặc định sort theo created_at
        $sortOrder = $request->input('sort_order', 'desc');  // Mặc định sort theo thứ tự giảm dần
        $query->orderBy($sortBy, $sortOrder);

        // Phân trang
        $perPage = $request->input('per_page', 10); // Mặc định 10 items/trang
        $posts = $query->paginate($perPage);

        return response()->json([
            'data' => $posts->items(),
            'meta' => [
                'current_page' => $posts->currentPage(),
                'last_page' => $posts->lastPage(),
                'per_page' => $posts->perPage(),
                'total' => $posts->total()
            ]
        ], 200);
    }

    /*
     * Display 1 by Id
     */

    public function getById($id)
    {
        $post = Posts::query()->findOrFail($id);

        return response()->json($post, 200);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(Request $request)
    {

    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StorePostsRequest $request)
    {
        try {
            // Lấy dữ liệu đã được validate từ StorePostsRequest
            $data = $request->validated();

            // Xử lý upload hình ảnh
            if ($request->hasFile('image')) {
                $data['image'] = $request->file('image')->store('posts/images', 'public');
            }

            // Thêm các giá trị mặc định
            $data['user_id'] = $data['user_id'] ?? auth()->id();
            $data['publish'] = $data['publish'] ?? false;

            // Tạo post mới sử dụng Eloquent
            $post = Posts::create($data);

            return response()->json([
                'message' => 'Post created successfully',
                'data' => $post
            ], 201);

        } catch (\Exception $e) {
            return response()->json([
                'message' => 'Failed to create post',
                'error' => $e->getMessage()
            ], 500);
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(Posts $posts)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Posts $posts)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdatePostsRequest $request, Posts $id)
    {
        // Tìm post cần update
        $post = Posts::findOrFail($id);

        // Validate dữ liệu
        $data = $request->validate([
            'title' => 'sometimes|required|string|max:225',
            'description' => 'sometimes|required|string',
            'body' => 'sometimes|required|string',
            'image' => 'sometimes|image|mimes:jpg,png,jpeg,gif,svg|max:2048',
            'publish' => 'sometimes|boolean',
            'post_category_id' => 'sometimes|required|exists:post_categories,id'
        ]);

        // Xử lý upload ảnh mới nếu có
        if ($request->hasFile('image')) {
            // Xóa ảnh cũ nếu có
            if ($post->image) {
                Storage::disk('public')->delete($post->image);
            }
            // Upload và lưu đường dẫn ảnh mới
            $data['image'] = $request->file('image')->store('posts/images', 'public');
        }

        // Cập nhật post
        $post->update($data);

        return response()->json([
            'message' => 'Post updated successfully',
            'data' => $post
        ], 200);

    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        // Tìm post cần xóa
        $post = Posts::findOrFail($id);

        try {
            // Xóa file ảnh từ storage nếu có
            if ($post->image) {
                Storage::disk('public')->delete($post->image);
            }

            // Xóa bản ghi từ database
            $post->delete();

            return response()->json([
                'message' => 'Post deleted successfully'
            ], 200);

        } catch (\Exception $e) {
            return response()->json([
                'message' => 'Failed to delete post',
                'error' => $e->getMessage()
            ], 500);
        }

    }
}
