@extends('master.master')

@section('sanpham2')
<div class="container">
    <!-- Display Category Name -->
    <div class="my-4">
        <h2 class="text-center">{{ $category->theloaitruyen }}</h2> <!-- Category name centered -->

        <div class="row g-3"> <!-- Gap between product columns -->
            <!-- Loop through each post and display its details -->
            @foreach($posts as $post)
            <div class="col-12 col-sm-6 col-md-4 col-lg-2">
                <div class="card h-100 shadow-sm position-relative custom-card" style="border: none;">
                    <a href="{{ route('detail.show', ['id' => $post->id]) }}" class="text-decoration-none">
                        <div class="image-container position-relative">
                            <img src="{{ asset($post->anhgioithieu) }}" alt="{{ $post->tentruyen }}" class="card-img-top img-fluid custom-image">

                            <!-- Price Tag -->
                            <div class="price-tag position-absolute">
                                <b class="text-white bg-dark p-1">{{ $post->gia }} Đ</b>
                            </div>

                            <!-- Hover Info (Author and Add to Cart form) -->
                            <div class="hover-info position-absolute p-3">
                                <h5 class="text-white mb-2">{{ $post->tentruyen }}</h5>
                                <p class="text-white mb-2"><strong>Tác giả:</strong> {{ $post->tacgia }}</p>
                                <p class="text-white mb-2"><strong>Thể loại:</strong> {{ $post->theloai }}</p>
                                <form method="POST" action="{{ route('cart.add') }}">
                                    @csrf
                                    <input type="hidden" name="post_id" value="{{ $post->id }}">
                                    <input type="hidden" name="quantity" value="1">
                                    <button type="submit" class="btn btn-primary">Mua sách</button>
                                </form>
                            </div>
                        </div>
                    </a>

                    <div class="card-body d-flex flex-column">
                        <a href="{{ route('detail.show', ['id' => $post->id]) }}"
                            class="card-title text-white text-truncate">
                            {{ $post->tentruyen }}
                        </a>
                    </div>
                </div>
            </div>
            @endforeach
        </div>
    </div>
</div>
@endsection