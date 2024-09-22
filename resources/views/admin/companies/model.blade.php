  		<!-- Add Project-->
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
                        <input type="hidden" name="company_id" id="projects_id">
                        @csrf
                        @honeypot
                        <div class="modal-body">
                            <div class="form-group test">
                                <label class="form-label">{{trans('langconvert.admindashboard.companyname')}} <span class="text-red">*</span></label>
                                <input type="text" class="form-control" name="name" id="name">
                                <span id="nameError" class="text-danger alert-message"></span>
                            </div>
                            <div class="form-group {{ $errors->has('country_id') ? ' has-danger' : '' }}">
                                <label for="theme_color-input" class="form-label">{{trans('langconvert.admindashboard.countrieslist')}}</label>
                                <select id="country" class="form-control select2 @error('country_id') is-invalid @enderror" data-placeholder="Select Country" name="country_id">
                                    <option label="Select Country"></option>
                                    @foreach($countries as $country)
                                    <option  value="{{$country->id}}"  @if(isset($sla) && $sla->country_id == $country->id) selected @endif > {{$country->name}} - {{$country->code}}</option>
                                    @endforeach
                                </select>
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