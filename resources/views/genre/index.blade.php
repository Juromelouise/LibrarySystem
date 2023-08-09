@extends('layout.master')

@section('title')
    New York Sanctuary
@endsection
@section('styles')
    <link rel="stylesheet" href="{{ asset('/css/genre.css') }}">
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
            {{-- <div class="container"> --}}
            <div class="row justify-content-center">
                <div class="col-md-8">
                    <div class="card">
                        <table id="genreTable" class="table">
                            <thead>
                                <tr>
                                    <th scope="col">ID</th>
                                    <th scope="col">Image</th>
                                    <th scope="col">Genre</th>
                                    <th scope="col">Action</th>
                                </tr>
                            </thead>
                        </table>
                    </div>
                </div>
            </div>
        </div>

        <div class="modal fade" id="modalCUgenre" tabindex="-1" role="dialog" aria-labelledby="modalCUgenreTitle"
            aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="modalCUgenreLongTitle">Create</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <form id="genreForm">
                            <div class="form-group">
                                <label for="genre_name">Name</label>
                                <input type="text" class="form-control" id="genre_name" placeholder="Enter Genre Name"
                                    name="genre_name">
                            </div>
                            <div class="form-group">
                                <label for="document">Attachments</label>
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
        </div>
        <script src="{{ asset('/js/genre.js') }}"></script>
    @else
        <p>Access denied. You must be an admin to view this page.</p>
    @endif
    <script>
        var uploadedDocumentMap = {}
        Dropzone.options.documentDropzone = {
            url: '{{ route('genre.storeMedia') }}',
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
