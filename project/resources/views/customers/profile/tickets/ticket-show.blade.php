@extends('customers.layouts.master-one-col')

@section('head-tags')
<title>تیکت ها</title>
@endsection

@section('content')


<section class="row">
    <section class="col-12">
        <section class="main-body-container">
            <section class="main-body-container-header">
                <h5>
                نمایش تیکت ها
                </h5>
            </section>

            <section class="d-flex justify-content-between align-items-center mt-4 mb-3 border-bottom pb-2">
                <a href="{{ route('customer.profile.my-tickets') }}" class="btn btn-info btn-sm">بازگشت</a>
            </section>

            <section class="order-wrapper">

                <section class="card mb-3">
                    <section class="card-header  bg-info">
                        {{ $ticket->user->first_name . ' ' . $ticket->user->last_name }}

                    </section>
                    <section class="card-body">
                        <h5 class="card-title">موضوع : {{ $ticket->subject }}
                        </h5>
                        <p class="card-text">
                            {{ $ticket->description }}
                        </p>
                    </section>
                </section>



                <hr>

                <div class="border my-2">
                  @forelse ($ticket->children()->get() as $child )
                <section class="card m-4">
                        <section class="card-header bg-light d-flex justify-content-between">
                           <div> {{ $child->user->first_name . ' ' . $child->user->last_name }}</div>
                            <small>{{ jdate($child->created_at) }}</small>
                        </section>
                        <section class="card-body">
                            <p class="card-text">
                                {{ $child->description }}
                            </p>
                        </section>
                    </section>
                  @empty
                  <section class="card m-4">
                    <div>
                        پاسخی ثبت نشده است
                    </div>
                </section>
                  @endforelse
                </div>



                <section class="my-3">
                    <form action="{{ route('customer.profile.my-tickets.answer', $ticket->id) }}" method="post">
                        @csrf
                        <section class="row">
                            <section class="col-12">
                                <div class="form-group">
                                    <label for="" class="my-2">پاسخ تیکت </label>
                                    ‍<textarea class="form-control form-control-sm" rows="4"
                                        name="description">{{ old('description') }}</textarea>
                                </div>
                                @error('description')
                                <span class="alert_required bg-danger text-white p-1 rounded" role="alert">
                                    <strong>
                                        {{ $message }}
                                    </strong>
                                </span>
                                @enderror
                            </section>
                            <section class="col-12 my-3">
                                <button class="btn btn-primary btn-sm">ثبت</button>
                            </section>
                        </section>
                    </form>
                </section>

            </section>

        </section>
    </section>
</section>

@endsection

@section('script')

@endsection
