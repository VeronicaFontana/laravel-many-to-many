<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">

    <!-- CKEditor -->
    <script src="https://cdn.ckeditor.com/ckeditor5/40.1.0/classic/ckeditor.js"></script>

    <!-- Fontawesome -->
    <script src="https://kit.fontawesome.com/66b933bf5d.js" crossorigin="anonymous"></script>

    <!-- Scripts -->
    @vite(["resources/js/app.js"])

    <title>Admin</title>
</head>
<body>

    @include("admin.partials.header")

    <div class="main-wrapper d-flex">
        @include("admin.partials.sidebar")
        <div class="p-5 w-100 content">
            @yield("content")
        </div>
    </div>


</body>
</html>
