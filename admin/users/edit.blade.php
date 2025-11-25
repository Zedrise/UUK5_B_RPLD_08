@extends('layouts.admin')

@section('title', 'Edit Pengguna')

@section('content')
<div class="container">

    <h3 class="mb-4">✏ Edit Pengguna</h3>

    <form action="{{ route('admin.users.update', $user->id) }}" method="POST">
        @csrf

        <label>Nama</label>
        <input type="text" class="form-control" name="name" value="{{ $user->name }}" required>

        <label class="mt-2">Email</label>
        <input type="email" class="form-control" name="email" value="{{ $user->email }}" required>

       

        <label class="mt-2">Role</label>
        <select name="role" class="form-control">
            <option value="pelanggan" {{ $user->role=='pelanggan'?'selected':'' }}>Pelanggan</option>
            <option value="petugas" {{ $user->role=='petugas'?'selected':'' }}>Petugas</option>
            <option value="admin" {{ $user->role=='admin'?'selected':'' }}>Admin</option>
        </select>

        <button class="btn btn-primary mt-3">Update</button>
    </form>

</div>
@endsection
