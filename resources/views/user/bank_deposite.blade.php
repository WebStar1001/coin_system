@extends('layouts.master')

@section('content')

    <div class="all-transation-area" style="background-color: #ffffff; margin-bottom: 120px; " >
        <div class="container">
            <div class="row">
                <div class="col-md-6 offset-md-3">
                    <form class="contact-form" action="{{ route('submit.bank.deposit') }}" method="post" enctype="multipart/form-data">
                        @csrf
                        <input type="hidden" name="data_id" value="{{$data->id}}">

                        <div class="row">

                            <div class="col-xl-12 col-lg-12">
                                <div class="card">
                                    <div class="card-header text-center">
                                        <h3>@lang('Please Send Exactly') {{$data->amount + $data->charge}} {{$data->type == 1? 'USD': $general->currency}} </h3>
                                    </div>
                                    <div class="card-body text-center" style="color: #fff">
                                        <ul class="list-group">
                                            <li class="list-group-item">@lang('Your Requested Amount'): {{__($data->amount)}} {{$data->type == 1? 'USD': $general->currency}}</li>
                                            <li class="list-group-item">@lang('Account Name'): {{__($method->name)}}</li>
                                            <li class="list-group-item">@lang('Account Detail'): {{__($method->val1)}}</li>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                            <hr>
                            <br>

                            <div class="col-xl-12 col-lg-12">
                                <div class="form-group">
                                    <label for="InputFirstname">@lang('Upload Image/Photo (Purchase Verify)')<span class="requred">*</span></label>
                                    <input type="file" class="form-control"  name="image" required>
                                </div>
                            </div>

                            <div class="col-xl-12 col-lg-12">
                                <div class="form-group">
                                    <label for="InputFirstname">@lang('Payment Detail (Purchase Verify)')<span class="requred">*</span></label>
                                    <textarea class="form-control" placeholder="@lang('Enter Your Payment Details...')" name="detail" rows="5"></textarea>
                                </div>
                            </div>


                            <div class="col-xl-12 col-lg-12">
                                <div class="row d-flex">
                                    <div class="col-xl-12 col-lg-12">
                                        <button id="btn-confirm" type="submit" style="width: 100%" class="login-button btn-contact"> @lang('Submit')</button>
                                    </div>

                                </div>
                            </div>
                        </div>


                    </form>
                </div>
            </div>
        </div>



    </div>

@endsection
@section('script')

@endsection
