@extends('master.blog')
@section('name')
    @foreach ($posts as $post)
        <div class="post-preview">
            <a href="post.html">
                <h5>Publicación {{ $post->fecha }}</h5>
                <h3 class="post-title">{{ $post->titulo }}</h3>
                <h4 class="post-subtitle">{{ $post->descripcion }}</h4>
            </a>
            <div class="row">
                @foreach ($imagenes as $imagen)
                    @if ($imagen->IdPost == $post->IdPost)
                        @if ($imagen->link == 1)
                            <div class="col-md-3">
                                <img src="{{ asset('/storage/' . $imagen->imagen) }}" alt="" width="100">
                            </div>
                        @else
                            <div class="col-md-3">
                                {!!$imagen->imagen!!}
                            </div>
                        @endif
                    @endif
                @endforeach
            </div>
        </div>
        <!-- Divider-->
        <hr class="my-4" />
    @endforeach
@endsection
