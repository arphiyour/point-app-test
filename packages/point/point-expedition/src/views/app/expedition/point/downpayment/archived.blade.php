@extends('core::app.layout')

@section('content')
    <div id="page-content">
        <ul class="breadcrumb breadcrumb-top">
            @include('point-expedition::app/expedition/point/downpayment/_breadcrumb')
            <li><a href="{{ url('expedition/point/downpayment/'.$downpayment->id) }}">{{$downpayment->formulir->form_date}}</a></li>
            <li>Archived</li>
        </ul>
        <h2 class="sub-header">Downpayment </h2>
        @include('point-expedition::app.expedition.point.downpayment._menu')

        @include('core::app.error._alert')

        <div class="block full">
            <div class="form-horizontal form-bordered">
                <div class="form-group">
                    <div class="col-md-12">
                        <div class="alert alert-danger alert-dismissable">
                            <h1 class="text-center"><strong>Archived</strong></h1>
                        </div>
                    </div>
                </div>
                @if($expedition_order)
                <fieldset>
                    <div class="form-group">
                        <div class="col-md-12">
                            <legend>
                                <i class="fa fa-angle-right"></i> 
                                REF#<a target="_blank" href="{{url('expedition/point/expedition-order/'.$expedition_order->id)}}">{{$expedition_order->formulir->form_number}} </a>
                            </legend>
                        </div>
                    </div>
                </fieldset>
                <div class="form-group">
                    <label class="col-md-3 control-label">Form Date</label>
                    <div class="col-md-6 content-show">
                        {{ date_format_view($expedition_order->formulir->form_date)}}
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-md-3 control-label">Expedition </label>
                    <div class="col-md-6 content-show">
                        {!! get_url_person($downpayment_archived->expedition->id) !!}
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-md-3 control-label">Total amount</label>
                    <div class="col-md-6 content-show">
                        {{ number_format_price($expedition_order->total) }}
                    </div>
                </div>
                @endif
                <fieldset>
                    <div class="form-group">
                        <div class="col-md-12">
                            <legend><i class="fa fa-angle-right"></i> Formulir Downpayment</legend>
                        </div>
                    </div>
                </fieldset>
                <div class="form-group">
                    <label class="col-md-3 control-label">Form Number</label>
                    <div class="col-md-6 content-show">
                        {{ $downpayment_archived->formulir->archived }}
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-md-3 control-label">Form Date</label>
                    <div class="col-md-6 content-show">
                        {{ date_format_view($downpayment_archived->formulir->form_date, true) }}
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-md-3 control-label">Expedition</label>
                    <div class="col-md-6 content-show">
                        {{ $downpayment_archived->expedition->codeName }}
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-md-3 control-label">Notes</label>
                    <div class="col-md-6 content-show">
                        {{ $downpayment_archived->formulir->notes }}
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-md-3 control-label">Amount</label>
                    <div class="col-md-6 content-show">
                        {{ number_format_quantity($downpayment_archived->amount) }}
                    </div>
                </div>

                <fieldset>
                    <div class="form-group">
                        <div class="col-md-12">
                            <legend><i class="fa fa-angle-right"></i> Authorized User</legend>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-md-3 control-label">Form Creator</label>
                        <div class="col-md-6 content-show">
                            {{ $downpayment_archived->formulir->createdBy->name }}
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-md-3 control-label">Request Approval To</label>
                        <div class="col-md-6 content-show">
                            {{ $downpayment_archived->formulir->approvalTo->name }}
                        </div>
                    </div>
                </fieldset>

                <fieldset>
                    <div class="form-group">
                        <div class="col-md-12">
                            <legend><i class="fa fa-angle-right"></i> Status</legend>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-md-3 control-label">Approval Status</label>
                        <div class="col-md-6 content-show">
                            @include('framework::app.include._approval_status_label_detailed', [
                                'approval_status' => $downpayment_archived->formulir->approval_status,
                                'approval_message' => $downpayment_archived->formulir->approval_message,
                                'approval_at' => $downpayment_archived->formulir->approval_at,
                                'approval_to' => $downpayment_archived->formulir->approvalTo->name,
                            ])
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-md-3 control-label">Form Status</label>
                        <div class="col-md-6 content-show">
                            @include('framework::app.include._form_status_label', ['form_status' => $downpayment_archived->formulir->form_status])
                        </div>
                    </div>
                </fieldset>
            </div>
        </div>
    </div>
@stop

@section('scripts')
    <script>
        initDatatable('#item-datatable');
    </script>
@stop
