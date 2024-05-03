<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<x-head title="Reset Password" />

<x-layoutAuth class="flex justify-center items-center h-screen">
    <div class="bg-white shadow-md rounded-lg p-8 max-w-md w-full">
        <h1 class="text-2xl font-semibold mb-4 font-poppins">Reset Password</h1>
        <p class="mb-6 font-gelasio">Click the button below to reset your password</p>
        <a href="{{ route('reset-password', ['token' => $token]) }}"
            class="bg-blue-500 text-white px-4 py-2 rounded-md hover:bg-blue-600 transition duration-300 font-poppins">Reset
            Password</a>
    </div>
</x-layoutAuth>

</html>
