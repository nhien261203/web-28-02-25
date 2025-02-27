<?php

namespace App\Http\Controllers;
use App\Models\Favorite;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class FavoriteController extends Controller
{
    // cach 1: viet relation ben model
    public function index()
    {

        $favorites = Favorite::with('product', 'user') // Lấy thông tin sản phẩm & người dùng
        ->orderByDesc('created_at') // Sắp xếp theo thời gian mới nhất
        ->get();

    return view('admin.favorites.index', compact('favorites'));
    }

    // where: loc cac ban ghi ma user_id trung voi id cua nguoi dung hien tai (nguoi dung da dang nhap)





}
