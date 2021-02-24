@extends('layouts.master')
@section('style')
    <link rel="stylesheet" type="text/css" href="{{asset('assets/front/css/custom.css')}}">
@stop
@section('content')
    @include('layouts.balance_show')

    <div class="all-transation-area pranto-trans-aria" >
        <div class="container">
            <div class="row">
                @foreach($gates as $gate)
                    <div class="col-md-4">
                        <div class='wrapper grid-container grid-x grid-margin-x align-top align-justify'>
                            <div class='package small-12 medium-4 cell'>
                                <div class='package-name' style="font-size: 22px;">{{__($gate->name)}}</div><hr>
                                <div class='package-img'>
                                    <img style="max-width: 180px" src="{{asset('assets/images/gateway')}}/{{$gate->id}}.jpg">
                                </div>
                          
                          
<div class="charge" style="padding: 20px 0;">
       @lang('Charge'): <strong>{{__($gate->fixed_charge)}} USD</strong> + <strong>{{__($gate->percent_charge)}} %</strong>
</div>
                             

                                <div class="select">
                                    <a class="btn btn-primary scale pranto-anchor-plan depoButton" data-toggle="modal"  data-name="{{__($gate->name)}}" data-gate="{{$gate->id}}" class="depoButton" href="#depoModal">@lang('Buy Now')</a>
                                </div>

                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </div>

    <div class="modal fade" id="depoModal" tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content text-center">
                <div class="modal-header">
                    <h5 class="modal-title" id="ModalLabel"></h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form action="{{route('deposit.data-insert')}}" method="POST">
                    <div class="modal-body">
                        @csrf

                        <input type="hidden" name="gateway" id="gateWay"/>
                        <h5> @lang('STO Amount') </h5>

                        <div class="col-md-12">
                            <div class="form-element">
                                <div class="has-icon" >
                                    <input type="text" name="amount">
                                    <div class="the-icon">
                                        <i class="fa fa-building"></i>
                                    </div>
                                </div>
                                <small style="color:forestgreen">1 @lang('STO') =  {{$general->currency_sym}}{{$ico->price}} & @lang('Available') : {{$ico->amount - $ico->sold}}</small>
                            </div>

                        </div>



                    </div>
                    <div class="modal-footer">
                        <button type="submit" class="btn btn-success">@lang('Payment Preview')</button>
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">@lang('Close')</button>
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

@endsection



