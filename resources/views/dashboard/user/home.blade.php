@extends('layouts/stafflayout')
@section('content')
    @if (Session::has('success'))
        <div class="alert alert-success">{{ Session::get('success') }}</div>
    @endif
    <div class="container">
        <div class="row">
            <div class="text-center">
                <div class="accordion" id="accordionExample">
                    <div class="card">
                        <div class="card-header" id="headingOne">
                            <h2 class="mb-0">
                                <button class="btn btn-link" type="button" data-toggle="collapse" data-target="#collapseOne"
                                    aria-expanded="true" aria-controls="collapseOne">
                                    Enter Task
                                </button>
                            </h2>
                        </div>

                        <div id="collapseOne" class="collapse show" aria-labelledby="headingOne"
                            data-parent="#accordionExample">
                            <div class="card-body">
                                <!--#2# Task start -->
                                <form action="{{ route('user.add') }}" method="post">
                                    <div class="input-field">
                                        @csrf
                                        <table class="table table-striped table-bordered nowrap" style="width: 100%"
                                            id="table_field">
                                            <tr>
                                                <th>Enter date</th>
                                                <th>Enter task </th>
                                                <th>Enter Time </th>
                                                <th>Add or Remove</th>
                                                <th style="text-align: center">#</th>
                                            </tr>

                                            <tr>
                                                <td><input type="date" name="date[]" class="form-control"
                                                        aria-describedby="emailHelp" required></td>
                                                <td> <input type="text" name="task[]" class="form-control"
                                                        aria-describedby="emailHelp" placeholder="Enter Task" required></td>
                                                <td> <span>Hrs</span>
                                                    <input type="number" name="hrs_time[]" class=" form-control"
                                                        aria-describedby="emailHelp" placeholder="Enter Time" style="width: 100px;"  required>
                                                       <span>Min</span>
                                                       <input type="number" name="time[]" class=" form-control"
                                                        aria-describedby="emailHelp" placeholder="Enter Time" style="width: 100px;"  required>
                                                </td>
                                                <td> <input type="button" class="btn btn-warning" name="add" id="add"
                                                        value="Add"></td>
                                                <td><a class="btn btn-success"href="{{ route('user.whome') }}">Add Holidays Task</a></td>
                                            </tr>

                                        </table>

                                        <center> <button type="submit" class="btn btn-primary" name="save" id="save"
                                                values="Save Data">Submit Task</button></center>

                                    </div>
                                </form>

                                <!--#2# Task End -->
                            </div>
                        </div>
                    </div>
                    <div class="card">
                        <div class="card-header" id="headingTwo">
                            <h2 class="mb-0">
                                <button class="btn btn-link collapsed" type="button" data-toggle="collapse"
                                    data-target="#collapseTwo" aria-expanded="false" aria-controls="collapseTwo">
                                    Check Your data
                                </button>
                            </h2>
                        </div>
                        <div id="collapseTwo" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionExample">
                            <div class="card-body">
                                <!--#3# Task start-->
                                <br>
                                <div class = "container main-section">
                                    <div class = "row">
                                    <div class = "col-lg-12 hedding pb-2">
                                        </div>
                                        <div   class = "col-lg-12">
                                        <table  id="example" class="display"  style="width:100%">
                                        <thead>
                                            <tr>
                                                <th>Id</th>
                                                <th>Task</th>
                                                <th>Time in hrs</th>
                                                <th>Time in Minutes</th>
                                                <th>Date</th>
                                                <th>Action1</th>
                                                <th>Action2</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                        @foreach ($data as $value)
                                        <tr >

                                                <td scope="row">{{ $value['id'] }}</td>
                                                <td>{{ $value['task'] }}</td>
                                                <td>{{ $value['hrs_time'] }}</td>
                                                <td>{{ $value['time'] }}</td>
                                                <td>{{ $value['date'] }}</td>
                                                <td><a  class = "btn btn-danger" onclick="return confirm('Are you Sure?')"  href={{ 'delete/' . $value['id'] }}>Delete</a></td>
                                                <td><a class = "btn btn-primary" href={{ 'edit/' . $value['id'] }}>Edit</a></td>
                                        </tr>
                                        @endforeach
                                        </tbody>
                                        </table>
                                        </div>
                                        </div>
                                        </div>
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
                                        style="color:rgb(202, 45, 45) !important; font-weight:bold">{{ round($average, 2) }}</span>

                                </button>
                            </h2>
                        </div>
                        <div id="collapseThree" class="collapse" aria-labelledby="headingThree"
                            data-parent="#accordionExample">
                            <div class="card-body">
                                <!-- #3# Task starts-->
                                <form action="{{ route('user.home') }}" method="get">
                                    @csrf
                                    <div class="input-field">
                                        <table class="table table-striped table-bordered nowrap" style="width: 100%"
                                            id="table_field">

                                            <tr>
                                                <th>From Date</th>
                                                <th>To Date </th>
                                            </tr>

                                            <tr>
                                                <td> <input type="date" name="fromdate" class="form-control"
                                                        aria-describedby="emailHelp" required></td>
                                                <td> <input type="date" name="todate" class="form-control"
                                                        aria-describedby="emailHelp" required> </td>
                                                <td> <button type="submit" class="btn btn-primary">Average</button></td>
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
                                <form action="{{ route('user.home') }}" method="get">


                                        <h5 style="color:rgb(202, 45, 45) !important; font-weight:bold">Monthly Data</h5>

                            <table class="table table-striped table-bordered nowrap" style="width: 100%"id="table_field">
                                            <tr>
                                                <th style="text-align: center" >Select Month</th>

                                            </tr>

                                            <tr>
                                                <td> <input type="month" name="frommonth" class="form-control"
                                                        aria-describedby="emailHelp" required></td>
                                                <td> <button type="submit"  class="btn btn-info btn_load_screen"  >view</button>

                                                </td>

                                            </tr>

                                        </table>


                                </form>
                            <hr>
                            <div class = "container main-section">
                                <div class = "row">
                                <div class = "col-lg-12 hedding pb-2">
                                    </div>
                                    <div   class = "col-lg-12">
                                 @if (!empty($querys))
                                    <table  id="example" class="display"  style="width:100%">
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
                                            <td>{{ $query->date}}</td>

                                        </tr>
                                    @endforeach
                                    </tbody>

                                    @endif
                                    </table>

                                    </div>
                                    </div>
                                    </div>
                                <!--#5#--->
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@stop
