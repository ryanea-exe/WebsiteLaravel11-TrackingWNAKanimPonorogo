<!DOCTYPE html>
<html>
<head>
    <title>Import Excel WNA</title>
</head>
<body>

<h2>Upload Excel WNA</h2>

@if(session('success'))
    <p style="color:green">{{ session('success') }}</p>
@endif

<form action="/import-wna" method="POST" enctype="multipart/form-data">
    @csrf
    <input type="file" name="file" required>
    <button type="submit">Upload</button>
</form>

</body>
</html>