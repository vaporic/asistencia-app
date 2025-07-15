<x-layouts.app :title="__('Dashboard')">
    <div class="flex flex-col gap-4">
        <h1 class="text-xl font-bold">{{ __('Employees') }}</h1>
        <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-4">
            @forelse ($employees as $employee)
                <div class="border rounded p-4 flex flex-col items-center">
                    <img class="w-24 h-24 rounded-full object-cover mb-2" src="{{ $employee['photo'] ?: asset('images/default-user.svg') }}" alt="{{ $employee['first_name'] ?? '' }} {{ $employee['last_name'] ?? '' }}" />
                    <div class="text-center">
                        <p class="font-semibold">{{ $employee['first_name'] ?? '' }} {{ $employee['last_name'] ?? '' }}</p>
                        <p class="text-sm text-gray-500">{{ $employee['email'] ?? '' }}</p>
                    </div>
                    <button class="mt-4 px-4 py-2 bg-blue-600 text-white rounded shadow hover:bg-blue-700">{{ __('Registrar asistencia') }}</button>
                </div>
            @empty
                <p class="text-gray-500">{{ __('No employees found.') }}</p>
            @endforelse
        </div>
    </div>
</x-layouts.app>
