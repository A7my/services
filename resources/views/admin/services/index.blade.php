<?php

use App\Models\Cart;
use App\Models\Client;
use App\Models\Product;

?>

@extends('admin.layouts.master')

    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
    @section('title')
        Services
    @endsection

    @section('content')

        <div class="container mt-3">
            <div class="card">
                <div class="card-header">
                    <h3>Service</h3>
                    <span  class="btn btn-primary float-end btn-sm text-white"  data-toggle="modal" data-target="#createModal" >Add</span>
                </div>
                <table class="table table-light" id="member_table">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Name</th>
                            <th>Description</th>
                            <th>Price</th>
                            <th>Action</th>

                        </tr>
                    </thead>
                    <tbody class="table-border-bottom-0">
                        @forelse($services as $service)
                            <tr>

                                <td>{{ $service->id }}</td>
                                <td>{{ $service->name }}</td>
                                <td>{{ $service->description }}</td>
                                <td>{{ $service->price }} $</td>

                                <td>
                                    <span class="btn btn-sm round btn-outline-primary" data-toggle="modal" data-target="#exampleModal2{{ $service->id }}"><i
                                        class="fa-solid fa-pen-to-square"></i></i>
                                    </span>

                                    <span class="btn btn-sm round btn-outline-danger" class="btn btn-danger delete"
                                    data-toggle="modal" data-target="#exampleModal{{ $service->id }}"><i
                                        class="fa-solid fa-trash"></i>
                                    </span>

                                    <!-- EDIT Modal -->
                                    <div class="modal fade" id="exampleModal2{{ $service->id }}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                    <div class="card mb-4">
                                        <h5 class="card-header"> Edit Service </h5>
                                        <div class="card-body">
                                            <div>
                                                <form action="{{ url('admin/service/edit' , $service->id) }}" method="POST" enctype="multipart/form-data">
                                                    @csrf
                                                    <div>
                                                        <label for="defaultFormControlInput" class="form-label">Name</label>
                                                        <input type="text" required name="name" class="form-control" id="defaultFormControlInput" value="{{ $service->name }}"/>
                                                    </div>
                                                    <div>
                                                        <label for="exampleFormControlTextarea1" class="form-label">Description</label>
                                                        <textarea required class="form-control" id="exampleFormControlTextarea1" name="description" rows="3">{{ $service->description}}</textarea>
                                                    </div>

                                                    <div class="mb-3">
                                                        <label for="formFile" class="form-label">Price</label>
                                                        <input type="text" required name="price" class="form-control" id="defaultFormControlInput" value="{{ $service->price }}"/>

                                                    </div>
                                                    <br>
                                                    <button type="submit" class="btn btn-success">Edit</button>
                                                </form>
                                            </div>
                                        </div>
                                        </div>
                                    </div>

                                    <!-- Modal -->
                                    <div class="modal fade" id="exampleModal{{ $service->id }}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                        <div class="modal-dialog" role="document">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                            <h5 class="modal-title" id="exampleModalLabel">Modal title</h5>
                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                <span aria-hidden="true">&times;</span>
                                            </button>
                                            </div>
                                            <div class="modal-body">
                                                Are you sure you want to delete this service ?
                                            </div>
                                            <div class="modal-footer">
                                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                            <form action="{{ url('admin/service/delete' , $service->id) }}" method="POST">
                                                @csrf
                                                <button type="submit" class="btn btn-danger">Delete</button>
                                            </form>
                                            </div>
                                        </div>
                                        </div>
                                    </div>




                                </td>

                            </tr>
                            @empty
                                <tr>
                                    <td colspan="7">No data</td>
                                </tr>
                        @endforelse
                    </tbody>
                </table>
                    <!-- create Modal -->
                    <div class="modal fade" id="createModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                        <div class="card mb-4">
                            <h5 class="card-header"> Add a Service </h5>
                            <div class="card-body">
                                <div>
                                    <form action="{{ url('admin/service/create') }}" method="POST" enctype="multipart/form-data">
                                        @csrf
                                        <div>
                                            <label for="defaultFormControlInput" class="form-label">Name</label>
                                            <input type="text" name="name" required class="form-control" id="defaultFormControlInput" />
                                        </div>
                                        <div>
                                            <label for="exampleFormControlTextarea1" class="form-label">Description</label>
                                            <textarea class="form-control" required id="exampleFormControlTextarea1" name="description" rows="3"></textarea>
                                        </div>

                                        <div class="mb-3">
                                            <label for="formFile" class="form-label">Price</label>
                                            <input type="text" name="price" required class="form-control" id="defaultFormControlInput" />

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
        </div>

        <script>
            $(document).ready(function() {
                $('.form-select').on('change', function() {
                    var delivery_id = $(this).find(':selected').data('delivery-id');
                    var orderId = $(this).data('order-id');

                    $.ajax({
                        url: '/restaurant/order/chooseDelivery',
                        type: 'POST',
                        data: {
                            '_token': '{{ csrf_token() }}',
                            'delivery_id': delivery_id,
                            'orderId': orderId
                        },
                        success: function(response) {
                            console.log(response);
                        },
                        error: function(xhr) {
                            console.log(xhr.responseText);
                        }
                    });
                });
            });
        </script>
        <script>
            $(document).ready(function() {
                $('.form-check-input').on('change', function() {
                    var managerId = $(this).data('manager-id');
                    var status = $(this).prop('checked') ? 1 : 0;

                    $.ajax({
                        url: '/updateManagerStatus',
                        type: 'POST',
                        data: {
                            '_token': '{{ csrf_token() }}',
                            'manager_id': managerId,
                            'status': status
                        },
                        success: function(response) {
                            console.log(response);
                        },
                        error: function(xhr) {
                            console.log(xhr.responseText);
                        }
                    });
                });
            });
        </script>
        <script>
            @if(Session::has('deleteProduct'))
            toastr.error("{{ session('deleteProduct') }}")
            @endif
            @if(Session::has('createCategory'))
            toastr.success("{{ session('createCategory') }}")
            @endif
            @if(Session::has('createProduct'))
            toastr.success("{{ session('createProduct') }}")
            @endif
            @error('price')
            toastr.error("the price should be numeric")
            @enderror

        </script>
        <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
        <script>
            $(document).ready(function() {
                $('.form-select').on('change', function() {
                    var selectedDeliveryId = $(this).val();
                    var orderId = $(this).data('order-id');
                    var phoneNumber = $('[data-delivery-id="' + selectedDeliveryId + '"]').data('phone');

                    // Set the phone number for the corresponding order
                    $('[data-order-id="' + orderId + '"]').closest('tr').find('.phone-number a').text(phoneNumber);

                    // Update the WhatsApp link
                    var whatsappLink = "https://wa.me/" + phoneNumber;
                    $('[data-order-id="' + orderId + '"]').closest('tr').find('.phone-number a').attr('href', whatsappLink);
                });
            });
        </script>
        <script>
            @if(Session::has('createService'))
                    toastr.success("{{ session('createService') }}")
            @endif
            @if(Session::has('updateService'))
                    toastr.success("{{ session('updateService') }}")
            @endif

            @if(Session::has('deleteService'))
                    toastr.error("{{ session('deleteService') }}")
            @endif
            @error('price')
                    toastr.error("The price must be numberic")
            @enderror

        </script>
        <script>
            @if(Session::has('infoupdated'))
                    toastr.success("{{ session('infoupdated') }}")
            @endif
        </script>

    @endsection
