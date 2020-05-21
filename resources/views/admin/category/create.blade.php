@extends('admin.layouts.master')
@section('content')
<div class="content">

				<!-- Vertical form options -->
				<div class="row">
					<div class="col-md-6">

						<!-- Basic layout-->
						<div class="card">
							<div class="card-header header-elements-inline">
								<h5 class="card-title">Category Add</h5>
								<div class="header-elements">
									<div class="list-icons">
				                		<a class="list-icons-item" data-action="collapse"></a>
				                		<a class="list-icons-item" data-action="reload"></a>
				                		
				                	</div>
			                	</div>
							</div>

							<div class="card-body">
								<form action="{{url('admin/category/create')}}" method="POST" enctype="multipart/form-data">
                                    @csrf
									<div class="form-group">
										<label>Category Name:</label>
										<input type="text" name="name" class="form-control" placeholder="Eugene Kopyov">
									</div>

									<div class="form-group">
										<label>Parent Category:</label>
										<select name="parent_id" class="form-control  form-control-select2" data-fouc>

												<option value="0">Alaska</option>
												<option value="1">Hawaii</option>

										</select>
									</div>
                                    <div class="form-group">
                                
                                     <input type="checkbox" id="featured" name="featured"/>Featured Category
                                  
									</div>


									<div class="form-group">
										<label>Image:</label>
										<input type="file" class="form-input-styled" data-fouc name="image">
										<span class="form-text text-muted">Accepted formats: png, jpg. Max file size 2Mb</span>
									</div>

									<div class="form-group">
										<label>Description:</label>
										<textarea rows="5" cols="5" name="description" class="form-control" placeholder="Enter  Description here"></textarea>
									</div>

									<div class="text-right">
										<button type="submit" class="btn btn-primary">Submit form <i class="icon-paperplane ml-2"></i></button>
									</div>
								</form>
							</div>
						</div>
						<!-- /basic layout -->

					</div>
				</div>
				<!-- /vertical form options -->


			</div>
@endsection
@section('footerScripts')
    @parent
    <script>

        $(document).ready(function(){
          $('.form-control-select2').select2();

          $('.form-input-styled').uniform({
            fileButtonClass: 'action btn bg-pink-400'
        });
        });


    </script>
@stop