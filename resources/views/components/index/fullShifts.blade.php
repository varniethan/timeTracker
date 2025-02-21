<div class="page-title">
    <div class="col-md-4">
        <div class="title_left"><h3>Full Time Sheets</h3></div>
    </div>
    <div class="col-md-3">
        @if(Session::has('message'))
            <p class="alert {{ Session::get('alert-class', 'alert-sucess') }}">{{ Session::get('message') }}</p>
        @endif
            @if ($errors->any())
                <div class="alert alert-danger">
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif
    </div>
</div>


<div class="clearfix"></div>

<style>.grey-bg { background-color: rgb(248,248,249);}</style>
<div class="modal-body row">
{{--    Left Side Bar--}}
    <div class="col-md-2">
        <div class="x_panel grey-bg">
            <div class="x_title">
<!--Heading and reset button row-->
                <div class="row">
                    <div class="col-md-10">
                        <h4>Filter <small>your time sheet</small></h4>
                    </div>
                    <div class="col-md-2 form-group">
                        <div class="col-sm emphasis">
                            <!-- show the shark (uses the show method found at GET /sharks/{id} -->
                            <a href="{{url('/full_shifts')}}"><button type="button" class="btn btn-secondary btn-sm"><i class="fa fa-refresh"></i></button></a>
                        </div>
                    </div>
                </div>
            </div>
            <form class="" method="post" action="{{ route('full-shifts-filter') }}">
                @csrf
    {{--            From Row--}}
                <style>.row-margin-05 { margin-top: 2.5em; }</style>
                <div class="row  row-margin-05">
                    <div class="col-md-2">
                        <label class="col-form-label text-left"><b>From</b></label>
                    </div>
                    <div class="col-md-10">
                        <input type="date" name="from_date"   class="form-control date" value="{{old('from_date')}}">
                    </div>
                </div>
    {{--            To Row--}}
                <style>.row-margin-01 { margin-top: 1.5em; }</style>
                <div class="row row-margin-01">
                    <div class="col-md-2">
                        <label class="col-form-label text-left"><b>To</b></label>
                    </div>
                    <div class="col-md-10">
                        <input type="date" name="to_date"   class="form-control date" value="{{old('to_date')}}">
                    </div>
                </div>
    {{--            Branch Row--}}
                <div class="row row-margin-01">
                    <h2>Select Branch - <small>location worked?</small></h2>
                    <div class="col-md-2">
                        <label class="col-form-label text-left"><b>Branch</b></label>
                    </div>
                    <div class="col-md-10">
                        <select class="form-select" name='branch_id' aria-label=".form-select-sm example" value="{{old('branch_id')}}">
                            <option value='0'>{{"All Branches"}}</option>
                            @foreach($branchData as $branch)
                                <option value='{{$branch['id']}}'>{{$branch['name']}}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
                @if ((Session::get('role_id') == 1 or Session::get('role_id') == 2) and Session::has('org_id'))
    {{--            Employee Row--}}
                <div class="row row-margin-01">
                    <h2>Select Employee - <small>Employee name?</small></h2>
                    <div class="col-md-2">
                        <label class="col-form-label text-left"><b>Name </b></label>
                    </div>
                    <div class="col-md-10">
                        <select class="form-select" name='user_id' aria-label=".form-select-sm example" value="{{old('user_id')}}">
                            <option value='0'>{{"All Employees"}}</option>
                            @foreach($employeeData as $employee)
                                <option value='{{$employee->id}}'>{{$employee->first_name}} {{$employee->last_name}}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
    {{--            Role Row--}}
                <div class="row row-margin-01">
                    <h2>Select Role - <small>Job title of the employee?</small></h2>
                    <div class="col-md-2">
                        <label class="col-form-label text-left"><b>Role </b></label>
                    </div>
                    <div class="col-md-10">
                        <select class="form-select" name='role_id' aria-label=".form-select-sm example" value="{{old('role_id')}}">
                            <option value='0'>{{"All Roles"}}</option>
                            @if (Session::get('role_id') == 1 or Session::get('role_id') == 2)
                                <option value="3">Managing Director</option>
                                <option value="4">Branch Manager</option>
                                <option value="5">Shift Manager</option>
                                <option value="6">Employee</option>
                            @elseif(Session::get('role_id') == 3)
                                <option value="4">Branch Manager</option>
                                <option value="5">Shift Manager</option>
                                <option value="6">Employee</option>
                            @elseif(Session::get('role_id') == 4)
                                <option value="5">Shift Manager</option>
                                <option value="6">Employee</option>
                            @endif
                        </select>
                    </div>
                </div>
    {{--            Position Row--}}
                <div class="row row-margin-01">
                    <h2>Select Position - <small>What does the employee do?</small></h2>
                    <div class="col-md-2">
                        <label class="col-form-label text-left"><b>Position </b></label>
                    </div>
                    <div class="col-md-10">
                            @if(count($positionData) < 1)
                                <div class="alert alert-danger" role="alert">
                                    <h4 class="alert-heading">Add your employee Positions!</h4>
                                    <p>Aww no, you have to add your employee Positions to countinue adding employees!</p>
                                    <hr>
                                    <p class="mb-0">Got to <code>Job Codes</code> to add all the employee Positions</p>
                                </div>
                            @else
                                <select class="form-select" name='position_id' aria-label=".form-select-sm example" value="{{old('position_id')}}">
                                    <option value='0'>{{"All Position Type"}}</option>
                                    @foreach($positionData as $position)
                                        <option value='{{$position['id']}}'>{{$position['name']}}</option>
                                    @endforeach
                                </select>
                            @endif
                    </div>
                </div>
                @endif
    {{--            Employee Did Row--}}
                <div class="row row-margin-01">
                    <h2>Select Shift Type - <small>What employee did?</small></h2>
                    <div class="col-md-2">
                        <label class="col-form-label text-left"><b>Shift Type </b></label>
                    </div>
                    <div class="col-md-10">
                        <select class="form-select" name='shift_type_id' aria-label=".form-select-sm example" value="{{old('shift_type_id')}}">
                            <option value='0'>{{"All Shift Type"}}</option>
                            @foreach($shiftTypeData as $shiftType)
                                <option value="{{$shiftType->id}}">{{$shiftType->name}}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
                <div class="row row-margin-01 col-sm emphasis">
                    <!-- show the shark (uses the show method found at GET /sharks/{id} -->
                    <button type="submit" class="btn btn-outline-success pull-right"><i class="fa fa-filter"></i> Apply Filter</button>
                </div>
            </form>
        </div>
    </div>

{{--    Right Side Bar--}}
    <div class="col-md-10">
        <div class="x_panel">
            <div class="x_title">
                @if ((Session::get('role_id') == 1 or Session::get('role_id') == 2) and Session::has('org_id'))
                <button type="button" class="btn btn-success" data-toggle="modal" data-target="#add_shift" data-whatever="@getbootstrap">Add New Shift</button>
                <div class="modal fade" id="add_shift" tabindex="-1" role="dialog" aria-labelledby="addShiftLabel" aria-hidden="true">
                    <div class="modal-dialog modal-lg" role="document">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="addShiftLabel">Add New Shift</h5>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            <form method="POST" action="{{url('/full_shifts')}}" class="form-horizontal form-label-left" id="openTab">
                                @csrf
                                <div class="modal-body">
                                    <div role="tabpanel">
                                        <!-- Nav tabs -->
                                        <ul class="nav nav-tabs" role="tablist">
                                            <li role="presentation" class="active"><a href="#uploadTab" aria-controls="uploadTab" role="tab" data-toggle="tab">Summary</a></li>
                                            <li role="presentation"><a href="#browseTab" aria-controls="browseTab" role="tab" data-toggle="tab">Breaks</a></li>
                                        </ul>
                                        <script>
                                            $(document).ready(function() {
                                                $("#uploadTab a").click(function() {
                                                    $("#uploadTab").tab('show');
                                                });
                                                $("#browseTab a").click(function() {
                                                    $("#browseTab").tab('show');
                                                });
                                            });
                                        </script>
                                        <!-- Tab panes -->
                                        <div class="tab-content">
    {{--                                       Shift Tab--}}
                                            <div role="tabpanel" class="tab-pane active" id="uploadTab">
                                                    <div class="row form-group row-margin-05">
                                                        <div class="col-md-2">
                                                            <label class="col-form-label text-left"><b>Location</b></label>
                                                        </div>
                                                        <div class="col-md-10">
                                                            <select class="form-select" name='branch_shift_id' aria-label=".form-select-sm example">
                                                                @foreach($branchData as $branch)
                                                                    <option value='{{$branch['id']}}'>{{$branch['name']}}</option>
                                                                @endforeach
                                                            </select>
                                                        </div>
                                                    </div>

                                                    <div class="row form-group row-margin-05">
                                                        <div class="col-md-2">
                                                            <label class="col-form-label text-left"><b>Shift Type</b></label>
                                                        </div>
                                                        <div class="col-md-10">
                                                            <select class="form-select" name='shift_type_id' aria-label=".form-select-sm example">
                                                                @foreach($shiftTypeData as $shiftType)
                                                                    <option value="{{$shiftType->id}}">{{$shiftType->name}}</option>
                                                                @endforeach
                                                            </select>
                                                        </div>
                                                    </div>

                                                    <div class="row form-group row-margin-05">
                                                        <div class="col-md-2">
                                                            <label class="col-form-label text-left"><b>Employee</b></label>
                                                        </div>
                                                        <div class="col-md-10">
                                                            <select class="form-select" name='user_id' aria-label=".form-select-sm example">
                                                                @foreach($employeeData as $employee)
                                                                    <option value="{{$employee->id}}">{{$employee->first_name}} {{$employee->last_name}}</option>
                                                                @endforeach
                                                            </select>
                                                        </div>
                                                    </div>

                                                    <div class="row form-group row-margin-05">
                                                        <div class="col-md-6">
                                                            <div class="col-md-2">
                                                                <label class="col-form-label text-left"><b>Date</b></label>
                                                            </div>
                                                            <div class="col-md-10">
                                                                <input type="date" name="date"   class="form-control date" value="{{old('dob')}}">
                                                            </div>
                                                        </div>
                                                        <div class="col-md-6">
                                                            <div class="col-md-2">
                                                                <label class="col-form-label text-left"><b>End Date</b></label>
                                                            </div>
                                                            <div class="col-md-10">
                                                                <input type="date" name="dob"   class="form-control date" value="{{old('dob')}}">
                                                            </div>
                                                        </div>
                                                    </div>

                                                    <div class="row form-group row-margin-05">
                                                        <div class="col-md-6">
                                                            <div class="col-md-2">
                                                                <label class="col-form-label text-left"><b>From</b></label>
                                                            </div>
                                                            <div class="col-md-10">
                                                                <div class="form-group">
                                                                    <div class='input-group date' id='myDatepicker3'>
                                                                        <input type='text' class="form-control" name="scheduled_from"/>
                                                                        <span class="input-group-addon"><span class="fa fa-clock-o"></span></span>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="col-md-6">
                                                            <div class="col-md-2">
                                                                <label class="col-form-label text-left"><b>To</b></label>
                                                            </div>
                                                            <div class="col-md-10">
                                                                <div class="form-group">
                                                                    <div class='input-group date' id='myDatepicker4'>
                                                                        <input type='text' class="form-control" name="scheduled_to"/>
                                                                        <span class="input-group-addon"><span class="fa fa-clock-o"></span></span>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>

                                                    <div class="row form-group row-margin-05">
                                                        <div class="col-md-2">
                                                            <label class="col-form-label text-left" name="shift_note"><b>Notes</b></label>
                                                        </div>
                                                        <div class="col-md-9">
                                                            <div class="form-group">
                                                                <textarea class="form-control" name="description" id="exampleFormControlTextarea1" rows="3"></textarea>
                                                                <label for="exampleFormControlTextarea1">Add Note for the employee working on the shift....etc</label>
                                                            </div>
                                                        </div>
                                                    </div>

    {{--                                                <div class="row form-group row-margin-05">--}}
    {{--                                                    <div class="col-md-2">--}}
    {{--                                                        <label class="col-form-label text-left"><b>No. of breaks</b></label>--}}
    {{--                                                    </div>--}}
    {{--                                                    <div class="col-md-10">--}}
    {{--                                                        <select class="form-select" name='position_id' aria-label=".form-select-sm example">--}}
    {{--                                                            @foreach($branchData as $branch)--}}
    {{--                                                                <option value='{{$branch['id']}}'>{{$branch['name']}}</option>--}}
    {{--                                                            @endforeach--}}
    {{--                                                        </select>--}}
    {{--                                                    </div>--}}
    {{--                                                </div>--}}


                                                    <div class="row row-margin-05">
                                                        <div class="col-md-3">
                                                            <label class="col-form-label text-left"><b>Break Time</b></label>
                                                        </div>
                                                        <div class="col-md-9">
                                                            <a href="#"><button type="button" class="add_break btn btn-primary btn-sm" id="add_break"><i class="fa fa-plus"></i> Add Break</button></a>
                                                        </div>
                                                    </div>

    {{--                                                <div class="row form-group row-margin-05">--}}
    {{--                                                    <div class="col-md-6">--}}
    {{--                                                        <div class="col-md-2">--}}
    {{--                                                            <label class="col-form-label text-left"><b>Duration</b></label>--}}
    {{--                                                        </div>--}}
    {{--                                                        <div class="col-md-10">--}}
    {{--                                                            <input type="text" class="form-control" placeholder="e.g. 10 hours" name="duration" value="{{old('duration')}}" disabled>--}}
    {{--                                                        </div>--}}
    {{--                                                    </div>--}}
    {{--                                                    <div class="col-md-6">--}}
    {{--                                                        <div class="col-md-2">--}}
    {{--                                                            <label class="col-form-label text-left"><b>Paid Time</b></label>--}}
    {{--                                                        </div>--}}
    {{--                                                        <div class="col-md-10">--}}
    {{--                                                            <input type="text" class="form-control" placeholder="e.g. 10 hours" name="paid_time" value="{{old('paid_time')}}" disabled>--}}
    {{--                                                        </div>--}}
    {{--                                                    </div>--}}
    {{--                                                </div>--}}

    {{--                                                <div class="row form-group row-margin-05">--}}
    {{--                                                    <div class="col-md-2">--}}
    {{--                                                        <label class="col-form-label text-left"><b>Pay Rate</b></label>--}}
    {{--                                                    </div>--}}
    {{--                                                    <div class="col-md-10">--}}
    {{--                                                        <input type="text" class="form-control" placeholder="e.g. 8£ per hour" name="pay_rate" value="{{old('pay_rate')}}" disabled>--}}
    {{--                                                    </div>--}}
    {{--                                                </div>--}}

    {{--                                                <div class="row form-group row-margin-05">--}}
    {{--                                                    <div class="col-md-2">--}}
    {{--                                                        <label class="col-form-label text-left"><b>Total</b></label>--}}
    {{--                                                    </div>--}}
    {{--                                                    <div class="col-md-10">--}}
    {{--                                                        <input type="text" class="form-control" placeholder="Email" name="total" value="{{old('total')}}" disabled>--}}
    {{--                                                    </div>--}}
    {{--                                                </div>--}}
                                            </div>

                                            <script>
                                                $(document).ready(function(){
                                                    $("#add_break").click(function(){
                                                        $("#browseTab").tab('show');
                                                    });
                                                });
                                            </script>
    {{--                                        Browse Tab--}}
                                            <div role="tabpanel" class="tab-pane" id="browseTab">
                                                <div class="row form-group row-margin-05">
                                                    <div class="col-md-2">
                                                        <label class="col-form-label text-left"><b>Break Type</b></label>
                                                    </div>
                                                    <div class="col-md-10">
                                                        <select class="form-select" name='break_type_id' aria-label=".form-select-sm example">
                                                            @foreach($breakTypeData as $breakType)
                                                                <option value='{{$breakType->id}}'>{{$breakType->name}}</option>
                                                            @endforeach
                                                        </select>
                                                    </div>
                                                </div>

                                                <div class="row form-group row-margin-05">
                                                    <div class="col-md-6">
                                                        <div class="col-md-2">
                                                            <label class="col-form-label text-left"><b>Break From</b></label>
                                                        </div>
                                                        <div class="col-md-10">
                                                            <div class="form-group">
                                                                <div class='input-group date' id='myDatepicker3'>
                                                                    <input type='text' class="form-control" name="break_scheduled_from"/>
                                                                    <span class="input-group-addon"><span class="fa fa-clock-o"></span></span>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-6">
                                                        <div class="col-md-2">
                                                            <label class="col-form-label text-left"><b>To</b></label>
                                                        </div>
                                                        <div class="col-md-10">
                                                            <div class="form-group">
                                                                <div class='input-group date' id='myDatepicker4'>
                                                                    <input type='text' class="form-control" name="break_scheduled_to"/>
                                                                    <span class="input-group-addon"><span class="fa fa-clock-o"></span></span>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                {{--                                            <table class="table table-striped">--}}
    {{--                                                <thead>--}}
    {{--                                                <tr>--}}
    {{--                                                    <th scope="col">Break Rule</th>--}}
    {{--                                                    <th scope="col">Start</th>--}}
    {{--                                                    <th scope="col">End</th>--}}
    {{--                                                    <th scope="col">Duration</th>--}}
    {{--                                                </tr>--}}
    {{--                                                </thead>--}}
    {{--                                                <tbody>--}}
    {{--                                                <tr>--}}
    {{--                                                    <th scope="row">1</th>--}}
    {{--                                                    <td>Mark</td>--}}
    {{--                                                    <td>Otto</td>--}}
    {{--                                                    <td>@mdo</td>--}}
    {{--                                                </tr>--}}
    {{--                                                <tr>--}}
    {{--                                                    <th scope="row">2</th>--}}
    {{--                                                    <td>Jacob</td>--}}
    {{--                                                    <td>Thornton</td>--}}
    {{--                                                    <td>@fat</td>--}}
    {{--                                                </tr>--}}
    {{--                                                <tr>--}}
    {{--                                                    <th scope="row">3</th>--}}
    {{--                                                    <td>Larry</td>--}}
    {{--                                                    <td>the Bird</td>--}}
    {{--                                                    <td>@twitter</td>--}}
    {{--                                                </tr>--}}
    {{--                                                </tbody>--}}
    {{--                                            </table>--}}
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="modal-footer">
                                    <input type="submit" value="Save" class="btn btn-success">
                                    <input type="submit" value="Save and Add New" class="btn btn-primary">
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
                <a href="#" class="btn btn-primary" id="approveAllSelectedRecord">Approve Shifts</a>
                <a href="#" class="btn btn-warning" id="unapproveAllSelectedRecord">Unapprove Shifts</a>
                <a href="#" class="btn btn-danger" id="deleteAllSelectedRecord"><i class="fa fa-trash-o"></i></a>
                @endif
            </div>
            <table class="table table-striped">
                <thead>
                <tr>
                    <th scope="col">No</th>
                    <th scope="col"><input type="checkbox" name="ids" id="chkCheckAll"></th>
                    <th scope="col">Date</th>
                    <th scope="col">Shift Type</th>
                    <th scope="col">Employee</th>
                    <th scope="col">Location</th>
                    <th scope="col">Punch In</th>
                    <th scope="col">Punch Out</th>
                    <th scope="col">Duration</th>
                    <th scope="col">Break Time</th>
                    <th scope="col">Paid Time</th>
                    <th scope="col">Paid Rate</th>
                    <th scope="col">Pay Total</th>
                    <th scope="col"><b>Actions</b></th>
                </tr>
                </thead>
                <tbody>
                @foreach($fullShiftData as $fullShift)
                    <tr id="sid{{$fullShift->id}}">
                        <td>{{$loop->iteration}}</td>
                        <td><input type="checkbox" id="checkbox" name="ids" class="checkBox_class" value={{$fullShift->id}}></td>
                        <td>{{$fullShift->date}}</td>
                        @if($fullShift->clock_in ==' ')
                            <td><i class="fa fa-ban"></i></td>
                        @else
                            <td>{{$fullShift->shift_type_name}}</td>
                        @endif
                        <td>{{$fullShift->user_name}}</td>
                        <td>{{$fullShift->branch_name}}</td>
                        @if($fullShift->clock_in == '00:00:00' or $fullShift->clock_in == '')
                            <td><i class="fa fa-bell-slash"></i></td>
                        @else
                            <td>{{$fullShift->clock_in}}</td>
                        @endif
                        @if($fullShift->clock_out == '')
                            <td><i class="fa fa-hourglass-end"></i></td>
                        @else
                            <td>{{$fullShift->clock_out}}</td>
                        @endif
                        <td>{{$fullShift->duration}}</td>
                        <td>{{$fullShift->shift_break}}</td>
                        <td>{{$fullShift->duration}}</td>
                        @if($fullShift->rate == '')
                            <td><i class="fa fa-ban"></i></td>
                        @else
                            <td>{{"£"}}{{$fullShift->rate}}</td>
                        @endif
                        @if($fullShift->total_pay == '')
                            <td><i class="fa fa-ban"></i></td>
                        @else
                            <td>{{'£'}}{{$fullShift->total_pay}}</td>
                        @endif
                        <td>
                            <div class="col-sm emphasis">
                                <div class="row">
                                    <div class="col-md-2">
                                        <a href="{{ URL::to('/full_shifts/' .$fullShift->id) }}"><button type="button" class="btn btn-success btn-sm" disabled><i class="fa fa-eye"></i></button></a>
                                    </div>
                                    @if ((Session::get('role_id') == 1 or Session::get('role_id') == 2) and Session::has('org_id'))
                                    <div class="col-md-2">
                                        @if ($fullShift->approved == 1)
                                            <a href="{{ URL::to('/full_shifts/approve/' .$fullShift->id) }}"><button type="button" class="btn btn-primary btn-sm" disabled><i class="fa fa-thumbs-o-up"></i></button></a>
                                        @else
                                            <a href="{{ URL::to('/full_shifts/approve/' .$fullShift->id) }}"><button type="button" class="btn btn-primary btn-sm"><i class="fa fa-thumbs-o-up"></i></button></a>
                                        @endif
                                    </div>
                                    <div class="col-md-2">
                                        @if ($fullShift->approved == 0)
                                            <a href="{{ URL::to('/full_shifts/unapprove/' .$fullShift->id) }}"><button type="button" class="btn btn-warning btn-sm" disabled><i class="fa fa-times-circle"></i></button></a>
                                        @else
                                            <a href="{{ URL::to('/full_shifts/unapprove/' .$fullShift->id) }}"><button type="button" class="btn btn-warning btn-sm"><i class="fa fa-times-circle"></i></button></a>
                                        @endif
                                    </div>
                                    <div class="col-md-2">
                                        <form method="POST" action="/timeTracker/public/full_shifts/{{$fullShift->id}}">
                                            {{ method_field('Delete') }}
                                            @csrf
                                            <input type="hidden" name="_method" value="DELETE">
                                            <button type="submit" name="submit" class="btn btn-danger btn-sm"><i class="fa fa-trash-o"></i></button>
                                        </form>
                                    </div>
                                    @endif
                                </div>
                            </div>
                        </td>
                    </tr>
                @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>

