       <!-- Modal -->
       <div class="modal center-modal fade" id="editImage" tabindex="-1">
           <div class="modal-dialog">
               <div class="modal-content">
                   <div class="modal-header">
                       <h5 class="modal-title">Edit Images</h5>
                       <button type="button" class="close" data-dismiss="modal">
                           <span aria-hidden="true">&times;</span>
                       </button>
                   </div>
                   <div class="modal-body">
                       <form method="post" action="{{route('admin.products.updateImage')}}" enctype="multipart/form-data">
                           @csrf
                           @method('PUT')
                           <div class="form-group">
                               <h5>File<span class="text-danger"></span></h5>
                               <div class="controls">
                                   @foreach ($product->images as $image)
                                       <img style="width: 10%; height: 10%;"
                                           src="{{ !empty($image->name) ? asset('storage/products/images/' . $image->name) : asset('backend/images/no_image.jpg') }}"
                                           alt="User Avatar">
                                           <a id="delete" href="{{ route('admin.products.deleteImage', [$image->id]) }}"
                                            class="btn btn-danger btn-flat mb-5" title="Delete"><i class="fa fa-trash"></i></a>
                                       <input type="file" name="images[{{$image->id}}]" accept="images/*" multiple
                                           class="form-control">

                                       @error('images')
                                           <span class="alert text-danger"> {{ $message }}</span>
                                       @enderror
                                   @endforeach
                               </div>
                           </div>
                           <div class="modal-footer modal-footer-uniform">
                               <button type="button" class="btn btn-rounded btn-secondary"
                                   data-dismiss="modal">Close</button>
                               <button type="submit" class="btn btn-rounded btn-primary float-right">Save
                                   changes</button>
                           </div>
                       </form>
                   </div>

               </div>
           </div>
       </div>
       </div>
       <!-- /.modal -->
