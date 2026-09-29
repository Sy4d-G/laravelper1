@extends('layouts.app')

@section('title', 'Profil Pengguna')

@section('content')
<div class="bg-white p-6 rounded-lg shadow max-w-md mx-auto">
    <h1 class="text-2xl font-bold mb-4">Profil Pengguna</h1>
    <div class="space-y-2 text-gray-700">
        <p><strong>Nama:</strong> Administrator</p>
        <p><strong>Role:</strong> Super Admin</p>
        <p><strong>Status:</strong> <span class="text-green-600 font-semibold">Aktif</span></p>
    </div>
</div>
@endsection
