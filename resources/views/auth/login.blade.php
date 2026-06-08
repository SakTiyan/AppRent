@extends('layouts.app')

@section('title', 'Login Administrator')

@section('content')
<div class="min-h-screen flex items-center justify-center bg-brand-light px-4">
    
    <div class="bg-white p-8 md:p-10 rounded-2xl shadow-xl w-full max-w-md border-t-4 border-brand-blue" data-aos="zoom-in" data-aos-duration="1000">
        
        <div class="text-center mb-8">
            <img src="{{ asset('assets/img/logo-square.png') }}" alt="Logo AppRent" class="w-20 mx-auto mb-4 drop-shadow-md">
            <h2 class="text-2xl font-bold text-brand-dark tracking-tight">Login <span class="text-brand-amber">AppRent</span></h2>
            <p class="text-gray-500 text-sm mt-1">Sistem Manajemen Sewa iPhone</p>
        </div>

        @if(session('error'))
            <div class="bg-red-50 border-l-4 border-red-500 text-red-700 p-4 mb-6 rounded-md" role="alert">
                <p class="text-sm font-medium">{{ session('error') }}</p>
            </div>
        @endif

        <form action="{{ route('login.process') }}" method="POST">
            @csrf
            
            <div class="mb-5">
                <label for="email" class="block text-sm font-semibold text-brand-dark mb-2">Alamat Email</label>
                <input type="email" name="email" id="email" 
                       class="w-full px-4 py-3 rounded-xl border border-gray-200 focus:ring-2 focus:ring-brand-blue focus:border-brand-blue transition-all outline-none bg-gray-50 focus:bg-white" 
                       placeholder="admin@gmail.com" value="{{ old('email') }}" required autofocus>
                @error('email')
                    <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                @enderror
            </div>

            <div class="mb-8">
                <label for="password" class="block text-sm font-semibold text-brand-dark mb-2">Kata Sandi</label>
                <input type="password" name="password" id="password" 
                       class="w-full px-4 py-3 rounded-xl border border-gray-200 focus:ring-2 focus:ring-brand-blue focus:border-brand-blue transition-all outline-none bg-gray-50 focus:bg-white" 
                       placeholder="••••••••" required>
            </div>

            <button type="submit" 
                    class="w-full bg-brand-blue text-white font-bold py-3.5 rounded-xl hover:bg-blue-700 transition duration-300 shadow-lg hover:shadow-brand-blue/50 transform hover:-translate-y-1">
                MASUK SISTEM
            </button>
        </form>
        
        <div class="mt-8 text-center">
            <p class="text-xs text-gray-400 font-medium">&copy; {{ date('Y') }} AppRent. Ujikom Project.</p>
        </div>
        
    </div>
</div>
@endsection