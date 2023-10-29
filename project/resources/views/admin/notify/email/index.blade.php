@extends('admin.layouts.master')

@section('head-tag')
<title>اطلاعیه ایمیلی</title>
@endsection

@section('content')

<nav aria-label="breadcrumb">
    <ol class="breadcrumb">
      <li class="breadcrumb-item font-size-12"> <a href="#">خانه</a></li>
      <li class="breadcrumb-item font-size-12"> <a href="#">اطلاع رسانی</a></li>
      <li class="breadcrumb-item font-size-12 active" aria-current="page"> اطلاعیه ایمیلی</li>
    </ol>
  </nav>


  <section class="row">
    <section class="col-12">
        <section class="main-body-container">
            <section class="main-body-container-header">
                <h5>
                   اطلاعیه ایمیلی
                </h5>
            </section>

            <section class="d-flex justify-content-between align-items-center mt-4 mb-3 border-bottom pb-2">
                <a href="{{ route('admin.notify.email.create') }}" class="btn btn-info btn-sm">ایجاد اطلاعیه ایمیلی</a>
                <div class="max-width-16-rem">
                    <input type="text" class="form-control form-control-sm form-text" placeholder="جستجو">
                </div>
            </section>

            <section class="table-responsive">
                <table class="table table-striped table-hover">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>عنوان اطلاعیه</th>
                            <th>تاریخ ارسال	</th>
                            <th> وضعیت</th>
                            <th class="max-width-16-rem text-center"><i class="fa fa-cogs"></i> تنظیمات</th>
                        </tr>
                    </thead>
                    <tbody>
                    @foreach($mails as $key => $mail)
                        <tr>
                            <th>{{ $key += 1 }}</th>
                            <td>{{ $mail->subject }}</td>
                            <td>{{ jalaliDate($mail->published_at, 'H:i:s Y-m-d') }}</td>
                            <td>
                                <label>
                                    <input id="{{ $mail->id }}" onchange="changeStatus({{ $mail->id }})" data-url="{{ route('admin.notify.email.status', $mail->id) }}" type="checkbox" @if ($mail->status === 1)
                                        checked
                                        @endif>
                                </label>
                            </td>
                            <td class="width-16-rem text-left">
                                <a href="{{ route('admin.notify.email-file.index',$mail->id) }}" class="btn btn-warning btn-sm"><i class="fa fa-file"></i> فایل های ضمیمه شده</a>
                                <a href="{{ route('admin.notify.email.edit',$mail->id) }}" class="btn btn-info btn-sm"><i class="fa fa-edit"></i> ویرایش</a>
                                <form class="d-inline" action="{{ route('admin.notify.email.destroy', $mail->id) }}" method="post">
                                    @csrf
                                    {{ method_field('delete') }}
                                    <button class="btn btn-danger btn-sm delete" type="submit"><i class="fa fa-trash-alt"></i> حذف</button>
                                </form>
                            </td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
            </section>

        </section>
    </section>
</section>

@endsection
@section('script')

    <script type="text/javascript">
        function changeStatus(id){
            var element = $("#" + id)
            var url = element.attr('data-url')
            var elementValue = !element.prop('checked');

            $.ajax({
                url : url,
                type : "GET",
                success : function(response){
                    if(response.status){
                        if(response.checked){
                            element.prop('checked', true);
                            successToast('ایمیل با موفقیت فعال شد')
                        }
                        else{
                            element.prop('checked', false);
                            successToast('ایمیل با موفقیت غیر فعال شد')

                        }
                    }
                    else{
                        element.prop('checked', elementValue);
                        errorToast('هنگام ویرایش مشکلی رخ داده است')

                    }
                },
                error : function (){
                    element.prop('checked', elementValue);
                    errorToast('ارتباط برقرار نشد')

                }
            })

            function successToast(message){

                var successToastTag = '    <section class="toast" data-delay="3000">\n' +
                    '<section class="toast-body py-3 d-flex bg-success text-white">\n' +
                    '<strong class="ml-auto">' + message +'</strong>\n' +
                    '<button type="button" class="mr-2  close" data-dismiss="toast" aria-label="Close">\n' +
                    '<span aria-hidden="true">&times;</span>\n' +
                    '</button>\n' +
                    '</section>\n' +
                    '</section>';

                $('.toast-wrapper').append(successToastTag)
                $('.toast').toast('show').delay(3000).queue(function (){
                    $(this).remove()
                })
            }
            function errorToast(message){

                var errorToastTag = '    <section class="toast" data-delay="5000">\n' +
                    '<section class="toast-body py-3 d-flex bg-danger text-white">\n' +
                    '<strong class="ml-auto">' + message +'</strong>\n' +
                    '<button type="button" class="mr-2  close" data-dismiss="toast" aria-label="Close">\n' +
                    '<span aria-hidden="true">&times;</span>\n' +
                    '</button>\n' +
                    '</section>\n' +
                    '</section>';

                $('.toast-wrapper').append(errorToastTag)
                $('.toast').toast('show').delay(3000).queue(function (){
                    $(this).remove()
                })
            }
        }
    </script>

    <script type="text/javascript">
        function commentable(id){
            var element = $("#" + id + '-commentable')
            var url = element.attr('data-url')
            var elementValue = !element.prop('checked');

            $.ajax({
                url : url,
                type : "GET",
                success : function(response){
                    if(response.commentable){
                        if(response.checked){
                            element.prop('checked', true);
                            successToast('امکان درج کامنت  با موفقیت فعال شد')
                        }
                        else{
                            element.prop('checked', false);
                            successToast('امکان درج کامنت  با موفقیت غیر فعال شد')
                        }
                    }
                    else{
                        element.prop('checked', elementValue);
                        errorToast('هنگام ویرایش مشکلی بوجود امده است')
                    }
                },
                error : function(){
                    element.prop('checked', elementValue);
                    errorToast('ارتباط برقرار نشد')
                }
            });

            function successToast(message){

                var successToastTag = '<section class="toast" data-delay="5000">\n' +
                    '<section class="toast-body py-3 d-flex bg-success text-white">\n' +
                    '<strong class="ml-auto">' + message + '</strong>\n' +
                    '<button type="button" class="mr-2 close" data-dismiss="toast" aria-label="Close">\n' +
                    '<span aria-hidden="true">&times;</span>\n' +
                    '</button>\n' +
                    '</section>\n' +
                    '</section>';

                $('.toast-wrapper').append(successToastTag);
                $('.toast').toast('show').delay(5500).queue(function() {
                    $(this).remove();
                })
            }

            function errorToast(message){

                var errorToastTag = '<section class="toast" data-delay="5000">\n' +
                    '<section class="toast-body py-3 d-flex bg-danger text-white">\n' +
                    '<strong class="ml-auto">' + message + '</strong>\n' +
                    '<button type="button" class="mr-2 close" data-dismiss="toast" aria-label="Close">\n' +
                    '<span aria-hidden="true">&times;</span>\n' +
                    '</button>\n' +
                    '</section>\n' +
                    '</section>';

                $('.toast-wrapper').append(errorToastTag);
                $('.toast').toast('show').delay(5500).queue(function() {
                    $(this).remove();
                })
            }
        }
    </script>

    @include('admin.alerts.sweetalert.delete-confirm', ['className' => 'delete'])

@endsection

