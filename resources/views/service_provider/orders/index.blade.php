<?php

use App\Models\Client;
use App\Models\Order;
use App\Models\ServiceProvider;



?>
@extends('service_provider.layouts.master')

<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
@section('title')
    Orders
@endsection
@section('content')


    <div class="container mt-3">
        <div class="card">
            <div class="card-header">
                <h3>Orders</h3>
            </div>
            <table class="table table-light" id="member_table">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>client</th>
                        <th>service provider</th>
                        <th>price</th>
                        <th>status</th>
                        <th>client details</th>
                    </tr>
                </thead>
                <tbody class="table-border-bottom-0">
                    @forelse($data as $order)
                        <tr>
                            <td>{{ $order->id }}</td>
                            <td> {{ Client::find($order->client_id)->name  }}</td>
                            <td>
                                @php
                                $serviceProvider = ServiceProvider::find($order->service_provider_id);
                                @endphp

                                @if ($serviceProvider && $serviceProvider->name)
                                    {{ $serviceProvider->name }}
                                @else
                                    NAn
                                @endif
                            </td>
                            <td>
                                @php
                                $serviceProvider = ServiceProvider::find($order->service_provider_id);
                                @endphp

                                @if ($serviceProvider && $serviceProvider->service && $serviceProvider->service->price)
                                    {{ $serviceProvider->service->price }}$
                                @else
                                    NAn
                                @endif
                            </td>

                            @if($order->status == 'pending')
                                <td style="color:rgb(83, 82, 4)">{{ $order->status }}</td>
                            @endif
                            @if($order->status == 'done')
                                <td style="color:rgb(40, 185, 21)">Delivered</td>
                            @endif
                            @if($order->status == 'canceled')
                                <td style="color:rgb(240, 16, 16)">Not Delivered</td>
                            @endif

                            <td>
                                <span data-toggle="modal" data-target="#orderdetails{{ $order->id }}">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-0-circle" viewBox="0 0 16 16">
                                        <path d="M7.988 12.158c-1.851 0-2.941-1.57-2.941-3.99V7.84c0-2.408 1.101-3.996 2.965-3.996 1.857 0 2.935 1.57 2.935 3.996v.328c0 2.408-1.101 3.99-2.959 3.99ZM8 4.951c-1.008 0-1.629 1.09-1.629 2.895v.31c0 1.81.627 2.895 1.629 2.895s1.623-1.09 1.623-2.895v-.31c0-1.8-.621-2.895-1.623-2.895Z"/>
                                        <path d="M16 8A8 8 0 1 1 0 8a8 8 0 0 1 16 0ZM1 8a7 7 0 1 0 14 0A7 7 0 0 0 1 8Z"/>
                                    </svg>
                                </span>
                            </td>

                            <div class="modal fade" id="orderdetails{{ $order->id }}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                <div class="card mb-4">
                                    <h5 class="card-header"> Client Info </h5>
                                    <div class="card-body">
                                        <div>
                                                <div>
                                                    <label for="defaultFormControlInput" class="form-label">Email</label>
                                                    <p style="color:green"><i>{{ Client::find($order->client_id)->email }}</i></p>
                                                </div>
                                                <div>
                                                    <label for="defaultFormControlInput" class="form-label">Location</label>
                                                    <p style="color:green"><i><a target="_blank" href="https://www.google.com/maps?q={{ Client::find($order->client_id)->lat }},{{ Client::find($order->client_id)->lng }}">Locatoin</a></i></p>
                                                </div>
                                                <div>
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
                <form action="{{ url('provider/settings') }}" method="POST" >
                    @csrf

                    <div>
                        <label for="defaultFormControlInput" class="form-label"> Name </label>
                        <input type="text" value="{{ Auth::guard('provider')->user()->name }}" class="form-control" id="defaultFormControlInput" required placeholder="Name" name="name" aria-describedby="defaultFormControlHelp" />
                    </div>
                    <div>
                        <label for="defaultFormControlInput" class="form-label"> Email </label>
                        <input type="email" class="form-control" value="{{ Auth::guard('provider')->user()->email }}" id="defaultFormControlInput" required placeholder="Email" name="email" aria-describedby="defaultFormControlHelp" />
                    </div>

                    <div>
                        <label for="defaultFormControlInput" class="form-label"> Password </label>
                        <input type="text" class="form-control" id="defaultFormControlInput" value=""  placeholder="Password" name="password" aria-describedby="defaultFormControlHelp" />
                    </div>

                    <div>
                        <label for="defaultFormControlInput" class="form-label"> Bio </label>
                        <input required type="text" class="form-control" id="defaultFormControlInput" value="{{ Auth::guard('provider')->user()->bio }}"  placeholder="bio" name="bio" aria-describedby="defaultFormControlHelp" />
                    </div>

                    <button type="submit" class="btn btn-warning"> update info </button>

                </form>
                    <div>
                </div>
        </div>
    </div>
</div>
                        </tr>
                        @empty
                            <tr>
                                <td colspan="7">No data</td>
                            </tr>
                    @endforelse
                </tbody>
            </table>
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
        @if(Session::has('edit_office'))
        toastr.success("{{ session('edit_office') }}")
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
        @if(Session::has('infoupdated'))
                toastr.success("{{ session('infoupdated') }}")
        @endif
    </script>

{{-- <script>
    $(document).ready(function() {
        $('.form-select').on('change', function() {
            var selectedDeliveryId = $(this).val();
            var orderId = $(this).data('order-id');

            // Send an AJAX request to get the phone number
            $.ajax({
                url: 'restaurant/get-phone-number', // Replace with the actual route to fetch the phone number
                method: 'POST',
                data: { deliveryId: selectedDeliveryId , order_id : orderId},
                success: function(response) {
                    // Update the phone number for the corresponding order
                    $('[data-order-id="' + orderId + '"]').closest('tr').find('.phone-number').text(response.phone);
                },
                error: function(error) {
                    console.log(error);
                }
            });
        });
    });
</script> --}}


@endsection


