@extends('layouts.adminmaster')

@section('styles')

<!-- INTERNAl Tag css -->
<link href="{{asset('assets/plugins/taginput/bootstrap-tagsinput.css')}}?v=<?php echo time(); ?>" rel="stylesheet" />

@endsection

@section('content')


<!--Page header-->
<div class="page-header d-xl-flex d-block">
	<div class="page-leftheader">
		<h4 class="page-title"><span
				class="font-weight-normal text-muted ms-2">{{trans('langconvert.admindashboard.employee')}}</span></h4>
	</div>
</div>
<!--End Page header-->

<!-- Employee Create -->
<div class="col-xl-12 col-lg-12 col-md-12">
	<div class="card ">
		<div class="card-header border-0">
			<h4 class="card-title">{{trans('langconvert.adminmenu.createemployee')}}</h4>
		</div>
		<form method="POST" action="{{url('/admin/agent')}}" enctype="multipart/form-data">
			<div class="card-body">
				@csrf

				@honeypot
				<div class="row">
					<div class="col-sm-6 col-md-6">
						<div class="form-group">
							<label class="form-label">{{trans('langconvert.admindashboard.firstname')}} <span
									class="text-red">*</span></label>
							<input type="text" class="form-control @error('firstname') is-invalid @enderror"
								name="firstname" value="{{old('firstname')}}">
							@error('firstname')

							<span class="invalid-feedback" role="alert">
								<strong>{{ $message }}</strong>
							</span>
							@enderror

						</div>
					</div>
					<div class="col-sm-6 col-md-6">
						<div class="form-group">
							<label class="form-label">{{trans('langconvert.admindashboard.lastname')}} <span
									class="text-red">*</span></label>
							<input type="text" class="form-control @error('lastname') is-invalid @enderror"
								name="lastname" value="{{old('lastname')}}">
							@error('lastname')

							<span class="invalid-feedback" role="alert">
								<strong>{{ $message }}</strong>
							</span>
							@enderror

						</div>
					</div>
					<div class="col-sm-6 col-md-6">
						<div class="form-group">
							<label class="form-label">{{trans('langconvert.admindashboard.role')}} <span
									class="text-red">*</span></label>
							<select
								class="form-control select2-show-search  select2 @error('role') is-invalid @enderror"
								data-placeholder="Select Role" name="role">
								<option label="Select Role"></option>
								@foreach($roles as $role)
								@if($role->name != 'superadmin')

								<option value="{{$role->name}}" {{ old('role')==$role->name ? "selected" : "" }}>
									{{$role->name}}</option>
								@endif
								@endforeach

							</select>
							@error('role')

							<span class="invalid-feedback" role="alert">
								<strong>{{ $message }}</strong>
							</span>
							@enderror

						</div>
					</div>
					<div class="col-sm-6 col-md-6">
						<div class="form-group">
							<label class="form-label">{{trans('langconvert.admindashboard.employeeiD')}} <span
									class="text-red">*</span></label>
							<input type="text" class="form-control @error('empid') is-invalid @enderror"
								placeholder="EMPID-001" name="empid" value="{{old('empid')}}">
							@error('empid')

							<span class="invalid-feedback" role="alert">
								<strong>{{ $message }}</strong>
							</span>
							@enderror

						</div>
					</div>
					<div class="col-sm-6 col-md-6">
						<div class="form-group">
							<label class="form-label">{{trans('langconvert.admindashboard.mobilenumber')}} </label>
							<input type="text" class="form-control @error('phone') is-invalid @enderror" name="phone"
								value="{{old('phone')}}">
							@error('phone')

							<span class="invalid-feedback" role="alert">
								<strong>{{ $message }}</strong>
							</span>
							@enderror

						</div>
					</div>
					<div class="col-sm-6 col-md-6">
						<div class="form-group">
							<label class="form-label">{{trans('langconvert.admindashboard.emailaddress')}} <span
									class="text-red">*</span></label>
							<input type="email" class="form-control @error('email') is-invalid @enderror" name="email"
								value="{{old('email')}}">
							@error('email')

							<span class="invalid-feedback" role="alert">
								<strong>{{ $message }}</strong>
							</span>
							@enderror

						</div>
					</div>
					<div class="col-sm-6 col-md-6">
						<div class="form-group">
							<label class="form-label">{{trans('langconvert.admindashboard.password')}} <small
									class="text-muted"><i>{{trans('langconvert.admindashboard.copythepassword')}}</i></small></label>
							<div class="input-group mb-4">
								<div class="input-group">
									<a href="javascript:void(0)" class="input-group-text">
										<i class="fe fe-eye" aria-hidden="true"></i>
									</a>
									<input class="form-control @error('password') is-invalid @enderror" type="text"
										name="password" value="{{str_random(10)}}">
									@error('password')

									<span class="invalid-feedback" role="alert">
										<strong>{{ $message }}</strong>
									</span>
									@enderror

								</div>
							</div>
						</div>
					</div>
					{{-- <div class="col-sm-6 col-md-6">
						<div class="form-group">
							<label class="form-label">{{trans('langconvert.admindashboard.languages')}}</label>
							<input type="text" class="form-control @error('languages') is-invalid @enderror"
								value="{{old('languages')}}" name="languages" data-role="tagsinput" />
							@error('languages')

							<span class="invalid-feedback" role="alert">
								<strong>{{ $message }}</strong>
							</span>
							@enderror

						</div>
					</div>
					<div class="col-sm-6 col-md-6">
						<div class="form-group">
							<label class="form-label">{{trans('langconvert.admindashboard.skills')}}</label>
							<input type="text" class="form-control @error('skills') is-invalid @enderror"
								value="{{old('skills')}}" name="skills" data-role="tagsinput" />
							@error('skills')

							<span class="invalid-feedback" role="alert">
								<strong>{{ $message }}</strong>
							</span>
							@enderror

						</div>
					</div> --}}
				</div>
				<div class="row">
					<div class="col-md-6 col-sm-6">
						<div class="form-group">
							<label class="form-label">Category</label>
							<select
								class="form-control select2-show-search  select2 @error('category') is-invalid @enderror"
								data-placeholder="Select Category" name="category[]" id="category" multiple>
								<option label="Select Category"></option>
								@foreach ($categories as $category)
								<option value="{{ $category->id }}" @if(old('category')==$category->id) selected
									@endif>{{
									$category->name }}</option>
								@endforeach
							</select>

						</div>
					</div>

					<div class="col-md-6 col-sm-6">
						<div class="form-group" id="selectssSubCategory">
							<label class="form-label">Sub Category</label>

							<select class="form-control select2-show-search  select2"
								data-placeholder="Select SubCategory" name="subcategory[]" id="sub_categroy" multiple>
								<option label="Select Category"></option>
								@foreach ($sub_categories as $sub_category)
								<option class="sub_cat_opt" data-category="{{$sub_category->subcategorylist[0]->category_id}}" value="{{ $sub_category->id }}" @if(old('sub_category')==$sub_category->id) selected
									@endif>{{
									$sub_category->subcategoryname }}</option>
								@endforeach
							</select>
						</div>

					</div>

					<div class="col-md-6 col-sm-6">
						<div class="form-group">
							<label class="form-label">Products</label>
							<select
								class="form-control select2-show-search  select2 @error('category') is-invalid @enderror"
								data-placeholder="Select product" name="product[]" id="product" multiple>
								<option label="Select Product"></option>
								@foreach ($products as $product)
								<option value="{{ $product->id }}" @if(old('product')==$product->id) selected @endif>{{
									$product->name }}</option>
								@endforeach

							</select>

						</div>

					</div>

					<div class="col-md-6 col-sm-6">
						<div class="form-group">
							<label class="form-label">Projects</label>
							<select
								class="form-control select2-show-search  select2 @error('project') is-invalid @enderror"
								data-placeholder="Select Project" name="project[]" id="project" multiple>
								<option label="Select Project"></option>
								@foreach ($projects as $project)
								<option class="project_opt" data-product={{$project->product_id}} value="{{ $project->id
									}}"
									@if(old('project')==$project->id) selected @endif>{{
									$project->name }}</option>
								@endforeach

							</select>
						</div>
					</div>
				</div>
			</div>
			<div class="col-md-12 card-footer">
				<div class="form-group float-end">
					<input type="submit" class="btn btn-secondary"
						value="{{trans('langconvert.adminmenu.createemployee')}}"
						onclick="this.disabled=true;this.form.submit();">
				</div>
			</div>
		</form>
	</div>
</div>
<!-- End Employee Create -->
<style>
	.select2-results__option--disabled {
		display: none;
	}
</style>
@endsection

@section('scripts')

<!--File BROWSER -->
<script src="{{asset('assets/js/form-browser.js')}}"></script>

<!-- INTERNAL Vertical-scroll js-->
<script src="{{asset('assets/plugins/vertical-scroll/jquery.bootstrap.newsbox.js')}}"></script>
<script src="{{asset('assets/js/select2.js')}}"></script>

<!-- INTERNAL Index js-->
<script src="{{asset('assets/js/support/support-sidemenu.js')}}"></script>

<!-- INTERNAL TAG js-->
<script src="{{asset('assets/plugins/taginput/bootstrap-tagsinput.js')}}"></script>
<script>
	$(".sub_cat_opt").prop('disabled',true);
	$(".project_opt").prop('disabled',true);

	$('#category').on('change',function(e) {
		var selected = $(e.target).val();
		var len = selected.length;
		$(".sub_cat_opt").prop('disabled',true);
for (var i = 0; i < len; i++) {
$("#sub_categroy option[data-category='"+selected[i]+"']").prop('disabled',false);
}
						});

						$('#product').on('change',function(e) {
							var selected = $(e.target).val();
							var len = selected.length;

$(".project_opt").prop('disabled',true);
for (var i = 0; i < len; i++) {
$("#project option[data-product='"+selected[i]+"']").prop('disabled',false);
}
						});
						

						$('#category').on("select2:unselect", function() {
							$("#sub_categroy").val("").trigger('change');
});
$('#product').on("select2:unselect", function() {
							$("#project").val("").trigger('change');
});
</script>
@endsection
