<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<x-head title="Reset Password" />


<x-layoutAuth class="flex justify-center items-center h-screen">
    <div class="bg-white shadow-md rounded-lg p-8 max-w-md w-full">
        <div class="flex flex-col mb-4">
            <h1 class="text-3xl font-bold font-poppins text-white sm:text-black">Reset Password</h1>
            <p class="text-lg text-gray-400 font-gelasio">Enter your new password for your account</p>
        </div>
        <form action="{{ route('reset-password.post') }}" method="post" class="space-y-4">
            @csrf
            <input type="hidden" name="token" value="{{ $token->token ?? '' }}">
            <div>
                <label for="email" class="block font-poppins text-white sm:text-black">Email<span
                        class="text-red-500">*</span></label>
                <input type="email" name="email" id="email"
                    class="border rounded-md px-3 py-2 w-full font-gelasio disabled:cursor-not-allowed disabled:opacity-50 @if ($errors->has('email')) border-red-500 @else border-gray-300 @endif"
                    placeholder="Type your email here..." value="{{ $token->email ?? '' }}" disabled>
                @error('email')
                    <p class="text-red-500">{{ $message }}</p>
                @enderror
            </div>
            <div>
                <label for="password" class="block font-poppins text-white sm:text-black">Password<span
                        class="text-red-500">*</span></label>
                <input type="password" name="password" id="password"
                    class="border rounded-md px-3 py-2 w-full font-gelasio @if ($errors->has('password')) border-red-500 @else border-gray-300 @endif"
                    placeholder="Type your password here...">
                @error('password')
                    <p class="text-red-500">{{ $message }}</p>
                @enderror
            </div>
            <div class="flex items-center">
                <button type="submit"
                    class="bg-blue-500 text-white px-4 py-2 rounded-md hover:bg-blue-600 transition duration-300 font-poppins w-full">Reset</button>
            </div>
        </form>
    </div>
</x-layoutAuth>

</html>
