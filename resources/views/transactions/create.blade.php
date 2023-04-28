<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between items-center">
            <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
              {{ __('Adding transaction') }}
            </h2>
        </div>
        <div>
          <a href="{{ route('transactions.index') }}" class="flex items-center gap-2 mt-2 text-sm text-gray-400">
            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-4 h-4">
              <path stroke-linecap="round" stroke-linejoin="round" d="M9 15L3 9m0 0l6-6M3 9h12a6 6 0 010 12h-3" />
            </svg>
            {{ __('Back to transaction list') }}
          </a>
        </div>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                  <!-- Validation Errors -->
                  <form method="POST" action="{{ route('transactions.store') }}" class="custom-form">
                    @csrf
                    @if ($message = Session::get('success'))
                    <div class="success">
                      <strong>{{ $message }}</strong>
                    </div>
                    @endif
                    <input type="hidden" name="client_id" value="{{ old('client_id') }}" />
                    <x-auth-validation-errors class="mb-4" :errors="$errors" />
                    <div>
                      <label>{{ __('Client') }}</label>
                      <input id="autoComplete" name="client_name" type="text" class="@error('client') is-invalid @enderror" value="{{ old('client_name') }}" />
                    </div>
                    <div>
                      <label>{{ __('Amount') }}</label>
                      <input name="amount" type="text" class="@error('amount') is-invalid @enderror" value="{{ old('amount') }}" />
                    </div>
                    <div>
                      <label>{{ __('Date') }}</label>
                      <input name="date" type="text" class="@error('date') is-invalid @enderror" value="{{ old('date') }}" />
                    </div>
                    <x-primary-button class="w-48 justify-center mx-auto mt-5">
                        {{ __('Add transaction') }}
                    </x-primary-button>
                  </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>

@section('additional_scripts')
    <p>This is my body content.</p>
@stop