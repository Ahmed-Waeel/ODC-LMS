@extends('layouts.app1')
@if(Session::has('success'))
    <div class="alert alert-success" style="display: flex ; flex-direction: row-reverse ; position: absolute  ; top: 300px; margin-left: 46% width: 300px ; height: 40px" >
        <p> {{Session::get('success')}}  </p>
    </div>
@endif


<div style="display: flex ; flex-direction: row-reverse ; margin: auto"  >
