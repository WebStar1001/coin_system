@extends('layouts.master')

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
                                                <th class="text-center">@lang('Amount')</th>
                                                <th class="text-center">@lang('Gateway')</th>
                                                <th class="text-center">@lang('TRX ID')</th>
                                                <th class="text-center">@lang('TRX Time')</th>
                                            </tr>
                                            </thead>
                                            <tbody>
                                            @if(count($deposit)==0)
                                                <tr>
                                                    <td colspan="3"><h2>@lang('No Data Available')</h2></td>
                                                </tr>
                                            @endif
                                            @foreach($deposit as $log)
                                                <tr>
                                                    <td>{{$log->amount}} {{__($general->currency_sym)}}</td>
                                                    <td>{{__($log->gateway->name)}}</td>
                                                    <td>{{__($log->trx)}}</td>
                                                    <td>{{$log->created_at}}</td>
                                                </tr>
                                            @endforeach
                                            </tbody>
                                        </table>
                                        <div class="row">
                                            <div class="col-md-12">
                                                {{$deposit->links()}}
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




