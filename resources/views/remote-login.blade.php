<x-layouts.auth.simple title="Login">
    <x-auth-header :title="__('Log in')" :description="__('Enter your email and password to sign in')" />

    @if (session('error'))
        <div class="text-red-500 text-sm text-center">{{ session('error') }}</div>
    @endif

    <form method="POST" action="{{ route('remote.login.submit') }}" class="flex flex-col gap-4">
        @csrf
        <div>
            <label class="block text-sm mb-1" for="email">Email</label>
            <input id="email" name="email" type="email" required autofocus class="w-full border rounded px-3 py-2" />
        </div>
        <div>
            <label class="block text-sm mb-1" for="password">Password</label>
            <input id="password" name="password" type="password" required class="w-full border rounded px-3 py-2" />
        </div>
        <div class="flex items-center justify-end">
            <button type="submit" class="px-4 py-2 bg-blue-600 text-white rounded">Login</button>
        </div>
    </form>
</x-layouts.auth.simple>
