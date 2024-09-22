@extends('layouts.adminmaster')

		@section('styles')

		<!-- INTERNAL Data table css -->
		<link href="{{asset('assets/plugins/datatable/css/dataTables.bootstrap5.min.css')}}?v=<?php echo time(); ?>" rel="stylesheet" />
		<link href="{{asset('assets/plugins/datatable/responsive.bootstrap5.css')}}?v=<?php echo time(); ?>" rel="stylesheet" />

		<!-- INTERNAL Sweet-Alert css -->
		<link href="{{asset('assets/plugins/sweet-alert/sweetalert.css')}}?v=<?php echo time(); ?>" rel="stylesheet" />

		<!-- INTERNAL Multiselect css -->
		<link href="{{asset('assets/plugins/multipleselect/multiple-select.css')}}?v=<?php echo time(); ?>" rel="stylesheet" />
		<link href="{{asset('assets/plugins/multi/multi.min.css')}}?v=<?php echo time(); ?>" rel="stylesheet" />

		@endsection

							@section('content')

							<!--Page header-->
							<div class="page-header d-xl-flex d-block">
								<div class="page-leftheader">
									<h4 class="page-title"><span class="font-weight-normal text-muted ms-2">{{trans('langconvert.adminmenu.products')}}</span></h4>
								</div>
							</div>
							<!--End Page header-->

							<!-- Project List-->
							<div class="col-xl-12 col-lg-12 col-md-12">
								<div class="card ">
									<div class="card-header border-0 d-md-max-block">
										<h4 class="card-title mb-md-max-2">{{trans('langconvert.adminmenu.products')}}</h4>
										<div class="card-options d-md-max-block">
											@can('Project Create')

											<a href="javascript:void(0)" class="btn btn-success me-3 mb-md-max-2 mw-10" id="create-new-projects">{{trans('langconvert.admindashboard.addproducts')}}</a>
											@endcan

										</div>
									</div>
									<div class="card-body" >
										<div class="table-responsive spruko-delete">
											@can('Project Delete')

											<button id="massdelete" class="btn btn-outline-light btn-sm mb-4 data-table-btn"><i class="fe fe-trash"></i> {{trans('langconvert.admindashboard.delete')}}</button>
											@endcan

											<table class="table table-vcenter text-nowrap table-bordered table-striped ticketdeleterow w-100" id="support-articlelists">
												<thead>
													<tr>
														<th >{{trans('langconvert.admindashboard.id')}}</th>
														<th  width="10">{{trans('langconvert.admindashboard.slNo')}}</th>
														@can('Project Delete')

														<th width="10" >
															<input type="checkbox"  id="customCheckAll">
															<label  for="customCheckAll"></label>
														</th>
														@endcan
														@cannot('Project Delete')

														<th width="10" >
															<input type="checkbox"  id="customCheckAll" disabled>
															<label  for="customCheckAll"></label>
														</th>
														@endcannot

														<th >{{trans('langconvert.admindashboard.name')}}</th>
														<th >{{trans('langconvert.admindashboard.actions')}}</th>
													</tr>
												</thead>
											</table>
										</div>
									</div>
								</div>
							</div>
							<!-- End Project List-->

							@endsection
	@section('modal')

    @include('admin.products.model')


			<!-- INTERNAL Multiselect Js -->
            <script src="{{asset('assets/plugins/multipleselect/multiple-select.js')}}?v=<?php echo time(); ?>"></script>
            <script src="{{asset('assets/plugins/multipleselect/multi-select.js')}}?v=<?php echo time(); ?>"></script>
	@endsection

		@section('scripts')


		<!-- INTERNAL Vertical-scroll js-->
		<script src="{{asset('assets/plugins/vertical-scroll/jquery.bootstrap.newsbox.js')}}?v=<?php echo time(); ?>"></script>

		<!-- INTERNAL Data tables -->
		<script src="{{asset('assets/plugins/datatable/js/jquery.dataTables.min.js')}}?v=<?php echo time(); ?>"></script>
		<script src="{{asset('assets/plugins/datatable/js/dataTables.bootstrap5.js')}}?v=<?php echo time(); ?>"></script>
		<script src="{{asset('assets/plugins/datatable/dataTables.responsive.min.js')}}?v=<?php echo time(); ?>"></script>
		<script src="{{asset('assets/plugins/datatable/responsive.bootstrap5.min.js')}}?v=<?php echo time(); ?>"></script>
        <script src="{{asset('assets/js/select2.js')}}?v=<?php echo time(); ?>"></script>


		<!-- INTERNAL Sweet-Alert js-->
		<script src="{{asset('assets/plugins/sweet-alert/sweetalert.min.js')}}?v=<?php echo time(); ?>"></script>

        <script type="text/javascript">

			"use strict";

			(function($)  {

				// Variables
				var SITEURL = '{{url('')}}';

				// Csrf Field
				$.ajaxSetup({
					headers: {
						'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
					}
				});
                $(window).on('shown.bs.modal', function() {
					$(".select2").select2({
    dropdownParent: $("#addtestimonial")
  });
				});


				// Datatable
				$('#support-articlelists').DataTable({
					processing: true,
					serverSide: true,
					ajax: {
						url: "{{ url('/admin/products') }}"
					},
					columns: [
						{data: 'id', name: 'id', 'visible': false},
						{data: 'DT_RowIndex', name: 'DT_RowIndex', orderable: false,searchable: false},
						{data: 'checkbox', name: 'checkbox', orderable: false,searchable: false},
						{ data: 'name', name: 'name' },
						{data: 'action', name: 'action', orderable: false},
					],
					order:[],
					responsive: true,
					drawCallback: function () {
						var tooltipTriggerList = [].slice.call(document.querySelectorAll('[data-bs-toggle="tooltip"]'))
						var tooltipList = tooltipTriggerList.map(function (tooltipTriggerEl) {
							return new bootstrap.Tooltip(tooltipTriggerEl)
						});
						$('.form-select').select2({
							minimumResultsForSearch: Infinity,
							width: '100%'
						});
						$('#customCheckAll').prop('checked', false);
						$('.checkall').on('click', function(){
							if($('.checkall:checked').length == $('.checkall').length){
								$('#customCheckAll').prop('checked', true);
							}else{
								$('#customCheckAll').prop('checked', false);
							}
						});
					},

				});


				/*  When user click add project button */
				$('#create-new-projects').on('click', function () {
					$('#btnsave').val("create-product");
					$('#projects_id').val('');
					$('#projects_form').trigger("reset");
					$('.modal-title').html("{{trans('langconvert.admindashboard.addnewproduct')}}");
					$('#addtestimonial').modal('show');
				});


				/* When click edit project */
				$('body').on('click', '.edit-testimonial', function () {
					var product_id = $(this).data('id');
					$.get('products/' + product_id , function (data) {
                        console.log(data);
						$('#nameError').html('');
						$('.modal-title').html("{{trans('langconvert.admindashboard.editproduct')}}");
						$('#btnsave').val("edit-project");
						$('#addtestimonial').modal('show');
						$('#projects_id').val(data.id);
						$('#name').val(data.name);
                        $('#agent_id').val(data.agent_id);
					})
				});

				// Delete Project
				$('body').on('click', '#delete-testimonial', function () {
					var _id = $(this).data("id");
						swal({
							title: `{{trans('langconvert.admindashboard.wanttocontinue')}}`,
							text: "{{trans('langconvert.admindashboard.eraserecordspermanently')}}",
							icon: "warning",
							buttons: true,
							dangerMode: true,
						})
						.then((willDelete) => {
							if (willDelete) {
								$.ajax({
									type: "get",
									url: SITEURL + "/admin/products/delete/"+_id,
									success: function (data) {
									var oTable = $('#support-articlelists').dataTable();
									oTable.fnDraw(false);
									toastr.error(data.error);
									},
									error: function (data) {
									console.log('Error:', data);
									}
								});
							}
						});
				});

				//Mass Delete
				$('body').on('click', '#massdelete', function () {
					var id = [];
					$('.checkall:checked').each(function(){
						id.push($(this).val());
					});
					if(id.length > 0){
						swal({
							title: `{{trans('langconvert.admindashboard.wanttocontinue')}}`,
							text: "{{trans('langconvert.admindashboard.eraserecordspermanently')}}",
							icon: "warning",
							buttons: true,
							dangerMode: true,
						})
						.then((willDelete) => {
							if (willDelete) {
								$.ajax({
									url:"{{ url('admin/massproduct/delete')}}",
									method:"GET",
									data:{id:id},
									success:function(data)
									{
										$('#support-articlelists').DataTable().ajax.reload();
										toastr.error(data.error);
									},
									error:function(data){

									}
								});
							}
						});
					}else{
						toastr.error('{{trans('langconvert.functions.checkboxselect')}}');
					}
				});

				// Project submit button
				$('body').on('submit', '#projects_form', function (e) {
					e.preventDefault();
					var actionType = $('#btnsave').val();
					var fewSeconds = 2;
					$('#btnsave').html('Sending..');
					$('#btnsave').prop('disabled', true);
						setTimeout(function(){
							$('#btnsave').prop('disabled', false);
						}, fewSeconds*1000);
					var formData = new FormData(this);
					$.ajax({
						type:'POST',
						url: SITEURL + "/admin/products/create",
						data: formData,
						cache:false,
						contentType: false,
						processData: false,
						success: (data) => {

							if(data.errors){
								$('#nameError').html('');
								$('#nameError').html(data.errors.name);
								$('#btnsave').html('Save Changes');
							}
							if(data.success){
								$('#nameError').html('');
								$('#projects_form').trigger("reset");
								$('#addtestimonial').modal('hide');
								$('#btnsave').html('Save Changes');
								var oTable = $('#support-articlelists').dataTable();
								oTable.fnDraw(false);
								toastr.success(data.success);
							}
						},
						error: function(data){
							$('#nameError').html('');
							toastr.error('Product Name is Already Exists');
							$('#btnsave').html('Save Changes');
						}
					});


				});

				//Checkbox checkall
				$('#customCheckAll').on('click', function() {
					$('.checkall').prop('checked', this.checked);
				});

			})(jQuery);


		</script>

		@endsection
