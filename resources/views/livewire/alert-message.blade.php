<div>
    @if (session()->has('alert-messages') && session()->get('alert-messages')->count())
        <div class="fixed mt-4 w-full sm:px-6 lg:px-8" wire:poll.4s="render">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-4 bg-gray-50 border-b border-gray-200">
                    @foreach (session()->get('alert-messages') as $alert)
                        <div class="text-center {{ $alert['type'] == 'success' ? 'text-green-500' : 'text-red-500' }}">{{ $alert['message'] }}</div>
                    @endforeach
                </div>
            </div>
        </div>
    @endif
</div>
