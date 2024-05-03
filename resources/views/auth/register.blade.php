<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<x-head title="Register to Bookify" />

<x-layoutAuth
    class="grid grid-cols-1 sm:grid-cols-2 min-h-screen bg-[url('/public/images/register-image.webp')] sm:bg-none sm:bg-white">
    <div class="flex flex-col justify-center">
        <div class="bg-[rgba(255, 255, 255, 0.25)] backdrop-blur-sm sm:bg-white p-8 mx-8 rounded-xl shadow-xl">
            <div class="flex flex-col mb-4">
                <h1 class="text-3xl font-bold font-poppins text-white sm:text-black">Register to Bookify</h1>
                <p class="text-lg text-gray-400 font-gelasio">Create an account to get started</p>
            </div>
            <form action="{{ route('register.post') }}" method="post" class="flex flex-col gap-4">
                @csrf
                <div>
                    <label for="name" class="block font-poppins text-white sm:text-black">Name<span
                            class="text-red-500">*</span></label>
                    <input type="text" name="name" id="name"
                        class="border rounded-md px-3 py-2 w-full font-gelasio @if ($errors->has('name')) border-red-500 @else border-gray-300 @endif"
                        placeholder="Type your name here...">
                    @error('name')
                        <p class="text-red-500">{{ $message }}</p>
                    @enderror
                </div>
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

                <button type="submit"
                    class="bg-blue-500 text-white px-4 py-2 rounded-md hover:bg-blue-600 transition duration-300 mt-4 font-poppins">Register</button>
            </form>
            <p class="text-gray-400 font-gelasio mt-4 text-end">Already have an account? <a href="{{ route('login') }}"
                    class="text-blue-500 hover:underline font-poppins">Login here</a>
            </p>
        </div>
    </div>
    <img src="{{ asset('images/register-image.webp') }}" alt="Image by unsplash" title="https://unsplash.com/@tothnorex"
        class="w-full h-full max-h-screen object-cover object-center hidden sm:block">
</x-layoutAuth>

</html>
