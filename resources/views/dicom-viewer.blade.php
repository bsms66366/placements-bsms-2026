<!-- resources/views/dicom-viewer.blade.php -->
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>DICOM Viewer</title>
    <link rel="stylesheet" href="{{ mix('css/app.css') }}">
</head>
<body>
    <div id="app">
        <dicom-viewer file-url="{{ $fileUrl }}"></dicom-viewer>
    </div>
    <script src="{{ mix('js/app.js') }}"></script>
</body>
</html>
