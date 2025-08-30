@extends('admin.layout.template')
@section('content')
<div class="card mb-3">
    <div class="card-body">
        <div class="row flex-between-center">
            <div class="col-md">
                <h5 class="mb-2 mb-md-0">View Doctors</h5>
            </div>
        </div>
    </div>
</div>
        <div class="row g-0">
            <div class="col-lg-12 pe-lg-2">
            <div class="card mb-3">
                <div class="card-header bg-body-tertiary">
                <h6 class="mb-0">Doctor Information</h6>
                </div>
                <div class="card-body">
                <table class="table table-bordered">
                    <thead>
                    <tr>
                        <th>Doctor Name</th>
                        <th>Specialization</th>
                        <th>Contact Number</th>
                        <th>Action</th>
                    </tr>
                    </thead>
                    <tbody>
                    <tr>
                        <td>Dr. John Doe</td>
                        <td>Cardiology</td>
                        <td>123-456-7890</td>
                        <td><a href="#" class="btn btn-primary">Edit</a></td>
                    </tr>
                    <tr>
                        <td>Dr. Jane Smith</td>
                        <td>Neurology</td>
                        <td>987-654-3210</td>
                        <td><a href="#" class="btn btn-primary">Edit</a></td>
                    </tr>
                    <tr>
                        <td>Dr. Emily Johnson</td>
                        <td>Pediatrics</td>
                        <td>555-123-4567</td>

                    </div>
                </div>
            </div>
        </div>

    </div>
</div>
@endsection