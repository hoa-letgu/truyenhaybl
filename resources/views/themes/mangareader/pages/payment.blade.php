@extends('themes.mangareader.layouts.full')
@section('title', L::_("Add Coin"))

@section('content')
<div id="main-wrapper">
    <div class="container">
        <div id="mw-2col">
            <!--Begin: main-content-->
            <div id="main-content">
                <section class="block_area ">
                    <div class="block_area-header block_area-header-tabs">
                        <div class="float-left bah-heading">
                            <h2 class="cat-heading">{{ L::_("Nạp Token") }}</h2>
                        </div>
                        <div class="clearfix"></div>
                    </div>

                    <div class="block_area-content">
                        <div class="description mb-4">
                            <p>10k VND = {{ (10000 * $_ENV['tranfer_rate']) }} Token</p>
                            <p>- Vui lòng chọn nhà mạng và mệnh giá cần nạp.</p>
                            <p>- Sai mệnh giá bị trừ 50% giá trị thẻ</p>

                            <p>- Sau khi nạp thành công, vui lòng chờ 1-2 phút để hệ thống cập nhật số dư.</p>
                        </div>
                        <form class="preform preform pr-settings" method="post" id="napthe-form">
                            @php
                            $networks = [
                                'VTT' => 'VIETTEL',
                                'VMS' => 'MOBIFONE',
                                'VNP' => 'VINAPHONE',
                                'VNM' => 'VIETNAMMOBILE',
                            ];

                            @endphp
                            <select class="form-control" id="nha_mang" name="telco" onchange="showMenhGia(this)">
                                @foreach($price as $key => $value)
                                <option value="{{ $key }}">{{ $networks[$key] ?? $key }}</option>

                                @endforeach
                            </select>

                            @foreach($price as $key => $value)
                            <select class="form-control menh-gia mt-3" id="{{ $key }}" style="display: none;">
                                @foreach($value as $k => $v)
                                <option value="{{ $v['value'] }}">{{ number_format($v['value'], 0, '.', ',') }} VND
                                </option>
                                @endforeach
                            </select>
                            @endforeach

                            <input class="form-control mt-3" type="type" name="serial" placeholder="Serial" required>
                            <input class="form-control mt-3" type="type" name="code" placeholder="Mã thẻ" required>


                            <div class="form-group mb-0">
                                <div class="mt-3">&nbsp;</div>
                                <button class="btn btn-block btn-primary">Nạp Ngay</button>
                                <div class="loading-relative" id="import-loading" style="display:none">
                                    <div class="loading">
                                        <div class="span1"></div>
                                        <div class="span2"></div>
                                        <div class="span3"></div>
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
                </section>

                <section class="block_area ">

                    <div class="block_area-header block_area-header-tabs">
                        <div class="float-left bah-heading">
                            <h2 class="cat-heading">{{ L::_("Lịch Sử Nạp") }}</h2>
                        </div>
                        <div class="clearfix"></div>
                    </div>

                    <div class="block_area-content">
                        @php
                        $history = \Models\Model::getDB()->where('user_id', userget()->id)->orderBy('id',
                        'desc')->objectBuilder()->get('user_payment');
                        @endphp
                        <table class="table table-striped">
                            <thead>
                                <tr>
                                    <th scope="col">Nhà Mạng</th>
                                    <th scope="col">Mệnh giá</th>
                                    <th scope="col">Tình trạng</th>
                                    <th scope="col">Ngày nạp</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($history as $item)
                                @php
                                $card = json_decode($item->card_data);
                                @endphp
                                <tr>
                                    <td>{{ $card->telco }}</td>
                                    <td>{{ number_format($card->amount, 0, '.', ',') }} VND</td>
                                    <td>{{ $item->status }}</td>
                                    <td>{{ $item->payment_date }}</td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>

                    </div>


                </section>
            </div>

            <!--/End: main-content-->

            <!--Begin: main-sidebar-->
            @include('themes.mangareader.components.user.main-sidebar')
            <!--/End: main-sidebar-->
            <div class="clearfix"></div>
        </div>
    </div>
</div>
@stop

@section('modal')

@stop

@section('js-body')
<script type="text/javascript">
    var current = document.querySelector('#nha_mang').value;
    document.querySelector('#' + current).style.display = 'block';

    var tableMode = [...document.querySelectorAll(".table")];
    activeUiMode();

    const showMenhGia = function(vm) {
        var allMenhGia = document.getElementsByClassName('menh-gia');
        for (var i = 0; i < allMenhGia.length; i++) {
            allMenhGia[i].style.display = 'none';
        }

        var menhGia = document.getElementById(vm.value);
        menhGia.style.display = 'block';
    }

    $("#napthe-form").on("submit", function(e) {
        e.preventDefault();

        var form = $(this);
        var data = form.serializeArray();

        var amount = $("#napthe-form .menh-gia:visible").val();

        data.push({
            name: 'amount'
            , value: amount
        });


        var loading = $("#import-loading");
        loading.show();

        $.post('/user/payment/charging', data, function(res) {
            alert(res.message);
            loading.hide();
        });
    });

</script>
@stop