       <!-- Modal -->
       <div class="modal center-modal fade" id="addSize" tabindex="-1">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Add Size</h5>
                    <button type="button" class="close" data-dismiss="modal">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form method="post" action="{{ route('admin.sizes.store') }}">
                        @csrf
                        <div class="form-group">
                            @foreach(config('app.languages') as $language)
                            <h5>Name In {{$language['name']}}<span class="text-danger">*</span></h5>
                            <div class="controls">
                                <input type="text" name="name[{{$language['locale']}}]" class="form-control"
                                    value="{{ old('name')[$language['locale']] ?? ''}}">
                                @error('name.*'.$language['locale'])
                                    <span class="alert text-danger"> {{ $message }}</span>
                                @enderror
                            </div>
                            @endforeach
                            <div class="form-control-feedback"></div>
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
@section('js')
<script>
    $(document).ready(function() {
        $('#addSize').on('hidden.bs.modal', function (e) {
            if ($('.modal-content form').find('.is-invalid').length) {
                e.preventDefault();
            }
        });
    });
</script>
@endsection
