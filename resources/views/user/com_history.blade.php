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
                                                <th scope="col">@lang('Date')</th>
                                                <th scope="col">@lang('Description')</th>
                                                <th scope="col">@lang('Amount')</th>
                                                <th scope="col">@lang('After Balance')</th>
                                            </tr>
                                            </thead>
                                            <tbody>
                                            @if(count($trans)==0)
                                                <tr>
                                                    <td colspan="5" class="text-center">@lang('No Data Available')</td>
                                                </tr>
                                            @endif
                                            @foreach($trans as $data)
                                                <tr @if($data->amount < 0) style="background-color: #e4afaf" @endif>
                                                    <td scope="row">{{date('g:ia \o\n l jS F Y', strtotime($data->created_at))}}</td>
                                                    <td>{{__($data->des)}}</td>
                                                    <td>{{abs($data->amount)}} {{__($general->currency_sym)}}</td>
                                                    <td> {{$data->balance}} {{__($general->currency_sym)}}</td>
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
