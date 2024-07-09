<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Students List</title>
</head>
<body>
    <div>
        <h1>Students List</h1>
        
        <div>
            <table>
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>First Name</th>
                        <th>Last Name</th>
                        <th>Middle Name</th>
                        <th>Date of Birth</th>
                        <th>Address</th>
                        <th>Course & Year</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($students as $stud)
                    <tr>
                        <td>{{$stud->id}}</td>
                        <td>{{$stud->first_name}}</td>
                        <td>{{$stud->last_name}}</td>
                        <td>{{$stud->middle_name}}</td>
                        <td>{{$stud->DOB}}</td>
                        <td>{{$stud->address}}</td>
                        <td>{{$stud->course}}-{{$stud->year}}</td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</body>
</html>
