@extends('layouts.admin')
@section('title')
Ajouter un employé
@endsection
@section('content')
<div class="container px-6 mx-auto grid">
    <h2 class="my-6 text-2xl font-semibold text-gray-700 dark:text-gray-200">
        إضافة مستخدم
    </h2>
    @if(session('error'))
    <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded relative" role="alert">
        <strong class="font-bold">خطأ!</strong>
        <span class="block sm:inline">{{ session('error') }}</span>
    </div>
@endif

    <div class="px-4 py-3 mb-8 bg-white rounded-lg shadow-md dark:bg-gray-800">
        <form method="POST" action="{{ route('admin.employee.store') }}">
            @csrf
            <label class="block text-sm">
                <span class="text-gray-400 dark:text-gray-400">الاسم</span>
                <input name="name" type="text" value="{{ old('name') }}" required autofocus class="block w-full text-gray-400 mt-1 text-sm dark:border-gray-600 dark:bg-gray-700 form-input" placeholder="مثال: محمد أحمد" />
                @error('name') <p class="text-red-500 text-xs italic">{{ $message }}</p> @enderror
            </label>

            <label class="block mt-4 text-sm">
                <span class="text-gray-700 dark:text-gray-400">البريد الإلكتروني</span>
                <input  name="email" type="string" value="{{ old('email') }}" required class="block w-full mt-1 text-gray-400 text-sm dark:border-gray-600 dark:bg-gray-700 form-input" placeholder="مثال: user@example.com" />
                @error('email') <p class="text-red-500 text-xs italic">{{ $message }}</p> @enderror
            </label>

            <label class="block mt-4 text-sm">
                <span class="text-gray-700 dark:text-gray-400">الدور (Role)</span>
                <select name="role" required class="block w-full mt-1 text-gray-400 text-sm dark:border-gray-600 dark:bg-gray-700 form-select">
                    <option value="admin">مدير</option>
                    <option value="user">موظف</option>
                    <option value="ingenieur">مهندس</option>
                </select>
                @error('role') <p class="text-red-500 text-xs italic">{{ $message }}</p> @enderror
            </label>

            <label class="block mt-4 text-sm">
                <span class="text-gray-700 dark:text-gray-400">كلمة المرور</span>
                <input name="password" type="password" required class="block w-full mt-1  text-gray-400 text-sm dark:border-gray-600 dark:bg-gray-700 form-input" placeholder="***************" />
                @error('password') <p class="text-red-500 text-xs italic">{{ $message }}</p> @enderror
            </label>

            <label class="block mt-4 text-sm">
                <span class="text-gray-700 dark:text-gray-400">تأكيد كلمة المرور</span>
                <input name="password_confirmation" type="password" required class="block w-full mt-1 text-sm dark:border-gray-600 dark:bg-gray-700 form-input" placeholder="***************" />
            </label>

            <button type="submit" class="block w-full px-4 py-2 mt-4 text-sm font-medium text-white bg-purple-600 rounded-lg hover:bg-purple-700">
                إضافة المستخدم
            </button>
        </form>
    </div>
</div>
@endsection
