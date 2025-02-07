<?php
use App\Core\Session;
use App\Core\Security;

$error = Session::get('error');
$success = Session::get('success');
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Authentication</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-50 min-h-screen flex items-center justify-center">
    <?php if ($error): ?>
        <div class="fixed top-5 right-5 bg-red-500 text-white px-6 py-3 rounded shadow-lg transform transition-all duration-500 opacity-100 translate-y-0 fade-out">
            <?php echo $error; ?>
        </div>
    <?php endif; ?>

    <?php if ($success): ?>
        <div class="fixed top-5 right-5 bg-green-500 text-white px-6 py-3 rounded shadow-lg transform transition-all duration-500 opacity-100 translate-y-0 fade-out">
            <?php echo $success; ?>
        </div>
    <?php endif; ?>

    <div class="w-full max-w-md p-6">
        <div class="bg-white rounded-lg shadow-lg">
            <?php echo $content; ?>
        </div>
    </div>

    <script>
        setTimeout(function() {
            const notifications = document.querySelectorAll('.fade-out');
            notifications.forEach(notification => {
                notification.style.opacity = '0';
                notification.style.transform = 'translateY(-20px)';
            });
        }, 10000);
    </script>
</body>
</html> 