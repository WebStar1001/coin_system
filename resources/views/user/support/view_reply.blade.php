@extends('layouts.master')

@section('content')

    <!-- contact us area start -->
    <section class="contact-area" style="margin-bottom: 120px;">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-lg-8 text-center">
                    <div class="section-title">
                        <h2 style="font-size: 38px"> #{{$ticket_object->ticket}} - {{__($ticket_object->subject)}}</h2>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-lg-12">
                    <div class="contact-from-wrapper">
                        <form class="contact-form" action="{{route('store.customer.reply', $ticket_object->ticket)}}" method="post">
                            @csrf
                            <div class="row">
                                @foreach($ticket_data as $data)
                                    <fieldset class="col-md-12" style="margin-bottom: 10px;">
                                        <div class="card" style="border-radius: 15px;">
                                            <div class="card-body">
                                                @if($data->type == 1)
                                                    <legend><span style="color: #0e76a8">{{Auth::user()->name}}</span> , <small>{{ \Carbon\Carbon::parse($data->updated_at)->format('F dS, Y - h:i A') }}</small></legend>
                                                @else
                                                    <legend><span style="color: #0e76a8">{{$general->sitename}}</span> , <small>{{ \Carbon\Carbon::parse($data->updated_at)->format('F dS, Y - h:i A') }}</small></legend>
                                                @endif
                                                <div class="panel panel-danger">
                                                    <div class="panel-body">
                                                        <p>{!! $data->comment !!}</p>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </fieldset>
                                @endforeach



                                <div class="col-xl-12 col-lg-12">
                                    <div class="form-group">
                                        <label for="InputName">@lang('Reply')<span class="requred">:</span></label>
                                        <textarea class="form-control" name="comment" rows="10" required></textarea>
                                    </div>
                                </div>


                                <div class="col-xl-12 col-lg-12">
                                    <div class="row d-flex">
                                        <div class="col-xl-12 col-lg-12">
                                            <button type="submit" style="width: 100%" class="login-button btn-contact">@lang('Submit')</button>
                                        </div>
                                    </div>
                                </div>
                            </div>


                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- contact us area end -->
@endsection
@section('script')

@stop
