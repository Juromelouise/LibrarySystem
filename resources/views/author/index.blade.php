@extends('layout.master')
@section('title')
    New York Sanctuary
@endsection
@section('styles')
    <link rel="stylesheet" href="{{ asset('/css/author.css') }}">
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
            <div class="row justify-content-center">
                <div class="col-md-8">
                    <div class="card">
                        <form action="{{ route('author.import') }}" method="post" enctype="multipart/form-data">
                            @csrf
                            <input type="file" id="uploadName" class="form-control" name="excel" required>
                            <button type="submit" class="btn btn-info btn-primary">Import Excel File</button>
                        </form>
                    </div>
                        <table id="authorsTable" class="table">
                            <thead>
                                <tr>
                                    <th scope="col">ID</th>
                                    <th scope="col">Author Name</th>
                                    <th scope="col">Image</th>
                                    <th scope="col">Gender</th>
                                    <th scope="col">Age</th>
                                    <th scope="col">Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                {{-- @foreach ($authors as $author)
                                    <tr>
                                        <td>{{ $author->name }}</td>
                                        <td>{{ $author->gender }}</td>
                                        <td>{{ $author->age }}</td>
                                        <td>
                                            <a href="{{ route('author.edit', $author->id) }}"><i
                                                    class="fas fa-edit"></i></a>
                                            <form action="{{ route('author.destroy', $author->id) }}" method="POST"
                                                style="display:inline-block">
                                                @method('DELETE')
                                                @csrf
                                                <button type="submit">
                                                    <i class="fa-solid fa-trash" style="color:red"></i>
                                                </button>
                                            </form>
                                        </td>
                                    </tr>
                                @endforeach --}}
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>

        <div class="modal fade" id="modalCU" tabindex="-1" role="dialog" aria-labelledby="modalCUTitle"
            aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="modalCULongTitle">Create</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <form id="authorForm">
                            <div class="form-group">
                                <label for="name">Name</label>
                                <input type="text" class="form-control" id="name" placeholder="Enter author name"
                                    name="name">
                            </div>
                            <div class="form-group">
                                <p>Gender</p>
                                <div class="form-check form-check-inline">
                                    <input class="form-check-input" type="radio" name="gender" id="female"
                                        value="female">
                                    <label class="form-check-label" for="inlineRadio1">Female</label>
                                </div>
                                <div class="form-check form-check-inline">
                                    <input class="form-check-input" type="radio" name="gender" id="male"
                                        value="male">
                                    <label class="form-check-label" for="inlineRadio2">Male</label>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="name">Age</label>
                                <input type="number" class="form-control" id="age" placeholder="Enter author name"
                                    name="age">
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
    @else
        <>Access denied. You must be an admin to view this page.</p>
    @endif
    <script src="https://cdn.jsdelivr.net/jquery.validation/1.16.0/jquery.validate.min.js"></script>
    <script src="{{ asset('/js/author.js') }}"></script>
    <script>
        var uploadedDocumentMap = {}
        Dropzone.options.documentDropzone = {
            url: '{{ route('author.storeMedia') }}',
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
