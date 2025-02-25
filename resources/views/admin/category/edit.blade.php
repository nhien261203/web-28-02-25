@extends('admin.admin')
@section('main')
    <h1>Sua Danh muc</h1>
    <form action="{{ route('category.update' , $category->id) }}" method="POST" role="form">
        @csrf
        @method('PUT')
        <div class="form-group mb-2">
            <label for="" class="fw-bold">Ten danh muc</label>
            <input type="text" class="form-control" value="{{ $category->name }}" name="name" placeholder="input field">
        </div>

        <div class="form-group mb-2">
            <label for="" class="fw-bold">Trang thai</label>


            <div class="radio mt-1">
                <label for="" >
                    <input type="radio" name="status" id="" value="1" {{$category->status == 1 ? 'checked' : ''}}>
                    Hien thi
                </label>
            </div>

            <div class="radio">
                <label for="">
                    <input type="radio" name="status" id="" value="0" {{$category->status == 0 ? 'checked' : ''}}>
                    Tam an
                </label>
            </div>
        </div>


        <button type="submit" class="btn btn-primary">update</button>
    </form>

@endsection
