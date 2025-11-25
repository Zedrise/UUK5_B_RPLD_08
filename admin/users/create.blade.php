@extends('layouts.admin')

@section('title', 'Tambah Pengguna')

@section('content')
<div class="container">

    <h3 class="mb-4">➕ Tambah Pengguna</h3>

    <form action="{{ route('admin.users.store') }}" method="POST">
        @csrf

        <label>Nama</label>
        <input type="text" class="form-control" name="name" required>

        <label class="mt-2">Email</label>
        <input type="email" class="form-control" name="email" required>

        <label class="mt-2">Password</label>
        <input type="password" class="form-control" name="password" required>

        <label class="mt-2">Role</label>
        <select name="role" class="form-control">
            <option value="pelanggan">Pelanggan</option>
            <option value="petugas">Petugas</option>
            <option value="admin">Admin</option>
        </select>

        <button class="btn btn-primary mt-3">Simpan</button>
    </form>

</div>
@endsection
