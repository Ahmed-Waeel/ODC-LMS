@extends('layouts.app1')


@if (Session::has('success'))
<div class="alert alert-success up"  style=" margin-bottom:40px; display:flex; flex-direction:row; width:100% ; position:absolute; top:0; left:0; align-items:center; justify-content:center ; font-size:40px;" role="alert">
   <h2> {{Session::get('success')}}  </h2>
</div>
@endif
@if (Session::has('failed'))
<div class="alert alert-success up" style="display:flex; flex-direction:row; width:100% ; position:absolute; top:0; left:0; align-items:center; justify-content:center ; font-size:40px;" role="alert">
   <h2> {{Session::get('failed')}}  </h2>
</div>
@endif

<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
<title>Courses</title>
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
					<div class="col-sm-6">
						<h2>Manage <b>Courses</b></h2>
					</div>
					<div class="col-sm-5">
						<a href="#addEmployeeModal"  class="btn btn-success" data-toggle="modal"><i class="material-icons">&#xE147;</i> <span>Add Course</span></a>
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
						<th>Description</th>
						<th>Level</th>
						<th>Category</th>
                        <th>Actions</th>
					</tr>
				</thead>
				<tbody>
                    @foreach ( $courses as $course )
					<tr>
                        <td>
                            <span class="custom-checkbox">
                                <input type="checkbox" id="checkbox1" name="options[]" value="1">
								<label for="checkbox1"></label>
							</span>
						</td>
						<td>{{$course->name}}</td>
						<td>{{$course->description}}</td>
						<td>{{$course->level}}</td>
						<td>{{$course->category_id}}</td>
						<td>
                            <a href="#editEmployeeModal" class="edit" data-toggle="modal"><i class="material-icons" data-toggle="tooltip" title="Edit">&#xE254;</i></a>
                            <a href="{{url('admin/courses/' . $course->id)}}" class="delete" ><i class="material-icons" data-toggle="tooltip" title="Delete">&#xE872;</i></a>
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
			<form action="{{url('admin/courses/store')}}"method="POST">
                @csrf
				<div class="modal-header">
					<h4 class="modal-title">Add Course</h4>
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
						<label>Description</label>
						<input type="text" name="description" class="form-control" >
                        @error('description')
                        <small class="form-text text-danger">{{$message}}</small>
                        @enderror
					</div>
					<div class="form-group">
						<label>Level</label>
						<select  name="level" class="form-control" >
                            <option value="beginner">beginner</option>
                            <option value="Intermidiate">Intermidiate</option>
                            <option value="Advanced">Advanced</option>
                        </select>
					</div>
					<div class="form-group">
						<label>Category</label>
						<select  name="category_id" class="form-control" >
                            <option value="1">Web</option>
                            <option value="2">IT</option>
                            <option value="3">PHP</option>
                            <option value="4">MYSQL</option>
                            <option value="5">CS</option>
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
<!-- Edit Modal HTML -->
<div id="editEmployeeModal" class="modal fade">
	<div class="modal-dialog">
		<div class="modal-content">
			<form>
				<div class="modal-header">
					<h4 class="modal-title">Edit Course</h4>
					<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
				</div>
				<div class="modal-body">
					<div class="form-group">
						<label>Name</label>
						<input type="text" class="form-control" required>
					</div>
					<div class="form-group">
						<label>Description</label>
						<input type="email" class="form-control" required>
					</div>
					<div class="form-group">
						<label>Level</label>
						<select type="number" name="role" class="form-control" >
                            <option value="0">Beiganer</option>
                            <option value="1">Intermidiate</option>
                            <option value="1">Advanced</option>
                        </select>
                    </div>
					<div class="form-group">
						<label>Category</label>
						<select type="number" name="role" class="form-control" >
                            <option value="0">Web</option>
                            <option value="1">IT</option>
                        </select>
                    </div>
				</div>
				<div class="modal-footer">
					<input type="button" class="btn btn-default" data-dismiss="modal" value="Cancel">
					<input type="submit" class="btn btn-info" value="Save">
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
					<h4 class="modal-title">Delete Course</h4>
					<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
				</div>
				<div class="modal-body">
					<p>Are you sure you want to delete This Course?</p>
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
