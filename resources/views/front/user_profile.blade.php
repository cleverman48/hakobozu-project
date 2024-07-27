@extends('layouts.front.front_main_layout')
@section('content')
    <style>
        .img-round {
            width: 130px;
            height: 130px;
            border-radius: 65px;
            border: 2px solid #0be22e;
        }

        .company-title {
            font-size: 20px;
            margin-top: 50px;
        }

        th {
            vertical-align: middle !important;
        }

        .w-full {
            width: 100%;
            border: 1px solid #777;
        }

        .w-two {
            width: 20% !important;
        }

        .flex {
            display: flex;
            justify-content: flex-start;
            gap: 10px;
        }

        .border-left {
            border-left: 5px solid #0074c1;
            padding-left: 8px;
            letter-spacing: 2px;
            font-weight: 600;
        }

        .mb-10 {
            margin-bottom: 10px;
        }
    </style>
    <div id="mv_low">
        <div class="breadcrumb">
            <ul>
                <li><a href="/">ホーム</a></li>
            </ul>
        </div>
    </div>
    <article id="search_d">
        <section class="sec01">
            <div class="inner">
                <div class="box">
                    <div class="block2">
                        <form action="{{ route('home.user_profile_db') }}" method="post" enctype="multipart/form-data">
                            @csrf
                            <h4>ユーザー情報</h4>
                            <table cellpadding="0" class="table_work">
                                <tr>
                                    <th>お名前</th>
                                    <td>
                                        <div class="row">
                                            <div class="col-md-3">
                                                @if ($user['image'] == 'default.png')
                                                    <img src="{{ asset('images/users/default.png') }}" alt=""
                                                        class="img-round">
                                                @else
                                                    <img src="{{ asset('images/users') }}/{{ $user['image'] }}"
                                                        alt="" class="img-round">
                                                @endif
                                            </div>
                                            <div class="col-md-8">
                                                <p class="company-title">
                                                    {{ !empty($profile['fullname']) ? $profile['fullname'] : $profile['last_name'] . $profile['first_name'] }}
                                                </p>
                                            </div>
                                        </div>
                                    </td>
                                </tr>
                                <tr>
                                    <th>ふりがな</th>
                                    <td>{{ !empty($profile['fullname_kana']) ? $profile['fullname_kana'] : $profile['last_name_kana'] . $profile['first_name_kana'] }}
                                    </td>
                                </tr>
                                <tr>
                                    <th>携帯電話番号</th>
                                    <td>{{ $profile['phone'] }}</td>
                                </tr>
                                <tr>
                                    <th>生年月日 </th>
                                    <td>{!! $profile['birthday'] !!} </td>
                                </tr>
                                <tr>
                                    <th>性別 </th>
                                    <td>
                                        @if ($profile->sex != 2)
                                            男性
                                        @else
                                            女性
                                        @endif
                                    </td>
                                </tr>
                                <tr>
                                    <th>居住地</th>
                                    <td>{{ $address->ken_name }}
                                        @if (isset($address->city_name))
                                            {{ $address->city_name }}
                                        @endif
                                    </td>
                                </tr>
                                <tr>
                                    <th>持ち込み車両の有無</th>
                                    <td>
                                        @if ($profile->car != 0)
                                            あり
                                        @else
                                            なし
                                        @endif
                                    </td>
                                </tr>
                                <tr>
                                    <th>軽貨物運送業の経験</th>
                                    <td>
                                        @if ($profile->experience != 0)
                                            あり
                                        @else
                                            なし
                                        @endif
                                    </td>
                                </tr>
                                @if ($interviews)
                                    <tr>
                                        <th>面接可能日時</th>
                                        <td>
                                            @foreach ($interviews as $key => $interview)
                                            <div>
                                                <p class="border-left mb-10">候補日時 {{$key == 0 ? '①' : ($key == 1 ?'②':'③')}}</p>
                                                <div class="mb-10">
                                                    <span>{{$interview->date}}: 
                                                        @if ($interview->time1 == 1)
                                                        午前中、
                                                        @endif                                                        
                                                        @if ($interview->time2 == 1)
                                                        12時〜14時、
                                                        @endif
                                                        @if ($interview->time3 == 1)
                                                        14時〜16時、
                                                        @endif
                                                        @if ($interview->time4 == 1)
                                                        16時〜18時、
                                                        @endif
                                                        @if ($interview->time5 == 1)
                                                        18時〜20時、
                                                        @endif
                                                        @if ($interview->time6 == 1)
                                                        終日可
                                                        @endif
                                                    </span>
                                                </div>
                                            </div>
                                            @endforeach
                                        </td>
                                    </tr>
                                @endif
                                @if($bid_content)
                                <tr>
                                    <th>備考</th>
                                    <td>
                                        {{$bid_content}}
                                    </td>
                                </tr>
                                @endif
                                <tr>
                                    <th>メモ</th>
                                    <td>
                                        <textarea name="memo" class="form-control" rows="10">{{ $profile->memo }}</textarea>
                                    </td>
                                </tr>
                            </table>
                            <input type="hidden" name="user_id" value="{{ $profile->user_id }}">
                            <div class="row mt-3">
                                <button type="submit"
                                    class="action-button submitButton userInfoButton">ユーザー情報を保存する</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </section>
    </article>
@endsection
