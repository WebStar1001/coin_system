@extends('layouts.master')
@section('style')
    <link rel="stylesheet" type="text/css" href="{{asset('assets/front/css/custom.css')}}">
@stop
@section('content')
    @include('layouts.balance_show')
    <!-- contact us area start -->
    <section class="all-transation-area pranto-trans-aria">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="contact-from-wrapper">
                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-element">
                                    <label for="">@lang('My Referral Link')</label>
                                    <div class="has-icon" id="copyBoard">
                                        <input readonly type="url" id="ref" name="referral_link"  value="{{url('/')}}/register/{{Auth::user()->username}}"  required>
                                        <div class="the-icon"  id="copybtn" data-copytarget="#ref" >
                                            <i class="fa fa-copy" id="copybtn" data-copytarget="#ref"></i>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="row justify-content-center">
                <div class="col-lg-8 text-center">
                    <div class="section-title">
                        <h2>@lang('My Referral Statistic')</h2>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-lg-12">
                    <div class="contact-from-wrapper">
                        <div class="row">
                            <div class="col-md-12">
                                <div class="part-text pranto-ul">
                                    <ul style="width: 100%">
                                        <li class="container"><p> <strong>{{Auth::user()->username}}</strong> </p>
                                            <ul>
                                                {!! showBelowUser(Auth::id()) !!}
                                            </ul>
                                        </li>

                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- contact us area end -->


@endsection

@section('script')

    <script>


        (function() {

            'use strict';

            // click events
            document.body.addEventListener('click', copy, true);

            // event handler
            function copy(e) {


                // find target element
                var
                    t = e.target,
                    c = t.dataset.copytarget,
                    inp = (c ? document.querySelector(c) : null);

                // is element selectable?
                if (inp && inp.select) {

                    // select text
                    inp.select();

                    try {
                        // copy text
                        document.execCommand('copy');
                        inp.blur();

                        // copied animation
                        t.classList.add('copied');
                        setTimeout(function() { t.classList.remove('copied'); }, 1500);
                    }
                    catch (err) {
                        alert('please press Ctrl/Cmd+C to copy');
                    }

                }

            }

        })();

    </script>

@stop
