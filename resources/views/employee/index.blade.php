@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">Items List</div>

                @if (session('success'))
                <div class="alert alert-success">
                    {{ session('success') }}
                </div>
                @endif
            
                @if (session('error'))
                <div class="alert alert-danger">
                    {{ session('error') }}
                </div>
                @endif

                <div class="card-body">
                   
                  <button type="button" class="btn btn-warning" data-bs-toggle="modal" data-bs-target="#urlFormModal">
                    Fetch URL
                  </button> 

                <form action="{{ route('employee.index') }}" method="GET" class="mb-3">
                    <div class="input-group">
                        <input type="text" name="search" class="form-control" placeholder="Search by name">
                        <div class="input-group-append">
                            <button type="submit" class="btn btn-primary">Search</button>
                        </div>
                    </div>
                </form>

                    <table class="table table-striped">
                        <thead>
                            <tr>
                                <th>id</th>
                                <th>Nama</th>
                                <th>Jabatan</th>
                                <th>Jenis Kelamin</th>
                                <th>Alamat</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($items as $item)
                            <tr>
                                <td>{{ $item->id }}</td>
                                <td>{{ $item->nama }}</td>
                                <td>{{ $item->jenis_kelamin }}</td>
                                <td>{{ $item->jabatan }}</td>
                                <td>{{ $item->alamat }}</td>
                                <td>
                                    <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#editModal{{ $item->id }}">
                                        Edit
                                    </button> 
                                    <button type="button" class="btn btn-danger" data-bs-toggle="modal" data-bs-target="#deleteModal{{ $item->id }}">
                                        Delete
                                    </button> 
                                </td>
                            </tr>

                            <!-- Edit Modal -->
                            <div class="modal fade" id="editModal{{ $item->id }}" tabindex="-1" role="dialog" aria-labelledby="deleteModalLabel{{ $item->id }}" aria-hidden="true">
                                <div class="modal-dialog" role="document">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title" id="urlFormModalLabel">Edit data Employee</h5>
                                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                        </div>
                                        <div class="modal-body">
                                            <form id="urlForm" action="{{ route('employee.update',$item->id) }}" method="POST">
                                                @csrf
                                                @method('PUT')
                                                <div class="form-group">
                                                    <label for="url">Nama</label>
                                                    <input type="text" class="form-control" id="nama" name="nama" value="{{ $item->nama }}" placeholder="Enter Nama">
                                                    <label for="url">Jabatan</label>
                                                    <input type="text" class="form-control" id="jabatan" name="jabatan" value="{{ $item->jabatan }}" placeholder="Enter Jabatan">
                                                    <label for="url">Jenis Kelamin</label>
                                                    <input type="text" class="form-control" id="jenis_kelamin" name="jenis_kelamin" value="{{ $item->jenis_kelamin }}" placeholder="Enter Jenis Kelamin">
                                                    <label for="url">Alamat</label>
                                                    <input type="text" class="form-control" id="alamat" name="alamat" value="{{ $item->alamat }}" placeholder="Enter Alamat">
                                                </div>
                                                <div class="modal-footer">
                                                    <button type="submit" class="btn btn-success">Save</button>
                                                </div>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <!-- Delete Modal -->
                            <div class="modal fade" id="deleteModal{{ $item->id }}" tabindex="-1" role="dialog" aria-labelledby="deleteModalLabel{{ $item->id }}" aria-hidden="true">
                                <div class="modal-dialog" role="document">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title" id="deleteModalLabel{{ $item->id }}">Delete Item</h5>
                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                <span aria-hidden="true">&times;</span>
                                            </button>
                                        </div>
                                        <div class="modal-body">
                                            Apakah kamu yakin menghapus data <b>{{ $item->nama }}</b>
                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                                                <form action="{{ route('employee.destroy',$item->id) }}" method="POST">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn btn-danger">Delete</button>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            @endforeach
                        </tbody>
                    </table>
                </div>
                             <!-- Modal for URL Form -->
                  <div class="modal fade" id="urlFormModal" tabindex="-1" role="dialog" aria-labelledby="urlFormModalLabel" aria-hidden="true">
                    <div class="modal-dialog" role="document">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="urlFormModalLabel">Add Data from URL</h5>
                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                            </div>
                            <div class="modal-body">
                                <form id="urlForm" action="{{ route('employee.fetchData') }}" method="POST">
                                    @csrf
                                    <div class="form-group">
                                        <label for="url">URL</label>
                                        <input type="text" class="form-control" id="url" name="url" placeholder="Enter URL">
                                    </div>
                                    <div class="modal-footer">
                                        <button type="submit" class="btn btn-success">Fetch and Save Data</button>

                                      </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>


            </div>
        </div>
    </div>
</div>
@endsection
