@extends('layout.app')

@section('meta')
@endsection

@section('title')
New Permission
@endsection

@section('styles')
@endsection

@section('content')
<div class="container-xxl flex-grow-1 container-p-y">
    <div class="row sm-12">
        <div class="col-md">
            <div class="card">
                <h5 class="card-header">New Permission</h5>
                <div class="card-body">
                    <form action="{{ route('permission.insert') }}" name="form" id="form" method="post" class="needs-validation ajax-form" novalidate="">
                        @csrf
                        @method('post')

                        <div class="form-floating form-floating-outline mb-6">
                            <input name="name" type="text" value="{{ @old('name') }}" id="name" class="form-control" placeholder="create-user / edit-user" >
                            <label for="bs-validation-name">Name</label>
                            <div class="invalid-feedback invalid-feedback-name"></div>
                        </div>
                        <div class="form-floating form-floating-outline mb-6">
                            <input name="guard_name" type="text" value="{{ @old('guard_name') }}" id="guard_name" class="form-control" placeholder="web / api" >
                            <label for="bs-validation-guard_name">Guard Name</label>
                            <div class="invalid-feedback invalid-feedback-guard_name"></div>
                        </div>
                        <div class="row">
                            <div class="col-12">
                                <button type="submit" class="btn btn-primary waves-effect waves-light">Submit</button>
                                <a href="{{ route('permission') }}" class="btn btn-primary waves-effect waves-light">Cancel</a>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@section('scripts')
<script>
    $(document).ready(function () {
        var form = $('.ajax-form');
        form.submit(function (e) {
            $('.ajax-form').removeClass('was-validated');
            $('.invalid-feedback').css({"display": "none"});
            $('.invalid-feedback').html('');
            $.ajax({
                url: form.attr('action'),
                type: form.attr('method'),
                data: new FormData($(this)[0]),
                dataType: 'json',
                async: false,
                processData: false,
                contentType: false,
                success: function (response) {
                    return true;
                },
                error: function (response) {
                    e.preventDefault();
                    if (response.status === 422) {
                        var errors = response.responseJSON;
                        $.each(errors.errors, function (key, value) {
                            $('.ajax-form').addClass('was-validated');
                            $('.invalid-feedback-'+key).css({"display": "block"});
                            $('.invalid-feedback-'+key).html(value[0]);
                        });
                    }
                }
            });
        });
    });
</script>
@endsection