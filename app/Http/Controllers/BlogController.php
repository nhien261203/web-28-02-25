<?php

namespace App\Http\Controllers;

use App\Models\Blog;
use Illuminate\Http\Request;

class BlogController extends Controller
{
    public function index()
    {
        $news =Blog::all();
        return view('admin.blogs.index', compact('news'));
    }


    // Hiển thị form tạo tin tức
    public function create()
    {
        return view('admin.blogs.create');
    }

    // Lưu tin tức mới
    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required',
            'content' => 'required',
            'image' => 'image|mimes:jpeg,png,jpg|max:2048',
            'status' => 'required|boolean',
        ]);

        $imagePath = null;
        if ($request->hasFile('image')) {
            $imagePath = $request->file('image')->store('news_images', 'public');
        }

        Blog::create([
            'title' => $request->title,
            'content' => $request->content,
            'image' => $imagePath,
            'status' => $request->status,
        ]);

        return redirect()->route('blogs.index')->with('success', 'Thêm tin tức thành công!');
    }

    // Hiển thị form chỉnh sửa tin tức
    public function edit($id)
    {
        $news = Blog::findOrFail($id);
        return view('admin.blogs.edit', compact('news'));
    }

    // Cập nhật tin tức
    public function update(Request $request, $id)
    {
        $news = Blog::findOrFail($id);

        $request->validate([
            'title' => 'required',
            'content' => 'required',
            'image' => 'image|mimes:jpeg,png,jpg|max:2048',
            'status' => 'required|boolean',
        ]);

        $imagePath = $news->image;
        if ($request->hasFile('image')) {
            $imagePath = $request->file('image')->store('news_images', 'public');
        }

        $news->update([
            'title' => $request->title,
            'content' => $request->content,
            'image' => $imagePath,
            'status' => $request->status,
        ]);

        return redirect()->route('blogs.index')->with('success', 'Cập nhật tin tức thành công!');
    }

    // Xóa tin tức
    public function destroy($id)
    {
        $news = Blog::findOrFail($id);
        $news->delete();
        return redirect()->route('blogs.index')->with('success', 'Xóa tin tức thành công!');
    }
}
