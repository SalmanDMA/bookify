<body class="bg-gray-100">
    <main class="{{ $class }}">
        {{ $slot }}
    </main>

    @include('sweetalert::alert')
</body>
