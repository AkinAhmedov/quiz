@extends('layouts.app')
@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header right">TO DO LIST <a href="add" class="btn btn-primary" style="float: right">Yeni Ekle +</a></div>
                    <div class="card-body">
                        <div class="x_content">
                            <form id="form" data-parsley-validate class="form-horizontal form-label-left" action="" method="post">
                                {{csrf_field()}}
                                <div class="form-group">
                                    <label class="control-label col-md-12">Başlık *</label>
                                    <div class="col-md-12">
                                        <input type="text" class="form-control col-md-12" value="@if(!empty($updateVals)) {{$updateVals->title}} @endif" name="title" required>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="control-label col-md-12">Açıklama *</label>
                                    <div class="col-md-12">
                                        <input type="text" class="form-control col-md-12" value="@if(!empty($updateVals)) {{$updateVals->description}} @endif" name="description" required>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="control-label col-md-12">Son Tarih *</label>
                                    <div class="col-md-12">
                                        <input type="date" class="form-control col-md-12" value="@if(!empty($updateVals)){{trim($updateVals->deadline)}}@endif" name="deadline" required>
                                    </div>
                                </div>
                                <div class="ln_solid"></div>
                                <div class="form-group">
                                    <div class="col-md-12 col-md-offset-3">
                                        <button type="submit" class="btn btn-success">Kaydet</button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
             </div>
        </div>
    </div>
@endsection
@section('js')
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.15.0/jquery.validate.min.js"></script>
    <script src="/js/jquery.form.min.js"></script>
    <script src="/js/sweetalert.min.js"></script>
    <script>
        $(document).ready(function() {
            $('form').validate();
            $('form').ajaxForm({
                success: function(response) {
                    var button = 'success';
                    if (response.hata != '') {
                        button = 'warning';
                    }
                    swal({
                        title: response.baslik,
                        text: response.icerik,
                        icon: button,
                        button: 'OK',
                        timer: 3000,
                    }).then(function() {
                        window.location = '/';
                    });
                },
                error: function(response) {
                    swal({
                        title: response.baslik,
                        text: response.icerik,
                        icon: button,
                        button: 'OK',
                    });
                }
            })
        });
    </script>
@endsection
