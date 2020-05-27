@extends('admin.layouts.master')
@section('content')
<div class="content">

				<!-- Vertical form options -->
				<div class="row">
					<div class="col-md-12">
						<!-- Basic layout-->
						<div class="card">
							<div class="card-header header-elements-inline">
								<h5 class="card-title">Edit Product</h5>
								<div class="header-elements">
									<div class="list-icons">
				                		<a class="list-icons-item" data-action="collapse"></a>
				                		<a class="list-icons-item" data-action="reload"></a>

				                	</div>
			                	</div>
							</div>

							<div class="card-body">
							<fieldset>
								<form action="{{url('admin/product/update')}}" method="POST" enctype="multipart/form-data">
								@csrf
								<input name="id" value="{{$product->id}}" type="hidden" />
					                	<legend class="font-weight-semibold"><i class="icon-truck mr-2"></i> Shipping details</legend>

										<div class="row">
											<div class="col-md-4">
												<div class="form-group">
													<label>Product Name:</label>
													<input type="text" placeholder="Enter Product Name" class="form-control" name="name" value="{{$product->name}}">
												</div>
											</div>
											<div class="col-md-4">
												<div class="form-group">
													<label>Product Code:</label>
													<input type="text" placeholder="Enter Product Code" name="code" class="form-control" value="{{$product->code}}">
												</div>
											</div>
											<div class="col-md-4">
												<div class="form-group">
													<label>Quantity:</label>
													<input type="text" placeholder="Enter Product quantity" name="quantity" class="form-control" value="{{$product->quantity}}">
												</div>
											</div>
											<div class="col-md-4">
												<div class="form-group">
													<label>Alert Quantity:</label>
													<input type="text" placeholder="Enter Product Quantity" name="alert_quantity" class="form-control" value="{{$product->alert_quantity}}">
												</div>
											</div>
											<div class="col-md-4">
												<div class="form-group">
													<label>Category Name:</label>
													<select data-placeholder="Select Category" name="category_id" class="form-control form-control-select2" data-fouc>
						                            	<option value=""></option>
														@foreach($categories as $category)
														<option value="{{$category->id}}" @isset($product->category_id){{$product->category_id==$category->id?'selected':''}}@endisset>{{$category->name}}</option>
														@endforeach
						                            </select>
												</div>
											</div>
											<div class="col-md-4">
												<div class="form-group">
													<label>Sub Category Name:</label>
													<select name="sub_category_id" class="form-control form-control-select2" data-fouc>
													
													@foreach($sub_categories as $category)
														<option value="{{$category->id}}" @isset($product->category_id){{$product->category_id==$category->id?'selected':''}}@endisset>{{$category->name}}</option>
														@endforeach
						                            </select>
												</div>
											</div>
											<div class="col-md-4">
												<div class="form-group">
													<label>Brand Name:</label>
													<select name="brand_id" data-placeholder="Select your country" class="form-control form-control-select2" data-fouc>
						                            	<option value=""></option>
						                                @foreach($brands as $brand)
														<option value="{{$brand->id}}" @isset($product->category_id){{$product->brand_id==$brand->id?'selected':''}}@endisset>{{$brand->name}}</option>
														@endforeach
						                            </select>
												</div>
											</div>
											<div class="col-md-4">
												<div class="form-group">
													<label>Cost Price:</label>
													<input type="text" placeholder="Enter  Cost Price" name="cost_price" value="{{$product->cost_price}}" class="form-control">
												</div>
											</div>
											<div class="col-md-4">
												<div class="form-group">
													<label>Selling Price:</label>
													<input type="text" placeholder="Enter Selling Price" name="selling_price" class="form-control" value="{{$product->selling_price}}">
												</div>
											</div>
											<div class="col-md-4">
												<div class="form-group">
													<label>Discount Price:</label>
													<input type="text" placeholder="Enter Discount Price" name="discount_price" value="{{$product->discount_price}}" class="form-control">
												</div>
											</div>
											<div class="col-md-4">
												<div class="form-group">
													<label>Product Size:</label>
													
													<input type="text"  name="size" class="form-control tokenfield" value="{{$product->size}}"  data-fouc placeholder="Enter Product Size">
												</div>
											</div>
											<div class="col-md-4">
												<div class="form-group">
													<label>Product Color:</label>
													<input type="text"  name="color" value="{{$product->color}}" class="form-control tokenfield"  data-fouc>
												
												</div>
											</div>
											<div class="col-md-12">
												<div class="form-group">
													<label>Product Description:</label>
													<textarea  name="description" id="editor-full" rows="4" cols="4">{{$product->description}}</textarea>
												</div>
											</div>

											<div class="col-md-12">
												<div class="form-group">
													<label>Video Link:</label>
													<input type="text" name="video_link"  value="{{$product->video_link}}"  placeholder="Video link" class="form-control ">
												</div>
											</div>

											<div class="col-md-4">
												<div class="form-group">
													<label>Image One:</label>
													<input type="file" name="image_one" value="{{$product->image_one}}" placeholder="Kopyov" class="form-control form-input-styled" onchange="readURL(this)">
													

													@if($product->image_one)
													<img src="{{asset($product->image_one)}}"  style="height: 80px;width:80px" id="one"/>
													@endif
												</div>
											</div>
											<div class="col-md-4">
												<div class="form-group">
													<label>Image Two:</label>
													<input type="file" name="image_two" value="{{$product->image_two}}" placeholder="Kopyov" class="form-control form-input-styled" onchange="readURLTwo(this)">
													@if($product->image_two)
													<img src="{{asset($product->image_two)}}"  style="height: 80px;width:80px" id="two"/>
													@endif
													
												</div>
											</div>
											<div class="col-md-4">
												<div class="form-group">
													<label>Image Three:</label>
													<input type="file" name="image_three"  value="{{$product->image_three}}" placeholder="Kopyov" class="form-control form-input-styled" onchange="readURLThree(this)">
													@if($product->image_three)
													<img src="{{asset($product->image_three)}}"  style="height: 80px;width:80px" id="three"/>
													@endif
													
												</div>
											</div>
											<div class="col-md-4">
											 <div class="form-group">
												 <div class="form-check">
											<label class="form-check-label">
											<input type="checkbox" value="1" @isset($product->main_slider){{$product->main_slider==1?'checked':''}} @endisset name="main_slider" class="form-check-input-styled"  data-fouc>
											Main Slider
												</label>
												</div>
											 </div>
											</div>
											<div class="col-md-4">
												<div class="form-group">
												<div class="form-check">
											<label class="form-check-label">
											<input type="checkbox" value="1"  @isset($product->mid_slider){{$product->mid_slider==1?'checked':''}} @endisset   name="mid_slider" class="form-check-input-styled"  data-fouc>
											Mid Slider
												</label>
												</div>
												</div>
											</div>
											<div class="col-md-4">
												<div class="form-group">
													
													<div class="form-check">
											<label class="form-check-label">
											<input type="checkbox"  value="1"  @isset($product->best_rated){{$product->best_rated==1?'checked':''}} @endisset    name="best_rated" class="form-check-input-styled"  data-fouc>
											Best Rated
												</label>
												</div>
												</div>
											</div>
											<div class="col-md-4">
												<div class="form-group">
													<div class="form-check">
											<label class="form-check-label">
											<input type="checkbox" value="1"  @isset($product->trend){{$product->trend==1?'checked':''}} @endisset   name="trend" class="form-check-input-styled"  data-fouc>
											Trend Product
												</label>
												</div>

												</div>
											</div>
											<div class="col-md-4">
												<div class="form-group">
												
													<div class="form-check">
											<label class="form-check-label">
											<input type="checkbox" value="1"  @isset($product->featured){{$product->featured==1?'checked':''}} @endisset   name="featured" class="form-check-input-styled"  data-fouc>
											Featured Product
												</label>
												</div>

												</div>
											</div>
											<div class="col-md-4">
												<div class="form-group">
													
													<div class="form-check">
											<label class="form-check-label">
											<input type="checkbox" value="1"  @isset($product->hot_new){{$product->hot_new==1?'checked':''}} @endisset  name="hot_new" class="form-check-input-styled"  data-fouc>
											Hot New
												</label>
												</div>
												</div>
											</div>

										</div>
										<button type="submit" class="btn btn-success">Update Product</button>
										</form>
									</fieldset>

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
	<script src="{{asset('public/backend/assets/global/js/plugins/editors/ckeditor/ckeditor.js')}}"></script>
	<script src="{{asset('public/backend/assets/global/js/plugins/forms/tags/tagsinput.min.js')}}"></script>
	<script src="{{asset('public/backend/assets/global/js/plugins/forms/tags/tokenfield.min.js')}}"></script>
    <script>

        $(document).ready(function(){
          $('.form-control-select2').select2();
		  // Basic initialization
		  $('.tokenfield').tokenfield();

// Create token on blur
$('.tokenfield-blur').tokenfield({
	createTokensOnBlur: true
})
// Setup
CKEDITOR.replace('editor-full', {
            height: 200
        });
          $('.form-input-styled').uniform({
            fileButtonClass: 'action btn bg-pink-400'
        });
          $('.form-check-input-styled').uniform();
        });


	</script>
	
													
	<script type="text/javascript">
      $(document).ready(function(){
     $('select[name="category_id"]').on('change',function(){
          var category_id = $(this).val();
          if (category_id) {
            
            $.ajax({
              url: "{{ url('admin/get/subcategory/') }}/"+category_id,
              type:"GET",
              dataType:"json",
              success:function(data) { 
              var d =$('select[name="sub_category_id"]').empty();
              $.each(data, function(key, value){
              
              $('select[name="sub_category_id"]').append('<option value="'+ value.id + '">' + value.name + '</option>');

              });
              },
            });

          }else{
            alert('danger');
          }

            });
      });

 </script>

<script type="text/javascript">
  function readURL(input){
    if (input.files && input.files[0]) {
      var reader = new FileReader();
      reader.onload = function(e) {
        $('#one')
        .attr('src', e.target.result)
        .width(80)
        .height(80);
      };
      reader.readAsDataURL(input.files[0]);
    }
  }
  function readURLTwo(input){
    if (input.files && input.files[0]) {
      var reader = new FileReader();
      reader.onload = function(e) {
        $('#two')
        .attr('src', e.target.result)
        .width(80)
        .height(80);
      };
      reader.readAsDataURL(input.files[0]);
    }
  }
  function readURLThree(input){
    if (input.files && input.files[0]) {
      var reader = new FileReader();
      reader.onload = function(e) {
        $('#three')
        .attr('src', e.target.result)
        .width(80)
        .height(80);
      };
      reader.readAsDataURL(input.files[0]);
    }
  }
</script>
@stop