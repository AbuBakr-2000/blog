<x-layouts.main>

    <x-slot:title>
        Notifications
    </x-slot:title>


    <!-- Blog Start -->
    <div class="container-fluid py-5">
        <div class="container">
            <div class="row align-items-end mb-4">
                <div class="col-lg-6">
                    <h1 class="section-title mb-3">Notifications</h1>
                </div>
            </div>
            @foreach($notifications as $notification)
                <div>
                    <div class="rounded border mb-3 p-4">
                        <div class="position-relative mb-4">
                            @if($notification->read_at == null)
                                <div class="blog-date">
                                    <h4 class="font-weight-bold mb-n1">New</h4>
                                </div>
                            @else
                                <div class="text-right">
                                    <form action="{{ route('notifications.destroy',$notification->id) }}" method="POST"
                                          onsubmit="return confirm('Are you sure you wish to delete?');">
                                        @method('DELETE')
                                        @csrf
                                        <button type="submit" class="btn btn-sm btn-danger">
                                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-trash" viewBox="0 0 16 16">
                                                <path d="M5.5 5.5A.5.5 0 0 1 6 6v6a.5.5 0 0 1-1 0V6a.5.5 0 0 1 .5-.5zm2.5 0a.5.5 0 0 1 .5.5v6a.5.5 0 0 1-1 0V6a.5.5 0 0 1 .5-.5zm3 .5a.5.5 0 0 0-1 0v6a.5.5 0 0 0 1 0V6z"/>
                                                <path fill-rule="evenodd" d="M14.5 3a1 1 0 0 1-1 1H13v9a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2V4h-.5a1 1 0 0 1-1-1V2a1 1 0 0 1 1-1H6a1 1 0 0 1 1-1h2a1 1 0 0 1 1 1h3.5a1 1 0 0 1 1 1v1zM4.118 4 4 4.059V13a1 1 0 0 0 1 1h6a1 1 0 0 0 1-1V4.059L11.882 4H4.118zM2.5 3V2h11v1h-11z"/>
                                            </svg>
                                        </button>
                                    </form>
                                </div>
                            @endif
                        </div>
                        <div class="d-flex mb-2">
                            <div class="text-secondary text-uppercase font-weight-medium">{{ $notification->data['created_at'] }}</div>
                        </div>
                        <a href="{{ route('posts.show',$notification->data['id']) }}">
                            <h5 class="font-weight-medium mb-2">
                                {{ $notification->data['title'] }}
                            </h5>
                        </a>
                        <p class="mb-4">
                            {{ $notification->data['id'] ."- id post has been created." }}
                        </p>
                        @if($notification->read_at == null)
                            <a class="btn btn-sm btn-primary py-2" href="{{ route('notifications.read',$notification->id) }}">Read more</a>
                        @endif
                    </div>
                </div>
            @endforeach

                {{--======================= Pagonation ===============================--}}
                <div class="col-12 d-flex align-items-center justify-content-center  pagination-lg">
                    {{ $notifications->links() }}
                </div>

            </div>
        </div>
    </div>
    <!-- Blog End -->
</x-layouts.main>
