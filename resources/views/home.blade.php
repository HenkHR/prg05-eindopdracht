<x-app-layout>
    @auth
    <x-slot name="header">this is logged in the header</x-slot>
    this is logged in the slot content
    @endauth
    @guest
    <a href="{{ route('login') }}" class="bg-blue-500 text-white p-2 rounded-md">Login</a>
    <a href="{{ route('register') }}" class="bg-blue-500 text-white p-2 rounded-md">Register</a>
    @endguest
</x-app-layout>
