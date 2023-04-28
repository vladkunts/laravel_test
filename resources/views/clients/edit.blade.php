<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between items-center">
            <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
                {{ __('Editing client') }}
            </h2>
        </div>
        <div>
          <a href="{{ route('clients.index') }}" class="flex items-center gap-2 mt-2 text-sm text-gray-400">
            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-4 h-4">
              <path stroke-linecap="round" stroke-linejoin="round" d="M9 15L3 9m0 0l6-6M3 9h12a6 6 0 010 12h-3" />
            </svg>
            {{ __('Back to client list') }}
          </a>
        </div>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                  <!-- Validation Errors -->
                  <form method="POST" action="{{ route('clients.update', $client->id) }}" class="custom-form" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')
                    @if ($message = Session::get('success'))
                    <div class="success">
                      <strong>{{ $message }}</strong>
                    </div>
                    @endif
                    <x-auth-validation-errors class="mb-4" :errors="$errors" />
                    <div>
                      <label>{{ __('First Name') }}</label>
                      <input name="firstname" type="text" class="@error('firstname') is-invalid @enderror" value="{{ old('firstname', $client->firstname) }}" />
                    </div>
                    <div>
                      <label>{{ __('Last Name') }}</label>
                      <input name="lastname" type="text" class="@error('lastname') is-invalid @enderror" value="{{ old('lastname', $client->lastname) }}" />
                    </div>
                    <div>
                      <label>{{ __('Email') }}</label>
                      <input name="email" type="text" class="@error('email') is-invalid @enderror" value="{{ old('email', $client->email) }}" />
                    </div>
                    <div>
                      <img src="{{ asset($client->avatar) }}" class="max-w-[200px] max-h-[200px] mx-auto" />
                      <label>{{ __('Upload file') }}</label>
                      <input name="avatar" class="block w-full text-sm text-gray-900 border border-gray-300 rounded-lg cursor-pointer bg-gray-50 dark:text-gray-400 focus:outline-none dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400" id="file_input" type="file">
                    </div>
                    <x-primary-button class="w-32 justify-center mx-auto mt-5">
                        {{ __('Edit client') }}
                    </x-primary-button>
                  </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>