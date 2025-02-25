@extends('admin.admin')

@section('main')
    <h1>Them Danh muc</h1>
    <form action="{{ route('category.store') }}" method="POST" role="form">
        @csrf
        <div class="form-group mb-2">
            <label for="" class="fw-bold">Ten danh muc</label>
            <input type="text" class="form-control" name="name" placeholder="input field">


        </div>

        <div class="form-group mb-2">
            <label for="" class="fw-bold">Trang thai</label>


            <div class="radio mt-1">
                <label for="" >
                    <input type="radio" name="status" id="" value="1">
                    Hien thi
                </label>
            </div>

            <div class="radio">
                <label for="">
                    <input type="radio" name="status" id="" value="0" checked>
                    Tam an
                </label>
            </div>
        </div>


        <button type="submit" class="btn btn-primary">add</button>
    </form>

@endsection

