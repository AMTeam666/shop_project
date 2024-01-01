@extends('customers.layouts.master-one-col')

@section('head-tags')
<title>افزودن تیکت</title>
@endsection

@section('content')


<main id="main-body" class="main-body mt-0 p-4">
    <section class="content-wrapper bg-white p-3 mb-2">
        <section>
                <h5>
                    افزودن تیکت
                </h5>
            </section>

            <section class="d-flex justify-content-between align-items-center mt-4 mb-3 border-bottom pb-2">
                <a href="{{ route('customer.profile.my-tickets') }}" class="btn btn-info btn-sm">بازگشت</a>
            </section>

            <section class="my-3">
                <form action="{{ route('customer.profile.my-tickets.store') }}" method="post" enctype="multipart/form-data">
                    @csrf
                    <section class="row">
                        <section class="col-12 col-md-4">
                            <div class="form-group">
                                <label for="" class="">عنوان</label>
                                ‍<input class="form-control form-control-sm" rows="4" name="subject"
                                    value="{{ old('subject') }}" />
                            </div>
                            @error('subject')
                            <span class="alert_required bg-danger text-white p-1 rounded" role="alert">
                                <strong>
                                    {{ $message }}
                                </strong>
                            </span>
                            @enderror
                        </section>
                
                        <section class="col-12">
                            <div class="form-group">
                                <label for="" class="my-2">متن</label>
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

                        <section class="col-12 my-2">
                            <div class="form-group">
                                <label for="file">فایل</label>
                                <input type="file" class="form-control form-control-sm" name="file"
                                    id="file">
                            </div>
                            @error('file')
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
</main>


@endsection

@section('script')

@endsection
