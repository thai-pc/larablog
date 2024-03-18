@section('title', 'Danh sách cài đặt')
@extends('backend.layouts.master')
@section('content')
    @include('backend.layouts.success')
    <div class="row">
        <div class="col-md-12">
            <form
                action="{{route('backend.settings.store')}}"
                method="post"
                enctype="multipart/form-data"
            >
                @csrf
                <h3>Thông tin</h3>
                @include("backend.components.site-info")

                <h3>Đường dẫn mạng xã hội</h3>
                @include("backend.components.site-social-link")

                <h3>Thông tin chủ sỡ hữu</h3>
                @include("backend.components.site-owner-info")

                <h3>Thông tin chủ sỡ hữu mạng xã hội</h3>
                @include("backend.components.site-owner-social-links")

                <h3>Văn bản bản quyền</h3>
                @include("backend.partials.textarea-input",
                            [
                               "id"     => "copyright_text",
                               "title"  => "Copyright Text"
                            ])
                <button class="btn btn-primary btn-round btn-block mt-2">Lưu</button>

            </form>
        </div>
    </div>
@endsection
