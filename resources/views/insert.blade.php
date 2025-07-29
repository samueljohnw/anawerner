<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Upload CSV File</title>
</head>
<body>
    <h1>Upload CSV File</h1>
    <form action="{{ route('csv.upload') }}" method="POST" enctype="multipart/form-data">
        @csrf
        <label for="csv_file">Select CSV file:</label>
        <input type="file" id="csv_file" name="csv_file" accept=".csv" required>
        <label for="course">Select Course:</label>
        <select id="course" name="course"  required>
            <option value="-">Select Course</option>
            @foreach($courses as $course)
                 <option value="{{$course['title']}}">{{$course['title']}}</option>
            @endforeach
        </select>
        <button type="submit">Upload</button>
    </form>

    <!-- Error/Success Messages -->
    @if ($errors->any())
        <div>
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    @if (session('success'))
        <div>
            <p>{{ session('success') }}</p>
        </div>
    @endif
</body>
</html>
