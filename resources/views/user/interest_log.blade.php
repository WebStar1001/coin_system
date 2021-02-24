@extends('layouts.master')

@section('content')
    @include('layouts.balance_show')
    <script>
        function createCountDown(elementId, sec) {
            var tms = sec;
            var x = setInterval(function() {
                var distance = tms*1000;
                var days = Math.floor(distance / (1000 * 60 * 60 * 24));
                var hours = Math.floor((distance % (1000 * 60 * 60 * 24)) / (1000 * 60 * 60));
                var minutes = Math.floor((distance % (1000 * 60 * 60)) / (1000 * 60));
                var seconds = Math.floor((distance % (1000 * 60)) / 1000);
                document.getElementById(elementId).innerHTML =days+"d: "+ hours + "h "+ minutes + "m " + seconds + "s ";
                if (distance < 0) {
                    clearInterval(x);
                    document.getElementById(elementId).innerHTML = "{{__('COMPLETE')}}";
                }
                tms--;
            }, 1000);
        }

    </script>

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
                                                <th scope="col">@lang('Plan Name')</th>
                                                <th scope="col">@lang('Received')</th>
                                                <th scope="col">@lang('Invest Amount')</th>
                                                <th scope="col" style="width :20%">@lang('Next Payment')</th>
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
                                                    <td>{{__($data->plan->name)}}</td>
                                                    <td>  {{__($data->return_rec_time)}} @lang('Times') </td>
                                                    <td> {{__($data->amount)}}</td>
                                                    <td scope="row" style="font-weight:bold;"><p id="counter{{$data->id}}" class="demo countdown timess2"> </p></td>
                                                </tr>
                                                <script>createCountDown('counter<?php echo $data->id ?>', {{\Carbon\Carbon::parse($data->next_time)->diffInSeconds()}});</script>
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
