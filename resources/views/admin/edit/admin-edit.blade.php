@extends('layouts.app1')
@if(Session::has('success'))
    <div class="alert alert-success" style="display: flex ; flex-direction: row-reverse ; position: absolute  ; top: 300px; margin-left: 46% width: 300px ; height: 40px" >
        <p> {{Session::get('success')}}  </p>
    </div>
@endif


<div style="display: flex ; flex-direction: row-reverse ; margin: auto"  >
        <div class="modal-dialog">
            <div class="modal-content">
                <form action="{{url('admin/admins/update/'.$admin->id)}}" method="post">
                    @csrf
                    <div class="modal-header">
                        <h4 class="modal-title">Edit Employee</h4>
                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                    </div>
                    <div class="modal-body">
                        <div class="form-group">
                            <label>Name</label>
                            <input type="text" value="{{$admin->name}}" name="name" class="form-control" required>
                        </div>
                        <div class="form-group">
                            <label>Email</label>
                            <input type="email" value="{{$admin->email}}" name="email" class="form-control" required>
                        </div>
                        <div class="form-group">
                            <label>Address</label>
                            <textarea class="form-control" required></textarea>
                        </div>
                        <div class="form-group">
                            <label>Phone</label>
                            <input type="text" class="form-control" required>
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
