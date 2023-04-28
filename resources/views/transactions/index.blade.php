<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between items-center">
            <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
                {{ __('Transactions') }}
            </h2>
            <a href="{{ route('transactions.create') }}" class="flex items-center gap-2 py-2 px-3 border border-white rounded-md text-white hover:bg-white hover:text-black transition-colors duration-300 ease-in-out">
                {{ __('Add transaction') }}
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M12 6v12m6-6H6" />
                </svg>
            </a>
        </div>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="relative overflow-x-auto text-gray-900 dark:text-gray-100">
                  <table class="custom-table">
                    <thead>
                      <tr>
                        <th>{{ __('Client') }}</th>
                        <th>{{ __('Amount') }}</th>
                        <th>{{ __('Transaction date') }}</th>
                        <th></th>
                      </tr>
                    </thead>
                    <tbody>
                      @if(count($transactions))
                      @foreach ($transactions as $transaction)
                      <tr>
                        <td>{{ $transaction->client->firstname }} {{ $transaction->client->lastname }}</td>
                        <td>{{ $transaction->amount }}</td>
                        <td>{{ date("d/m/Y", strtotime($transaction->transaction_date)) }}</td>
                        <td>
                          <a href="{{ route('transactions.edit', $transaction->id) }}" class="inline-block">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                              <path stroke-linecap="round" stroke-linejoin="round" d="M16.862 4.487l1.687-1.688a1.875 1.875 0 112.652 2.652L10.582 16.07a4.5 4.5 0 01-1.897 1.13L6 18l.8-2.685a4.5 4.5 0 011.13-1.897l8.932-8.931zm0 0L19.5 7.125M18 14v4.75A2.25 2.25 0 0115.75 21H5.25A2.25 2.25 0 013 18.75V8.25A2.25 2.25 0 015.25 6H10" />
                            </svg>
                          </a>
                          <a href="#" onClick="event.preventDefault();if(confirm('Are you sure?')) document.getElementById('delete-{{ $transaction->id }}').submit()" class="inline-block ml-3 text-red-600">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                              <path stroke-linecap="round" stroke-linejoin="round" d="M14.74 9l-.346 9m-4.788 0L9.26 9m9.968-3.21c.342.052.682.107 1.022.166m-1.022-.165L18.16 19.673a2.25 2.25 0 01-2.244 2.077H8.084a2.25 2.25 0 01-2.244-2.077L4.772 5.79m14.456 0a48.108 48.108 0 00-3.478-.397m-12 .562c.34-.059.68-.114 1.022-.165m0 0a48.11 48.11 0 013.478-.397m7.5 0v-.916c0-1.18-.91-2.164-2.09-2.201a51.964 51.964 0 00-3.32 0c-1.18.037-2.09 1.022-2.09 2.201v.916m7.5 0a48.667 48.667 0 00-7.5 0" />
                            </svg>
                          </a>
                          <form id="delete-{{ $transaction->id }}" action="{{ route('transactions.destroy', $transaction->id) }}" method="POST">
                                @csrf
                                @method('DELETE')
                          </form>
                        </td>
                      </tr>
                      @endforeach
                      @else
                        <td colspan="4" align="center">Transactions not found.</td>
                      @endif
                    </tbody>
                  </table>
                </div>
                <div class="text-white">
                  {{ $transactions->links() }}
                </div>
            </div>
        </div>
    </div>
</x-app-layout>