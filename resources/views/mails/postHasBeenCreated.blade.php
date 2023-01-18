<div>
    <h1>Dear {{ $post->user->name }}</h1>
    <h5>Siz {{ $post->created_at }} da yangi post yaratdingiz.</h5>
    <p>Pos id : {{ $post->id }}</p>
    <div>{{ $post->title }}</div>
    <div>{{ $post->short_content }}</div>
    <div>{{ $post->content }}</div>
    <strong>Thanks</strong>
</div>
