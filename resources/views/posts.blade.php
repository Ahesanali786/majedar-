<!DOCTYPE html>
<html>

<head>
    <title>Laravel AJAX CRUD</title>
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
</head>

<body>
    <div class="container">
        <h2>Laravel AJAX CRUD</h2>
        <button id="createPost" class="btn btn-success">Create Post</button>
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Title</th>
                    <th>Content</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody id="postTable">
                <!-- Posts will be loaded here -->
            </tbody>
        </table>
    </div>

    <!-- Create/Edit Modal -->
    <div class="modal" id="postModal">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title">Post</h4>
                    <button type="button" class="close" data-dismiss="modal">×</button>
                </div>
                <div class="modal-body">
                    <form id="postForm">
                        <input type="hidden" id="postId">
                        <div class="form-group">
                            <label for="title">Title:</label>
                            <input type="text" class="form-control" id="title" required>
                        </div>
                        <div class="form-group">
                            <label for="content">Content:</label>
                            <textarea class="form-control" id="content" required></textarea>
                        </div>
                        <button type="submit" class="btn btn-primary">Save</button>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <script>
        $(document).ready(function() {
            // Load posts
            function loadPosts() {
                $.ajax({
                    url: '/posts',
                    method: 'GET',
                    success: function(data) {
                        let rows = '';
                        data.forEach(post => {
                            rows += `
                        <tr>
                            <td>${post.id}</td>
                            <td>${post.title}</td>
                            <td>${post.content}</td>
                            <td>
                                <button class="btn btn-info editPost" data-id="${post.id}">Edit</button>
                                <button class="btn btn-danger deletePost" data-id="${post.id}">Delete</button>
                            </td>
                        </tr>
                    `;
                        });
                        $('#postTable').html(rows);
                    }
                });
            }

            loadPosts();

            // Create post
            $('#createPost').click(function() {
                $('#postForm')[0].reset();
                $('#postId').val('');
                $('#postModal').modal('show');
            });

            $('#postForm').submit(function(e) {
                e.preventDefault();
                let id = $('#postId').val();
                let url = id ? `/posts/${id}` : '/posts';
                let method = id ? 'PUT' : 'POST';
                $.ajax({
                    url: url,
                    method: method,
                    data: {
                        title: $('#title').val(),
                        content: $('#content').val(),
                        _token: $('meta[name="csrf-token"]').attr('content')
                    },
                    success: function(data) {
                        $('#postModal').modal('hide');
                        loadPosts();
                    }
                });
            });

            // Edit post
            $(document).on('click', '.editPost', function() {
                let id = $(this).data('id');
                $.ajax({
                    url: `/posts/${id}`,
                    method: 'GET',
                    success: function(data) {
                        $('#postId').val(data.id);
                        $('#title').val(data.title);
                        $('#content').val(data.content);
                        $('#postModal').modal('show');
                    }
                });
            });

            // Delete post
            $(document).on('click', '.deletePost', function() {
                let id = $(this).data('id');
                $.ajax({
                    url: `/posts/${id}`,
                    method: 'DELETE',
                    data: {
                        _token: $('meta[name="csrf-token"]').attr('content')
                    },
                    success: function(data) {
                        loadPosts();
                    }
                });
            });
        });
    </script>
</body>

</html>
