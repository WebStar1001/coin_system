@extends('layouts.master')
@section('style')

@stop
@section('content')
    @include('layouts.balance_show')
    <!-- contact us area start -->
    <section class="contact-area pranto-trans-aria" id="app">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    @if(count($plan) == 0)
                        <h2 class="text-center">@lang('Purchase STO first.') </h2>
                        @else
                    <form class="contact-form" method="POST" action="{{route('user.balance.transfer.post')}}">
                        @csrf
                        <div class="row">

                            <div class="col-xl-4 col-lg-12">
                                <div class="form-group">
                                    <label for="InputFirstname">@lang('Select STO Plan')<span class="requred">*</span></label>
                                    <select class="pranto-select" name="wallet_id" @change="wallet(newdata.wallet_type)" v-model="newdata.wallet_type" required>
                                        @foreach($plan as $data)
                                            <option value="{{$data->id}}">{{__($data->plan->name)}} ({{$data->amount}})</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>

                            <div class="col-xl-4 col-lg-12">
                                <div class="form-group">
                                    <label for="InputMail">@lang('Username / Email To Send Amount') <span class="requred">*</span></label>
                                    <input type="text" id="InputMailUser" @keyup="submitSearch" v-model="newdata.username" name="username" placeholder="@lang('Username/Email')" required autocomplete="off">
                                </div>
                            </div>

                            <div class="col-xl-4 col-lg-12">
                                <div class="form-group">
                                    <label for="InputMail">@lang('Transfer from') <span v-if="wallet_name"> @lang('@{{wallet_name}}') </span> <span class="requred">*</span></label>
                                    <input type="text" class="form-control" autocomplete="off" id="InputMail" v-model="newdata.amount" name="amount" placeholder="@lang('Amount/Qty')" required>
                                    <small v-if="parseInt(balance) < parseInt(newdata.amount)" style="color: red">@lang('Insufficient Balance!')</small>
                                </div>
                            </div>

                            <div class="col-xl-12 col-lg-12" id="bal" v-if="parseInt(balance) >= parseInt(newdata.amount) && hasmsg.success === true">
                                <div class="row d-flex">
                                    <div class="col-md-6 offset-md-3">
                                        @if(Auth::user()->tauth == 1)
                                            <button type="button" style="width: 100%;" data-toggle="modal" data-target="#openmodal" class="login-button btn-contact"> @lang('Transfer STO')</button>
                                        @else
                                            <button type="submit" style="width: 100%;" class="login-button btn-contact"> @lang('Transfer STO')</button>
                                        @endif

                                    </div>

                                </div>
                            </div>


                        </div>
                    </form>
                    @endif
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
    </section>
    <!-- contact us area end -->

@endsection
@section('script')
    <script>
        var app = new Vue({
            el: '#app',
            data:{
                showData: {},
                newdata:{
                    amount: '',
                    wallet_type : '',
                    username : '',
                },
                codeData:{
                    code: ''
                },
                balance : {},
                hasmsg : '',
                wallet_name : null,
                errors: ''
            },

            methods:{

                wallet(val){
                    axios.post('{{route('find.sto')}}', {id:val}).then(function (e) {
                        console.log(e.data);
                        if (e.data.success === true){
                            app.balance = e.data.balance;
                            app.wallet_name = e.data.wallet_name;
                        }else {
                            app.hasmsg = e.data.message;
                        }
                    });

                },
                submitSearch(){
                    var input = this.newdata;
                    axios.post('{{route('search.user')}}', input).then(function (e) {
                        app.hasmsg = e.data;
                        if (e.data.success == true){
                            $('#InputMailUser').css('box-shadow', '1px 1px 0px #039f08, 0 0 4px #039f08, 0 0 4px #039f08');
                            $('#bal').css('display', 'block');
                        }else {
                            $('#InputMailUser').css('box-shadow', '1px 1px 0px #de0015, 0 0 4px #de0015, 0 0 4px #de0015');
                            $('#bal').css('display', 'none');
                        }
                    });
                },

                submitCode(){
                    var input = this.codeData;
                    axios.post('{{route('check_two_facetor')}}',input).then(function (e) {

                        if (e.data.success == true){
                            $("#balanceTransfer").submit();
                        }else {

                                iziToast.error({
                                    title: '{{__('Opps!')}}',
                                    message: e.data.message,
                                });

                        }

                    }).catch(function (error) {
                        app.errors = error.response.data.errors.code;
                    })
                }
            }


        });
    </script>
@stop
