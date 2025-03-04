@extends('admin.admin')

@section('main')
<h2>Chi tiết thẻ thành viên</h2>

<p><strong>ID:</strong> {{ $membership->id }}</p>
<p><strong>Tên:</strong> {{ $membership->user->name }}</p>
<p><strong>Email:</strong> {{ $membership->user->email }}</p>
<p><strong>Điểm:</strong> {{ $membership->points }}</p>
<p><strong>Cấp độ:</strong> {{ $membership->membership_level }}</p>

<a href="{{ route('memberships.index') }}" class="btn btn-primary">Quay lại</a>
@endsection
