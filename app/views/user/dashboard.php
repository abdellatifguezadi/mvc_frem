

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard Utilisateur</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100">
    <!-- Barre de navigation -->
    <nav class="bg-gradient-to-r from-blue-500 to-blue-600 shadow-lg">
        <div class="max-w-7xl mx-auto px-4">
            <div class="flex justify-between items-center py-6">
                <div class="flex items-center">
                    <span class="text-2xl font-bold text-white">Dashboard</span>
                </div>
                <div class="flex items-center space-x-6">
                    <span class="text-white">
                        <i class="fas fa-user mr-2"></i>
                        <?php echo $user->name; ?>
                    </span>
                    <a href="/logout" class="bg-red-500 hover:bg-red-600 text-white px-4 py-2 rounded-lg transition duration-200">
                        Déconnexion
                    </a>
                </div>
            </div>
        </div>
    </nav>

    <div class="max-w-7xl mx-auto px-4 py-8">
        <!-- Carte de profil -->
        <div class="bg-white rounded-2xl shadow-lg p-8 mb-8">
            <div class="flex items-center justify-between mb-6">
                <h2 class="text-3xl font-bold text-gray-800">Mon Profil</h2>
                <span class="px-4 py-2 bg-blue-100 text-blue-800 rounded-full font-semibold">
                    <?php echo ucfirst($user->role); ?>
                </span>
            </div>
            
            <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
                <div class="space-y-6">
                    <div>
                        <label class="block text-sm font-medium text-gray-500 mb-1">Nom Complet</label>
                        <p class="text-xl font-semibold text-gray-800"><?php echo $user->name; ?></p>
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-gray-500 mb-1">Email</label>
                        <p class="text-xl font-semibold text-gray-800"><?php echo $user->email; ?></p>
                    </div>
                </div>
                <div class="space-y-6">
                    <div>
                        <label class="block text-sm font-medium text-gray-500 mb-1">Date d'inscription</label>
                        <p class="text-xl font-semibold text-gray-800">
                            <?php echo date('d/m/Y', strtotime($user->created_at)); ?>
                        </p>
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-gray-500 mb-1">Dernière connexion</label>
                        <p class="text-xl font-semibold text-gray-800">
                            <?php echo date('d/m/Y H:i', strtotime($user->updated_at)); ?>
                        </p>
                    </div>
                </div>
            </div>
        </div>

        <!-- Statistiques -->
        <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
            <div class="bg-gradient-to-br from-blue-500 to-blue-600 rounded-2xl shadow-lg p-6 text-white">
                <h3 class="text-lg font-semibold mb-2">Messages</h3>
                <p class="text-3xl font-bold">0</p>
            </div>
            <div class="bg-gradient-to-br from-green-500 to-green-600 rounded-2xl shadow-lg p-6 text-white">
                <h3 class="text-lg font-semibold mb-2">Notifications</h3>
                <p class="text-3xl font-bold">0</p>
            </div>
            <div class="bg-gradient-to-br from-purple-500 to-purple-600 rounded-2xl shadow-lg p-6 text-white">
                <h3 class="text-lg font-semibold mb-2">Activités</h3>
                <p class="text-3xl font-bold">0</p>
            </div>
        </div>
    </div>

    <!-- Font Awesome -->
    <script src="https://kit.fontawesome.com/your-code.js" crossorigin="anonymous"></script>
</body>
</html> 
</html> 