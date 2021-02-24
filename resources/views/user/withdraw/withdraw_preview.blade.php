@extends('layouts.master')

@section('content')

    <div class="all-transation-area" style="background-color: #ffffff; " id="app">
        <div class="container">

            <div class="row">
                <div class="col-md-12" style="margin-bottom: 70px">
                    <h2 class="text-center">@lang($pt)</h2>
                </div>
            </div>


                <div class="row">

                    <div class="col-md-6 offset-md-3">
                        <div class="card">

                            <div class="card-body" style="padding: 10%">

                        <form action="{{route('confirm.withdraw.store', $with_method->id)}}" method="post">
                            @csrf
                            @php
                                $one = $amount + $with_method->chargefx;
                                $two = ($amount * $with_method->chargepc)/100;
                               $charge = $with_method->chargefx + ( $amount *  $with_method->chargepc )/100
                            @endphp
                            <input type="hidden" name="amount" value="{{$amount}}">

                            <div class="row">
                                <div class="col-xs-6 col-sm-6 col-md-6">
                                    <img style="max-width: 120px" src="{{asset('assets/images/withdraw/'.$with_method->image)}}">
                                </div>
                                <div class="col-xs-6 col-sm-6 col-md-6 text-right">
                                    <p>
                                        <em>@lang('Gateway'):{{$with_method->name}}</em>
                                    </p>
                                    <p>
                                        <em>@lang('Fixed Charge'):{{$with_method->chargefx}} {{__($general->currency)}}</em>
                                    </p>
                                    <p>
                                        <em>@lang('Percentage Charge'):{{$with_method->chargepc}}%</em>
                                    </p>
                                    <p>
                                        <em>@lang('Processing Day') : {{$with_method->processing_day}}</em>
                                    </p>
                                </div>
                            </div>

                            <div class="row">

                                <table class="table table-hover">

                                    <tbody>
                                    <tr>
                                        <td><em>@lang('Request for Withdraw Amount')</em></td>
                                        <td class="text-right"><strong>{{$amount}} {{__($general->currency)}}</strong></td>
                                    </tr>
                                    <tr>
                                        <td><em>@lang('Total Charge')</em></td>
                                        <td class="text-right"><strong>{{$charge}} {{__($general->currency)}}</strong></td>
                                    </tr>
                                    <tr>
                                        <td><em>@lang('Total Withdraw Amount')</em></td>
                                        <td class="text-right"><strong>{{$to = $amount - $charge}} {{__($general->currency)}}</strong></td>
                                    </tr>
                                    <tr>
                                        <td class="text-right"><h4><strong>@lang('In') {{__($with_method->currency)}}: </strong></h4></td>
                                        <td class="text-right text-danger"> <strong>{{round($to / $with_method->rate, 4)}}</strong> {{__($with_method->currency)}}</td>
                                    </tr>
                                    </tbody>

                                </table>
                                @if(Auth::user()->tauth == 1)
                                    <button style="width: 100%;cursor: pointer;" data-toggle="modal" data-target="#openmodal" type="button" class="btn btn-primary"> @lang('Confirm Withdraw')</button>
                                @else
                                    <button style="width: 100%;cursor: pointer;" type="submit" class="btn btn-primary"> @lang('Confirm Withdraw') </button>
                                @endif
                            </div>
                        </form>

                    </div>


                    </div>
                </div>

            </div>




        <div id="openmodal" class="modal fade" role="dialog">
            <div class="modal-dialog">

                <!-- Modal content-->
                <div class="modal-content">
                    <div class="modal-header">
                        <h4 class="modal-title">@lang('Google Authenticator Code Verify')</h4>
                    </div>
                    <form action="#" method="POST">
                        {{csrf_field()}}
                        <div class="modal-body">

                            <div class="form-group">
                                <input type="text" class="form-control" v-model="codeData.code" name="code" placeholder="@lang('Enter Google Authenticator Code')">
                                <small style="color: red; text-align: center" v-if="errors !== '' && codeData.code === '' ">@{{ errors }}</small>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="submit" @click.prevent="submitCode" class="btn btn-success">@lang('Verify')</button>
                            <button type="button" class="btn btn-danger" data-dismiss="modal">@lang('Close')</button>
                        </div>
                    </form>
                </div>

            </div>
        </div>

    </div>

@endsection
@section('script')
    <script>
        var app = new Vue({
            el: '#app',
            data:{
                codeData:{
                    code: ''
                },
                errors: ''
            },
            methods:{
                submitCode(){
                    var input = this.codeData;
                    axios.post('{{route('check_two_facetor')}}',input).then(function (e) {

                        if (e.data.success == true){
                            $("#balanceWithdraw").submit();
                        }else {
                            swal(e.data.message,"", "warning");
                        }

                    }).catch(function (error) {
                        app.errors = error.response.data.errors.code;
                    })
                }
            }


        });
    </script>
@stop
