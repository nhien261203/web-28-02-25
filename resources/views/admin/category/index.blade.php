@extends('admin.admin')

@section('main')
<h1>Danh muc</h1>
<a href="{{ route('category.create')  }}" class="btn btn-success" ><i class="fas fa-plus" style="width:10px"></i></a>

</a>
<hr>
<table class="table table-hover">
    <thead>
        <tr>
            <th>ID</th>
            <th>Name</th>
            <th>Status</th>
            <th></th>
        </tr>
    </thead>

    <tbody>
        @foreach ($cats as $cat)
        <tr>
            <td>{{ $cat->id }}</td>
            <td>{{ $cat->name}}</td>
            <td>{{ $cat->status == 0 ? 'Tạm ẩn' : 'Hiển thị' }}</td>
            <td>
                <form action="{{ route('category.destroy', $cat->id) }}" method="POST">
                    @csrf
                    @method('DELETE')
                    <button class="btn btn-danger"><i class="fas fa-trash"></i></button>
                </form>
                <a href="{{ route('category.edit', $cat->id) }}" class="btn btn-sm btn-primary"><i class="fas fa-edit"></i></a>
            </td>
        </tr>
        @endforeach
    </tbody>
</table>

{{ $cats->links() }}
@endsection
