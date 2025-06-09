<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Daftar - Sistem Absensi RFID</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="bg-gray-50 min-h-screen flex items-center justify-center">
    <div class="max-w-md w-full space-y-8 p-8" x-data="registerForm()">
        <!-- Logo/Header -->
        <div class="text-center">
            <div class="mx-auto h-16 w-16 bg-blue-600 rounded-full flex items-center justify-center mb-4">
                <i class="ri-scan-2-line ri-2x text-white"></i>
            </div>
            <h2 class="text-3xl font-bold text-gray-900 mb-2">Daftar Akun Baru</h2>
            <p class="text-gray-600">Buat akun untuk mengakses dashboard admin</p>
        </div>

        <!-- Register Form -->
        <div class="bg-white rounded-lg shadow-sm p-8">
            <form method="POST" action="{{ route('register') }}" class="space-y-6" x-ref="registerForm">
                @csrf
                <div>
                    <label for="name" class="block text-sm font-medium text-gray-700 mb-2">
                        Nama Lengkap
                    </label>
                    <div class="relative">
                        <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                            <i class="ri-user-line text-gray-400"></i>
                        </div>
                        <input type="text" id="name" name="name" required
                               class="w-full pl-10 pr-3 py-3 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent"
                               placeholder="Masukkan nama lengkap">
                    </div>
                </div>

                <div>
                    <label for="email" class="block text-sm font-medium text-gray-700 mb-2">
                        Email
                    </label>
                    <div class="relative">
                        <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                            <i class="ri-mail-line text-gray-400"></i>
                        </div>
                        <input type="email" id="email" name="email" required
                               class="w-full pl-10 pr-3 py-3 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent"
                               placeholder="Masukkan email">
                    </div>
                </div>

                <div>
                    <label for="password" class="block text-sm font-medium text-gray-700 mb-2">
                        Password
                    </label>
                    <div class="relative">
                        <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                            <i class="ri-lock-line text-gray-400"></i>
                        </div>
                        <input :type="showPassword ? 'text' : 'password'"
                               id="password"
                               name="password"
                               required
                               class="w-full pl-10 pr-10 py-3 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent"
                               placeholder="Masukkan password (minimal 6 karakter)">
                        <button type="button"
                                @click="showPassword = !showPassword"
                                class="absolute inset-y-0 right-0 pr-3 flex items-center">
                            <i :class="showPassword ? 'ri-eye-off-line' : 'ri-eye-line'" class="text-gray-400 hover:text-gray-600"></i>
                        </button>
                    </div>
                </div>

                <div>
                    <label for="password_confirmation" class="block text-sm font-medium text-gray-700 mb-2">
                        Konfirmasi Password
                    </label>
                    <div class="relative">
                        <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                            <i class="ri-lock-line text-gray-400"></i>
                        </div>
                        <input :type="showConfirmPassword ? 'text' : 'password'"
                               id="password_confirmation"
                               name="password_confirmation"
                               required
                               class="w-full pl-10 pr-10 py-3 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent"
                               placeholder="Masukkan ulang password">
                               <button type="button"
                                @click="showConfirmPassword = !showConfirmPassword"
                                class="absolute inset-y-0 right-0 pr-3 flex items-center">
                            <i :class="showConfirmPassword ? 'ri-eye-off-line' : 'ri-eye-line'" class="text-gray-400 hover:text-gray-600"></i>
                        </button>
                    </div>
                </div>

                <div>
                    <button type="submit"
                            class="w-full flex justify-center py-3 px-4 border border-transparent rounded-md shadow-sm text-sm font-medium text-white bg-blue-600 hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500 transition-colors">
                        <i class="ri-user-add-line mr-2"></i>
                        <span>Daftar</span>
                    </button>
                </div>

                <div class="text-center">
                    <span class="text-sm text-gray-600">Sudah punya akun? </span>
                    <a href="{{ route('login') }}" class="text-sm font-medium text-blue-600 hover:text-blue-500">
                        Masuk disini
                    </a>
                </div>
            </form>
        </div>

        <!-- Footer -->
        <div class="text-center text-sm text-gray-500">
             <p>&copy; <?= date('Y') ?> Sistem Absensi RFID. All rights reserved.</p>
        </div>
    </div>

    <script>
    function registerForm() {
        return {
            showPassword: false
            , showConfirmPassword: false
        }
    }
    </script>

</body>
</html>
