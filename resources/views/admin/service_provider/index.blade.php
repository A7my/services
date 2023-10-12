<?php


?>

@extends('admin.layouts.master')


    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
    @section('title')
        Services Providers
    @endsection

    @section('content')

        <div class="container mt-3">
            <div class="card">
                <div class="card-header">
                    <h3>Services Providers</h3>
                    <span  class="btn btn-primary float-end btn-sm text-white"  data-toggle="modal" data-target="#createModal" >Add</span>
                </div>
                <table class="table table-light" id="member_table">
                    <thead>
                        <tr>
                            <td>Name</td>
                            <td>Email</td>
                            <td>Bio</td>
                            <td>Service</td>
                            <td>Image</td>
                            <td>Delete</td>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ( $serviceProviders as $serviceProvider )
                            <tr>
                                <td>{{ $serviceProvider->name }}</td>
                                <td>{{ $serviceProvider->email }}</td>
                                <td>{{ $serviceProvider->bio }}</td>
                                <td>{{ $serviceProvider->service['name'] }}</td>
                                <td> <img width="80px" height="80px" src="{{ URL::asset('images/serviceProviders/'.$serviceProvider->attachment->file ) }}" alt=""></td>
                                <td>

                                    <span class="btn btn-sm round btn-outline-danger" class="btn btn-danger delete"
                                    data-toggle="modal" data-target="#exampleModal{{ $serviceProvider->id }}"><i
                                        class="fa-solid fa-trash"></i>
                                    </span>




                                        <!--  Delete Modal -->
                                        <div class="modal fade" id="exampleModal{{ $serviceProvider->id }}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                            <div class="modal-dialog" role="document">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                <h5 class="modal-title" id="exampleModalLabel">Delete Service Provider</h5>
                                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                    <span aria-hidden="true">&times;</span>
                                                </button>
                                                </div>
                                                <div class="modal-body">
                                                    Are you sure you want to delete this service provider ?
                                                </div>
                                                <div class="modal-footer">
                                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                                <form action="{{ url('admin/service_provider/delete' , $serviceProvider->id) }}" method="POST">
                                                    @csrf
                                                    <button type="submit" class="btn btn-danger">Delete</button>
                                                </form>
                                                </div>
                                            </div>
                                            </div>
                                        </div>


                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>

        </div>


        {{-- Create Modal --}}
        <div class="modal fade" id="createModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="card mb-4">
                <h5 class="card-header"> Add a Restaurant </h5>
                <div class="card-body">
                    <div>
                        <form action="{{ url( 'admin/service_provider/create' ) }}" method="POST" enctype="multipart/form-data">
                            @csrf
                            <div>
                                <label for="defaultFormControlInput" class="form-label">Name</label>
                                <input type="text" name="name" required class="form-control" id="defaultFormControlInput"  />
                            </div>
                            <div>
                                <label for="defaultFormControlInput" class="form-label">Email</label>
                                <input type="email" name="email" required class="form-control" id="defaultFormControlInput" />
                            </div>
                            <div>
                                <label for="defaultFormControlInput" class="form-label">Password</label>
                                <input type="text" name="password" required class="form-control" id="defaultFormControlInput" />
                            </div>

                            <div>
                                <label for="defaultFormControlInput" class="form-label">Bio</label>
                                <input type="text" name="bio" required class="form-control" id="defaultFormControlInput" />
                            </div>

                            <div>
                                <label for="defaultFormControlInput" class="form-label">Service</label>
                                <select name="service" id="" class="form-control">
                                        <option value="" selected disabled><-- Select --></option>
                                    @foreach ($services as $service)
                                        <option value="{{ $service->id }}">{{ $service->name }}</option>
                                    @endforeach
                                </select>
                            </div>


                            <div class="mb-3">
                                <label for="formFile" class="form-label">Image</label>
                                <input class="form-control" type="file" id="formFile" name="image" />
                            </div>

                            <br>
                            <button type="submit" class="btn btn-success">add</button>
                        </form>
                    </div>
                </div>
                </div>
            </div>
        </div>


        {{-- setting --}}
        <div class="modal fade" id="setting" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="card mb-4">
                <h5 class="card-header"> Settings </h5>
                <div class="card-body">
                    <div>
                        <form action="{{ url('admin/settings') }}" method="POST" >
                            @csrf

                            <div>
                                <input type="text" value="{{ Auth::guard('web')->user()->name }}" class="form-control" id="defaultFormControlInput" required placeholder="Name" name="name" aria-describedby="defaultFormControlHelp" />
                                <label for="defaultFormControlInput" class="form-label"> Name </label>
                            </div>
                            <div>
                                <input type="email" class="form-control" value="{{ Auth::guard('web')->user()->email }}" id="defaultFormControlInput" required placeholder="Email" name="email" aria-describedby="defaultFormControlHelp" />
                                <label for="defaultFormControlInput" class="form-label"> Email </label>
                            </div>

                            <div>
                                <input type="text" class="form-control" id="defaultFormControlInput" value=""  placeholder="Password" name="password" aria-describedby="defaultFormControlHelp" />
                                <label for="defaultFormControlInput" class="form-label"> Password </label>
                            </div>

                            <button type="submit" class="btn btn-warning"> update info </button>

                        </form>
                            <div>
                        </div>
                </div>
            </div>
        </div>

        <script>
            @if(Session::has('deleteServiceProvider'))
            toastr.error("{{ session('deleteServiceProvider') }}")
            @endif
            @if(Session::has('createServiceProvider'))
            toastr.success("{{ session('createServiceProvider') }}")
            @endif


            @error('email')
            toastr.error("This Email already used")
            @enderror

            @error('phone')
            toastr.error("This Phone already used")
            @enderror
        </script>
        <script>
            @if(Session::has('infoupdated'))
                    toastr.success("{{ session('infoupdated') }}")
            @endif
        </script>

    @endsection
