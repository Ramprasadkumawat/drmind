@extends('user.layout.template')
@section('content')

    <div class="edit-profile">
    
          <div class="row g-0">
            <div class="col-lg-12 pe-lg-2">
              <div class="card mb-3">
                <div class="card-header">
                  <h5 class="mb-0">Profile Settings</h5>
                </div>
                @if(session('success'))
                    <div class="alert alert-success">{{ session('success') }}</div>
                @endif
                @if(session('error'))
                    <div class="alert alert-danger">{{ session('error') }}</div>
                @endif
                <div class="card-body bg-body-tertiary">
                  <form class="row g-3" action="{{ route('user.setting') }}" method="POST">
                    @csrf
                    <div class="col-lg-12">
                      <label class="form-label" for="current_password">Current Password</label>
                      <input class="form-control @error('current_password') is-invalid @enderror" id="current_password" name="current_password" type="password" autocomplete="current-password">
                      @error('current_password')
                        <div class="invalid-feedback">{{ $message }}</div>
                      @enderror
                    </div>
                    <div class="col-lg-12">
                      <label class="form-label" for="password">New Password</label>
                      <input class="form-control @error('password') is-invalid @enderror" id="password" name="new_password" type="password" autocomplete="new-password">
                      @error('new_password')
                        <div class="invalid-feedback">{{ $message }}</div>
                      @enderror
                    </div>
                    <div class="col-lg-12">
                      <label class="form-label" for="password_confirmation">Confirm New Password</label>
                      <input class="form-control @error('password_confirmation') is-invalid @enderror" id="password_confirmation" name="password_confirmation" type="password" autocomplete="new-password">
                      @error('password_confirmation')
                        <div class="invalid-feedback">{{ $message }}</div>
                      @enderror
                    </div>
                    <div class="col-12 d-flex justify-content-end"><button class="btn btn-primary" type="submit">Update </button></div>
                  </form>
                </div>
              </div>
            
            </div>
            <div class="col-lg-4 ps-lg-2">
              <div class="sticky-sidebar">
                {{-- <div class="card mb-3 overflow-hidden">
                  <div class="card-header">
                    <h5 class="mb-0">Account Settings</h5>
                  </div>
                  <div class="card-body bg-body-tertiary">
                    <h6 class="fw-bold">Who can see your profile ?<span class="fs-11 ms-1 text-primary" data-bs-toggle="tooltip" data-bs-placement="top" aria-label="Only The group of selected people can see your profile" data-bs-original-title="Only The group of selected people can see your profile"><svg class="svg-inline--fa fa-question-circle fa-w-16" aria-hidden="true" focusable="false" data-prefix="fas" data-icon="question-circle" role="img" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512" data-fa-i2svg=""><path fill="currentColor" d="M504 256c0 136.997-111.043 248-248 248S8 392.997 8 256C8 119.083 119.043 8 256 8s248 111.083 248 248zM262.655 90c-54.497 0-89.255 22.957-116.549 63.758-3.536 5.286-2.353 12.415 2.715 16.258l34.699 26.31c5.205 3.947 12.621 3.008 16.665-2.122 17.864-22.658 30.113-35.797 57.303-35.797 20.429 0 45.698 13.148 45.698 32.958 0 14.976-12.363 22.667-32.534 33.976C247.128 238.528 216 254.941 216 296v4c0 6.627 5.373 12 12 12h56c6.627 0 12-5.373 12-12v-1.333c0-28.462 83.186-29.647 83.186-106.667 0-58.002-60.165-102-116.531-102zM256 338c-25.365 0-46 20.635-46 46 0 25.364 20.635 46 46 46s46-20.636 46-46c0-25.365-20.635-46-46-46z"></path></svg><!-- <span class="fas fa-question-circle"></span> Font Awesome fontawesome.com --></span></h6>
                    <div class="ps-2">
                      <div class="form-check mb-0 lh-1"><input class="form-check-input" type="radio" value="" id="everyone" name="view-settings"><label class="form-check-label mb-0" for="everyone">Everyone</label></div>
                      <div class="form-check mb-0 lh-1"><input class="form-check-input" type="radio" value="" id="my-followers" checked="checked" name="view-settings"><label class="form-check-label mb-0" for="my-followers">My followers</label></div>
                      <div class="form-check mb-0 lh-1"><input class="form-check-input" type="radio" value="" id="only-me" name="view-settings"><label class="form-check-label mb-0" for="only-me">Only me</label></div>
                    </div>
                    <h6 class="mt-2 fw-bold">Who can tag you ?<span class="fs-11 ms-1 text-primary" data-bs-toggle="tooltip" data-bs-placement="top" aria-label="Only The group of selected people can tag you" data-bs-original-title="Only The group of selected people can tag you"><svg class="svg-inline--fa fa-question-circle fa-w-16" aria-hidden="true" focusable="false" data-prefix="fas" data-icon="question-circle" role="img" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512" data-fa-i2svg=""><path fill="currentColor" d="M504 256c0 136.997-111.043 248-248 248S8 392.997 8 256C8 119.083 119.043 8 256 8s248 111.083 248 248zM262.655 90c-54.497 0-89.255 22.957-116.549 63.758-3.536 5.286-2.353 12.415 2.715 16.258l34.699 26.31c5.205 3.947 12.621 3.008 16.665-2.122 17.864-22.658 30.113-35.797 57.303-35.797 20.429 0 45.698 13.148 45.698 32.958 0 14.976-12.363 22.667-32.534 33.976C247.128 238.528 216 254.941 216 296v4c0 6.627 5.373 12 12 12h56c6.627 0 12-5.373 12-12v-1.333c0-28.462 83.186-29.647 83.186-106.667 0-58.002-60.165-102-116.531-102zM256 338c-25.365 0-46 20.635-46 46 0 25.364 20.635 46 46 46s46-20.636 46-46c0-25.365-20.635-46-46-46z"></path></svg><!-- <span class="fas fa-question-circle"></span> Font Awesome fontawesome.com --></span></h6>
                    <div class="ps-2">
                      <div class="form-check mb-0 lh-1"><input class="form-check-input" type="radio" value="" id="tag-everyone" name="tag-settings"><label class="form-check-label mb-0" for="tag-everyone">Everyone</label></div>
                      <div class="form-check mb-0 lh-1"><input class="form-check-input" type="radio" value="" id="group-members" checked="checked" name="tag-settings"><label class="form-check-label mb-0" for="group-members">Group Members</label></div>
                    </div>
                    <div class="border-dashed-bottom my-3"></div>
                    <div class="form-check mb-0 lh-1"><input class="form-check-input" type="checkbox" id="userSettings1" checked="checked"><label class="form-check-label mb-0" for="userSettings1">Allow users to show your followers</label></div>
                    <div class="form-check mb-0 lh-1"><input class="form-check-input" type="checkbox" id="userSettings2" checked="checked"><label class="form-check-label mb-0" for="userSettings2">Allow users to show your email</label></div>
                    <div class="form-check mb-0 lh-1"><input class="form-check-input" type="checkbox" id="userSettings3"><label class="form-check-label mb-0" for="userSettings3">Allow users to show your experiences</label></div>
                    <div class="border-bottom border-dashed my-3"></div>
                    <div class="form-check form-switch mb-0 lh-1"><input class="form-check-input" type="checkbox" id="flexSwitchCheckDefault" checked="checked"><label class="form-check-label mb-0" for="flexSwitchCheckDefault">Make your phone number visible</label></div>
                    <div class="form-check form-switch mb-0 lh-1"><input class="form-check-input" type="checkbox" id="flexSwitchCheckChecked"><label class="form-check-label mb-0" for="flexSwitchCheckChecked">Allow user to follow you</label></div>
                  </div>
              
                </div> --}}
            </div>
          </div>
    </div>

@endsection
