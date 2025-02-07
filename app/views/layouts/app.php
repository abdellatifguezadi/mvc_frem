<?php
use App\Core\Session;

$error = Session::get('error');
$success = Session::get('success');
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
</head>
<body class="bg-gray-50">
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

    <?php echo $content; ?>

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