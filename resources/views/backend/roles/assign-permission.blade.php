@section('title', 'Gán quyền')
@extends('backend.layouts.master')
@section('content')

    @include('backend.layouts.success')
    @include('backend.layouts.errors')

    <div class="d-flex justify-content-between">
        <a href="{{route('backend.role.index')}}" class="btn btn-primary rounded">Danh sách vai trò</a>
    </div>
    <h3 class="text-center">
        Gán quyền cho {{$role->name}}
    </h3>

    <form action="{{route('backend.role.store.permission', [$role->id])}}" method="post">
        @csrf
        @forelse($permissions as $permission)
            <div class="form-group">
                <table class="table">
                    <tr>
                        <td><label for="permission">{{$permission->name}}</label></td>
                        <td class="d-flex justify-content-end">
                            <input type="checkbox" name="permission[]"
                                   id="permission" value="{{$permission->name}}"
                            @if($role->hasPermissionTo($permission->id)) checked @endif>
                        </td>
                    </tr>
                </table>
            </div>
            @empty
            <p>Không có quyền nào được thêm vào</p>
        @endforelse
        <button type="submit" class="btn btn-primary rounded">Lưu</button>
    </form>

@endsection
