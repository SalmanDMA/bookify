<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<x-head title="Forgot Password" />

<x-layoutAuth class="flex justify-center items-center h-screen">
    <div class="bg-white shadow-md rounded-lg p-8 max-w-md w-full">
        <div class="flex flex-col mb-4">
            <h1 class="text-3xl font-bold font-poppins text-white sm:text-black">Forgot Password</h1>
            <p class="text-lg text-gray-400 font-gelasio">Enter your email address to reset your password</p>
        </div>
        <form action="{{ route('forgot-password.post') }}" method="post" class="space-y-4">
            @csrf
            <div>
                <label for="email" class="block font-poppins text-white sm:text-black">Email<span
                        class="text-red-500">*</span></label>
                <input type="email" name="email" id="email"
                    class="border rounded-md px-3 py-2 w-full font-gelasio @if ($errors->has('email')) border-red-500 @else border-gray-300 @endif"
                    placeholder="Type your email here...">
                @error('email')
                    <p class="text-red-500">{{ $message }}</p>
                @enderror
            </div>
            <div class="flex items-center">
                <button type="submit"
                    class="bg-blue-500 text-white px-4 py-2 rounded-md hover:bg-blue-600 transition duration-300 font-poppins w-full">Send
                    Password Reset Link</button>
            </div>
        </form>
    </div>
</x-layoutAuth>

</html>
