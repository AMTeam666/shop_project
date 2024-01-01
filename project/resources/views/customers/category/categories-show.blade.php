@extends('customers.layouts.master-two-col')

@section('head-tag')
    <title>دسته بندی {{ $category->name }}</title>
@endsection

@section('content')
      <!-- start body -->
      <section class="">
        <section id="main-body-two-col" class="container-xxl body-container">
            <section class="row">
                <main id="main-body" class="main-body">
                    <section class="sub-category-body">
                        <section class="mb-3 pt-3">
                            <section class="" >
                                <section class="">
                                    <section class="col">
                                        <section class="content-wrapper p-3 top-category-box container-lazyload-box-subcategory">
                                            <!-- start vontent header -->
                                            @if($category->children() == null)
                                            <section class="content-header">
                                                <section class="">
                                                    <h2 class="content-header-title text-center">
                                                        <span class=""> دسته بندی مرتبط</span>
                                                    </h2>
                                                </section>
                                            </section>
                                            @endif
                                            <!-- start vontent header -->
                                            <section class="lazyload-wrapper" >
                                                <section class="lazyload light-owl-nav owl-carousel owl-theme lazyload-category-outer d-flex justify-content-center">
                                                    @forelse ($category->children()->get() as $childe)
                                                    <section class="item">
                                                        <section class="lazyload-item-wrapper">
                                                            <section class="category-lazyload">
                                                                <a class="category-lazyload-link" href="#">
                                                                    <section class="category-lazyload-image">
                                                                        <img class="" src="{{ asset($childe->image['indexArray']['large']) }}" alt="$childe->name">
                                                                    </section>
                                                                </a>
                                                            </section>
                                                        </section>
                                                    </section> 
                                                    @empty
                                                        
                                                    @endforelse
                                           
                                                  
                                                </section>
                                            </section>
                                        </section>
                                    </section>
                                </section>
                            </section>
                        </section>
                    </section>
                    <section class="content-wrapper bg-white p-3 mb-2 container-subcategory-items">
                        <!-- start vontent header -->
                        <section class="content-header">
                            <section class="">
                                <h2 class="content-header-title text-center">
                                    <span class=""> کالاهای دسته</span>
                                </h2>
                            </section>
                        </section>
                        <!-- ------item categories------ -->
                        <section class="content-items-body">
                            <aside class="filter-body">

                                <h3>فیلتر</h3>
                                <form action="{{ route('customers.category.show', $category) }}" method="get" id="myForm">
                                    <input type="hidden" name="sort" value="{{ request()->sort }}">
                                <a class="accordion_filter text-decoration-none text-dark text-dark" type="button">وضعیت</a>
                                    <div class="panel_filter">
                                       
                                            <label><input type="checkbox" id="" name="status" value="1">کالا های موجود</label>
                                            <label><input type="checkbox" id="" name="status" value="2">کالا های تخفیف دار</label>
                                     
                                    </div>
                                <a class="accordion_filter text-decoration-none text-dark" type="button">برند ها</a>
                                    <div class="panel_filter">
                                        <section class="sidebar-brand-wrapper">
                                            @foreach ($brands as $brand)
                                            <section class="form-check sidebar-brand-item">
                                                <input type="checkbox" class="form-check-input" name="brands[]" id="{{ $brand->id }}" value="{{ $brand->id }}" @if(request()->brands && in_array($brand->id, request()->brands))
                                                    checked
                                                @endif>
                                                <label for="{{ $brand->id }}" class="form-check-label d-flex justify-content-between">
                                                    <span>{{ $brand->persian_name }}</span>
                                                    <span>{{ $brand->original_name }}</span>
                                                </label>
                                            </section>
                                            @endforeach
                                        </section>
                                    </div>
                                <a class="accordion_filter text-decoration-none text-dark" type="button">رنج سنی و جنسیت</a>
                                    <div class="panel_filter">
                                            <label><input type="radio" id="" name="age_range" value="1">1 - 5</label>
                                            <label><input type="radio" id="" name="age_range" value="2">6 - 10</label>
                                            <label><input type="radio" id="" name="age_range" value="3">11 - 16</label>
                                            <label><input type="radio" id="" name="age_range" value="4">17 - 20</label>
                                            <label><input type="radio" id="" name="age_range" value="5">دخترانه</label>
                                            <label><input type="radio" id="" name="age_range" value="6">پسرانه</label>
                                    </div>
                                <a class="accordion_filter text-decoration-none text-dark" type="button">محدوده قیمت</a>
                                    <div class="panel_filter panel-filter-price">
                                        <div class="price-input">
                                            <div class="field">
                                              <span>حداکثر</span>
                                              <input type="number" class="input-min filter_price_input" placeholder="قیمت از ..." value="{{ request()->min_price }}" name="min_price">
                                            </div>
                                            <div class="field">
                                              <span>حداقل</span>
                                              <input type="number" class="input-max filter_price_input" placeholder="قیمت تا ..." value="{{ request()->max_price }}" name="max_price">
                                            </div>
                                          </div>
                                    </div>
                                <div>

                                    <button class="apply-filter" type="submit" onclick="document.getElementById('myForm').submit();" >
                                        اعمال فیلتر
                                    </button>
                                </form>
                                </div>
                            </aside>
                            <section>
                                <section class="filters mb-3">
                                    <span class="d-inline-block border p-1 rounded bg-light">نتیجه جستجو برای : <span class="badge bg-info text-dark">"کتاب اثر مرک"</span></span>
                                    <span class="d-inline-block border p-1 rounded bg-light">برند : <span class="badge bg-info text-dark">"کتاب"</span></span>
                                    <span class="d-inline-block border p-1 rounded bg-light">دسته : <span class="badge bg-info text-dark">"کتاب"</span></span>
                                    <span class="d-inline-block border p-1 rounded bg-light">قیمت از : <span class="badge bg-info text-dark">25,000 تومان</span></span>
                                    <span class="d-inline-block border p-1 rounded bg-light">قیمت تا : <span class="badge bg-info text-dark">360,000 تومان</span></span>
        
                                </section>
                                <section class="sort ">
                                    <span>مرتب سازی بر اساس : </span>
                                    <a class="btn {{ request()->sort == 1 ? 'btn-info' : '' }} btn-sm px-1 py-0" href="{{ route('customers.category.show', [$category , 'sort' => 1, 'min_price' => request()->min_price, 'max_price' => request()->max_price, 'brands' => request()->brands]) }}">جدیدترین</a>
                                    <a class="btn {{ request()->sort == 2 ? 'btn-info' : '' }} btn-sm px-1 py-0" href="{{ route('customers.category.show', [$category ,'sort' => 2, 'min_price' => request()->min_price, 'max_price' => request()->max_price, 'brands' => request()->brands]) }}">گران ترین</a>
                                    <a class="btn {{ request()->sort == 3 ? 'btn-info' : '' }} btn-sm px-1 py-0" href="{{ route('customers.category.show', [$category ,'sort' => 3, 'min_price' => request()->min_price, 'max_price' => request()->max_price, 'brands' => request()->brands]) }}">ارزان ترین</a>
                                    <a class="btn {{ request()->sort == 4 ? 'btn-info' : '' }} btn-sm px-1 py-0" href="{{ route('customers.category.show', [$category ,'sort' => 4, 'min_price' => request()->min_price, 'max_price' => request()->max_price, 'brands' => request()->brands]) }}">پربازدیدترین</a>
                                    <a class="btn {{ request()->sort == 5 ? 'btn-info' : '' }} btn-sm px-1 py-0" href="{{ route('customers.category.show', [$category ,'sort' => 5, 'min_price' => request()->min_price, 'max_price' => request()->max_price, 'brands' => request()->brands]) }}">پرفروش ترین</a>
                                </section>
        
        
                                <section class="main-product-wrapper d-flex flex-wrap my-4" >
        
                                    @forelse($products as $product)
                                    <section class="item col-md-3">
                                        <section class="lazyload-item-wrapper">
                                        <section class="product">
                                            @auth
                                            <form action="{{ route('customers.sales-process.add-to-cart', $product) }}" method="POST">
                                            @csrf
                                                <section class="product-add-to-cart"><button class="btn btn-sm" type="submit" data-bs-toggle="tooltip" data-bs-placement="left" title="افزودن به سبد خرید"><i class="fa fa-cart-plus"></i></button></section>
                                            </form>
                                            @endauth
                                            @guest
                                            <section class="product-add-to-favorite">
                                                <button class="btn btn-light btn-sm text-decoration-none" data-url="{{ route('customer.market.add-to-favorite', $product) }}" data-bs-toggle="tooltip" data-bs-placement="left" title="اضافه از علاقه مندی">
                                                    <i class="fa fa-heart"></i>
                                                </button>
                                            </section>
                                            @endguest
                                            @auth
                                                @if ($product->user->contains(auth()->user()->id))
                                                <section class="product-add-to-favorite">
                                                    <button class="btn btn-light btn-sm text-decoration-none" data-url="{{ route('customer.market.add-to-favorite', $product) }}" data-bs-toggle="tooltip" data-bs-placement="left" title="حذف از علاقه مندی">
                                                        <i class="fa fa-heart text-danger"></i>
                                                    </button>
                                                </section>
                                                @else
                                                <section class="product-add-to-favorite">
                                                    <button class="btn btn-light btn-sm text-decoration-none" data-url="{{ route('customer.market.add-to-favorite', $product) }}" data-bs-toggle="tooltip" data-bs-placement="left" title="اضافه به علاقه مندی">
                                                        <i class="fa fa-heart"></i>
                                                    </button>
                                                </section>
                                                @endif
                                            @endauth <a class="product-link" href="{{ route('customer.market.product', $product) }}">
                                                <section class="product-image">
                                                    <img class="" src="{{ asset($product->image['indexArray']['large']) }}" alt="{{ $product->name }}">
                                                </section>
                                                <section class="product-colors"></section>
                                                <section class="product-name"><h3>{{ $product->name }}</h3></section>
                                                <section class="product-price-wrapper">
                                                    <section class="product-price">{{ priceFormat($product->price) }} تومان</section>
                                                </section>
                                            </a>
                                            </section>
                                        </section>
                                    </section>
                                    @empty
                                        
                                    @endforelse
                            
        

        
        
                                    <section class="col-12">
                                        <section class="my-4 d-flex justify-content-center">
                                            <nav>
                                                <ul class="pagination">
                                                    <li class="page-item">
                                                        <a class="page-link" href="#" aria-label="Previous">
                                                            <span aria-hidden="true">&laquo;</span>
                                                        </a>
                                                    </li>
                                                    <li class="page-item active"><a class="page-link" href="#">1</a></li>
                                                    <li class="page-item"><a class="page-link" href="#">2</a></li>
                                                    <li class="page-item"><a class="page-link" href="#">3</a></li>
                                                    <li class="page-item">
                                                        <a class="page-link" href="#" aria-label="Next">
                                                            <span aria-hidden="true">&raquo;</span>
                                                        </a>
                                                    </li>
                                                </ul>
                                            </nav>
                                        </section>
                                    </section>
        
                                </section>
                            </section>
                            
                        </section>


                    </section>
                </main>
            </section>
        </section>
    </section>
    <!-- end body -->

    <section class="position-fixed p-4 flex-row-reverse" style="z-index: -1; right: 0; top: 3rem; width: 26rem; max-width: 80%;">
    
        <div class="toast" role="alert" aria-live="assertive" aria-atomic="true">
            <div class="toast-header">
              <strong class="mr-auto">فروشگاه</strong>
              <button type="button" class="ml-2 mb-1 close" data-dismiss="toast" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
            <div class="toast-body">
                <strong class="ml-auto">
                    خب کونی خان محترم .. الان میزنی علاقه مندی ها من اینو بزارمش تو کص بیبیت ؟؟
                    <br>
                    <a href="{{ route('auth.customers.login-register-form') }}" class="text-dark">
                        بزن رو این تا بدونم کدون کونی هستی
                    </a>
                </strong>             
             </div>
          </div>
          
    </section>

@endsection

@section('script')
<script>
    var acc = document.getElementsByClassName("accordion_filter");
    var i;

    for (i = 0; i < acc.length; i++) {
    acc[i].addEventListener("click", function() {
        this.classList.toggle("active_filter");
        var panel_filter = this.nextElementSibling;
        if (panel_filter.style.maxHeight) {
        panel_filter.style.maxHeight = null;
        } else {
        panel_filter.style.maxHeight = panel_filter.scrollHeight + "px";
        }
    });
    }
</script>

<script>
    $('.product-add-to-favorite button').click(function() {
       var url = $(this).attr('data-url');
       var element = $(this);
       $.ajax({
           url : url,
           success : function(result){
            if(result.status == 1)
            {
                $(element).children().first().addClass('text-danger');
                $(element).attr('data-original-title', 'حذف از علاقه مندی ها');
                $(element).attr('data-bs-original-title', 'حذف از علاقه مندی ها');
            }
            else if(result.status == 2)
            {
                $(element).children().first().removeClass('text-danger')
                $(element).attr('data-original-title', 'افزودن از علاقه مندی ها');
                $(element).attr('data-bs-original-title', 'افزودن از علاقه مندی ها');
            }
            else if(result.status == 3)
            {
                $('.toast').toast('show');
            }
           }
       })
    })
</script>

<script>
    //start product introduction, features and comment
$(document).ready(function() {
    var s = $("#introduction-features-comments");
    var pos = s.position();
    $(window).scroll(function() {
        var windowpos = $(window).scrollTop();

        if (windowpos >= pos.top) {
            s.addClass("stick");
        } else {
            s.removeClass("stick");
        }
    });
});
//end product introduction, features and comment
</script>
@endsection
