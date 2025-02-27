@extends('admin.admin')

@section('main')
<div class="container">
    <h2>Thêm tài khoản</h2>

    <form action="{{ route('user.store') }}" method="POST">
        @csrf
        <div class="form-group">
            <label for="name">Tên</label>
            <input type="text" name="name" id="name" class="form-control" value="{{ old('name') }}" required>
            @error('name') <small class="text-danger">{{ $message }}</small> @enderror
        </div>

        <div class="form-group">
            <label for="email">Email</label>
            <input type="email" name="email" id="email" class="form-control" value="{{ old('email') }}" required>
            @error('email') <small class="text-danger">{{ $message }}</small> @enderror
        </div>

        <div class="form-group">
            <label for="password">Mật khẩu</label>
            <input type="password" name="password" id="password" class="form-control" required>
            @error('password') <small class="text-danger">{{ $message }}</small> @enderror
        </div>

        <div class="form-group">
            <label for="role">Vai trò</label>
            <select name="role" id="role" class="form-control">
                <option value="user" {{ old('role') == 'user' ? 'selected' : '' }}>User</option>
                <option value="admin" {{ old('role') == 'admin' ? 'selected' : '' }}>Admin</option>
            </select>
            @error('role') <small class="text-danger">{{ $message }}</small> @enderror
        </div>

        <div class="form-group">
            <label>
                <input type="checkbox" name="verify_email" value="1" {{ old('verify_email') ? 'checked' : '' }}>
                Xác minh email ngay
            </label>
        </div>

        <button type="submit" class="btn btn-success">Thêm tài khoản</button>
    </form>
</div>
@endsection
