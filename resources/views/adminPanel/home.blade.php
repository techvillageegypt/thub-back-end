@extends('adminPanel.layouts.app')

@section('breadcrumb')
<ul class="breadcrumb breadcrumb-transparent breadcrumb-dot font-weight-bold p-0 my-2 font-size-sm">
    <li class="breadcrumb-item active"> Dashboard </li>
</ul>
@endsection
@section('content')
<div class="d-flex flex-column-fluid">
    <!--begin::Container-->
    <div class=" container ">
        <div class="row">
            <div class="col-lg-12">

                <!--begin::Card-->
                <div class="card card-custom gutter-b col-5 float-left mx-5">
                    <div class="card-header">
                        <div class="card-title">
                            <h3 class="card-label">
                                Donations Status
                            </h3>
                        </div>
                    </div>
                    <div class="card-body">
                        <!--begin::Chart-->
                        <div id="chart_12" class="d-flex justify-content-center"></div>
                        <!--end::Chart-->
                    </div>
                </div>
                <!--end::Card-->

                <!--begin::Card-->
                <div class="card card-custom gutter-b  col-5 float-left mx-5">
                    <div class="card-header">
                        <div class="card-title">
                            <h3 class="card-label">
                                Shop Orders Status
                            </h3>
                        </div>
                    </div>
                    <div class="card-body">
                        <!--begin::Chart-->
                        <div id="chart_11" class="d-flex justify-content-center"></div>
                        <!--end::Chart-->
                    </div>
                </div>
                <!--end::Card-->





                <div class="card card-custom gutter-b col-3 mx-5 float-left" style="height: 220px">
                    <div class="card-body text-center">
                        <span class="svg-icon svg-icon-primary svg-icon-5x">
                            <!--begin::Svg Icon | path:C:\wamp64\www\keenthemes\themes\metronic\theme\html\demo1\dist/../src/media/svg/icons\General\User.svg--><svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24px" height="24px" viewBox="0 0 24 24" version="1.1">
                                <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                                    <polygon points="0 0 24 0 24 24 0 24" />
                                    <path d="M12,11 C9.790861,11 8,9.209139 8,7 C8,4.790861 9.790861,3 12,3 C14.209139,3 16,4.790861 16,7 C16,9.209139 14.209139,11 12,11 Z" fill="#000000" fill-rule="nonzero" opacity="0.3" />
                                    <path d="M3.00065168,20.1992055 C3.38825852,15.4265159 7.26191235,13 11.9833413,13 C16.7712164,13 20.7048837,15.2931929 20.9979143,20.2 C21.0095879,20.3954741 20.9979143,21 20.2466999,21 C16.541124,21 11.0347247,21 3.72750223,21 C3.47671215,21 2.97953825,20.45918 3.00065168,20.1992055 Z" fill="#000000" fill-rule="nonzero" />
                                </g>
                            </svg>
                            <!--end::Svg Icon--></span>
                        <div class="text-dark font-weight-bolder font-size-h2 mt-3">{{$data['customers_count']}}</div>

                        <a href="{{route('adminPanel.customers.index')}}" class="text-muted text-hover-primary font-weight-bold font-size-lg mt-5">Customers Count</a>
                    </div>
                </div>

                <div class="card card-custom gutter-b col-3 mx-5 float-left" style="height: 220px">
                    <div class="card-body text-center">
                        <span class="svg-icon svg-icon-5x svg-icon-success">
                            <!--begin::Svg Icon | path:assets/media/svg/icons/Communication/Group.svg--><svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24px" height="24px" viewBox="0 0 24 24" version="1.1">
                                <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                                    <polygon points="0 0 24 0 24 24 0 24"></polygon>
                                    <path d="M18,14 C16.3431458,14 15,12.6568542 15,11 C15,9.34314575 16.3431458,8 18,8 C19.6568542,8 21,9.34314575 21,11 C21,12.6568542 19.6568542,14 18,14 Z M9,11 C6.790861,11 5,9.209139 5,7 C5,4.790861 6.790861,3 9,3 C11.209139,3 13,4.790861 13,7 C13,9.209139 11.209139,11 9,11 Z" fill="#000000" fill-rule="nonzero" opacity="0.3"></path>
                                    <path d="M17.6011961,15.0006174 C21.0077043,15.0378534 23.7891749,16.7601418 23.9984937,20.4 C24.0069246,20.5466056 23.9984937,21 23.4559499,21 L19.6,21 C19.6,18.7490654 18.8562935,16.6718327 17.6011961,15.0006174 Z M0.00065168429,20.1992055 C0.388258525,15.4265159 4.26191235,13 8.98334134,13 C13.7712164,13 17.7048837,15.2931929 17.9979143,20.2 C18.0095879,20.3954741 17.9979143,21 17.2466999,21 C13.541124,21 8.03472472,21 0.727502227,21 C0.476712155,21 -0.0204617505,20.45918 0.00065168429,20.1992055 Z" fill="#000000" fill-rule="nonzero"></path>
                                </g>
                            </svg>
                            <!--end::Svg Icon--></span>
                        <div class="text-dark font-weight-bolder font-size-h2 mt-3">{{$data['drivers_count']}}</div>

                        <a href="{{route('adminPanel.drivers.index')}}" class="text-muted text-hover-primary font-weight-bold font-size-lg mt-5">Drivers Count</a>
                    </div>
                </div>

                <div class="card card-custom gutter-b col-3 mx-5 float-left" style="height: 220px">
                    <div class="card-body text-center">
                        <span class="svg-icon svg-icon-info svg-icon-5x">
                            <!--begin::Svg Icon | path:C:\wamp64\www\keenthemes\themes\metronic\theme\html\demo1\dist/../src/media/svg/icons\Shopping\Cart1.svg--><svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24px" height="24px" viewBox="0 0 24 24" version="1.1">
                                <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                                    <rect x="0" y="0" width="24" height="24" />
                                    <path d="M18.1446364,11.84388 L17.4471627,16.0287218 C17.4463569,16.0335568 17.4455155,16.0383857 17.4446387,16.0432083 C17.345843,16.5865846 16.8252597,16.9469884 16.2818833,16.8481927 L4.91303792,14.7811299 C4.53842737,14.7130189 4.23500006,14.4380834 4.13039941,14.0719812 L2.30560137,7.68518803 C2.28007524,7.59584656 2.26712532,7.50338343 2.26712532,7.4104669 C2.26712532,6.85818215 2.71484057,6.4104669 3.26712532,6.4104669 L16.9929851,6.4104669 L17.606173,3.78251876 C17.7307772,3.24850086 18.2068633,2.87071314 18.7552257,2.87071314 L20.8200821,2.87071314 C21.4717328,2.87071314 22,3.39898039 22,4.05063106 C22,4.70228173 21.4717328,5.23054898 20.8200821,5.23054898 L19.6915238,5.23054898 L18.1446364,11.84388 Z" fill="#000000" opacity="0.3" />
                                    <path d="M6.5,21 C5.67157288,21 5,20.3284271 5,19.5 C5,18.6715729 5.67157288,18 6.5,18 C7.32842712,18 8,18.6715729 8,19.5 C8,20.3284271 7.32842712,21 6.5,21 Z M15.5,21 C14.6715729,21 14,20.3284271 14,19.5 C14,18.6715729 14.6715729,18 15.5,18 C16.3284271,18 17,18.6715729 17,19.5 C17,20.3284271 16.3284271,21 15.5,21 Z" fill="#000000" />
                                </g>
                            </svg>
                            <!--end::Svg Icon--></span>
                        <div class="text-dark font-weight-bolder font-size-h2 mt-3">{{$data['orders_count']}}</div>

                        <a href="{{route('adminPanel.orders.index')}}" class="text-muted text-hover-primary font-weight-bold font-size-lg mt-5">Orders Count</a>
                    </div>
                </div>

                <div class="card card-custom gutter-b col-3 mx-5 float-left" style="height: 220px">
                    <div class="card-body text-center">
                        <span class="svg-icon svg-icon-danger svg-icon-5x">
                            <!--begin::Svg Icon | path:C:\wamp64\www\keenthemes\themes\metronic\theme\html\demo1\dist/../src/media/svg/icons\General\Heart.svg--><svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24px" height="24px" viewBox="0 0 24 24" version="1.1">
                                <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                                    <polygon points="0 0 24 0 24 24 0 24" />
                                    <path d="M16.5,4.5 C14.8905,4.5 13.00825,6.32463215 12,7.5 C10.99175,6.32463215 9.1095,4.5 7.5,4.5 C4.651,4.5 3,6.72217984 3,9.55040872 C3,12.6834696 6,16 12,19.5 C18,16 21,12.75 21,9.75 C21,6.92177112 19.349,4.5 16.5,4.5 Z" fill="#000000" fill-rule="nonzero" />
                                </g>
                            </svg>
                            <!--end::Svg Icon--></span>
                        <div class="text-dark font-weight-bolder font-size-h2 mt-3">{{$data['donations_count']}}</div>

                        <a href="{{route('adminPanel.donations.index')}}" class="text-muted text-hover-primary font-weight-bold font-size-lg mt-5">Donations Count</a>
                    </div>
                </div>

                <div class="card card-custom gutter-b col-3 mx-5 float-left" style="height: 220px">
                    <div class="card-body text-center">
                        <span class="svg-icon svg-icon-dark svg-icon-5x">
                            <!--begin::Svg Icon | path:C:\wamp64\www\keenthemes\themes\metronic\theme\html\demo1\dist/../src/media/svg/icons\Clothes\T-Shirt.svg--><svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24px" height="24px" viewBox="0 0 24 24" version="1.1">
                                <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                                    <rect x="0" y="0" width="24" height="24" />
                                    <path d="M7.83498136,4 C8.22876115,5.21244017 9.94385174,6.125 11.999966,6.125 C14.0560802,6.125 15.7711708,5.21244017 16.1649506,4 L17.2723671,4 C17.3446978,3.99203791 17.4181234,3.99191839 17.4913059,4 L17.5,4 C17.8012164,4 18.0713275,4.1331782 18.2546625,4.34386406 L22.5900048,6.8468751 C23.0682974,7.12301748 23.2321726,7.73460788 22.9560302,8.21290051 L21.2997802,11.0816097 C21.0236378,11.5599023 20.4120474,11.7237774 19.9337548,11.4476351 L18.5,10.6198563 L18.5,20 C18.5,20.5522847 18.0522847,21 17.5,21 L6.5,21 C5.94771525,21 5.5,20.5522847 5.5,20 L5.5,10.6204852 L4.0673344,11.4476351 C3.58904177,11.7237774 2.97745137,11.5599023 2.70130899,11.0816097 L1.04505899,8.21290051 C0.768916618,7.73460788 0.932791773,7.12301748 1.4110844,6.8468751 L5.74424153,4.34512566 C5.92759515,4.13371 6.19818276,4 6.5,4 L6.50978325,4 C6.58296578,3.99191839 6.65639143,3.99203791 6.72872211,4 L7.83498136,4 Z" fill="#000000" />
                                </g>
                            </svg>
                            <!--end::Svg Icon--></span>
                        <div class="text-dark font-weight-bolder font-size-h2 mt-3">{{$data['products_count']}}</div>

                        <a href="{{route('adminPanel.products.index')}}" class="text-muted text-hover-primary font-weight-bold font-size-lg mt-5">Products Count</a>
                    </div>
                </div>

                <div class="card card-custom gutter-b col-3 mx-5 float-left" style="height: 220px">
                    <div class="card-body text-center">
                        <span class="svg-icon svg-icon-primary svg-icon-5x">
                            <!--begin::Svg Icon | path:C:\wamp64\www\keenthemes\themes\metronic\theme\html\demo1\dist/../src/media/svg/icons\Clothes\T-Shirt.svg--><svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24px" height="24px" viewBox="0 0 24 24" version="1.1">
                                <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                                    <rect x="0" y="0" width="24" height="24" />
                                    <path d="M5.5,2 L18.5,2 C19.3284271,2 20,2.67157288 20,3.5 L20,6.5 C20,7.32842712 19.3284271,8 18.5,8 L5.5,8 C4.67157288,8 4,7.32842712 4,6.5 L4,3.5 C4,2.67157288 4.67157288,2 5.5,2 Z M11,4 C10.4477153,4 10,4.44771525 10,5 C10,5.55228475 10.4477153,6 11,6 L13,6 C13.5522847,6 14,5.55228475 14,5 C14,4.44771525 13.5522847,4 13,4 L11,4 Z" fill="#000000" opacity="0.3" />
                                    <path d="M5.5,9 L18.5,9 C19.3284271,9 20,9.67157288 20,10.5 L20,13.5 C20,14.3284271 19.3284271,15 18.5,15 L5.5,15 C4.67157288,15 4,14.3284271 4,13.5 L4,10.5 C4,9.67157288 4.67157288,9 5.5,9 Z M11,11 C10.4477153,11 10,11.4477153 10,12 C10,12.5522847 10.4477153,13 11,13 L13,13 C13.5522847,13 14,12.5522847 14,12 C14,11.4477153 13.5522847,11 13,11 L11,11 Z M5.5,16 L18.5,16 C19.3284271,16 20,16.6715729 20,17.5 L20,20.5 C20,21.3284271 19.3284271,22 18.5,22 L5.5,22 C4.67157288,22 4,21.3284271 4,20.5 L4,17.5 C4,16.6715729 4.67157288,16 5.5,16 Z M11,18 C10.4477153,18 10,18.4477153 10,19 C10,19.5522847 10.4477153,20 11,20 L13,20 C13.5522847,20 14,19.5522847 14,19 C14,18.4477153 13.5522847,18 13,18 L11,18 Z" fill="#000000" />
                                </g>
                            </svg>
                            <!--end::Svg Icon--></span>
                        <div class="text-dark font-weight-bolder font-size-h2 mt-3">{{$data['total_daily_weight']}}</div>

                        <a href="{{route('adminPanel.driver_weights.index')}}" class="text-muted text-hover-primary font-weight-bold font-size-lg mt-5">Daily Weight</a>
                    </div>
                </div>




                <!--begin::Card-->
                <div class="card card-custom gutter-b col-12">
                    <div class="card-header">
                        <div class="card-title">
                            <h3 class="card-label">
                                Latest Orders
                            </h3>
                            <a href="{{route('adminPanel.orders.index')}}" style="position: absolute;right: 20px;">
                                All Orders
                            </a>
                        </div>
                    </div>
                    <div class="card-body">
                        <!--begin: Datatable-->
                        <table class="table table-separate table-head-custom table-checkable" id="kt_datatable1">
                            <thead>
                                <tr>
                                    <th>@lang('models/orders.fields.id')</th>
                                    <th>@lang('models/orders.fields.name')</th>
                                    <th>@lang('models/orders.fields.address')</th>
                                    <th>@lang('models/orders.fields.phone')</th>
                                    <th>@lang('models/orders.fields.payment_method')</th>
                                    <th>@lang('models/orders.fields.total')</th>
                                    <th>@lang('models/orders.fields.created_at')</th>
                                    <th>@lang('models/orders.fields.status')</th>
                                    <th>@lang('crud.action')</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($data['orders'] as $order)
                                <tr>
                                    <td>{{ $order->id }}</td>
                                    <td>{{ $order->name }}</td>
                                    <td>{{ Str::limit($order->address, 40, '...') }}</td>
                                    <td>{{ $order->phone }}</td>
                                    <td>{{ $order->payment_method }}</td>
                                    <td>{{ $order->total }} @lang('lang.currency')</td>
                                    <td>{{ $order->created_at->diffForHumans() }}</td>
                                    <td>{{ $order->status_text }}</td>
                                    <td nowrap>
                                        <div class='btn-group'>
                                            @can('orders view')
                                            <a href="{{ route('adminPanel.orders.show', [$order->id]) }}" class='btn btn-sm btn-shadow mx-1 btn-transparent-success'><i class="fa fa-eye"></i></a>
                                            @endcan
                                        </div>

                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                        <!--end: Datatable-->
                    </div>
                </div>
                <!--end::Card-->

                <!--begin::Card-->
                <div class="card card-custom gutter-b col-12">
                    <div class="card-header">
                        <div class="card-title">
                            <h3 class="card-label">
                                Latest Donations
                            </h3>
                            <a href="{{route('adminPanel.donations.index')}}" style="position: absolute;right: 20px;">
                                All Donations
                            </a>
                        </div>
                    </div>
                    <div class="card-body">
                        <!--begin: Datatable-->
                        <table class="table table-separate table-head-custom table-checkable" id="kt_datatable1">
                            <thead>
                                <tr>
                                    <th>@lang('models/donations.fields.id')</th>
                                    <th>@lang('models/donations.fields.customer')</th>
                                    <th>@lang('models/donations.fields.phone')</th>
                                    {{-- <th>@lang('models/donations.fields.driver')</th> --}}
                                    <th>@lang('models/donations.fields.pickup_date')</th>
                                    <th>@lang('models/donations.fields.state')</th>
                                    <th>@lang('models/donations.fields.status')</th>
                                    <th>@lang('crud.action')</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($data['donations'] as $donation)
                                <tr>
                                    <td>{{ $donation->id }}</td>
                                    <td>{{ $donation->customer->name ?? '' }}</td>
                                    <td>{{ $donation->customer->user->phone ?? '' }}</td>
                                    {{-- <td>{{ $donation->driver->name ?? '' }}</td> --}}
                                    <td>{{ $donation->pickup_date }}</td>
                                    <td>{{ $donation->state->name ?? '' }}</td>
                                    <td>{{ $donation->status_text }}</td>

                                    <td nowrap>
                                        @can('donations view')
                                        <a href="{{ route('adminPanel.donations.show', [$donation->id]) }}" class='btn btn-sm btn-shadow mx-1 btn-transparent-success'><i class="fa fa-eye"></i></a>
                                        @endcan
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                        <!--end: Datatable-->

                    </div>
                </div>
                <!--end::Card-->

                <!--begin::Card-->
                <div class="card card-custom gutter-b col-12">
                    <div class="card-header">
                        <div class="card-title">
                            <h3 class="card-label">
                                Latest Customers
                            </h3>
                            <a href="{{route('adminPanel.customers.index')}}" style="position: absolute;right: 20px;">
                                All Customers
                            </a>
                        </div>
                    </div>
                    <div class="card-body">
                        <table class="table table-separate table-head-custom table-checkable" id="kt_datatable1">
                            <thead>
                                <tr>
                                    <th>@lang('models/customers.fields.name')</th>
                                    <th>@lang('models/customers.fields.phone')</th>
                                    <th>@lang('models/customers.fields.address')</th>
                                    <th>@lang('crud.action')</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($data['customers'] as $customer)
                                <tr>
                                    <td>{{ $customer->name }}</td>
                                    <td>{{ $customer->user->phone ?? '' }}</td>
                                    <td>{{ $customer->address }}</td>
                                    <td>
                                        <a href="{{ route('adminPanel.customers.show', [$customer->id]) }}" class='btn btn-sm btn-shadow mx-1 btn-transparent-success'><i class="fa fa-eye"></i></a>
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                        <!--end: Datatable-->


                    </div>
                </div>
                <!--end::Card-->
            </div>
        </div>
    </div>
    <!--end::Container-->
</div>
@endsection


@section('scripts')
<script src="{{asset('metronic/assets/js/pages/features/charts/apexcharts.js?v=7.0.6')}}"></script>
<script>
    var KTApexChartsDemo = function () {
	// Private functions

    // $data['new_orders_count'] = Donation::where('status', 0)->count();
    //     $data['delivered_orders_count'] = Donation::where('status', 1)->count();
    //     $data['not_delivered_orders_count'] = Donation::where('status', 2)->count();

    var newOrders            = {{$data['new_orders_count']}};
    var deliveredOrders       = {{$data['delivered_orders_count']}};
    var notDeliveredOrders      = {{$data['not_delivered_orders_count']}};

    var _demo11 = function () {
		const apexChart = "#chart_11";
		var options = {
			series: [newOrders, deliveredOrders, notDeliveredOrders],
			chart: {
				width: 380,
				type: 'donut',
			},
            labels: ['New', 'Delivered', 'Not Delivered'],
			responsive: [{
				breakpoint: 480,
				options: {
					chart: {
						width: 200
					},
					legend: {
						position: 'bottom'
					}
				}
			}],
			colors: [primary, success,  danger]
		};

		var chart = new ApexCharts(document.querySelector(apexChart), options);
		chart.render();
	}



    /////////////////////////////////////////////////////////////////////////////////

    var newDonations            = {{$data['new_donations_count']}};
    var pichedupDonations       = {{$data['pichedup_donations_count']}};
    var deliveredDonations      = {{$data['delivered_donations_count']}};
    var notPickedupDonations    = {{$data['not_ickedup_donations_count']}};
    var rescheduleDonations     = {{$data['reschedule_donations_count']}};
    var inProgressDonations     = {{$data['inProgress_donations_count']}};

	var _demo12 = function () {
		const apexChart = "#chart_12";
		var options = {
			series: [newDonations, pichedupDonations, deliveredDonations, notPickedupDonations, rescheduleDonations, inProgressDonations],
			chart: {
				width: 380,
				type: 'pie',
			},
			labels: ['New', 'Piched Up', 'Delivered', 'Not Picked Up', 'Reschedule', 'InProgress'],
			responsive: [{
				breakpoint: 480,
				options: {
					chart: {
						width: 200
					},
					legend: {
						position: 'bottom'
					}
				}
			}],
			colors: [primary, warning, success, danger, info, success]
		};

		var chart = new ApexCharts(document.querySelector(apexChart), options);
		chart.render();
	}

	return {
		// public functions
		init: function () {

			_demo11();
			_demo12();

		}
	};
}();
</script>
@endsection
