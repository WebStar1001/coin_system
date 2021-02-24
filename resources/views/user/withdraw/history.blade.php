@extends('layouts.master')
@section('style')

@stop
@section('content')
    @include('layouts.balance_show')
    <div class="all-transation-area pranto-trans-aria">
        <div class="container">
            <div class="card">
                <div class="card-body" style="padding: 20px">
                    <div class="row">
                        <div class="col-lg-12 ">
                            <div class="tab-content-area">
                                <div class="tab-content">
                                    <div id="deposit" class="deposit tab-pane active ">
                                        <table class="table">
                                            <thead>
                                            <tr>
                                                <th >@lang('Withdraw Id')</th>
                                                <th >@lang('Date')</th>
                                                <th >@lang('Payment Detail')</th>
                                                <th >@lang('Amount')</th>
                                                <th >@lang('Charge')</th>
                                                <th >@lang('Payable Amount')</th>
                                                <th >@lang('Processing Time')</th>
                                                <th >@lang('Status')</th>
                                            </tr>
                                            </thead>
                                            <tbody>
                                            @if(count($trans)==0)
                                                <tr>
                                                    <td colspan="8" class="text-center">@lang('No Data Available')</td>
                                                </tr>
                                            @endif
                                            @foreach($trans as $data)
                                                <tr>
                                                    <td>{{__($data->withdraw_id)}}</td>
                                                    <td scope="row">{{date('g:ia \o\n l jS F Y', strtotime($data->created_at))}}</td>
                                                    <td>{{__($data->detail)}}</td>
                                                    <td> {{__($general->currency_sym)}}{{__($data->amount)}}</td>
                                                    <td> {{__($general->currency_sym)}}{{__($data->charge)}}</td>
                                                    <td>{{__($data->method_cur_amount)}} {{__($data->withdraw_method->currency)}} - @lang('Via') {{__($data->withdraw_method->name)}}</td>
                                                    <td>{{__($data->processing_time)}}</td>
                                                    <td>
                                                        @if($data->status == 2)
                                                            <label class="badge badge-danger">@lang('Reject')</label>
                                                        @elseif($data->status == 0)
                                                            <label class="badge badge-warning">@lang('Pending')</label>
                                                        @elseif($data->status == 1)
                                                            <label class="badge badge-success">@lang('Complete')</label>
                                                        @endif
                                                    </td>
                                                </tr>
                                            @endforeach
                                            </tbody>
                                        </table>
                                        <div class="row">
                                            <div class="col-md-12">
                                                {{$trans->links()}}
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection
@section('script')

@stop
