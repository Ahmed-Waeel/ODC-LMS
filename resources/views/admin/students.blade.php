@extends('layouts.app1')



<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
<title> Students </title>
<link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Roboto|Varela+Round">
<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css">
<link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons">
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
<script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.min.js"></script>
</head>
<body>
<div class="container-xl">
	<div class="table-responsive">
		<div class="table-wrapper">
			<div class="table-title">
				<div class="row">
					<div class="col-sm-7">
						<h2>Manage <b>Students</b></h2>
					</div>
					<div class="col-sm-4">
						<a href="#addEmployeeModal"  class="btn btn-success" data-toggle="modal"><i class="material-icons">&#xE147;</i> <span>Add Student</span></a>
					</div>
				</div>
			</div>
			<table  class="table table-striped table-hover">
				<thead>
					<tr>
						<th>
							<span class="custom-checkbox">
								<input type="checkbox" id="selectAll">
								<label for="selectAll"></label>
							</span>
						</th>
						<th>Name</th>
						<th>Email</th>
						<th>Phone</th>
						<th>Address</th>
						<th>College</th>
						<th>Actions</th>
					</tr>
				</thead>
				<tbody>
                    @foreach ( $students as $student )
					<tr>
                        <td>
                            <span class="custom-checkbox">
                                <input type="checkbox" id="checkbox1" name="options[]" value="1">
								<label for="checkbox1"></label>
							</span>
						</td>
						<td> {{$student->name}}</td>
						<td>{{$student->email}}</td>
						<td> {{$student->phone}}</td>
						<td>{{$student->address}}</td>
						<td>{{$student->college}}</td>

						<td>
                            <a href="{{url('admin/students/'.$student->id)}}" class="delete" ><i class="material-icons" data-toggle="tooltip" title="Delete">&#xE872;</i></a>
						</td>
                    </tr>
                        @endforeach
                    </tbody>
			</table>
			<div class="clearfix">
				<div class="hint-text">Showing <b>5</b> out of <b>25</b> entries</div>
				<ul class="pagination">
					<li class="page-item disabled"><a href="#">Previous</a></li>
					<li class="page-item"><a href="#" class="page-link">1</a></li>
					<li class="page-item"><a href="#" class="page-link">2</a></li>
					<li class="page-item active"><a href="#" class="page-link">3</a></li>
					<li class="page-item"><a href="#" class="page-link">4</a></li>
					<li class="page-item"><a href="#" class="page-link">5</a></li>
					<li class="page-item"><a href="#" class="page-link">Next</a></li>
				</ul>
			</div>
		</div>
	</div>
</div>
<!-- Edit Modal HTML -->
<div id="addEmployeeModal" class="modal fade">
	<div class="modal-dialog">
		<div class="modal-content">
			<form action="{{url('admin/students/store')}}" method="POST">
                @csrf
				<div class="modal-header">
					<h4 class="modal-title">Add Admin</h4>
					<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
				</div>
				<div class="modal-body">
					<div class="form-group">
						<label>Name</label>
						<input type="text" name="name" class="form-control" >
                        @error('name')
                        <small class="form-text text-danger">{{$message}}</small>
                        @enderror

					</div>
					<div class="form-group">
						<label>Email</label>
						<input type="email" name="email" class="form-control" >
                        @error('email')
                        <small class="form-text text-danger">{{$message}}</small>
                        @enderror
					</div>
					<div class="form-group">
						<label>password</label>
						<input type="password" name="password" class="form-control" >
                        @error('password')
                        <small class="form-text text-danger">{{$message}}</small>
                        @enderror
					</div>
					<div class="form-group">
						<label>phone</label>
						<input type="text" name="phone" class="form-control">
                        @error('phone')
                        <small class="form-text text-danger">{{$message}}</small>
                        @enderror
					</div>
					<div class="form-group">
						<label>Address</label>
						<select name="address" class="form-control" >
                            <option value="Giza">Giza</option>
                            <option value="Cairo">cairo</option>
                            <option value="Alex">Alex</option>
                            <option value="Luxor">Luxor</option>
                            <option value="Tanta">Tanta</option>
                            <option value="Qena">Qena</option>
                        </select>
					</div>
					<div class="form-group">
						<label>College</label>
						<select name="college" class="form-control" >
                            <option value="Faculty of Science">Faculty of Science</option>
                            <option value="Faculty of engneering">Faculty of engneering</option>
                            <option value="Faculty of midicine">Faculty of midicine</option>
                            <option value="Faculty of art">Faculty of art</option>
                            <option value="Faculty of law">Faculty of law</option>
                        </select>
					</div>
				</div>
				<div class="modal-footer">
					<input type="button" class="btn btn-default" data-dismiss="modal" value="Cancel">
					<input type="submit" class="btn btn-success" value="Add">
				</div>
			</form>
		</div>
	</div>
</div>
<!-- Delete Modal HTML -->
<div id="deleteEmployeeModal" class="modal fade">
	<div class="modal-dialog">
		<div class="modal-content">
			<form>
				<div class="modal-header">
					<h4 class="modal-title">Delete Student</h4>
					<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
				</div>
				<div class="modal-body">
					<p>Are you sure you want to delete this Student?</p>
				</div>
				<div class="modal-footer">
					<input type="button" class="btn btn-default" data-dismiss="modal" value="Cancel">
					<input type="submit" class="btn btn-danger" value="Delete">
				</div>
			</form>
		</div>
	</div>
</div>
</body>
</html>
