@extends('admin.layouts.master')

@section('head-tag')
<title>ایجاد نقش ادمین</title>
@endsection

@section('content')

<nav aria-label="breadcrumb">
    <ol class="breadcrumb">
      <li class="breadcrumb-item font-size-12"> <a href="#">خانه</a></li>
      <li class="breadcrumb-item font-size-12"> <a href="#">بخش کاربران</a></li>
      <li class="breadcrumb-item font-size-12"> <a href="#">کاربران ادمین</a></li>
      <li class="breadcrumb-item font-size-12 active" aria-current="page"> ایجاد نقش فروشنده</li>
    </ol>
  </nav>


  <section class="row">
    <section class="col-12">
        <section class="main-body-container">
            <section class="main-body-container-header">
                <h5>
                  ایجاد نقش فروشنده
                </h5>
            </section>

            <section class="d-flex justify-content-between align-items-center mt-4 mb-3 border-bottom pb-2">
                <a href="{{ route('admin.user.sale.index') }}" class="btn btn-info btn-sm">بازگشت</a>
            </section>

            <section>
                <form action="{{ route('admin.user.admin-user.role.store', $user) }}" method="post" enctype="multipart/form-data">
                    @csrf
                    <section class="row">
                        <section class="col-12  my-2">
                            <div class="form-group">
                                <label for="tags"> نقش ها</label>
                                <select  class="form-control form-control-sm" id="select_role" multiple name="roles[]">
                                    @foreach($roles as $role)
                                    <option value="{{ $role->id }}" @foreach($user->roles as $user_role)
                                        @if($user_role->id === $role->id)
                                            selected
                                        @endif
                                    @endforeach>{{ $role->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                            @error('tags')
                            <span class="alert_required bg-danger text-white p-1 rounded" role="alert">
                                    <strong>
                                        {{ $message }}
                                    </strong>
                                </span>
                            @enderror
                        </section>

                        <section class="col-12">
                            <button class="btn btn-primary btn-sm">ثبت</button>
                        </section>
                    </section>
                </form>
            </section>

        </section>
    </section>
</section>

@endsection

@section('script')
    <script>
        var select_roles = $('#select_role');
        select_roles.select2({
            placeholder: 'لطفا نقش ها را انتخاب کنید',
            multiple: true,
            tags: true,
        })
    </script>
@endsection
