@extends('layout.master')

@section('title')
    New York Sanctuary
@endsection
@section('styles')
    <link rel="stylesheet" href="{{ asset('/css/stock.css') }}">
@endsection
@section('content')
    @if (Auth::user() && Auth::user()->role === '1')
    <div class="container-fluid">
        <div class="alert alert-success alert-dismissible fade show" role="alert"
            style="position:absolute; top:9.5%; width: 95%;">
            You should check in on some of those fields below.
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>
    <div class="container">
        <div class="row justify-content-center">
            <div class="row justify-content-center">
                <form action="{{ route('stock.import') }}" method="post" enctype="multipart/form-data">
                    @csrf
                    <input type="file" id="uploadName" class="form-control" name="excel" required>
                    <button type="submit" class="btn btn-info btn-primary">Import Excel File</button>
                </form>
            <div class="col-md-8">
                <div class="card">
                    <table id="stockTable" class="table">
                        <thead>
                            <tr>
                                <th scope="col">ID</th>
                                <th scope="col">Book</th>
                                <th scope="col">Image</th>
                                <th scope="col">Stock</th>
                                <th scope="col">Edit Stock</th>
                            </tr>
                        </thead>
                        <tbody>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
    <div class="modal fade" id="modalCUstock" tabindex="-1" role="dialog" aria-labelledby="modalCUstockTitle" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="modalCUstockLongTitle">Create</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form id="stockForm">
                        <div class="form-group">
                            <label class="col-form-label" id="book-label" for="book-select">Book Title</label>
                            <select class="form-control" id="book-select" name="book_id">
                                <option value="">
                                    Select Book
                                </option>
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="stock">Enter Stock</label>
                            <input type="number" class="form-control" id="stock" placeholder="Enter Stock" name="stock">
                        </div>
                        <div class="form-group">
                            <label for="document" id="document1">Attachments</label>
                            <div class="needsclick dropzone" id="document-dropzone"></div>
                        </div>
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button id="save" type="button" class="btn btn-primary">Save</button>
                    <button id="update" type="button" class="btn btn-primary">Update</button>
                </div>
            </div>
        </div>
    </div>

    <script src="{{ asset('/js/stock.js') }}"></script>
    @else
        <p>Access denied. You must be an admin to view this page.</p>
    @endif
    <script>
        var uploadedDocumentMap = {}
        Dropzone.options.documentDropzone = {
            url: '{{ route('stock.storeMedia') }}',
            // maxFilesize: 2, // MB
            addRemoveLinks: true,
            // acceptedFiles: "image/jpeg,image/png,image/gif",
            headers: {
                'X-CSRF-TOKEN': "{{ csrf_token() }}"
            },
            success: function(file, response) {
                $('form').append('<input type="hidden" name="document[]" value="' + response.name + '">')
                uploadedDocumentMap[file.name] = response.name
            },
            removedfile: function(file) {
                file.previewElement.remove()
                var name = ''
                if (typeof file.file_name !== 'undefined') {
                    name = file.file_name
                } else {
                    name = uploadedDocumentMap[file.name]
                }
                $('form').find('input[name="document[]"][value="' + name + '"]').remove()
            },
            init: function() {
                @if (isset($project) && $project->document)
                    var files =
                        {!! json_encode($project->document) !!}
                    for (var i in files) {
                        var file = files[i]
                        this.options.addedfile.call(this, file)
                        file.previewElement.classList.add('dz-complete')
                        $('form').append('<input type="hidden" name="document[]" value="' + file.file_name + '">')
                    }
                @endif
            }
        }
    </script>
@endsection
