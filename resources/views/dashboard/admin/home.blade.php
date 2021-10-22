<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Admin Home</title>
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

    <!--#1# start -->
    <div class="pos-f-t">
        <div class="collapse" id="navbarToggleExternalContent">
            <div class="bg-light p-2">
                @if (Session::has('success'))
                    <div class="alert alert-success">{{ Session::get('success') }}</div>
                @endif
                <li>Name:{{ Auth::guard('admin')->user()->name }}</li>
                <li>Email:{{ Auth::guard('admin')->user()->email }}</li>

                <li>
                    <a href="{{ route('admin.logout') }}"
                        onclick="event.preventDefault();document.getElementById('logout-form').submit();">
                        logout</a>
                    <form action="{{ route('admin.logout') }}" id="logout-form" method="POST">
                        @csrf
                    </form>
                </li>
            </div>
        </div>
        <nav class="navbar navbar-dark bg-primary">
            <ul>
                <li class="navbar-logo " style="color:white !important; font-weight:bold">{{ $admintime }}</li>
                <li class="navbar-logo " style="color:white !important; font-weight:bold">
                    WeekdayHours:&nbsp;{{ round($min / 60, 2) }} &nbsp;HolidaydayHours:&nbsp;{{ round($hmin / 60, 2) }}
                </li>

            </ul>
            <button class="navbar-toggler" type="button" data-toggle="collapse"
                data-target="#navbarToggleExternalContent" aria-controls="navbarToggleExternalContent"
                aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
        </nav>
    </div>
    <!--#1# End -->

    <div class="container">
        <div class="row">
            <div class="text-center">
                <div class="accordion" id="accordionExample">
                    <div class="card">
                        <div class="card-header" id="headingOne">
                            <h2 class="mb-0">
                                <button class="btn btn-link" type="button" data-toggle="collapse"
                                    data-target="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
                                    WeeKday TAble #1
                                </button>
                            </h2>
                        </div>

                        <div id="collapseOne" class="collapse show" aria-labelledby="headingOne"
                            data-parent="#accordionExample">
                            <div class="card-body">
                                <!--#2# Task start -->
                                <table id="example" class="display" style="width:100%">
                                    <thead>
                                        <tr>
                                            <th scope="col">Id</th>
                                            <th scope="col">Task</th>
                                            <th scope="col">Hours</th>
                                            <th scope="col">Minutes</th>
                                            <th scope="col">Date</th>
                                            <th scope="col">Emp Email</th>
                                            <th scope="col">Action1</th>
                                            <th scope="col">Action2</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($data as $item1)
                                            <tr>
                                                <th scope="row">{{ $item1['id'] }}</th>
                                                <td>{{ $item1['task'] }}</td>
                                                <td>{{ $item1['hrs_time'] }}</td>
                                                <td>{{ $item1['time'] }}</td>
                                                <td>{{ $item1['date'] }}</td>
                                                <td>{{ $item1['email'] }}</td>
                                                <td><a  class = "btn btn-danger" onclick="return confirm('Are you Sure?')" href={{ 'delete/' . $item1['id'] }}>Delete</a></td>
                                                <td><a class = "btn btn-primary" href={{ 'weekedit/' . $item1['id'] }}>Edit</a></td>

                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>


                                <!--#2# Task End -->
                            </div>
                        </div>
                    </div>
                    <div class="card">
                        <div class="card-header" id="headingTwo">
                            <h2 class="mb-0">
                                <button class="btn btn-link collapsed" type="button" data-toggle="collapse"
                                    data-target="#collapseTwo" aria-expanded="false" aria-controls="collapseTwo">
                                    Holiday Table #2
                                </button>
                            </h2>
                        </div>
                        <div id="collapseTwo" class="collapse" aria-labelledby="headingTwo"
                            data-parent="#accordionExample">
                            <div class="card-body">
                                <!--#3# Task start -->

                                <table id="example" class="display" style="width:100%">
                                    <thead>
                                        <tr>
                                            <th scope="col">Id</th>
                                            <th scope="col">Task</th>
                                            <th scope="col">Hours</th>
                                            <th scope="col">Minutes</th>
                                            <th scope="col">Date</th>
                                            <th scope="col">Emp Email</th>
                                            <th scope="col">Action1</th>
                                            <th scope="col">Action2</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($hdata as $item1)
                                            <tr>
                                                <th scope="row">{{ $item1['id'] }}</th>
                                                <td>{{ $item1['task'] }}</td>
                                                <td>{{ $item1['hrs_time'] }}</td>
                                                <td>{{ $item1['time'] }}</td>
                                                <td>{{ $item1['date'] }}</td>
                                                <td>{{ $item1['email'] }}</td>
                                                <td><a  class = "btn btn-danger" onclick="return confirm('Are you Sure?')" href={{ 'hdelete/' . $item1['id'] }}>Delete</a></td>
                                                <td><a class = "btn btn-primary" href={{ 'holidayedit/' . $item1['id'] }}>Edit</a></td>
                                            </tr>
                                        @endforeach
                                    </tbody>

                                </table>

                                <!--#3# Task End -->
                            </div>
                        </div>
                    </div>
                    <div class="card">
                        <div class="card-header" id="headingThree">
                            <h2 class="mb-0">
                                <button class="btn btn-link collapsed" type="button" data-toggle="collapse"
                                    data-target="#collapseThree" aria-expanded="false" aria-controls="collapseThree">
                                    Average Work:: <span
                                        style="color:rgb(202, 45, 45) !important; font-weight:bold">{{ round($average, 2) }}
                                    </span>&nbsp;&nbsp;HoliDay Average Work:: <span
                                        style="color:rgb(202, 45, 45) !important; font-weight:bold">{{ round($holidayaverage, 2) }}</span>

                                </button>
                            </h2>
                        </div>
                        <div id="collapseThree" class="collapse" aria-labelledby="headingThree"
                            data-parent="#accordionExample">
                            <div class="card-body">
                                <!-- #3# Task starts-->
                                <form action="{{ route('admin.home') }}" method="get">

                                    <div class="input-field">
                                        <h5 style="color:rgb(202, 45, 45) !important; font-weight:bold">WeekDay Task
                                        </h5>
                                        <table class="table table-bordered" id="table_field">

                                            <tr>
                                                <th>From Date</th>
                                                <th>To Date </th>
                                            </tr>

                                            <tr>
                                                <td> <input type="date" name="fromdate" class="form-control"
                                                        aria-describedby="emailHelp" required></td>
                                                <td> <input type="date" name="todate" class="form-control"
                                                        aria-describedby="emailHelp" required> </td>
                                                <td> <select name="email"  class="form-control"
                                                    aria-describedby="emailHelp">
                                                        @foreach ($usersEmails as $usersEmail)
                                                            <option value="{{ $usersEmail['email'] }}">
                                                                {{ $usersEmail['email'] }}</option>
                                                        @endforeach
                                                    </select>
                                                </td>
                                                <td> <button type="submit" class="btn btn-primary">Average</button></td>
                                            </tr>
                                        </table>
                                    </div>
                                </form>
                                <!------------------------------------------------------------------------------------->
                                <!-- #3# Task starts-->
                                <form action="{{ route('admin.home') }}" method="get">

                                    <div class="input-field">
                                        <h5 style="color:rgb(202, 45, 45) !important; font-weight:bold">HoliDay Task
                                        </h5>
                                        <table class="table table-bordered" id="table_field">

                                            <tr>
                                                <th>From Date</th>
                                                <th>To Date </th>
                                            </tr>

                                            <tr>
                                                <td> <input type="date" name="holidayfromdate" class="form-control"
                                                        aria-describedby="emailHelp" required></td>
                                                <td> <input type="date" name="holidaytodate" class="form-control"
                                                        aria-describedby="emailHelp" required> </td>
                                                <td> <select name="holidayemail"  class="form-control"
                                                    aria-describedby="emailHelp">
                                                        @foreach ($usersEmails as $usersEmail)
                                                            <option value="{{ $usersEmail['email'] }}">
                                                                {{ $usersEmail['email'] }}</option>
                                                        @endforeach
                                                    </select>
                                                </td>
                                                <td> <button type="submit" class="btn btn-primary">Holiday
                                                        Average</button></td>
                                            </tr>
                                        </table>
                                    </div>
                                </form>

                                <!--  #3# Task Ends-->
                            </div>
                        </div>
                    </div>
                    <div class="card">
                        <div class="card-header" id="headingFour">
                            <h2 class="mb-0">
                                <button class="btn btn-link collapsed" type="button" data-toggle="collapse"
                                    data-target="#collapseFour" aria-expanded="false" aria-controls="collapseFour">
                                    Monthly Data
                                </button>
                            </h2>
                        </div>
                        <div id="collapseFour" class="collapse" aria-labelledby="headingFour"
                            data-parent="#accordionExample">
                            <div class="card-body">
                                <!--#4#-->

                                <form action="{{ route('admin.home') }}" method="get">

                                    <div class="input-field">
                                        <h5 style="color:rgb(202, 45, 45) !important; font-weight:bold">Monthly Data
                                        </h5>
                                        <table class="table table-bordered" id="table_field">

                                            <tr>
                                                <th>Select Month</th>
                                                <th>To Date </th>
                                            </tr>

                                            <tr>
                                                <td> <input type="month" name="frommonth" class="form-control"
                                                        aria-describedby="emailHelp" required></td>

                                                <td> <select name="monthemail"  class="form-control"
                                                    aria-describedby="emailHelp">
                                                        @foreach ($usersEmails as $usersEmail)
                                                            <option value="{{ $usersEmail['email'] }}">
                                                                {{ $usersEmail['email'] }}</option>
                                                        @endforeach
                                                    </select>
                                                </td>
                                                <td> <button type="submit" class="btn btn-primary">view</button></td>

                                            </tr>
                                        </table>
                                    </div>
                                </form>
                                <hr>
                                <div class="input-field">
                                 @if (!empty($querys))

                                    <table id="example" class="display" style="width:100%">
                                        <thead>
                                            <tr>

                                                <th>Task</th>
                                                <th>Time</th>
                                                <th>Date</th>

                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach ($querys as $query)
                                                <tr>
                                                    <th scope="row">{{ $query->task }}</th>
                                                    <td>{{ $query->time }}</td>
                                                    <td>{{ $query->date }}</td>

                                                </tr>
                                            @endforeach
                                        </tbody>
                                    </table>
                                @endif
                                </div>



                                <!--#5#--->
                            </div>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </div>
</body>

</html>
