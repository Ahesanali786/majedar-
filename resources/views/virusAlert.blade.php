<!DOCTYPE html>
<html>
<head>
    <title>Virus Alert</title>
    <link rel="stylesheet" type="text/css" href="{{ asset('/assets/css/virus.css') }}">
    <script>
        function showAlert() {
            alert("Your system is infected with a virus!");
        }
        setTimeout(showAlert, 2);
    </script>
</head>
<body>
    <div class="container">
        <h1>Warning!</h1>
        <p>Your system is infected with a virus. Immediate action is required!</p>
        <button onclick="showAlert()">Click here to fix</button>
    </div>
</body>
</html>
