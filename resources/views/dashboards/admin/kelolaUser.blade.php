@extends('layouts.adminLayout.adminLayout')
@section('cssContent')
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
@endsection

@section('content')
        @if (session('pesan'))
        <div class="alert alert-success alert-dismissible">
            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
            <h5><i class="icon fas fa-check"></i> Success </h5>
            {{session('pesan')}}
        </div>
        @endif
@if ($user->isEmpty())
    <p> Tidak Ada User </p> <br>
    <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#tambahuser">Tambah</button>
@else
<div class="card-body">
    <h4 class="card-title">Tabel User</h4>
    <p class="card-description">

    </p>
    <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#tambahuser">Tambah</button>
   <hr>
    <h4 class="card-title">Tabel Pengguna</h4>
    <hr>
    <div class="table-responsive">

      <table class="table table-striped">
        <thead>
          <tr>
            <th>No</th>
            <th>Nama</th>
            <th>Email</th>
            <th>Role</th>
            <th>Action</th>
          </tr>
        </thead>
        <tbody>
            @php
                $no = 1;
            @endphp
            @foreach ($pengguna as $user)
                <tr>
                    <td class="py-1">{{ $no++ }}</td>
                    <td>{{ $user->name }}</td>
                    <td> {{ $user->email }}</td>
                    <td>
                        @if ($user->role == 0)
                            Pengguna
                        @elseif ($user->role == 1)
                            Administrator
                        @endif
                    </td>
                    <td>
                        <button type="button" class="btn btn-primary btn-sm" data-toggle="modal" data-target="#edituser-{{ $user->id }}">Edit</button>
                        <button type="button" class="btn btn-danger btn-sm" data-toggle="modal" data-target="#deleteuser-{{ $user->id }}">Hapus</button>
                    </td>
                </tr>

                  {{-- Form Edit user --}}

                    <div class="modal fade" id="edituser-{{ $user->id }}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                        <div class="modal-dialog" role="document">
                        <div class="modal-content">
                            <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLabel">Edit User</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                            </div>
                            <div class="modal-body">
                            <form method="POST" action="{{ route('admin.user.update', $user->id) }}">
                                @csrf
                                <input type="hidden" name="_method" value="PUT">
                                <div class="form-group">
                                    <label for="recipient-name" class="col-form-label">Nama User:</label>
                                    <input type="text" class="form-control" id="nama-user" name="name" placeholder="Nama User" value="{{ $user->name }}" required>
                                </div>
                                <div class="form-group">
                                    <label for="recipient-name" class="col-form-label">Email Baru:</label>
                                    <input type="email" class="form-control" id="email" name="email" placeholder="Email User" value="{{ $user->email }}" required>
                                </div>
                                <div class="form-group">
                                    <label for="recipient-name" class="col-form-label">Password Baru:</label>
                                    <input type="password" class="form-control" id="password" name="password" placeholder="Password User" required>
                                </div>
                                <div class="form-group">
                                <label for="message-text" class="col-form-label">Peran User:</label>
                                <select id="jenis-user" name="role" class="form-control" required>
                                    <option @if ($user->role == 0) selected @endif value = 0 >Pengguna</option>
                                    <option @if ($user->role == 1) selected @endif value = 1 >Administrator</option>
                                </select>
                                </div>
                            </div>
                            <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Tutup</button>
                            <button type="submit" class="btn btn-primary" value="submit">Simpan</button>
                            </div>
                        </form>
                        </div>
                        </div>
                    </div>

                      {{-- Form Delete user --}}
                      <div class="modal modal-danger fade" id="deleteuser-{{ $user->id }}" tabindex="-1" role="dialog" aria-labelledby="Delete" aria-hidden="true">
                        <div class="modal-dialog" role="document">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="exampleModalLabel">Hapus user</h5>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                                <div class="modal-body">
                                <form action="{{ route('admin.user.delete', $user->id) }}" method="post">
                                    @csrf
                                    @method('DELETE')
                                    <h5 class="text-center">Apakah Anda yakin untuk menghapus user {{ $user->name }}?</h5>
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                                    <button type="submit" class="btn btn-danger">Ya, Hapus user</button>
                                </div>
                                </form>
                            </div>
                        </div>
                    </div>

            @endforeach
        </tbody>
      </table>


      <hr>
    <h4 class="card-title">Tabel Administrator</h4>
    <hr>
    <div class="table-responsive">

      <table class="table table-striped">
        <thead>
          <tr>
            <th>No</th>
            <th>Nama</th>
            <th>Email</th>
            <th>Role</th>
            <th>Action</th>
          </tr>
        </thead>
        <tbody>
            @php
                $no = 1;
            @endphp
            @foreach ($admin as $user)
                <tr>
                    <td class="py-1">{{ $no++ }}</td>
                    <td>{{ $user->name }}</td>
                    <td> {{ $user->email }}</td>
                    <td>
                        @if ($user->role == 0)
                            Pengguna
                        @elseif ($user->role == 1)
                            Administrator
                        @endif
                    </td>
                    <td>
                        <button type="button" class="btn btn-primary btn-sm" data-toggle="modal" data-target="#edituser-{{ $user->id }}">Edit</button>
                        <button type="button" class="btn btn-danger btn-sm" data-toggle="modal" data-target="#deleteuser-{{ $user->id }}">Hapus</button>
                    </td>
                </tr>

                  {{-- Form Edit user --}}

                    <div class="modal fade" id="edituser-{{ $user->id }}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                        <div class="modal-dialog" role="document">
                        <div class="modal-content">
                            <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLabel">Edit User</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                            </div>
                            <div class="modal-body">
                            <form method="POST" action="{{ route('admin.user.update', $user->id) }}">
                                @csrf
                                <input type="hidden" name="_method" value="PUT">
                                <div class="form-group">
                                    <label for="recipient-name" class="col-form-label">Nama User:</label>
                                    <input type="text" class="form-control" id="nama-user" name="name" placeholder="Nama User" value="{{ $user->name }}" required>
                                </div>
                                <div class="form-group">
                                    <label for="recipient-name" class="col-form-label">Email Baru:</label>
                                    <input type="email" class="form-control" id="email" name="email" placeholder="Email User" value="{{ $user->email }}" required>
                                </div>
                                <div class="form-group">
                                    <label for="recipient-name" class="col-form-label">Password Baru:</label>
                                    <input type="password" class="form-control" id="password" name="password" placeholder="Password User" required>
                                </div>
                                <div class="form-group">
                                <label for="message-text" class="col-form-label">Peran User:</label>
                                <select id="jenis-user" name="role" class="form-control" required>
                                    <option @if ($user->role == 0) selected @endif value = 0 >Pengguna</option>
                                    <option @if ($user->role == 1) selected @endif value = 1 >Administrator</option>
                                </select>
                                </div>
                            </div>
                            <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Tutup</button>
                            <button type="submit" class="btn btn-primary" value="submit">Simpan</button>
                            </div>
                        </form>
                        </div>
                        </div>
                    </div>

                      {{-- Form Delete user --}}
                      <div class="modal modal-danger fade" id="deleteuser-{{ $user->id }}" tabindex="-1" role="dialog" aria-labelledby="Delete" aria-hidden="true">
                        <div class="modal-dialog" role="document">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="exampleModalLabel">Hapus user</h5>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                                <div class="modal-body">
                                <form action="{{ route('admin.user.delete', $user->id) }}" method="post">
                                    @csrf
                                    @method('DELETE')
                                    <h5 class="text-center">Apakah Anda yakin untuk menghapus user {{ $user->name }}?</h5>
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                                    <button type="submit" class="btn btn-danger">Ya, Hapus user</button>
                                </div>
                                </form>
                            </div>
                        </div>
                    </div>

            @endforeach
        </tbody>
      </table>


    </div>
  </div>





@endif


{{-- Form Tambah user --}}
<div class="modal fade" id="tambahuser" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">Tambah user</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
          <form method="POST" action="{{ route('admin.user.store') }}">
            @csrf
            <div class="form-group">
              <label for="recipient-name" class="col-form-label">Nama user:</label>
              <input type="text" class="form-control" id="nama-user" name="name" placeholder="Nama user" required>
            </div>
            <div class="form-group">
                <label for="recipient-name" class="col-form-label">Email User:</label>
                <input type="email" class="form-control" id="email-user" name="email" placeholder="Email user" required>
            </div>
            <div class="form-group">
                <label for="recipient-name" class="col-form-label">Password User:</label>
                <input type="password" class="form-control" id="password-user" name="password" placeholder="Password user" required>
            </div>
            <div class="form-group">
                <label for="recipient-name" class="col-form-label">Konfirmasi Password:</label>
                <input type="password" class="form-control" id="password-user-confirm" name="password_confirmation" placeholder="Konfirmasi password" required>
            </div>
            <div class="form-group">
                <label for="message-text" class="col-form-label">Peran User:</label>
                <select id="jenis-user" name="role" class="form-control" required>
                    <option value = 0 >Pengguna</option>
                    <option value = 1 >Administrator</option>
                </select>
                </div>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-dismiss="modal">Tutup</button>
          <button type="submit" class="btn btn-primary" value="submit">Simpan</button>
        </div>
    </form>
      </div>
    </div>
  </div>



@endsection

@section('jsContent')



@endsection
