@extends('layouts.front.front_main_layout')
@section('content')
    <style>
        th{
            width: 30%;
            vertical-align: middle!important;
            padding-left: 10%;
        }
        th,td{
            padding:20px 10px 20px 20px!important;
        }
        table{
            margin-bottom: 0px!important;
        }
        button{ border:none; }

    </style>
    <section class="user-panel">
        <div class="container">
            <div class="row">
                <div class="col-md-12 col-sm-12 col-xs-12 content">
                    @foreach(['danger','warning', 'success','info'] as $msg)
                        @if(Session::has('alert-'.$msg))
                            <p class="alert alert-{{$msg}}">{{ Session::get('alert-'.$msg) }}
                                <a href="#" class="close" data-dismiss="alert" aria-label="close">
                                    <i class="fa fa-times"></i>
                                </a>
                            </p>
                        @endif
                    @endforeach
                    <form action="{{ route('user.user_profile_update_db') }}" method="post">
                        @csrf
                        <section class="frame mt-3">
                            <section class="content-box">
                                <div class="box-title">
                                    <h4>会員登録情報</h4>
                                </div>
                                <div class="table-content">
                                    <table class="table-bordered">
                                        <tr>
                                            <th>お名前</th>
                                            <td>
                                                <div class="row">
                                                    <div class="col-md-6">
                                                        <div class="form-group">
                                                            <label for="">姓</label>
                                                            <input type="text" class="form-control" name="last_name" value="{{ $profile->last_name }}">
                                                        </div>
                                                    </div>
                                                    <div class="col-md-6">
                                                        <label for="">名</label>
                                                        <div class="form-group">
                                                            <input type="text" class="form-control" name="first_name" value="{{ $profile->first_name }}">
                                                        </div>
                                                    </div>
                                                </div>
                                            </td>
                                        </tr>
                                        <tr>
                                            <th>ふりがな</th>
                                            <td>
                                                <div class="row">
                                                    <div class="col-md-6">
                                                        <div class="form-group">
                                                            <label for="">せい</label>
                                                            <input type="text" class="form-control" name="last_name_kana" value="{{ $profile->last_name_kana }}">
                                                        </div>
                                                    </div>
                                                    <div class="col-md-6">
                                                        <label for="">めい</label>
                                                        <div class="form-group">
                                                            <input type="text" class="form-control" name="first_name_kana" value="{{ $profile->first_name_kana }}">
                                                        </div>
                                                    </div>
                                                </div>
                                            </td>
                                        </tr>
                                        <tr>
                                            <th>携帯電話番号</th>
                                            <td>
                                                <div class="row">
                                                    <div class="col-md-12">
                                                        <div class="form-group">
                                                            <input type="number" class="form-control" name="phone" value="{{ $profile->phone }}">
                                                        </div>
                                                    </div>
                                                </div>
                                            </td>
                                        </tr>
                                        <tr>
                                            <th>生年月日</th>
                                            <td>
                                                <div class="row">
                                                    <div class="col-md-12">
                                                        <div class="form-group">
                                                            <input type="text" class="form-control" name="birthday" value="{{ $profile->birthday }}">
                                                        </div>
                                                    </div>
                                                </div>
                                            </td>
                                        </tr>
                                        <tr>
                                            <th>性別</th>
                                            <td>
                                                <div class="row">
                                                    <div class="col-md-12">
                                                        <div class="col-md-3">
                                                            <label><input type="radio" name="sex" value="1" @if($profile->sex == 1) {{'checked'}} @endif>男性</label>
                                                        </div>
                                                        <div class="col-md-3">
                                                            <label><input type="radio" name="sex" value="0" @if($profile->sex == 0) {{'checked'}} @endif>女性</label>
                                                        </div>
                                                    </div>
                                                </div>
                                            </td>
                                        </tr>
                                        <tr>
                                            <th>居住地</th>
                                            <td>
                                                <div class="row">
                                                    <div class="col-md-12">
                                                        <input type="text" name="zip" id="zip" value="{{ $profile->zip }}" data-id="1" placeholder="郵便番号" pattern="^[0-9]{7}$" required>
                                                        <button type="button" id="zipSerchButton" class="button">郵便番号から入力</button>
                                                        ※ハイフンなし半角数字7桁で入力してください。
                                                        <select class="ken_id" name="ken_id" data-id="1" id="ken">
                                                            <option value="">選択してください</option>
                                                            @foreach($prefecture as $v)
                                                                <option value="{{ $v->ken_id }}">{{ $v->ken_name }}</option>
                                                            @endforeach
                                                        </select>
                                                        <select class="city" name="city_id" data-id="1" id="city">
                                                            <option value="">選択してください</option>
                                                        </select>
                                                    </div>
                                                </div>
                                            </td>
                                        </tr>
                                        <tr>
                                            <th>自動ログイン</th>
                                            <td>
                                                <div class="row">
                                                    <div class="col-md-12">
                                                        <p>あり</p>
                                                    </div>
                                                </div>
                                            </td>
                                        </tr>
                                    </table>
                                </div>
                            </section>
                            <section class="content-box">
                                <div class="table-content" style="padding:30px 0;">
                                    <div class="row">
                                        <button type="submit" class="action-button shadow animate orange col-md-push-4 col-md-4">変更する</button>
                                    </div>
                                </div>
                            </section>
                        </section>
                    </form>
                </div>
            </div>
        </div>
    </section>

    <script>
        $('#ken').change(function () {
            if (this.value) {
                let ken_id = this.value;
                $('#city' + ' option').remove();
                $('#city').append($('<option>').text('選択してください').val(''));
                $.getJSON('/api/getCityList/' + ken_id, function(data) {
                    $.each(data, function (index, data2) {
                        $('#city').append($('<option>').text(data2.city_name).val(data2.city_id));
                    });
                });
            }
        });
        $(document).ready(function(){
            // 居住地初期値表示
            document.getElementById('ken').value = '{{ $profile->ken_id }}';
            $.getJSON('/api/getCityList/' + '{{ $profile->ken_id }}', function (data) {
                $.each(data, function (index, data2) {
                    $('#city').append($('<option>').text(data2.city_name).val(data2.city_id));
                    $('#city').val('{{ $profile->city_id }}');
                });
            });

            $('#zipSerchButton').on('click', function(){
                var zip = $('#zip').val();
                if(zip.length === 7 || zip.length === 8){
                    $.ajax({
                        url: '/api/getKenCityByPost/' +  zip,
                        type: 'GET',
                        dataType: 'json',
                        data:{
                            zip: zip
                        }
                    }).done(function(serchData){
                        if(serchData){
                            $('#ken').val(serchData[0].ken_id);
                            $('#city' + ' option').remove();
                            $('#city').append($('<option>').text('選択してください').val(''));

                            $.getJSON('/api/getCityList/' + serchData[0].ken_id, function(data) {
                                $.each(data, function (index, data2) {
                                    $('#city').append($('<option>').text(data2.city_name).val(data2.city_id));
                                });
                                $('#city').val(serchData[0].city_id);
                            });
                        } else {
                            $("#ken").val('');
                            $("#city").val('');
                            alert("正しい郵便番号を入力してください。");
                        }
                    }).fail(function(XMLHttpRequest, textStatus, errorThrown){
                        alert("通信に失敗しました。");
                    });
                }
            });
        });
    </script>
@endsection

