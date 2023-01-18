<nav class="navbar navbar-expand-lg bg-white navbar-light p-0">
    <a href="" class="navbar-brand d-block d-lg-none">
        <h1 class="m-0 display-4 text-primary">Klean</h1>
    </a>
    <button type="button" class="navbar-toggler" data-toggle="collapse" data-target="#navbarCollapse">
        <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse justify-content-between" id="navbarCollapse">
        <div class="navbar-nav mr-auto py-0">
            <a href="{{route('main')}}" class="nav-item nav-link active">{{ __('Home') }}</a>
            <a href="{{route('about')}}" class="nav-item nav-link">{{__('About')}}</a>
            <a href="{{route('service')}}" class="nav-item nav-link">{{__('Service')}}</a>
            <a href="{{route('projects')}}" class="nav-item nav-link">{{__('Project')}}</a>
            <a href="{{route('posts.index')}}" class="nav-item nav-link">{{__('Blog')}}</a>
            <a href="{{route('contact')}}" class="nav-item nav-link">{{__('Contact')}}</a>
        </div>


            @foreach($all_locales as $local)
                <a class="mr-3" href="{{ route('language.locale',['locale'=>$local]) }}">
                    {{ $local }}
                </a>
            @endforeach

        @auth()
                <a href="{{ route('notifications.index') }}" class="mr-3">

                    @if(auth()->user()->unreadNotifications()->count() == 0)
                        <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="currentColor" class="bi bi-bell" viewBox="0 0 16 16">
                            <path d="M8 16a2 2 0 0 0 2-2H6a2 2 0 0 0 2 2zM8 1.918l-.797.161A4.002 4.002 0 0 0 4 6c0 .628-.134 2.197-.459 3.742-.16.767-.376 1.566-.663 2.258h10.244c-.287-.692-.502-1.49-.663-2.258C12.134 8.197 12 6.628 12 6a4.002 4.002 0 0 0-3.203-3.92L8 1.917zM14.22 12c.223.447.481.801.78 1H1c.299-.199.557-.553.78-1C2.68 10.2 3 6.88 3 6c0-2.42 1.72-4.44 4.005-4.901a1 1 0 1 1 1.99 0A5.002 5.002 0 0 1 13 6c0 .88.32 4.2 1.22 6z"/>
                        </svg>
                    @else
                        <div>
                            <span class="badge badge-info">{{ auth()->user()->unreadNotifications()->count() }}</span>
                        </div>
                        <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="currentColor" class="bi bi-bell" viewBox="0 0 16 16">
                            <path d="M8 16a2 2 0 0 0 2-2H6a2 2 0 0 0 2 2zM8 1.918l-.797.161A4.002 4.002 0 0 0 4 6c0 .628-.134 2.197-.459 3.742-.16.767-.376 1.566-.663 2.258h10.244c-.287-.692-.502-1.49-.663-2.258C12.134 8.197 12 6.628 12 6a4.002 4.002 0 0 0-3.203-3.92L8 1.917zM14.22 12c.223.447.481.801.78 1H1c.299-.199.557-.553.78-1C2.68 10.2 3 6.88 3 6c0-2.42 1.72-4.44 4.005-4.901a1 1 0 1 1 1.99 0A5.002 5.002 0 0 1 13 6c0 .88.32 4.2 1.22 6z"/>
                        </svg>
                    @endif

                </a>
            <span href="" class="success mr-3 d-none d-lg-block">{{__('User')}} : {{ auth()->user()->name }}</span>
            <a href="{{ route('posts.create') }}" class="btn btn-primary mr-3 d-none d-lg-block">{{__('Add Post')}}</a>
            <form action="{{ route('logout') }}" method="POST">
                @csrf
                <button class="btn btn-danger mr-3 d-none d-lg-block">{{__('Logout')}}</button>
            </form>
        @else
            <a href="{{ route('login') }}" class="btn btn-primary mr-3 d-none d-lg-block">{{__('Log in')}}</a>
        @endauth
    </div>
</nav>
