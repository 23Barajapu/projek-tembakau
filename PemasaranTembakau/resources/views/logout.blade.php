<!-- resources/views/logout.blade.php -->
<!DOCTYPE html>
<html>

<head>
    <title>Logout</title>
</head>

<body>
    <h1>Logout</h1>
    <form action="{{ route('logout') }}" method="POST">
        @csrf
        <button type="submit">Logout</button>
    </form>
</body>

</html>
