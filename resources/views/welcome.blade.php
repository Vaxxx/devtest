@extends('layouts.app')
@section('content')
    <div class="d-flex" id="wrapper">
    @include('includes.topnav')
    <div class="container-fluid p-3">
        <h2 class="mt-4">Okagbare Vakpo</h2><hr style="background-color: #fbb30b">
        <div class="resume-section-content">
            <div class="subheading mb-5">
                This is a Dev Test for KDNS

            </div>
            <p class="lead mb-5">
                The Adobe XD was not provided, so I had to try to clone the template
            </p>
            <p class="lead mb-5">
                This project was created using Laravel and Vue.

            </p>
            <h2 class="lead mb-5">
                To access the project, just register and login.
                <small>Or use <h3 class="colorLogo">Email: <small class="text-muted colorLogo">test@mail.com</small> </h3>  <h3 class="colorLogo">password: <small class="text-muted">12345678</small></h3></small>
            </h2>
            <p class="lead mb-5">
                The functionalities displayed on this project include the following:
            </p>
            <ol class="mt-n4 pl-4">
                <li>
                    Add new gig
                </li>
                <li>
                    Display all gigs
                </li>
                <li>
                    Delete a gig
                </li>
            </ol>
            </p>
            <p class="lead mb-5">
                Other details of the project are placed in the readme.md file
            </p>
        </div>
    </div>
    </div>

@endsection
