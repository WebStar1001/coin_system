@extends('layouts.master')

@section('content')
    <div class="all-transation-area" style="background-color: #ffffff;">
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

                            <form action="{{route('deposit.confirm')}}" method="post">
                                @csrf

                                <input type="hidden" name="gateway" value="{{$data->gateway_id}}"/>

                                <div class="row">
                                    <div class="col-xs-6 col-sm-6 col-md-6">
                                        <img style="max-width: 120px" src="{{asset('assets/images/gateway')}}/{{$data->gateway_id}}.jpg">
                                    </div>
                                    @php $deposit_data = \App\Gateway::find($data->gateway_id) @endphp
                                    <div class="col-xs-6 col-sm-6 col-md-6 text-right">
                                        <p>
                                            <em>@lang('Gateway'):{{$deposit_data->name}}</em>
                                        </p>
                                        <p>
                                            <em>@lang('Fixed Charge'):{{$deposit_data->fixed_charge}} {{__($general->currency)}}</em>
                                        </p>
                                        <p>
                                            <em>@lang('Percentage Charge'):{{$deposit_data->percent_charge}}%</em>
                                        </p>
                                    </div>
                                </div>

                                <div class="row">

                                    <table class="table table-hover">

                                        <tbody>
                                        <tr>
                                            <td><em>@lang('STO Amount')</em></td>
                                            <td class="text-right"><strong>{{__($data->amount)}}</strong></td>
                                        </tr>
                                        <tr>
                                            <td><em>@lang('Amount')</em></td>
                                            <td class="text-right"><strong>{{__($data->price)}} {{__($general->currency)}}</strong></td>
                                        </tr>
                                        <tr>
                                            <td><em>@lang('Charge')</em></td>
                                            <td class="text-right"><strong>{{__($data->charge)}} {{__($general->currency)}}</strong></td>
                                        </tr>
                                        <tr>
                                            <td><em>@lang('Payable')</em></td>
                                            <td class="text-right"><strong>{{$data->charge + $data->price}} {{__($general->currency)}}</strong></td>
                                        </tr>
                                        <tr>
                                            <td class="text-right"><h4><strong>@lang('In USD') : </strong></h4></td>
                                            <td class="text-right text-danger"> <strong>${{__($data->usd_amo)}}</strong></td>
                                        </tr>
                                        </tbody>

                                    </table>

                                    <button id="btn-confirm" style="width: 100%;cursor: pointer;" type="submit" class="btn btn-primary"> @lang('Pay Now') </button>

                                </div>
                            </form>

                        </div>


                    </div>
                </div>

            </div>

        </div>
    </div>


@endsection
@section('script')
@if($data->gateway_id == 107)
<form action="{{ route('ipn.paystack') }}" method="POST">
    @csrf
    <script
    src="//js.paystack.co/v1/inline.js"
    data-key="{{ $data->gateway->val1 }}"
    data-email="{{ $data->user->email }}"
    data-amount="{{ round($data->usd_amo/$data->gateway->val7, 2)*100 }}"
    data-currency="NGN"
    data-ref="{{ $data->trx }}"
    data-custom-button="btn-confirm"
    >
</script>
</form>
@elseif($data->gateway_id == 108)
<script src="//voguepay.com/js/voguepay.js"></script>
<script>
    closedFunction = function() {
        
    }
    successFunction = function(transaction_id) {
        window.location.href = '{{ url('home/vogue') }}/' + transaction_id + '/success';
    }
    failedFunction=function(transaction_id) {
        window.location.href = '{{ url('home/vogue') }}/' + transaction_id + '/error';
    }

    function pay(item, price) {
        //Initiate voguepay inline payment
        Voguepay.init({
            v_merchant_id: "{{ $data->gateway->val1 }}",
            total: price,
            notify_url: "{{ route('ipn.voguepay') }}",
            cur: 'USD',
            merchant_ref: "{{ $data->trx }}",
            memo:'Buy ICO',
            recurrent: true,
            frequency: 10,
            developer_code: '5af93ca2913fd',
            store_id:"{{ $data->user_id }}",
            custom: "{{ $data->trx }}",
            
            closed:closedFunction,
            success:successFunction,
            failed:failedFunction
        });
    }
    
    $(document).ready(function () {
        $(document).on('click', '#btn-confirm', function (e) {
            e.preventDefault();
            pay('Buy', {{ $data->usd_amo }});
        });
    })
</script>
@endif
@endsection
