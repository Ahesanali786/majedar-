<!DOCTYPE html>
<html>
<head>
    <title>Hacking in Progress</title>
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/css/hack.css') }}">
    <script>
        function startHacking() {
            let text = document.getElementById('hacking-text');
            let messages = [
                "Accessing system files...",
                "Decrypting passwords...",
                "Uploading data to server...",
                "Hacking in progress...",
                "Almost done...",
                "System compromised!"
            ];
            let i = 0;
            setInterval(() => {
                if (i < messages.length) {
                    text.innerHTML += messages[i] + "<br>";
                    i++;
                }
            }, 2000);
        }
        window.onload = startHacking;
    </script>
</head>
<body>
    <div class="container">
        <h1>Hacking in Progress...</h1>
        <div id="hacking-text"></div>
    </div>
</body>
</html>
