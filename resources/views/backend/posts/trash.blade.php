@section('title', 'Thùng rác thể loại')
@extends('backend.layouts.master')
@section('content')

    @include('backend.layouts.success')

    <div class="d-flex justify-content-between">
        <a href="{{route('backend.categories.index')}}"
           class="btn btn-primary rounded">Danh sách thể loại</a>
    </div>
    <table class="table table-hover table-bordered table-dark">
        <tr>
            <th>Tên</th>
            <th>Đường dẫn</th>
            <th>Hành động</th>
        </tr>
        @forelse($categories as $categorie)
            <tr>
                <td>{{ $categorie->name }}</td>
                <td>{{ $categorie->slug }}</td>
                <td class="d-flex">
                    <form action="{{route('backend.categories.restore', [$categorie->id])}}" method="post">
                        @csrf
                        <button class="btn btn-warning btn-sm rounded">
                            <i class="material-icons">restore</i>
                            Khôi phục
                        </button>
                    </form>
                    <form action="{{route('backend.categories.force.delete', [$categorie->id])}}" method="post">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-danger btn-sm rounded">
                            <i class="material-icons">delete</i>
                            Tiếp tục xóa
                        </button>
                    </form>
                </td>
            </tr>
        @empty
            <tr class="text-center">
                <td colspan="4">Không tìm thấy thể loại nào trong thùng rác</td>
            </tr>
        @endforelse

    </table>
@endsection
