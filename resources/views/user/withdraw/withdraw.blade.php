@extends('layouts.master')
@section('style')
    <style>
        .preview-pranto{
            display: none;
        }
    </style>
@stop
@section('content')

    @include('layouts.balance_show')
    <!-- page title end -->


    <div class="all-transation-area pranto-trans-aria" >
        <div class="container">
            <div class="row">
                @foreach($trans as $data)
                    <div class="col-md-4">
                        <div class='wrapper grid-container grid-x grid-margin-x align-top align-justify'>
                            <div class='package small-12 medium-4 cell'>
                                <div class='package-name' style="font-size: 22px;">{{__($data->name)}}</div><hr>
                                <div class='package-name'>
                                    <img style="max-width: 180px" src="{{asset('assets/images/withdraw/'.$data->image)}}">
                                </div>
                                <hr>
                                <ul class="package-list">
                                    <li>
                                        <span class="large-text">  @lang('Minimum') {{__($general->currency_sym)}}{{__($data->min_amo)}} - @lang('Maximum') {{__($general->currency_sym)}}{{__($data->max_amo)}}</span>
                                    </li>
                                    <li>
                                        <span class="large-text"> @lang('Percentage Charge'): {{__($data->chargepc)}} %</span>
                                    </li>
                                    <li>
                                        <span class="large-text">@lang('Fixed Charge'):  {{__($data->chargefx)}} {{__($general->currency)}}</span>
                                    </li>
                                </ul>
                                <div class="select">
                                    <a class="btn btn-primary scale pranto-anchor-plan depoButton" data-toggle="modal"  data-name="{{__($data->name)}}" data-gate="{{$data->id}}" class="depoButton" href="#buyModal">@lang('Withdraw Now')</a>
                                </div>

                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </div>

    <div id="buyModal" class="modal fade" role="dialog">
        <div class="modal-dialog">

            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title">@lang('Withdraw via') <strong id="ModalLabel"></strong></h4>
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                </div>
                <form method="POST" action="{{route('withdraw.preview.user')}}">

                    <input type="hidden" name="gateway" id="gateWay"/>
                    <div class="modal-body">
                        {{csrf_field()}}

                        <div class="col-md-12">
                            <div class="form-element">
                                <div class="has-icon" >
                                    <input type="text" name="amount" placeholder="@lang('AMOUNT YOU WANT TO WITHDRAW')" required>
                                    <div class="the-icon">
                                        {{__($general->currency)}}
                                    </div>
                                </div>
                            </div>
                        </div>

                    </div>
                    <div class="modal-footer">
                        <button type="submit" class="btn btn-success">@lang('Preview')</button>
                        <button type="button" class="btn btn-default pull-left" data-dismiss="modal">@lang('Close')</button>
                    </div>
                </form>
            </div>


        </div>
    </div>


@endsection
@section('script')
    <script>
        $(document).ready(function(){
            $(document).on('click','.depoButton', function(){
                $('#ModalLabel').text($(this).data('name'));
                $('#gateWay').val($(this).data('gate'));
            });
        });
    </script>
@stop
