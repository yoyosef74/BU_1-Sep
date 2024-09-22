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
                        <input type="hidden" name="product_id" id="projects_id">
                        @csrf
                        @honeypot
                        <div class="modal-body">
                            <div class="form-group test">
                                <label class="form-label">{{trans('langconvert.admindashboard.productname')}} <span class="text-red">*</span></label>
                                <input type="text" class="form-control" name="name" id="name">
                                <span id="nameError" class="text-danger alert-message"></span>
                            </div>

                            <div class="form-group {{ $errors->has('agent_id') ? ' has-danger' : '' }}" style="margin-bottom:8px">
                                <label for="theme_color-input" class="form-label">Project Manager <span class="text-red">*</span></label>
                                <select id="agent_id" class="form-control select2 @error('agent_id') is-invalid @enderror" data-placeholder="Select Project Manager" name="agent_id">
                                    <option label="Project Manager"></option>
                                    @foreach($agents as $agent)
                                    <option  value="{{$agent->id}}"> {{$agent->name}}</option>
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
