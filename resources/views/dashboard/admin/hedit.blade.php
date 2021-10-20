<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css"
        integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap-theme.min.css"
        integrity="sha384-rHyoN1iRsVXV4nD0JutlnGaslCJuC7uwjduW9SVrLvRYooPp2bWYgmgJQIXwl/Sp" crossorigin="anonymous">
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"
        integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa" crossorigin="anonymous">
    </script>
</head>

<body>
    <div class="container">
        <form action="{{ route('admin.holidayupdate') }}" method="post">
            @csrf
            <input type="hidden" name="id" value="{{ $data['id'] }}">

            <div class="input-field">
                <table class="table table-bordered" id="table_field">
                    <h1>Holidayday Upadte</h1>
                    <tr>
                        <th>Task</th>
                        <th>hours </th>
                        <th>Minutes</th>
                        <th>Date</th>
                    </tr>

                    <tr>
                        <td> <input type="text" name="task" class="form-control" aria-describedby="emailHelp"
                                value="{{ $data['task'] }}"> </td>
                        <td> <input type="number" name="hrs_time" class="form-control" id="exampleInputPassword1"
                                    value="{{ $data['hrs_time'] }}"></td>
                        <td> <input type="number" name="time" class="form-control" id="exampleInputPassword1"
                                value="{{ $data['time'] }}"></td>
                        <td> <input type="date" name="date" class="form-control" aria-describedby="emailHelp"
                                value="{{ $data['date'] }}"></td>
                        <td><button type="submit" class="btn btn-primary">Update Task</button></td>
                    </tr>
                </table>

        </form>
    </div>
</body>

</html>
