@extends('layouts.backend')

@section('title', __('Payment Methods'))

@section('content')
<!-- main Section -->
<div class="main-body">
	<div class="container-fluid">
		@php $vipc = vipc(); @endphp
		@if($vipc['bkey'] == 0)
		@include('backend.partials.vipc')
		@else
		<div class="row mt-25">
			<div class="col-lg-12">
				<div class="card">
					<div class="card-header">
						<div class="row">
							<div class="col-lg-6">
								<span>{{ __('Payment Methods') }}</span>
							</div>
							<div class="col-lg-6"></div>
						</div>
					</div>
					<div class="card-body">
						<div class="row">
							<div class="col-lg-12">
								<div class="float-right">
									<a onClick="onListPanel()" href="javascript:void(0);" class="btn warning-btn btn-list float-right dnone"><i class="fa fa-reply"></i> {{ __('Back to List') }}</a>
								</div>
							</div>
						</div>
						<div class="row">
							<div class="col-lg-12">
								<!--/Data grid-->
								<div id="list-panel">
									<div class="table-responsive">
										<table class="table table-borderless table-theme" style="width:100%;">
											<tbody>
												<tr>
													<td class="text-left" width="70%">{{ __('Stripe') }}</td>
													<td class="text-left" width="25%">
														@if($stripe_data_list['isenable'] == 1)
														<span class="enable_btn">{{ __('Active') }}</span>
														@else
														<span class="disable_btn">{{ __('Inactive') }}</span>
														@endif
													</td>
													<td class="text-center" width="5%">
														<div class="btn-group action-group">
															<a class="action-btn" href="javascript:void(0);" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><i class="fa fa-ellipsis-v"></i></a>
															<div class="dropdown-menu dropdown-menu-right">
																<a onclick="onEdit(1)" class="dropdown-item" href="javascript:void(0);">{{ __('Edit') }}</a>
															</div>
														</div>
													</td>
												</tr>
												<tr>
													<td class="text-left" width="70%">{{ __('Paypal') }}</td>
													<td class="text-left" width="25%">
														@if($paypal_data_list['isenable_paypal'] == 1)
														<span class="enable_btn">{{ __('Active') }}</span>
														@else
														<span class="disable_btn">{{ __('Inactive') }}</span>
														@endif
													</td>
													<td class="text-center" width="5%">
														<div class="btn-group action-group">
															<a class="action-btn" href="javascript:void(0);" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><i class="fa fa-ellipsis-v"></i></a>
															<div class="dropdown-menu dropdown-menu-right">
																<a onclick="onEdit(4)" class="dropdown-item" href="javascript:void(0);">{{ __('Edit') }}</a>
															</div>
														</div>
													</td>
												</tr>
												<tr>
													<td class="text-left" width="70%">{{ __('Razorpay') }}</td>
													<td class="text-left" width="25%">
														@if($razorpay_data_list['isenable_razorpay'] == 1)
														<span class="enable_btn">{{ __('Active') }}</span>
														@else
														<span class="disable_btn">{{ __('Inactive') }}</span>
														@endif
													</td>
													<td class="text-center" width="5%">
														<div class="btn-group action-group">
															<a class="action-btn" href="javascript:void(0);" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><i class="fa fa-ellipsis-v"></i></a>
															<div class="dropdown-menu dropdown-menu-right">
																<a onclick="onEdit(5)" class="dropdown-item" href="javascript:void(0);">{{ __('Edit') }}</a>
															</div>
														</div>
													</td>
												</tr>
												<tr>
													<td class="text-left" width="70%">{{ __('Mollie') }}</td>
													<td class="text-left" width="25%">
														@if($mollie_data_list['isenable_mollie'] == 1)
														<span class="enable_btn">{{ __('Active') }}</span>
														@else
														<span class="disable_btn">{{ __('Inactive') }}</span>
														@endif
													</td>
													<td class="text-center" width="5%">
														<div class="btn-group action-group">
															<a class="action-btn" href="javascript:void(0);" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><i class="fa fa-ellipsis-v"></i></a>
															<div class="dropdown-menu dropdown-menu-right">
																<a onclick="onEdit(6)" class="dropdown-item" href="javascript:void(0);">{{ __('Edit') }}</a>
															</div>
														</div>
													</td>
												</tr>
												<tr>
													<td class="text-left" width="70%">{{ __('Cash on Delivery (COD)') }}</td>
													<td class="text-left" width="25%">
														@if($cod_data_list['isenable'] == 1)
														<span class="enable_btn">{{ __('Active') }}</span>
														@else
														<span class="disable_btn">{{ __('Inactive') }}</span>
														@endif
													</td>
													<td class="text-center" width="5%">
														<div class="btn-group action-group">
															<a class="action-btn" href="javascript:void(0);" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><i class="fa fa-ellipsis-v"></i></a>
															<div class="dropdown-menu dropdown-menu-right">
																<a onclick="onEdit(2)" class="dropdown-item" href="javascript:void(0);">{{ __('Edit') }}</a>
															</div>
														</div>
													</td>
												</tr>
												<tr>
													<td class="text-left" width="70%">{{ __('Bank Transfer') }}</td>
													<td class="text-left" width="25%">
														@if($bank_data_list['isenable'] == 1)
														<span class="enable_btn">{{ __('Active') }}</span>
														@else
														<span class="disable_btn">{{ __('Inactive') }}</span>
														@endif
													</td>
													<td class="text-center" width="5%">
														<div class="btn-group action-group">
															<a class="action-btn" href="javascript:void(0);" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><i class="fa fa-ellipsis-v"></i></a>
															<div class="dropdown-menu dropdown-menu-right">
																<a onclick="onEdit(3)" class="dropdown-item" href="javascript:void(0);">{{ __('Edit') }}</a>
															</div>
														</div>
													</td>
												</tr>
											</tbody>
										</table>
									</div>
								</div>
								<!--/Data grid-->


								<!--/Cash on Delivery (COD) Form-->
								<div id="form-panel-2" class="dnone">
									<form novalidate="" data-validate="parsley" id="cod_formId">
										<div class="row mb-10">
											<div class="col-lg-8">
												<h5>{{ __('Cash on Delivery (COD)') }}</h5>
											</div>
										</div>
										<div class="row">
											<div class="col-lg-8">
												<div class="tw_checkbox checkbox_group">
													<input id="isenable_cod" name="isenable_cod" type="checkbox" {{ $cod_data_list['isenable'] == 1 ? 'checked' : '' }}>
													<label for="isenable_cod">{{ __('Active/Inactive') }}</label>
													<span></span>
												</div>
												<div class="form-group">
													<label for="description">{{ __('Description') }}</label>
													<textarea name="description" class="form-control" rows="3">{{ $cod_data_list['description'] }}</textarea>
												</div>
											</div>
											<div class="col-lg-4"></div>
										</div>
										<div class="row tabs-footer mt-15">
											<div class="col-lg-12">
												<a id="submit-form-cod" href="javascript:void(0);" class="btn blue-btn mr-10">{{ __('Save') }}</a>
											</div>
										</div>
									</form>
								</div>
								<!--/Cash on Delivery (COD) Form-->

								<!--/Bank Transfer Form-->
								<div id="form-panel-3" class="dnone">
									<form novalidate="" data-validate="parsley" id="bank_formId">
										<div class="row mb-10">
											<div class="col-lg-8">
												<h5>{{ __('Bank Transfer') }}</h5>
											</div>
										</div>
										<div class="row">
											<div class="col-lg-8">
												<div class="tw_checkbox checkbox_group">
													<input id="isenable_bank" name="isenable_bank" type="checkbox" {{ $bank_data_list['isenable'] == 1 ? 'checked' : '' }}>
													<label for="isenable_bank">{{ __('Active/Inactive') }}</label>
													<span></span>
												</div>
												<div class="form-group">
													<label for="description">{{ __('Description') }}</label>
													<textarea name="description" class="form-control" rows="3">{{ $bank_data_list['description'] }}</textarea>
												</div>
											</div>
											<div class="col-lg-4"></div>
										</div>
										<div class="row tabs-footer mt-15">
											<div class="col-lg-12">
												<a id="submit-form-bank" href="javascript:void(0);" class="btn blue-btn mr-10">{{ __('Save') }}</a>
											</div>
										</div>
									</form>
								</div>
								<!--/Bank Transfer Form-->
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
		@endif
	</div>
</div>
<!-- /main Section -->
@endsection

@push('scripts')
<script type="text/javascript">
var TEXT = [];
	TEXT['Do you really want to edit this record'] = "{{ __('Do you really want to edit this record') }}";
</script>
<script src="{{asset('public/backend/pages/payment-gateway.js')}}"></script>
@endpush