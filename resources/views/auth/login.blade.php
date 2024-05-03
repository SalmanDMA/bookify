<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<x-head title="Login to Bookify" />


<x-layoutAuth
    class="grid grid-cols-1 sm:grid-cols-2 min-h-screen bg-[url('/public/images/register-image.webp')] sm:bg-none sm:bg-white">
    <img src="{{ asset('images/login-image.webp') }}" alt="Image by unsplash" title="https://unsplash.com/@jaredd"
        class="w-full h-full max-h-screen object-cover object-center hidden sm:block">
    <div class="flex flex-col justify-center">
        <div class="bg-[rgba(255, 255, 255, 0.25)] backdrop-blur-sm sm:bg-white p-8 mx-8 rounded-xl shadow-xl">
            <div class="flex flex-col mb-4">
                <h1 class="text-3xl font-bold font-poppins text-white sm:text-black">Login to Bookify</h1>
                <p class="text-lg text-gray-400 font-gelasio">Login to access bookify website</p>
            </div>
            <form action="{{ route('login.post') }}" method="post" class="flex flex-col gap-4">
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
                <div class="flex justify-between items-center">
                    <div class="flex items-center gap-1">
                        <input type="checkbox" name="remember" id="remember"
                            class="w-4 h-4 disabled:cursor-not-allowed disabled:opacity-50">
                        <label for="remember" class="block font-poppins text-white sm:text-black">Remember
                            me</label>
                    </div>
                    <a href="{{ route('forgot-password') }}" class="text-blue-500 hover:underline">Forgot password?</a>
                </div>
                <button type="submit"
                    class="bg-blue-500 text-white px-4 py-2 rounded-md hover:bg-blue-600 transition duration-300 mt-4 font-poppins">Login</button>
            </form>
            <p class="text-gray-400 font-gelasio mt-4 text-end">Don't have an account? <a href="{{ route('register') }}"
                    class="text-blue-500 hover:underline font-poppins">Register
                    here</a></p>
        </div>
    </div>
</x-layoutAuth>


<script>
    $(document).ready(function() {
        function toggleRememberCheckbox() {
            const email = $('#email').val();
            if (!email) {
                $('#remember').prop('disabled', true);
            } else {
                $('#remember').prop('disabled', false);
                if ($('#remember').prop('checked')) {
                    localStorage.setItem('rememberMe', email);
                } else {
                    localStorage.removeItem('rememberMe');
                }
            }
        }

        $('#remember').change(function() {
            toggleRememberCheckbox();
        });

        const rememberMe = localStorage.getItem('rememberMe');
        if (rememberMe) {
            $('#email').val(rememberMe);
            $('#remember').prop('checked', true);
        }

        $('#email').change(function() {
            toggleRememberCheckbox();
        });

        toggleRememberCheckbox();
    });
</script>


</html>
