<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;
use App\Models\Category;
use App\Models\Comment;
use App\Models\Favorite;
// use App\Models\Cart;

use Illuminate\Support\Facades\Storage;


class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        // dd($cart);
        $products = Product::with('category')->orderBy('id', 'DESC')->paginate(5);

        return view('admin.product.index', compact('products'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $categories = Category::all(); // Lấy tất cả danh mục
        return view('admin.product.create', compact('categories'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {

        $request->validate([
            'name' => 'required|string|max:255|unique:products,name',
            'price' => 'required|numeric|min:0',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'content' => 'nullable|string',
            'category_id' => 'required|exists:categories,id',
            'status' => 'required|boolean',
        ]);

        $data = $request->only('name', 'price', 'content', 'category_id', 'status');


        if ($request->hasFile('image')) {
            $imagePath = $request->file('image')->store('images/products', 'public');
            $data['image'] = $imagePath; // Thêm đường dẫn hình ảnh vào mảng dữ liệu
        }

        Product::create($data);

        // Chuyển hướng với thông báo thành công
        return redirect()->route('product.index')->with('success', 'thao tac thanh cong.');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {


        $product = Product::findOrFail($id);
        // lay comment de chuan bi hien thi len view
        $comments = Comment::where('product_id', $product->id)->orderBy('id', 'DESC')->get();

        return view('admin.product.show', compact('product', 'comments'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Product $product)
    {
        // Lấy danh sách danh mục để hiển thị trong form
        $categories = Category::all();

        return view('admin.product.edit', compact('product', 'categories'));
    }

    /**
     * Cập nhật sản phẩm trong cơ sở dữ liệu.
     */
    public function update(Request $request, Product $product)
    {
        // $request->validate([
        //     'name' => 'required|unique:products,name,'.$product->id,
        //     'category_id' => 'required|exists:categories,id', // Đảm bảo category_id là hợp lệ
        //     'status' => 'required|boolean', // Kiểm tra status là kiểu boolean
        // ]);

        $data = $request->all(); // Lấy dữ liệu cần thiết
        if ($request->hasFile('image')) {
            // Xóa hình ảnh cũ nếu có
            if ($product->image) {
                Storage::disk('public')->delete($product->image);
            }
            // Lưu hình ảnh mới
            $data['image'] = $request->file('image')->store('images/products', 'public');
        }

        $product->update($data); // Cập nhật dữ liệu

        return redirect()->route('product.index')->with('success', 'thao tac thanh cong.');
    }
    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Product $product)
    {
        $product->delete();

        return redirect()->route('product.index');
    }

    // public function favorites()
    // {

    //     return view('admin.product.favorites');
    // }

}
