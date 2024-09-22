
          <div class="modal fade"  id="addtestimonial" aria-hidden="true">
			<div class="modal-dialog" role="document">
				<div class="modal-content">
					<div class="modal-header">
						<h5 class="modal-title" ></h5>
						<button  class="close" data-bs-dismiss="modal" aria-label="Close">
							<span aria-hidden="true">×</span>
						</button>
					</div>
					<form method="POST" enctype="multipart/form-data" id="projects_form" name="projects_form">
                        <input type="hidden" name="projects_id" id="projects_id">
                        @csrf
                        @honeypot
                        <div class="modal-body">
                            <div class="form-group">
                                <label class="form-label">{{trans('langconvert.admindashboard.projectname')}} <span class="text-red">*</span></label>
                                <input type="text" class="form-control" name="name" id="name">
                                <span id="nameError" class="text-danger alert-message"></span>
                            </div>
                            <div class="form-group {{ $errors->has('product_id') ? ' has-danger' : '' }}">
                                <label for="theme_color-input" class="form-label">{{trans('langconvert.admindashboard.product')}}</label>
                                <select id="product_id" class="form-control select2 @error('product_id') is-invalid @enderror" data-placeholder="Select Product" name="product_id">
                                    <option label="Select Product"></option>
                                    @foreach($products as $product)
                                    <option  value="{{$product->id}}"> {{$product->name}}</option>
                                    @endforeach
                                </select>
                            </div>

                            <div class="form-group {{ $errors->has('company_id') ? ' has-danger' : '' }}">
                                <label for="theme_color-input" class="form-label">{{trans('langconvert.admindashboard.company')}}</label>
                                <select id="company_id" class="form-control select2 @error('company_id') is-invalid @enderror" data-placeholder="Select Company" name="company_id">
                                    <option label="Select Company"></option>
                                    @foreach($companies as $company)
                                    <option  value="{{$company->id}}"> {{$company->name}}</option>
                                    @endforeach
                                </select>
                            </div>

                            <div class="form-group {{ $errors->has('sla_id') ? ' has-danger' : '' }}">
                                <label for="theme_color-input" class="form-label">{{trans('langconvert.adminmenu.sla')}}</label>
                                <select id="sla_id" class="form-control select2 @error('sla_id') is-invalid @enderror" data-placeholder="Select SLA" name="sla_id">
                                    <option label="Select SLA"></option>
                                    @foreach($sla as $sl)
                                    <option  value="{{$sl->id}}"> {{$sl->name}}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="form-group {{ $errors->has('agent_id') ? ' has-danger' : '' }}" style="margin-bottom:8px">
                                <label for="theme_color-input" class="form-label">Select Agent</label>
                                <select id="agent_id" class="form-control select2 @error('agent_id') is-invalid @enderror" data-placeholder="Select Agent" name="agent_id">
                                    <option label="Select Agent"></option>
                                    @foreach($agents as $agent)
                                    <option  value="{{$agent->id}}"> {{$agent->name}}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="form-check" style="left: 5px; margin-bottom:1rem">
                                <label class="form-check-label">
                                <input class="form-check-input" type="checkbox" id="auto_assign" name="auto_assign" value="1">
                                Auto Assign
                            </label>
                              </div>
                            <div class="form-group {{ $errors->has('start_date') ? ' has-danger' : '' }}">
                                <label class="form-label">{{trans('langconvert.admindashboard.start_date')}} <span class="text-red">*</span></label>
                                <input type="date" class="form-control" value="{{date('Y-m-d')}}" name="start_date" id="start_date" required>
                            </div>
                            <div class="form-group {{ $errors->has('end_date') ? ' has-danger' : '' }}">
                                <label class="form-label">{{trans('langconvert.admindashboard.end_date')}} <span class="text-red">*</span></label>
                                <input type="date" class="form-control" value="{{date('Y-m-d')}}" name="end_date" id="end_date" required>
                                <span id="dateError" class="text-danger alert-message"></span>
                            </div>

                        </div>
                        <div class="modal-footer">
                            <a href="#" class="btn btn-outline-danger" data-bs-dismiss="modal">{{trans('langconvert.admindashboard.close')}}</a>
                            <button type="submit" class="btn btn-secondary" id="btnsave"  >{{trans('langconvert.admindashboard.save')}}</button>
                        </div>
                    </form>
				</div>
			</div>
		</div>
		<!-- End  Add Project  -->
