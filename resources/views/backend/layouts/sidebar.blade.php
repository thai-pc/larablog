<aside
    class="sidenav navbar navbar-vertical navbar-expand-xs border-0 border-radius-xl my-3 fixed-start ms-3   bg-gradient-dark"
    id="sidenav-main">
    <div class="sidenav-header">
        <i class="fas fa-times p-3 cursor-pointer text-white opacity-5 position-absolute end-0 top-0 d-none d-xl-none"
           aria-hidden="true" id="iconSidenav"></i>
        <a class="navbar-brand m-0" href="/">
            <img src="https://www.liblogo.com/img-logo/ne1813l003-news-logo-logotype-free-logo-icons.png"
                 class="navbar-brand-img h-100" alt="Tech News">
            <span class="ms-1 font-weight-bold text-white">Tech Blog</span>
        </a>
    </div>
    <hr class="horizontal light mt-0 mb-2">
    <div class="collapse navbar-collapse  w-auto " id="sidenav-collapse-main">
        <ul class="navbar-nav">
            <li class="nav-item">
                <a class="nav-link text-white @if(Request::is('admin/dashboard')) active @endif" href="{{route('backend.dashboard')}}">
                    <div class="text-white text-center me-2 d-flex align-items-center justify-content-center">
                        <i class="material-icons opacity-10">dashboard</i>
                    </div>
                    <span class="nav-link-text ms-1">Bảng điều khiển</span>
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link text-white @if(Request::is('admin/post*')) active @endif"
                   href="{{route('backend.posts.index')}}">
                    <div class="text-white text-center me-2 d-flex align-items-center justify-content-center">
                        <i class="material-icons opacity-10">article</i>
                    </div>
                    <span class="nav-link-text ms-1">Bài viết</span>
                </a>
            </li>
            @hasanyrole('editor|admin')
            <li class="nav-item">
                <a class="nav-link text-white @if(Request::is('admin/categor*')) active @endif"
                   href="{{route('backend.categories.index')}}">
                    <div class="text-white text-center me-2 d-flex align-items-center justify-content-center">
                        <i class="material-icons opacity-10">all_inbox</i>
                    </div>
                    <span class="nav-link-text ms-1">Thể loại</span>
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link text-white @if(Request::is('admin/tag*')) active @endif"
                   href="{{route('backend.tags.index')}}">
                    <div class="text-white text-center me-2 d-flex align-items-center justify-content-center">
                        <i class="material-icons opacity-10">scatter_plot</i>
                    </div>
                    <span class="nav-link-text ms-1">Từ khóa</span>
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link text-white @if(Request::is('admin/comment*')) active @endif"
                   href="{{route('backend.comments.index')}}">
                    <div class="text-white text-center me-2 d-flex align-items-center justify-content-center">
                        <i class="material-icons opacity-10">batch_prediction</i>
                    </div>
                    <span class="nav-link-text ms-1">Bình luận</span>
                </a>
            </li>
            @endhasanyrole
            @role('admin')
            <li class="nav-item">
                <a class="nav-link text-white @if(Request::is('admin/permission*')) active @endif"
                   href="{{route('backend.permission.index')}}">
                    <div class="text-white text-center me-2 d-flex align-items-center justify-content-center">
                        <i class="material-icons opacity-10">work</i>
                    </div>
                    <span class="nav-link-text ms-1">Quyền</span>
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link text-white @if(Request::is('admin/role*')) active @endif"
                   href="{{route('backend.role.index')}}">
                    <div class="text-white text-center me-2 d-flex align-items-center justify-content-center">
                        <i class="material-icons opacity-10">group_work</i>
                    </div>
                    <span class="nav-link-text ms-1">Vai trò</span>
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link text-white @if(Request::is('admin/user*')) active @endif"
                   href="{{route('backend.user.index')}}">
                    <div class="text-white text-center me-2 d-flex align-items-center justify-content-center">
                        <i class="material-icons opacity-10">face</i>
                    </div>
                    <span class="nav-link-text ms-1">Người dùng</span>
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link text-white @if(Request::is('admin/site-settings')) active @endif"
                   href="{{route('backend.settings.index')}}">
                    <div class="text-white text-center me-2 d-flex align-items-center justify-content-center">
                        <i class="material-icons opacity-10">settings</i>
                    </div>
                    <span class="nav-link-text ms-1">Cài đặt website</span>
                </a>
            </li>
            @endrole
        </ul>
    </div>
</aside>
