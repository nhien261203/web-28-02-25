<?php

namespace App\Http\Controllers;

use App\Mail\ContactEmail;
use App\Mail\ContactSubmitted;
use App\Models\Banner;
use App\Models\Category;
use App\Models\Product;
use App\Models\Comment;
use App\Models\Contact;
use Illuminate\Support\Facades\DB;
use App\Models\Favorite;
use App\Models\User;
use Illuminate\Support\Facades\Mail;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Mail\VerifyEmail;
use App\Models\Membership;
use App\Models\Order;

class HomeController extends Controller
{
    public function login()
    {
        return view('home.login');
    }

    public function check_login()
    {
        request()->validate([

            'email' => 'required|email|exists:users',
            'password' => 'required',
        ]);

        $data = request()->all('email', 'password');
        // dd($data);

        if (auth()->attempt($data)) {
            return redirect()->route('home');
            // return redirect()->route('order.index');
        }

        return redirect()->back();
    }

    public function register()
    {
        return view('home.register');
    }

    public function check_register()
    {
        request()->validate([
            'name' => 'required',
            'email' => 'required|email|unique:users',
            'password' => 'required',
            'confirm_password' => 'required|same:password',
            'role' => 'required|in:user,admin',
        ]);

        $data = request()->all('email', 'name', 'role');
        $data['password'] = bcrypt(request('password'));
        // User::create($data);
        // return redirect()->route('home.login')->with('success', 'dang ky thanh cong');

        if ($acc = User::create($data)) {
            Mail::to($acc->email)->send(new VerifyEmail($acc));
            dd('ok');

            return redirect()->route('home.login')->with('ok', 'dang ki thanh cong, kiem tra email ');
        }

        return redirect()->back()->with('no', 'loi!!!, hay thu lai');
    }
    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect()->route('home.login');
    }
    // public function check_register(Request $request)
    // {
    //     $request->validate([
    //         'name' => 'required',
    //         'email' => 'required|email|unique:users',
    //         'password' => 'required|confirmed',
    //         'confirm_password' => 'required|same:password',
    //         'role' => 'required|in:user,admin',
    //     ]);

    //     $user = User::create([
    //         'name' => $request->name,
    //         'email' => $request->email,
    //         'password' => Hash::make($request->password),
    //         'role' => $request->role,
    //     ]);

    //     Mail::to($user->email)->send(new VerifyEmail($user));


    //     return redirect()->route('home.login')->with('success', 'Đăng ký thành công. Vui lòng kiểm tra email để xác thực tài khoản của bạn.');
    // }
    public function showChangePassword()
    {
        return view('home.change-password');
    }

    public function ChangePassword(Request $req)
    {
        $auth = Auth::user();

        // if (!$auth) {
        //     return redirect()->route('account.login')->with('no', 'User not authenticated');
        // }

        $req->validate([
            'old_password' => ['required', function ($attr, $value, $fail) use ($auth) {
                if (!Hash::check($value, $auth->password)) {
                    $fail('Your password does not match');
                }
            }],
            'password' => 'required|min:4',
            'confirm_password' => 'required|same:password'
        ]);

        $data['password'] = bcrypt($req->password);
        $check = $auth->update($data);

        if ($check) {
            // auth('cus')->logout();
            Auth::logout();
            return redirect()->route('login')->with('success', 'Password changed successfully');
        }

        return redirect()->back()->with('no', 'Failed to change password');
    }

    public function verify(Request $request)
    {
        $user = User::where('email', $request->email)->whereNull('email_verified_at')->firstOrFail();
        $user->update(['email_verified_at' => now()]);

        return redirect()->route('login')->with('success', 'Xác thực email thành công. Bạn có thể đăng nhập.');
    }


    // public function index(){
    //     $cats = Category::orderBy('name', 'ASC')->get();
    //     $products = Product::orderBy('id', 'DESC')->limit(6)->get();
    //     return view('index', compact('cats', 'products'));
    // }

    // public function product(Product $product)
    // {
    //     $cats = Category::orderBy('name', 'ASC')->get();
    //     return view('product', compact('product', 'cats'));
    // }

    public function post_comment($proId)
    {
        request()->validate([
            'comment' => 'required',
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255',
        ]);

        $data = [
            'product_id' => $proId,
            'user_id' => auth()->id(),
            'name' => request('name'),
            'email' => request('email'),
            'comment' => request('comment'),
            'status' => 0, // Bình luận mới chưa được duyệt
        ];

        if (Comment::create($data)) {
            return redirect()->back()->with('success', 'Bình luận của bạn đã được gửi và đang chờ duyệt.');
        }

        return redirect()->back()->with('error', 'Có lỗi xảy ra, vui lòng thử lại.');
    }


    // cach 2
    // public function getCommentsWithEloquent($productId)
    // {
    //     $comments = DB::table('comments')
    //         ->join('users', 'users.id', '=', 'comments.user_id')
    //         ->where('comments.product_id', $productId)
    //         ->select(
    //             'comments.id',
    //             'comments.comment',
    //             'comments.user_id',
    //             'users.name as user_name'
    //         )
    //         ->get();

    //     return redirect()->route('admin.product.show');
    // }

    // cach 1 dung relationShip hasOne ben model comment sau do lay len post_comment
    // cach 2 dung Query Builder de truy van du lieu tu bang comments va users de lay thong tin nguoi binh luan



    // public function contact() {
    //     return view('admin.email.contact');


    // }
    // public function senMail(){
    //     $email = 'dovannhien12345@gmail.com';
    //     Mail::to($email)->send(new ContactEmail());
    //     return redirect()->route('admin.contact')->with('success','da gui mail contact thanh cong');
    // }

    // xu li favorite


    public function favorite($product_id)
    {
        $user_id = auth()->id();
        $data = [
            'product_id' => $product_id,
            'user_id' => $user_id,
        ];
        $favorited = Favorite::where(['product_id' => $product_id, 'user_id' => auth()->id()])->first();
        if ($favorited) {
            $favorited->delete();
            return redirect()->back()->with('ok', 'ban da bo thich thanh cong');
        } else {
            Favorite::create($data);
            return redirect()->back()->with('success', 'ban da yeu thich san pham');
        }
    }

    public function index()
    {
        $products = Product::where('status', 1)
            ->whereHas('category', function ($query) {
                $query->where('status', 1); // Chỉ lấy sản phẩm thuộc danh mục đang hiển thị
            })
            ->with('category')
            ->orderBy('id', 'DESC')
            ->take(4)
            ->get();

        $banners = Banner::all();
        $randomBanners = $banners->shuffle()->take(3); // Lấy 3 banner ngẫu nhiên
        return view('home.home', compact('products', 'randomBanners'));
    }
    // ham ban dau
    // public function products()
    // {
    //     $categories = Category::with('products')->get();
    //     $banners = Banner::all();
    //     $randomBanners = $banners->shuffle()->take(3); // Lấy 3 banner ngẫu nhiên
    //     return view('home.product', compact('categories', 'randomBanners'));
    // }

    public function products(Request $request)
    {
        $minPrice = $request->input('min_price');
        $maxPrice = $request->input('max_price');

        // Kiểm tra giá trị hợp lệ
        if (($minPrice !== null && !is_numeric($minPrice)) || ($maxPrice !== null && !is_numeric($maxPrice))) {
            return redirect()->back();
        }

        $query = Product::where('status', 1)
            ->whereHas('category', function ($q) {
                $q->where('status', 1);
            });

        if ($minPrice !== null) {
            $query->where('price', '>=', $minPrice);
        }

        if ($maxPrice !== null) {
            $query->where('price', '<=', $maxPrice);
        }

        $products = $query->with('category')->get();

        // Lọc danh mục chỉ hiển thị những danh mục có sản phẩm thỏa mãn điều kiện lọc
        $categoryIds = $products->pluck('category_id')->unique();
        $categories = Category::where('status', 1)
            ->whereIn('id', $categoryIds)
            ->with(['products' => function ($q) use ($minPrice, $maxPrice) {
                $q->where('status', 1);
                if ($minPrice !== null) {
                    $q->where('price', '>=', $minPrice);
                }
                if ($maxPrice !== null) {
                    $q->where('price', '<=', $maxPrice);
                }
            }])
            ->get();

        $banners = Banner::inRandomOrder()->take(3)->get();

        return view('home.product', compact('products', 'categories', 'banners'));
    }

    // ... other code ...

    public function about()
    {
        return view('home.about');
    }

    public function showProduct($id)
    {
        $products = Product::findOrFail($id);

        // Luu san pham vao session
        $recentlyViewed = session()->get('recently_viewed', []);
        if (!in_array($products->id, $recentlyViewed)) {
            $recentlyViewed[] = $products->id;
            session(['recently_viewed' => $recentlyViewed]);
        }

        // Lấy các sản phẩm đã xem
        $recentProducts = Product::whereIn('id', $recentlyViewed)->get();

        $comments = Comment::where('product_id', $id)
            ->where('status', 1) // Chỉ lấy bình luận đã được admin duyệt
            ->with('user')
            ->orderBy('created_at', 'DESC')
            ->get();

        return view('home.product-detail', compact('products', 'recentProducts', 'comments'));
    }

    public function showContact()
    {
        return view('home.contact');
    }

    public function submitContact(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'email' => 'required|email',
            'message' => 'required',
        ]);

        $contact = Contact::create($request->all());

        // Gửi email xác nhận liên hệ
        Mail::to($contact->email)->send(new ContactSubmitted($contact->toArray()));

        return redirect()->route('home.contact')->with('success', 'Cảm ơn bạn đã liên hệ với chúng tôi!');
    }

    public function Favorite_user()
    {
        $user = Auth::user();
        $favorites = Favorite::where('user_id', $user->id)->with('product')->get();

        return view('home.favorites', compact('favorites'));
    }

    public function showMembership()
    {
        $user = Auth::user();
        $membership = Membership::where('user_id', $user->id)->first();
        $orders = Order::where('user_id', $user->id)->get();

        return view('home.membercard-user', compact('membership', 'orders'));
    }
}
