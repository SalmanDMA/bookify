<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<x-head title="Verify Email" />

<x-layoutAuth class="flex justify-center items-center h-screen">
    <div class="bg-white shadow-md rounded-lg p-8 max-w-md w-full">
        <h1 class="text-2xl font-semibold mb-4 font-poppins">Verify Your Email</h1>
        <p class="mb-6 font-gelasio">An email verification link has been sent to your email address. Please check
            your inbox and
            click on the link to verify your email.</p>
        <div class="mb-6">
            <p class="text-sm font-gelasio">Didn't receive the email?</p>
            <form action="{{ route('verification.send') }}" method="post">
                @csrf
                <button type="submit" class="text-blue-500 hover:underline font-poppins">Request another
                    verification
                    email</button>
            </form>
        </div>
    </div>
</x-layoutAuth>

</html>
