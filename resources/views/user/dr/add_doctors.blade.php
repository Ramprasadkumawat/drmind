@extends('admin.layout.template')
@section('content')
<div class="card mb-3">
    <div class="card-body">
        <div class="row flex-between-center">
            <div class="col-md">
                <h5 class="mb-2 mb-md-0">Add a Doctor</h5>
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
              @if(session('success'))
                  <div class="alert alert-success">
                      {{ session('success') }}
                  </div>
              @endif

              <form action="" method="POST">
                  @csrf
                  <div class="row gx-2">
                      <!-- Doctor Name Field -->
                      <div class="col-12 mb-3">
                          <label class="form-label" for="doctor-name">Doctor Name:</label>
                          <input class="form-control @error('doctor_name') is-invalid @enderror"
                                 id="doctor-name"
                                 name="doctor_name"
                                 type="text"
                                 value="{{ old('doctor_name') }}" />
                          @error('doctor_name')
                              <div class="invalid-feedback">{{ $message }}</div>
                          @enderror
                      </div>

                      <!-- Specialization Field -->
                      <div class="col-12 mb-3">
                          <label class="form-label" for="specialization">Specialization:</label>
                          <input class="form-control @error('specialization') is-invalid @enderror"
                                 id="specialization"
                                 name="specialization"
                                 type="text"
                                 value="{{ old('specialization') }}" />
                          @error('specialization')
                              <div class="invalid-feedback">{{ $message }}</div>
                          @enderror
                      </div>

                      <!-- Contact Number Field -->
                      <div class="col-12 mb-3">
                          <label class="form-label" for="contact-number">Contact Number:</label>
                          <input class="form-control @error('contact_number') is-invalid @enderror"
                                 id="contact-number"
                                 name="contact_number"
                                 type="text"
                                 value="{{ old('contact_number') }}" />
                          @error('contact_number')
                              <div class="invalid-feedback">{{ $message }}</div>
                          @enderror
                      </div>

                      <!-- Email Field -->
                      <div class="col-12 mb-3">
                          <label class="form-label" for="email">Email:</label>
                          <input class="form-control @error('email') is-invalid @enderror"
                                 id="email"
                                 name="email"
                                 type="email"
                                 value="{{ old('email') }}" />
                          @error('email')
                              <div class="invalid-feedback">{{ $message }}</div>
                          @enderror
                      </div>

                      <!-- Status Field -->
                      <div class="col-12 mb-3">
                          <label class="form-label" for="status">Status:</label>
                          <select class="form-control @error('status') is-invalid @enderror" name="status" id="status">
                              <option value="1" {{ old('status') == 1 ? 'selected' : '' }}>Active</option>
                              <option value="0" {{ old('status') == 0 ? 'selected' : '' }}>Inactive</option>
                          </select>
                          @error('status')
                              <div class="invalid-feedback">{{ $message }}</div>
                          @enderror
                      </div>

                      <div class="col-12">
                          <button class="btn btn-primary" type="submit">Submit</button>
                      </div>
                  </div>
              </form>
          </div>
      </div>
  </div>
</div>
@endsection