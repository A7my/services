<?php


?>

@extends('admin.layouts.master')

    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>

    @section('title')
        Clients
    @endsection

    @section('content')

        <div class="container mt-3">
            <div class="card">
                <div class="card-header">
                    <h3>Clients</h3>
                </div>
                <table class="table table-light" id="member_table">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Name</th>
                            <th>Email</th>
                            <th>Location</th>
                            <th>Status</th>
                            <th>Delete</th>

                        </tr>
                    </thead>
                    <tbody class="table-border-bottom-0">
                        @forelse($clients as $client)
                            <tr>

                                <td>{{ $client->id }}</td>
                                <td>{{ $client->name }}</td>
                                <td>{{ $client->email }}</td>
                                <td><a href="https://www.google.com/maps?q={{ $client->lat }},{{ $client->lng }}" target="_blank">Open in Google Maps</a></td>
                                {{-- <td>{{ $client->is_active }}</td> --}}
                                <td>
                                    <div class="form-check form-switch">
                                        <input class="form-check-input" type="checkbox" data-client-id="{{ $client->id }}" {{ $client->is_active ? 'checked' : '' }}>
                                    </div>
                                </td>

                                <td>
                                    <span class="btn btn-sm round btn-outline-danger" class="btn btn-danger delete"
                                    data-toggle="modal" data-target="#exampleModal{{ $client->id }}"><i
                                        class="fa-solid fa-trash"></i>
                                    </span>

                                    <!-- Modal -->
                                    <div class="modal fade" id="exampleModal{{ $client->id }}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                        <div class="modal-dialog" role="document">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                            <h5 class="modal-title" id="exampleModalLabel">Modal title</h5>
                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                <span aria-hidden="true">&times;</span>
                                            </button>
                                            </div>
                                            <div class="modal-body">
                                                Are you sure you want to delete this client ?
                                            </div>
                                            <div class="modal-footer">
                                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                            <form action="{{ url('admin/client/delete' , $client->id) }}" method="POST">
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

            @if(Session::has('deleteClient'))
                    toastr.error("{{ session('deleteClient') }}")
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

<script>
    $(document).ready(function() {
        $('.form-check-input').on('change', function() {
            var clientId = $(this).data('client-id');
            var status = $(this).prop('checked') ? 1 : 0;

            $.ajax({
                url: 'client/changeStatus',
                type: 'POST',
                data: {
                    '_token': '{{ csrf_token() }}',
                    'client_id': clientId,
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




    @endsection
