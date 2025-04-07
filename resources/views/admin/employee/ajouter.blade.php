@extends('layouts.admin')
@section('title')
Ajouter un employé
@endsection
@section('content')
@if ($errors->any())
    <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded relative" role="alert">
        <strong class="font-bold">هناك أخطاء في الإدخال:</strong>
        <ul class="mt-2">
            @foreach ($errors->all() as $error)
                <li>- {{ $error }}</li>
            @endforeach
        </ul>
    </div>

@endif


<div class="container px-6 mx-auto grid">
    <h2 class="my-6 text-2xl font-semibold text-gray-700 dark:text-gray-200">
        Ajouter un utilisateur
    </h2>
    @if(session('error'))
    <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded relative" role="alert">
        <strong class="font-bold">خطأ!</strong>
        <span class="block sm:inline">{{ session('error') }}</span>
    </div>
    @endif

    <div class="px-6 py-5 mb-8 bg-white dark:bg-gray-900 rounded-lg shadow-lg">
        <h2 class="text-xl font-semibold text-gray-900 dark:text-white mb-6">Ajouter un utilisateur</h2>
        <form method="POST" action="{{ route('admin.employee.store') }}" class="space-y-6">
            @csrf
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <div>
                    <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">
                        Nom complet <span style="color: red">*</span>
                    </label>
                    <input name="name" type="text" value="{{ old('name') }}" required autofocus 
                        class="block w-full rounded-lg border-2 border-gray-300 dark:border-gray-700 bg-white dark:bg-gray-800 text-gray-900 dark:text-white px-4 py-3 text-sm focus:border-purple-500 focus:ring-2 focus:ring-purple-500" 
                        placeholder="ex:Prenom Nom" />
                    @error('name') <p class="text-red-500 dark:text-red-400 text-xs mt-2">{{ $message }}</p> @enderror
                </div>
                
                <div>
                    <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">
                        Adresse
                    </label>
                    <input name="adress" type="text" value="{{ old('adresse') }}"  
                        class="block w-full rounded-lg border-2 border-gray-300 dark:border-gray-700 bg-white dark:bg-gray-800 text-gray-900 dark:text-white px-4 py-3 text-sm focus:border-purple-500 focus:ring-2 focus:ring-purple-500" 
                        placeholder="ex:Béjaia,Akbou" />
                    @error('name') <p class="text-red-500 dark:text-red-400 text-xs mt-2">{{ $message }}</p> @enderror
                </div>
            </div>
    
            <div>
                <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">
                    Position
                </label>
                <input name="position" type="text" value="{{ old('position') }}"  
                    class="block w-full rounded-lg border-2 border-gray-300 dark:border-gray-700 bg-white dark:bg-gray-800 text-gray-900 dark:text-white px-4 py-3 text-sm focus:border-purple-500 focus:ring-2 focus:ring-purple-500" 
                    placeholder="ex:Agent Technique" />
                @error('name') <p class="text-red-500 dark:text-red-400 text-xs mt-2">{{ $message }}</p> @enderror
            </div>
    
            <div>
                <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">
                    User id <span style="color: red">*</span>
                </label>
                <input name="email" type="string" value="{{ old('email') }}" required 
                    class="block w-full rounded-lg border-2 border-gray-300 dark:border-gray-700 bg-white dark:bg-gray-800 text-gray-900 dark:text-white px-4 py-3 text-sm focus:border-purple-500 focus:ring-2 focus:ring-purple-500" 
                    placeholder="example:824762" />
                @error('email') <p class="text-red-500 dark:text-red-400 text-xs mt-2">{{ $message }}</p> @enderror
            </div>
    
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <div>
                    <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">
                        Role <span style="color: red">*</span>
                    </label>
                    <select name="role" required 
                        class="block w-full rounded-lg border-2 border-gray-300 dark:border-gray-700 bg-white dark:bg-gray-800 text-gray-900 dark:text-white px-4 py-3 text-sm focus:border-purple-500 focus:ring-2 focus:ring-purple-500 appearance-none">
                        <option value="admin">Administrateur</option>
                        <option value="user">Employee</option>
                        <option value="ingenieur">Ingenieur</option>
                    </select>
                    @error('role') <p class="text-red-500 dark:text-red-400 text-xs mt-2">{{ $message }}</p> @enderror
                </div>
                
                <div>
                    <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">
                        Department if enginner <span style="color: red">*</span>
                    </label>
                    <select id="department" name="department_id"
                        class="block w-full rounded-lg border-2 border-gray-300 dark:border-gray-700 bg-white dark:bg-gray-800 text-gray-900 dark:text-white px-4 py-3 text-sm focus:border-purple-500 focus:ring-2 focus:ring-purple-500 appearance-none">
                        <option value="" disabled {{ old('department_id', '') ? '' : 'selected' }}>
                            -- Select a department --
                        </option>
                        @foreach ($departments as $department)
                            <option value="{{ $department->id }}">
                                {{ $department->name }}
                            </option>
                        @endforeach
                    </select>
                    @error('department') <p class="text-red-500 dark:text-red-400 text-xs mt-2">{{ $message }}</p> @enderror
                </div>
            </div>
    
            <div>
                <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">
                    Password <span style="color: red">*</span>
                </label>
                <input name="password" type="password" required 
                    class="block w-full rounded-lg border-2 border-gray-300 dark:border-gray-700 bg-white dark:bg-gray-800 text-gray-900 dark:text-white px-4 py-3 text-sm focus:border-purple-500 focus:ring-2 focus:ring-purple-500" 
                    placeholder="Entrer le mot de passe" />
                @error('password') <p class="text-red-500 dark:text-red-400 text-xs mt-2">{{ $message }}</p> @enderror
            </div>
    
            <div>
                <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">
                    Confirmer votre mot de pass <span style="color: red">*</span>
                </label>
                <input name="password_confirmation" type="password" required 
                    class="block w-full rounded-lg border-2 border-gray-300 dark:border-gray-700 bg-white dark:bg-gray-800 text-gray-900 dark:text-white px-4 py-3 text-sm focus:border-purple-500 focus:ring-2 focus:ring-purple-500" 
                    placeholder="Confirmation de mot de passe" />
            </div>
    
            <button type="submit" class="w-full px-6 py-3 mt-8 text-base font-medium text-white bg-purple-600 rounded-lg hover:bg-purple-700 focus:outline-none focus:ring-4 focus:ring-purple-500 focus:ring-offset-2 transition-colors duration-200">
                Ajouter un utilisateur
            </button>
        </form>
    </div>
    
</div>
@endsection
