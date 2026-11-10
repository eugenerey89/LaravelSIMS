<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=\, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">

    <title>Document</title>
</head>
<body>
    <div class="container mt-5">
        <h2 class="mb-4">Student Records</h2>
        
        <!-- Responsive Table Wrapper -->
        <div class="table-responsive">
            <table class="table table-striped table-hover table-bordered">
                <thead class="table-dark">
                    <tr>
                        <th scope="col">#</th>
                        <th scope="col">Student ID</th>
                        <th scope="col">First Name</th>
                        <th scope="col">Last Name</th>
                        <th scope="col">Email</th>
                        <th scope="col">Course</th>
                        <th scope="col">Year Level</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($student as $index => $stud)
                    <tr>
                        <td>{{ $stud->id }}</td>
                        <td>{{ $stud->first_name }}</td>
                        <td>{{ $stud->last_name }}</td>
                        <td>{{ $stud->email }}</td>
                        <td>{{ $stud->course }}</td>
                        <td>{{ $stud->year }}</td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</body>
</html>