<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Internet Connection Check</title>
</head>
<body>
    <h1>Internet Connection Status</h1>

    <script>
        function checkInternetConnection() {
            fetch('https://www.google.com', { mode: 'no-cors' })
                .then(() => {
                    alert("You are online.");
                })
                .catch(() => {
                    alert("You are offline.");
                });
        }

        window.addEventListener('offline', function() {
            alert("You are offline.");
        });

        window.addEventListener('online', function() {
            checkInternetConnection();
        });

        // Initial check
        checkInternetConnection();
    </script>
</body>
</html>
