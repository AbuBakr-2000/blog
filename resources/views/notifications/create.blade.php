<x-layouts.main>

    <x-slot:title>
        Create Post Page
    </x-slot:title>

    <!-- Page Header Start -->
    <div class="container-fluid bg-primary py-5 mb-5">
        <div class="container py-5">
            <div class="row align-items-center py-4">
                <div class="col-md-6 text-center text-md-left">
                    <h1 class="display-4 mb-4 mb-md-0 text-secondary text-uppercase">Create page</h1>
                </div>
                <div class="col-md-6 text-center text-md-right">
                    <div class="d-inline-flex align-items-center">
                        <a class="btn btn-sm btn-outline-light" href="">Home</a>
                        <i class="fas fa-angle-double-right text-light mx-2"></i>
                        <a class="btn btn-sm btn-outline-light disabled" href="">Create page</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Page Header End -->


    <!-- Contact Start -->
    <div class="container-fluid py-5">
        <div class="container">
            <div class="row ">
                <div class="w-50 py-4">
                    <div class="contact-form">
                        <div id="success"></div>

                        <form class="form-group" action="{{route('posts.store')}}" method="POST" enctype="multipart/form-data">
                            @csrf
                            <div class="control-group mb-4">
                                <input value="{{ old('title') }}" type="text" class="form-control p-4 @error('title') is-invalid @enderror" name="title" placeholder="Title"/>
                                @error('title')
                                     <p class="help-block text-danger">{{ $message }}</p>
                                @enderror
                            </div>
                            <div class="control-group mb-4">

                                <label for="">Categories</label>
                                <select name="category_id">
                                    <option selected disabled>Categories</option>
                                    @foreach($categories as $category)
                                        <option value="{{ $category->id }}">{{ $category->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="control-group mb-4">

                                <label for="">Tags</label>
                                <select name="tags[]" multiple>
                                    @foreach($tags as $tag)
                                        <option value="{{ $tag->id }}">{{ $tag->name }}</option>
                                    @endforeach
                                </select>
                                {{--                                --}}
                                {{--                                @error('category_id')--}}
                                {{--                                     <p class="help-block text-danger">{{ $message }}</p>--}}
                                {{--                                @enderror--}}
                            </div>
                            <div class="control-group mb-4">
                                <input type="file" class="form-control p-4 @error('image') is-invalid @enderror" name="image" placeholder="Image"/>
                                @error('image')
                                    <p class="help-block text-danger">{{ $message }}</p>
                                @enderror
                            </div>
                            <div class="control-group mb-4">
                                <textarea class="@error('short_content') is-invalid @enderror form-control p-4" rows="3" name="short_content" placeholder="Short Content">{{ old('short_content') }}</textarea>
                                @error('short_content')
                                    <p class="help-block text-danger">{{ $message }}</p>
                                @enderror
                            </div>
                            <div class="control-group mb-4">
                                <textarea class="@error('content') is-invalid @enderror form-control p-4" rows="6" name="content" placeholder="Content" >{{ old('content') }}</textarea>
                                @error('content')
                                    <p class="help-block text-danger">{{$message}}</p>
                                @enderror
                            </div>
                            <div>
                                <button class="btn btn-primary btn-block py-3 px-5" type="submit">Create a Post</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Contact End -->


</x-layouts.main>
