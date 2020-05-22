@extends('admin.layouts.master')
@section('content')
<div class="content">

				<!-- Vertical form options -->
				<div class="row">
					<div class="col-md-6 offset-md-3">
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
									<input type="hidden" value="{{isset($category->id)?$category->id:''}}" name="id"/>
									<div class="form-group">
										<label>Category Name:</label>
										<input type="text" name="name" class="form-control"  value="{{isset($category->name)?$category->name:''}}" placeholder="Enter Name">
									</div>
									<div class="form-group">
										<label>Parent Category:</label>
										<select name="parent_id" class="form-control  form-control-select2" data-fouc>
										<option value="">Select a Parent Category</option>
                                        @foreach($parent_categories as $cate)
                                            <option value="{{$cate->id}}" @isset($category->id){{$category->id==$cate->id?'selected':''}}@endisset> {{ $cate->name }} </option>
                                        @endforeach
										</select>
									</div>
                                    <div class="form-group">

                                     <input type="checkbox" value="{{isset($category->featured)?$category->featured:1}}" @isset($category->featured) {{$category->featured==1?'checked':''}} @endisset id="featured" name="featured"/>Featured Category

									</div>


									<div class="form-group">
										<label>Image:</label>
										<input type="file" class="form-input-styled" data-fouc name="image"  value="{{isset($category->image)?$category->image:''}}">
										@if(isset($category->image))
                               <img src="{{asset($category->image)}}" alt="{{$category->name}}"  style="height: 100px;width: 100px;">
                                   @endif
										<span class="form-text text-muted">Accepted formats: png, jpg. Max file size 2Mb</span>
									</div>

									<div class="form-group">
										<label>Description:</label>
										<textarea rows="5" cols="5" name="description" class="form-control" placeholder="Enter  Description here">
										{{isset($category->description)?$category->description:''}}
										</textarea>
									</div>
									@if(isset($category->id))
									<button type="submit" class="btn btn-primary">Update Category <i class="icon-paperplane ml-2"></i></button>
                                   @else
									<div class="text-right">
										<button type="submit" class="btn btn-primary">Add Category <i class="icon-paperplane ml-2"></i></button>
									</div>
									@endif
									
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