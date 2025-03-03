<?php

namespace App\Http\Controllers;

use App\Models\Membership;
use App\Models\Order;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class MembershipController extends Controller
{
    public function index()
    {
        $memberships = Membership::with('user')->orderBy('points', 'DESC')->paginate(10);
        return view('memberships.index', compact('memberships'));
    }

    // Hiển thị chi tiết một thành viên
    public function show($id)
    {

        $membership = Membership::with('user')->findOrFail($id);
        if ($membership) {
            $membership->updateMembershipLevel(); // Đảm bảo dữ liệu hiển thị mới nhất
        }
        return view('memberships.show', compact('membership'));
    }

    // Form chỉnh sửa thành viên
    public function edit($id)
    {
        $membership = Membership::findOrFail($id);
        return view('memberships.edit', compact('membership'));
    }

    // Cập nhật cấp độ thành viên
    public function update(Request $request, $id)
    {
        $request->validate([
            'points' => 'required|numeric|min:0',
        ]);

        $membership = Membership::findOrFail($id);
        $membership->points = $request->points;
        $membership->updateMembershipLevel(); // Cập nhật cấp độ tự động
        $membership->save();

        return redirect()->route('memberships.index')->with('success', 'Cập nhật thành viên thành công!');
    }

    // Xóa thành viên
    public function destroy($id)
    {
        $membership = Membership::findOrFail($id);
        $membership->delete();
        return redirect()->route('memberships.index')->with('success', 'Xóa thành viên thành công!');
    }
}
