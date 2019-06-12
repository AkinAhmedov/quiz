@extends('layouts.app')
@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header right">TO DO LIST <a href="add" class="btn btn-primary" style="float: right">Yeni Ekle +</a></div>
                    <div class="card-body">
                        <div class="x_panel">
                            <div class="x_title">
                                <div class="clearfix"></div>
                            </div>
                            <div class="x_content">
                                <table id="datatable-buttons" class="table table-striped table-bordered">
                                    <thead>
                                    <tr>
                                        <th>Başlik</th>
                                        <th>Açıklama</th>
                                        <th>Durum</th>
                                        <th>Oluşturulma Tarihi</th>
                                        <th>Son Tarih</th>
                                        <th style="width: 30%">İşlem</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    @foreach($list as $item)
                                            <tr id="sil-{{$item->id}}"
                                                @if(date('d.m.Y', strtotime(date($item->deadline))) < date('d.m.Y', strtotime(date(\Illuminate\Support\Carbon::now()))))
                                                    style="background: darkred; color: #fff;"
                                                @endif >
                                                <td>{{$item->title}}</td>
                                                <td>{{$item->description}}</td>
                                                <td>@if($item->status==1) Tamamlandı @else Tamamlanmadı @endif</td>
                                                <td>{{date('d.m.Y', strtotime(date($item->created_at)))}} </td>
                                                <td>{{date('d.m.Y', strtotime(date($item->deadline)))}} </td>
                                                <td>
                                                    <form id="form-{{$item->id}}" action="" method="post">
                                                        {{csrf_field()}}
                                                        <a class="btn btn-primary" href="add/{{$item->id}}" value="update"> Güncelle </a>
                                                        <input type="submit" name="action" value="Sil" class="btn btn-danger" />
                                                        <input type="submit" name="action" value="@if($item->status==1) Tamamlanmadı @else Tamamlandı @endif" class="btn @if($item->status==1) btn-secondary @else btn-success @endif" />
                                                        <!--<a class="btn btn-danger" href="delete/{{$item->id}}" onclick="sil({{$item->id}})" name="islem" value="Sil">Sil</a>-->
                                                        <!--<a class="btn @if($item->status==1) btn-secondary @else btn-success @endif" href="statusChange/{{$item->id}}/{{$item->status}}" value="statusChange"> @if($item->status==1) Tamamlanmadı @else Tamamlandı @endif </a>-->
                                                        <input type="hidden" name="id" value="{{$item->id}}">
                                                    </form>
                                                </td>
                                            </tr>
                                    @endforeach
                                    </tbody>
                                </table>
                            </div>
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
                        title: response.durum,
                        text: 'hata'
                    });
                }
            })
        });
    </script>
@endsection
