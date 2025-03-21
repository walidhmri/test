<!DOCTYPE html>
<html :class="{ 'theme-dark': dark }" x-data="data()" lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Create account - Windmill Dashboard</title>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700;800&display=swap" rel="stylesheet" />
    <link rel="stylesheet" href="{{ asset('assets/css/tailwind.output.css') }}" />
    <script src="https://cdn.jsdelivr.net/gh/alpinejs/alpine@v2.x.x/dist/alpine.min.js" defer></script>
    <script src="{{ asset('assets/js/init-alpine.js') }}"></script>
  </head>
  <body>
    <div class="flex items-center min-h-screen p-6 bg-gray-50 dark:bg-gray-900">
      <div class="flex-1 h-full max-w-4xl mx-auto overflow-hidden bg-white rounded-lg shadow-xl dark:bg-gray-800">
        <div class="flex flex-col overflow-y-auto md:flex-row">
          <div class="h-32 md:h-auto md:w-1/2">
            <img aria-hidden="true" class="object-cover w-full h-full dark:hidden" src="{{ asset('assets/img/create-account-office.jpeg') }}" alt="Office" />
            <img aria-hidden="true" class="hidden object-cover w-full h-full dark:block" src="{{ asset('assets/img/create-account-office-dark.jpeg') }}" alt="Office" />
          </div>
          <div class="flex items-center justify-center p-6 sm:p-12 md:w-1/2">
            <div class="w-full">
              <h1 class="mb-4 text-xl font-semibold text-gray-700 dark:text-gray-200">Create account</h1>
              <form method="POST" action="">
                @csrf
                <label class="block text-sm">
                  <span class="text-gray-700 dark:text-gray-400">Name</span>
                  <input name="name" type="text" value="{{ old('name') }}" required autofocus autocomplete="name" class="block w-full mt-1 text-sm dark:border-gray-600 dark:bg-gray-700 form-input" placeholder="Jane Doe" />
                  @error('name') <p class="text-red-500 text-xs italic">{{ $message }}</p> @enderror
                </label>
                <label class="block mt-4 text-sm">
                  <span class="text-gray-700 dark:text-gray-400">User Id</span>
                  <input name="email" type="number" value="{{ old('email') }}" required class="block w-full mt-1 text-sm dark:border-gray-600 dark:bg-gray-700 form-input" placeholder="24862754" />
                  @error('email') <p class="text-red-500 text-xs italic">{{ $message }}</p> @enderror
                </label>
                <label class="block mt-4 text-sm">
                  <span class="text-gray-700 dark:text-gray-400">Password</span>
                  <input name="password" type="password" required class="block w-full mt-1 text-sm dark:border-gray-600 dark:bg-gray-700 form-input" placeholder="***************" />
                  @error('password') <p class="text-red-500 text-xs italic">{{ $message }}</p> @enderror
                </label>
                <label class="block mt-4 text-sm">
                  <span class="text-gray-700 dark:text-gray-400">Confirm password</span>
                  <input name="password_confirmation" type="password" required class="block w-full mt-1 text-sm dark:border-gray-600 dark:bg-gray-700 form-input" placeholder="***************" />
                </label>
                <div class="flex mt-6 text-sm">
                  <label class="flex items-center dark:text-gray-400">
                    <input type="checkbox" class="form-checkbox" required />
                    <span class="ml-2">I agree to the <a href="#" class="underline">privacy policy</a></span>
                  </label>
                </div>
                <button type="submit" class="block w-full px-4 py-2 mt-4 text-sm font-medium text-white bg-purple-600 rounded-lg hover:bg-purple-700">Create account</button>
              </form>
              <p class="mt-4 text-center">
                <a class="text-sm font-medium text-purple-600 dark:text-purple-400 hover:underline" href="{{ route('login') }}">Already have an account? Login</a>
              </p>
            </div>
          </div>
        </div>
      </div>
    </div>
  </body>
</html>
