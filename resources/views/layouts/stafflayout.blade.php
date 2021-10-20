
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">

    <title>Home</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.1/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-F3w7mX95PdgyTmZZMECAngseQB83DfGTowi0iMjiWaeVhAn4FJkqJByhZMI3AhiU" crossorigin="anonymous">
    <!-- CSS only -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.1/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-F3w7mX95PdgyTmZZMECAngseQB83DfGTowi0iMjiWaeVhAn4FJkqJByhZMI3AhiU" crossorigin="anonymous">
    <!-- JavaScript Bundle with Popper -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.1/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-/bQdsTh/da6pkI1MST/rWKFNjaCP5gBSY4sEBT38Q/9RBh9AH40zEOg7Hlq2THRZ" crossorigin="anonymous">
    </script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.3/dist/umd/popper.min.js"
        integrity="sha384-W8fXfP3gkOKtndU4JGtKDvXbO53Wy8SZCQHczT5FMiiqmQfUpWbYdTil/SxwZgAN" crossorigin="anonymous">
    </script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.1/dist/js/bootstrap.min.js"
        integrity="sha384-skAcpIdS7UcVUC05LJ9Dxay8AXcDYfBJqt1CJ85S/CFujBsIzCIv+l9liuYLaMQ/" crossorigin="anonymous">
    </script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.1/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-/bQdsTh/da6pkI1MST/rWKFNjaCP5gBSY4sEBT38Q/9RBh9AH40zEOg7Hlq2THRZ" crossorigin="anonymous">
    </script>
    <script src="https://kit.fontawesome.com/a076d05399.js"></script>
    <script src="http://ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.js"></script>

    <script src="https://cdn.datatables.net/1.11.3/css/dataTables.bootstrap5.min.css"></script>
    <link rel="stylesheet" href=" https://cdn.datatables.net/1.11.3/css/jquery.dataTables.min.css">
    <script src="https://cdn.datatables.net/1.11.3/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.11.3/js/dataTables.bootstrap5.min.js"></script>


    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.2.1/js/bootstrap.min.js"
        integrity="sha384-B0UglyR+jN6CkvvICOB2joaf5I4l3gm9GU6Hc1og6Ls7i6U/mkkaduKaBhlAXv9k" crossorigin="anonymous">
    </script>
    <link href="{{ asset('css/home.css') }}" rel="stylesheet">






    <script type="text/javascript">
        $(document).ready(function() {

            var html =
                '<tr>  <td><input type="date"  name="date[]" class="form-control"  aria-describedby="emailHelp" required></td><td><input type="text"  name="task[]" class="form-control"  aria-describedby="emailHelp" placeholder="Enter Task" required></td> <td> <span>Hrs</span> <input type="number" name="hrs_time[]" class=" form-control"aria-describedby="emailHelp" placeholder="Enter Time" style="width: 100px;"  required><span>Min</span><input type="number" name="time[]" class=" form-control"aria-describedby="emailHelp" placeholder="Enter Time" style="width: 100px;"  required></td><td>  <input type="button" class="btn btn-danger" name="remove" id="remove" value="remove"></td></tr>';
            var x = 1;
            $("#add").click(function() {
                $("#table_field").append(html);

            });

            $("#table_field").on('click', '#remove', function() {
                $(this).closest('tr').remove();
            });
        });
    </script>



    <script>
        $(document).ready(function() {
            $('table.display').DataTable({
                "order": [[3, "desc"]],
                "lengthMenu": [[5,10, 15, 20, -1], [5,10, 15, 20, "All"]]

            });
        });
    </script>

</head>

<body>
    <div class="pos-f-t">
        <div class="collapse" id="navbarToggleExternalContent">
            <div class="bg-light p-2">

                <li>Name : {{ Auth::guard('web')->user()->name }}</li>
                <li>Email: {{ Auth::guard('web')->user()->email }}</li>
                <li><a href="{{ route('admin.login') }}">Admin login</a></li>

                <li>
                    <a href="{{ route('user.logout') }}"
                        onclick="event.preventDefault();document.getElementById('logout-form').submit();">
                        logout</a>
                    <form action="{{ route('user.logout') }}" id="logout-form" method="POST">
                        @csrf
                    </form>
                </li>
            </div>
        </div>
        <nav class="navbar navbar-dark bg-primary">
            <ul>
                <li class="navbar-logo " style="color:white !important; font-weight:bold">{{ $atime }}</li>
                <li class="navbar-logo " style="color:white !important; font-weight:bold">
                    Hours&nbsp;{{ round($min / 60, 2) }}</li>
            </ul>
            <button class="navbar-toggler" type="button" data-toggle="collapse"
                data-target="#navbarToggleExternalContent" aria-controls="navbarToggleExternalContent"
                aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
        </nav>
    </div>
    <div class="container">
        @yield('content')
    </div>
    <script type="text/javascript" src="{{ asset('js/staff.js') }}" ></script>



</body>
</html>
