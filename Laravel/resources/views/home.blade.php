<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>TCR - Cursus Inschrijvingen</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="bg-gray-50">
<nav class="bg-white shadow-sm">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex justify-between h-16">
            <div class="flex items-center">
                <h1 class="text-2xl font-bold text-blue-600">TCR School</h1>
            </div>
            <div class="flex items-center space-x-4">
                <a href="/courses" class="text-gray-700 hover:text-blue-600">Cursussen</a>
                <a href="/login" class="text-gray-700 hover:text-blue-600">Login</a>
                <a href="/register" class="bg-blue-600 text-white px-4 py-2 rounded-lg hover:bg-blue-700">
                    Registreer
                </a>
            </div>
        </div>
    </div>
</nav>

<div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-16">
    <div class="text-center">
        <h1 class="text-5xl font-extrabold text-gray-900 mb-4">
            Welkom bij TCR
        </h1>
        <p class="text-xl text-gray-600 mb-8">
            Schrijf je in voor de beste cursussen en start jouw leertraject vandaag
        </p>
        <div class="flex justify-center space-x-4">
            <a href="/courses" class="bg-blue-600 text-white px-8 py-3 rounded-lg text-lg font-semibold hover:bg-blue-700">
                Bekijk Cursussen
            </a>
            <a href="/register" class="bg-gray-200 text-gray-800 px-8 py-3 rounded-lg text-lg font-semibold hover:bg-gray-300">
                Maak Account
            </a>
        </div>
    </div>
</div>

<div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-12">
    <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
        <div class="bg-white p-6 rounded-lg shadow-sm">
            <div class="text-blue-600 text-4xl mb-4">📚</div>
            <h3 class="text-xl font-bold text-gray-900 mb-2">Diverse Cursussen</h3>
            <p class="text-gray-600">
                Kies uit een breed aanbod van cursussen, van webontwikkeling tot game design
            </p>
        </div>

        <div class="bg-white p-6 rounded-lg shadow-sm">
            <div class="text-blue-600 text-4xl mb-4">👥</div>
            <h3 class="text-xl font-bold text-gray-900 mb-2">Expert Docenten</h3>
            <p class="text-gray-600">
                Leer van ervaren professionals met jarenlange praktijkervaring
            </p>
        </div>

        <div class="bg-white p-6 rounded-lg shadow-sm">
            <div class="text-blue-600 text-4xl mb-4">⚡</div>
            <h3 class="text-xl font-bold text-gray-900 mb-2">Eenvoudig Inschrijven</h3>
            <p class="text-gray-600">
                Schrijf je in met één klik en start direct met leren
            </p>
        </div>
    </div>
</div>

<footer class="bg-gray-800 text-white mt-16">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
        <div class="text-center">
            <p>&copy; 2026 TCR School. Alle rechten voorbehouden.</p>
        </div>
    </div>
</footer>
</body>
</html>
