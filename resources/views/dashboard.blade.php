<x-layouts.app :title="__('Dashboard')">
    <div class="flex flex-col gap-4">
        <h1 class="text-xl font-bold">{{ __('Employees') }}</h1>
        <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-4">
            @forelse ($employees as $employee)
                <div class="border rounded p-4 flex flex-col items-center">
                    <img class="h-20 w-20 rounded-full object-cover mb-2" src="{{ $employee['photo'] ?? '' }}" alt="{{ $employee['first_name'] ?? '' }} {{ $employee['last_name'] ?? '' }}" />
                    <div class="text-center">
                        <p class="font-semibold">{{ $employee['first_name'] ?? '' }} {{ $employee['last_name'] ?? '' }}</p>
                        <p class="text-sm text-gray-500">{{ $employee['email'] ?? '' }}</p>
                    </div>
                </div>
            @empty
                <p class="text-gray-500">{{ __('No employees found.') }}</p>
            @endforelse
        </div>
    </div>
</x-layouts.app>
