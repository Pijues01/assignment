@extends('assignment.layout.master')
@push('title')
    <title>Dashboard</title>
@endpush
@section('content')
    <div class="content-section" id="assignment1">
        <div class="head-title">
            <div class="left">
                <h1>Dashboard</h1>
                <ul class="breadcrumb">
                    <li>
                        <a href="#">Assignment</a>
                    </li>
                    <li><i class='bx bx-chevron-right'></i></li>
                    <li>
                        Assignment 1
                    </li>
                </ul>
                <h3>Welcome, {{ auth()->user()->username }}</h3>
            </div>
            <a href="{{ route('users.export') }}" class="btn-download">
                <i class='bx bxs-cloud-download bx-fade-down-hover'></i>
                <span class="text">Get CSV file of Users</span>
            </a>
        </div>



        <div class="modal fade" id="editUserModal" tabindex="-1" role="dialog" aria-labelledby="editUserModalLabel"
            aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="editUserModalLabel"></h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>

                    <div class="modal-body">
                        <form id="updateUserForm" enctype="multipart/form-data">
                            @csrf
                            <input type="hidden" id="user_id" name="id">

                            <div class="form-group">
                                <label for="name">Full Name:</label>
                                <input class="form-control" id="name" name="username" type="text" >
                                <span class="error-message" id="name-error"></span>
                            </div>

                            <div class="form-group">
                                <label for="email">Email address:</label>
                                <input class="form-control" id="email" name="email" type="email" >
                                <span class="error-message" id="email-error"></span>
                            </div>

                            <div class="form-group">
                                <label for="contact">Contact Number:</label>
                                <input class="form-control" id="contact" name="phone" type="text" maxlength="10"
                                     pattern="[6-9]\d{9}">
                                <span class="error-message" id="contact-error"></span>
                            </div>

                            <!-- Profile Picture Preview -->
                            <div class="form-group">
                                <div id="oldpic">
                                    <label>Old Profile Picture:</label>
                                    <img id="profilePreview" src="" alt="Profile Picture" width="80"
                                        class="img-thumbnail">
                                </div>
                                <br>
                                <label id="piclabel" for="profileimg"></label>
                                <input type="file" id="profileimg" name="profileimg" class="form-control"
                                    accept="image/*">
                                <span class="error-message" id="profileimg-error"></span>
                            </div>
                            <div id="up_pass"></div>
                            <div id="cr_pass"></div>
                            <div class="text-right">
                                <button class="btn btn-success" type="submit">Submit</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
        <div class="d-flex justify-content-center">
            {{-- <button id="adduser" data-toggle="modal" data-target="#editUserModal" type="button"
                class="btn btn-secondary">Add New User</button> --}}
            <button id="adduser" data-toggle="modal" data-target="#editUserModal" type="button" class="btn btn-secondary"
                data-action="create">
                Add New User
            </button>
        </div>
        {{-- {{$users}} --}}
        <div class="table-data">
            <div class="order">
                <div class="head">
                    <h3>Users List</h3>
                </div>
                <table>
                    <thead>
                        <tr>
                            <th>Id</th>
                            <th>Name</th>
                            <th>Email</th>
                            <th>Mobile No.</th>
                            <th>Profile Pic</th>
                            {{-- <th>Password</th> --}}
                            <th>Operations</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php $i = 1; ?>
                        @foreach ($users as $user)
                            <tr data-user-id="{{ $user->id }}">
                                {{-- <td>{{ $user->id }}</td> --}}
                                <td>{{ $i }}</td>
                                <td>{{ $user->username }}</td>
                                <td>{{ $user->email }}</td>
                                <td>{{ $user->phone }}</td>
                                <td><img src="{{ asset('storage/' . $user->profileimg) }}" alt="Profile Picture"
                                        width="50">
                                </td>
                                <td>
                                    <button type="button" class="btn btn-outline-success btn-sm editform"
                                        data-toggle="modal" data-target="#editUserModal" data-user-id="{{ $user->id }}"
                                        data-username="{{ $user->username }}" data-email="{{ $user->email }}"
                                        data-phone="{{ $user->phone }}"
                                        data-profileimg="{{ asset('storage/' . $user->profileimg) }}" data-password="{{ $user->password }}"
                                        data-action="update">
                                        Edit
                                    </button>
                                    {{-- <button type="button" class="btn btn-outline-danger btn-sm">Delete</button> --}}
                                    <button type="button" class="btn btn-outline-danger btn-sm delete-user"
                                        data-user-id="{{ $user->id }}">
                                        Delete
                                    </button>
                                </td>
                            </tr>
                            <?php $i++; ?>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>


    {{-- Assignment 2 --}}


    <div class="content-section" id="assignment2">

        <div class="head-title">
            <div class="left">
                <h1>Dashboard</h1>
                <ul class="breadcrumb">
                    <li>
                        <a href="#">Assignment</a>
                    </li>
                    <li><i class='bx bx-chevron-right'></i></li>
                    <li>
                        Assignment 2
                    </li>
                </ul>
                <h3>Welcome, {{ auth()->user()->username }}</h3>
            </div>

        </div>
        <div id="audiocard">
            <div class="card text-center">
                <h4 class="mb-3">Upload Audio to Get Duration</h4>
                {{-- <form id="audioForm" enctype="multipart/form-data">
                    @csrf
                    <input type="file" class="form-control mb-3" name="audio" id="audio" accept="audio/*">
                    <button type="submit" class="btn btn-primary w-100">Upload</button>
                </form> --}}
                <form id="audioForm" enctype="multipart/form-data">
                    @csrf
                    <input type="file" class="form-control mb-3" name="audio" id="audio" accept="audio/*">
                    <button type="submit" class="btn btn-primary w-100">Upload</button>
                </form>

                <p class="mt-3">Duration: <span id="audioDuration">--</span></p>
            </div>
        </div>
    </div>

    {{-- Assignment 3 --}}


    <div class="container d-flex justify-content-center align-items-center vh-100 content-section" id="assignment3">
        <div class="head-title">
            <div class="left">
                <h1>Dashboard</h1>
                <ul class="breadcrumb">
                    <li>
                        <a href="#">Assignment</a>
                    </li>
                    <li><i class='bx bx-chevron-right'></i></li>
                    <li>
                        Assignment 3
                    </li>
                </ul>
                <h3>Welcome, {{ auth()->user()->username }}</h3>
            </div>

        </div>
        <div class="card shadow-lg p-4" style="width: 40rem;">
            <h2 class="text-center mb-4">Calculate Distance</h2>

            <form id="distanceForm">
                @csrf
                <div class="row mb-3">
                    <div class="col-md-6">
                        <label for="lat1" class="form-label">Latitude 1:</label>
                        <input type="text" id="lat1" name="lat1" class="form-control" >
                    </div>
                    <div class="col-md-6">
                        <label for="lng1" class="form-label">Longitude 1:</label>
                        <input type="text" id="lng1" name="lng1" class="form-control" >
                    </div>
                </div>

                <div class="row mb-3">
                    <div class="col-md-6">
                        <label for="lat2" class="form-label">Latitude 2:</label>
                        <input type="text" id="lat2" name="lat2" class="form-control" >
                    </div>
                    <div class="col-md-6">
                        <label for="lng2" class="form-label">Longitude 2:</label>
                        <input type="text" id="lng2" name="lng2" class="form-control" >
                    </div>
                </div>

                <button type="submit" class="btn btn-primary w-100">Calculate Distance</button>
            </form>


            <!-- Result Section -->
            <div class="mt-4 text-center">
                <h4 class="text-muted">Distance (Result)</h4>
                <div class="row">
                    <div class="col-md-6">
                        <h5><span id="distanceResultKm">0</span> KM</h5>
                    </div>
                    <div class="col-md-6">
                        <h5><span id="distanceResultMiles">0</span> Miles</h5>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
