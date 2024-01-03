@extends('customers.layouts.master-two-col')

@section('head-tag')
    <title>مقالات</title>
@endsection

@section('content')
     <!-- start body -->
     <main>
        <section class="grid-container">
            @foreach ($posts as $post )
            <div class="div-posts position-relative">
                <a href="#">
                    <img class="img-posts" src="{{ asset($post->image['indexArray']['large']) }}" alt="{{ $post->name }}">
                </a>  
                <div class="overlay-posts">
                    <a href="#" class="overlay-posts-a"><span class="overlay-posts-span"></span>مشاهده</a>
                </div>
                <div class="posts-description">
                    <a href="#" class="text-decoration-none text-dark">
                        <h3 class="text-center">{{ $post->title }}</h3>
                        <p class="">{{ $post->summary }}</p>

                    </a>
                    
                </div>
                <div class="posts-detail d-flex justify-content-between">
                    <div>
                        <i class="fa fa-eye">{{ $post->view }}</i>
                        <i class="fa fa-comment">{{ $post->activeComments()->count() }}</i>
                    </div>
                    <div>
                        <a href=""><i class="fa fa-user">{{ $post->user->first_name. ' '. $post->user->last_name  }}</i></a>
                    </div> 
                </div>
            </div>
            @endforeach
          
        </section>
    </main>
    <!-- end body -->
@endsection