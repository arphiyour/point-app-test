@extends('core::app.layout')

@section('content')
    <div id="page-content">
        <ul class="breadcrumb breadcrumb-top">
            @include('point-purchasing::app.purchasing.point.fixed-assets._breadcrumb')
            <li><a href="{{ url('purchasing/point/fixed-assets/purchase-requisition') }}">Purchase Requisition</a></li>
            <li>Archived</li>
        </ul>
        <h2 class="sub-header">Purchase Requisition | Fixed Assets</h2>
        @include('point-purchasing::app.purchasing.point.fixed-assets.purchase-requisition._menu')

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

                <fieldset>
                    <div class="form-group">
                        <div class="col-md-12">
                            <legend><i class="fa fa-angle-right"></i> Form</legend>
                        </div>
                    </div>
                </fieldset>
                <div class="form-group">
                    <label class="col-md-3 control-label">Form Number</label>

                    <div class="col-md-6 content-show">
                        {{ $purchase_requisition_archived->formulir->archived }}
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-md-3 control-label">Form Date</label>

                    <div class="col-md-6 content-show">
                        {{ date_format_view($purchase_requisition_archived->formulir->form_date, true) }}
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-md-3 control-label">Employee </label>

                    <div class="col-md-6 content-show">
                        {{ $purchase_requisition_archived->employee->name }}
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-md-3 control-label">Notes</label>

                    <div class="col-md-6 content-show">
                        {{ $purchase_requisition_archived->formulir->notes }}
                    </div>
                </div>
                <fieldset>
                    <div class="form-group">
                        <div class="col-md-12">
                            <legend><i class="fa fa-angle-right"></i> Item</legend>
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="col-md-12">
                            <div class="table-responsive">
                                <table id="item-datatable" class="table table-striped">
                                    <thead>
                                    <tr>
                                        <th>Account Assets</th>
                                        <th>Account Name</th>
                                        <th class="text-right">Quantity</th>
                                        <th>Unit</th>
                                        <th class="text-right">Price</th>
                                        <th>Allocation</th>
                                    </tr>
                                    </thead>
                                    <tbody class="manipulate-row">
                                    @foreach($purchase_requisition_archived->details as $purchase_requisition_item)
                                        <tr>
                                            <td>{{ $purchase_requisition_item->coa->name }}</td>
                                            <td>{{ $purchase_requisition_item->name }}</td>
                                            <td class="text-right">{{ number_format_quantity($purchase_requisition_item->quantity) }}</td>
                                            <td>{{ $purchase_requisition_item->unit }}</td>
                                            <td class="text-right">{{ number_format_quantity($purchase_requisition_item->price) }}</td>
                                            <td>{{ $purchase_requisition_item->allocation->name }}</td>
                                        </tr>
                                    @endforeach
                                    </tbody>
                                    <tfoot>
                                    <tr>
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                    </tr>
                                    </tfoot>
                                </table>
                            </div>
                        </div>
                    </div>
                </fieldset>

                <fieldset>
                    <div class="form-group">
                        <div class="col-md-12">
                            <legend><i class="fa fa-angle-right"></i> Authorized User</legend>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-md-3 control-label">Form Creator</label>

                        <div class="col-md-6 content-show">
                            {{ $purchase_requisition_archived->formulir->createdBy->name }}
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-md-3 control-label">Request Approval To</label>

                        <div class="col-md-6 content-show">
                            {{ $purchase_requisition_archived->formulir->approvalTo->name }}
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
                                        'approval_status' => $purchase_requisition_archived->formulir->approval_status,
                                        'approval_message' => $purchase_requisition_archived->formulir->approval_message,
                                        'approval_at' => $purchase_requisition_archived->formulir->approval_at,
                                        'approval_to' => $purchase_requisition_archived->formulir->approvalTo->name,
                                    ])
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-md-3 control-label">Form Status</label>

                        <div class="col-md-6 content-show">
                            @include('framework::app.include._form_status_label', ['form_status' => $purchase_requisition_archived->formulir->form_status])
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
