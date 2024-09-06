<!DOCTYPE html>
<html>
<head>
    <title>Send Email with Attachment</title>
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/css/email.css') }}">
</head>
<body>
    <div class="container">
        @if (session('success'))
            <div class="alert alert-success">
                {{ session('success') }}
            </div>
        @endif
        <form action="/send-email" method="POST" enctype="multipart/form-data">
            @csrf
            <h2>Send Email with Attachment</h2>
            <label for="email">Email:</label>
            <input type="email" id="email" name="email" required>
            <label for="subject">Subject:</label>
            <input type="text" id="subject" name="subject" required>
            <label for="message">Message:</label>
            <textarea id="message" name="message" required></textarea>
            <label for="attachment">Attachment:</label>
            <input type="file" id="attachment" name="attachment" required>
            <button type="submit">Send Email</button>
        </form>
    </div>
</body>
</html>
