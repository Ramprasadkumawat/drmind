@extends('admin.layout.template')
@section('content')
    <div class="card mb-3">
      <div class="card-header position-relative">
        <h5 class="mb-0 mt-1">All Courses</h5>
        <div class="bg-holder d-none d-md-block bg-card" style="background-image:url(../../../assets/img/illustrations/corner-6.png);"></div><!--/.bg-holder-->
      </div>
      <div class="card-body pt-0 pt-md-3">
        <div class="row g-3 align-items-center">
          <div class="col-auto d-xl-none"><button class="btn btn-sm p-0 btn-link position-relative" type="button" data-bs-toggle="offcanvas" data-bs-target="#filterOffcanvas" aria-controls="filterOffcanvas"><span class="fas fa-filter fs-9 text-700"></span></button></div>
          <div class="col">
            <form class="position-relative"><input class="form-control form-control-sm search-input lh-1 rounded-2 ps-4" type="search" placeholder="Search..." aria-label="Search" />
              <div class="position-absolute top-50 start-0 translate-middle-y ms-2"><span class="fas fa-search text-400 fs-10"></span></div>
            </form>
          </div>
          <div class="col position-sm-relative position-absolute top-0 end-0 me-3 me-sm-0 p-0">
            <div class="row g-0 g-md-3 justify-content-end">
              <div class="col-auto">
                <form class="row gx-2">
                  <div class="col-auto d-none d-lg-block"><small class="fw-semi-bold">Sort by:</small></div>
                  <div class="col-auto"> <select class="form-select form-select-sm" aria-label="Bulk actions">
                      <option value="rating">Rating</option>
                      <option value="review">Review</option>
                      <option value="price">Price</option>
                    </select></div>
                </form>
              </div>
              {{-- <div class="col-auto">
                <div class="d-flex align-items-center"><small class="fw-semi-bold d-none d-lg-block lh-1">View:</small>
                  <div class="d-flex"><a class="btn btn-link btn-sm text-700" href="../../../app/e-learning/course/course-grid.html" data-bs-toggle="tooltip" data-bs-placement="top" title="Course Grid"><span class="fas fa-th fs-8" data-fa-transform="down-1"></span></a><a class="btn btn-link btn-sm px-1 text-400 hover-700" href="../../../app/e-learning/course/course-list.html" data-bs-toggle="tooltip" data-bs-placement="top" title="Course List"><span class="fas fa-list-ul fs-8" data-fa-transform="down-1"></span></a></div>
                </div>
              </div> --}}
            </div>
          </div>
        </div>
      </div>
    </div>
    <div class="row mb-3 g-3">
      <article class="col-md-6 col-xxl-4">
        <div class="card h-100 overflow-hidden">
          <div class="card-body p-0 d-flex flex-column justify-content-between">
            <div>
              <div class="hoverbox text-center"><a class="text-decoration-none" href="../../../assets/video/beach.mp4" data-gallery="attachment-bg"><img class="w-100 h-100 object-fit-cover" src="../../../assets/img/elearning/courses/course1.png" alt="" /></a>
                <div class="hoverbox-content flex-center pe-none bg-holder overlay overlay-2"><img class="z-1" src="../../../assets/img/icons/play.svg" width="60" alt="" /></div>
              </div>
              <div class="p-3">
                <h5 class="fs-9 mb-2"><a class="text-1100" href="../../../app/e-learning/course/course-details.html">Script Writing Masterclass: Introdution to Industry Cliches</a></h5>
                <h5 class="fs-9"><a href="../../../app/e-learning/trainer-profile.html">Bill Finger</a></h5>
              </div>
            </div>
            {{-- <div class="row g-0 mb-3 align-items-end">
              <div class="col ps-3">
                <h4 class="fs-8 text-warning d-flex align-items-center"> <span>$69.50</span><del class="ms-2 fs-10 text-700">$139.90</del></h4>
                <p class="mb-0 fs-10 text-800">92,632 Learners Enrolled</p>
              </div>
              <div class="col-auto pe-3"><a class="btn btn-sm btn-falcon-default me-2 hover-danger" href="#!" data-bs-toggle="tooltip" data-bs-placement="top" title="Add to Wishlist"><span class="far fa-heart" data-fa-transform="down-2"></span></a><a class="btn btn-sm btn-falcon-default hover-primary" href="#!" data-bs-toggle="tooltip" data-bs-placement="top" title="Add to Cart"><span class="fas fa-cart-plus" data-fa-transform="down-2"></span></a></div>
            </div> --}}
          </div>
        </div>
      </article>
      <article class="col-md-6 col-xxl-4">
        <div class="card h-100 overflow-hidden">
          <div class="card-body p-0 d-flex flex-column justify-content-between">
            <div>
              <div class="hoverbox text-center"><a class="text-decoration-none" href="../../../assets/video/beach.mp4" data-gallery="attachment-bg"><img class="w-100 h-100 object-fit-cover" src="../../../assets/img/elearning/courses/course2.png" alt="" /></a>
                <div class="hoverbox-content flex-center pe-none bg-holder overlay overlay-2"><img class="z-1" src="../../../assets/img/icons/play.svg" width="60" alt="" /></div>
              </div>
              <div class="p-3">
                <h5 class="fs-9 mb-2"><a class="text-1100" href="../../../app/e-learning/course/course-details.html">Composition in Comics: Easy to Read Between Panels</a></h5>
                <h5 class="fs-9"><a href="../../../app/e-learning/trainer-profile.html">Bill Finger</a></h5>
              </div>
            </div>
            {{-- <div class="row g-0 mb-3 align-items-end">
              <div class="col ps-3">
                <h4 class="fs-8 text-warning d-flex align-items-center"> <span>$39.99</span><del class="ms-2 fs-10 text-700">$139.90</del></h4>
                <p class="mb-0 fs-10 text-800">92,603 Learners Enrolled</p>
              </div>
              <div class="col-auto pe-3"><a class="btn btn-sm btn-falcon-default me-2 hover-danger" href="#!" data-bs-toggle="tooltip" data-bs-placement="top" title="Add to Wishlist"><span class="far fa-heart" data-fa-transform="down-2"></span></a><a class="btn btn-sm btn-falcon-default hover-primary" href="#!" data-bs-toggle="tooltip" data-bs-placement="top" title="Add to Cart"><span class="fas fa-cart-plus" data-fa-transform="down-2"></span></a></div>
            </div> --}}
          </div>
        </div>
      </article>
      <article class="col-md-6 col-xxl-4">
        <div class="card h-100 overflow-hidden">
          <div class="card-body p-0 d-flex flex-column justify-content-between">
            <div>
              <div class="hoverbox text-center"><a class="text-decoration-none" href="../../../assets/video/beach.mp4" data-gallery="attachment-bg"><img class="w-100 h-100 object-fit-cover" src="../../../assets/img/elearning/courses/course3.png" alt="" /></a>
                <div class="hoverbox-content flex-center pe-none bg-holder overlay overlay-2"><img class="z-1" src="../../../assets/img/icons/play.svg" width="60" alt="" /></div>
              </div>
              <div class="p-3">
                <h5 class="fs-9 mb-2"><a class="text-1100" href="../../../app/e-learning/course/course-details.html">Advanced Design Tools for Modern Designs</a></h5>
                <h5 class="fs-9"><a href="../../../app/e-learning/trainer-profile.html">Bill Finger</a></h5>
              </div>
            </div>
            {{-- <div class="row g-0 mb-3 align-items-end">
              <div class="col ps-3">
                <h4 class="fs-8 text-warning d-flex align-items-center"> <span>$69.50</span><del class="ms-2 fs-10 text-700">$139.90</del></h4>
                <p class="mb-0 fs-10 text-800">11,000 Learners Enrolled</p>
              </div>
              <div class="col-auto pe-3"><a class="btn btn-sm btn-falcon-default me-2" href="#!" data-bs-toggle="tooltip" data-bs-placement="top" title="Remove from wishlist"><span class="fas fa-heart text-danger" data-fa-transform="down-2"></span></a><a class="btn btn-sm btn-falcon-default hover-primary" href="#!" data-bs-toggle="tooltip" data-bs-placement="top" title="Add to Cart"><span class="fas fa-cart-plus" data-fa-transform="down-2"></span></a></div>
            </div> --}}
          </div>
        </div>
      </article>
      <article class="col-md-6 col-xxl-4">
        <div class="card h-100 overflow-hidden">
          <div class="card-body p-0 d-flex flex-column justify-content-between">
            <div>
              <div class="hoverbox text-center"><a class="text-decoration-none" href="../../../assets/video/beach.mp4" data-gallery="attachment-bg"><img class="w-100 h-100 object-fit-cover" src="../../../assets/img/elearning/courses/course4.png" alt="" /></a>
                <div class="hoverbox-content flex-center pe-none bg-holder overlay overlay-2"><img class="z-1" src="../../../assets/img/icons/play.svg" width="60" alt="" /></div>
              </div>
              <div class="p-3">
                <h5 class="fs-9 mb-2"><a class="text-1100" href="../../../app/e-learning/course/course-details.html">Comic Page Layout: Analysing The Classics</a></h5>
                <h5 class="fs-9"><a href="../../../app/e-learning/trainer-profile.html">Bill Finger</a></h5>
              </div>
            </div>
            {{-- <div class="row g-0 mb-3 align-items-end">
              <div class="col ps-3">
                <h4 class="fs-8 text-warning d-flex align-items-center"> <span>$49.50</span><del class="ms-2 fs-10 text-700">$139.90</del></h4>
                <p class="mb-0 fs-10 text-800">32,106 Learners Enrolled</p>
              </div>
              <div class="col-auto pe-3"><a class="btn btn-sm btn-falcon-default me-2 hover-danger" href="#!" data-bs-toggle="tooltip" data-bs-placement="top" title="Add to Wishlist"><span class="far fa-heart" data-fa-transform="down-2"></span></a><a class="btn btn-sm btn-primary" href="#!" data-bs-toggle="tooltip" data-bs-placement="top" title="Remove from Cart"><span class="fas fa-shopping-cart" data-fa-transform="down-2"></span></a></div>
            </div> --}}
          </div>
        </div>
      </article>
      <article class="col-md-6 col-xxl-4">
        <div class="card h-100 overflow-hidden">
          <div class="card-body p-0 d-flex flex-column justify-content-between">
            <div>
              <div class="hoverbox text-center"><a class="text-decoration-none" href="../../../assets/video/beach.mp4" data-gallery="attachment-bg"><img class="w-100 h-100 object-fit-cover" src="../../../assets/img/elearning/courses/course5.png" alt="" /></a>
                <div class="hoverbox-content flex-center pe-none bg-holder overlay overlay-2"><img class="z-1" src="../../../assets/img/icons/play.svg" width="60" alt="" /></div>
              </div>
              <div class="p-3">
                <h5 class="fs-9 mb-2"><a class="text-1100" href="../../../app/e-learning/course/course-details.html">Abstract Painting: Zero to Mastery in Traditional Medium</a></h5>
                <h5 class="fs-9"><a href="../../../app/e-learning/trainer-profile.html">J. H. Williams III</a></h5>
              </div>
            </div>
            {{-- <div class="row g-0 mb-3 align-items-end">
              <div class="col ps-3">
                <h4 class="fs-8 text-warning d-flex align-items-center"> <span>$69.50</span><del class="ms-2 fs-10 text-700">$139.90</del></h4>
                <p class="mb-0 fs-10 text-800">2,304 Learners Enrolled</p>
              </div>
              <div class="col-auto pe-3"><a class="btn btn-sm btn-falcon-default me-2 hover-danger" href="#!" data-bs-toggle="tooltip" data-bs-placement="top" title="Add to Wishlist"><span class="far fa-heart" data-fa-transform="down-2"></span></a><a class="btn btn-sm btn-falcon-default hover-primary" href="#!" data-bs-toggle="tooltip" data-bs-placement="top" title="Add to Cart"><span class="fas fa-cart-plus" data-fa-transform="down-2"></span></a></div>
            </div> --}}
          </div>
        </div>
      </article>
      <article class="col-md-6 col-xxl-4">
        <div class="card h-100 overflow-hidden">
          <div class="card-body p-0 d-flex flex-column justify-content-between">
            <div>
              <div class="hoverbox text-center"><a class="text-decoration-none" href="../../../assets/video/beach.mp4" data-gallery="attachment-bg"><img class="w-100 h-100 object-fit-cover" src="../../../assets/img/elearning/courses/course6.png" alt="" /></a>
                <div class="hoverbox-content flex-center pe-none bg-holder overlay overlay-2"><img class="z-1" src="../../../assets/img/icons/play.svg" width="60" alt="" /></div>
              </div>
              <div class="p-3">
                <h5 class="fs-9 mb-2"><a class="text-1100" href="../../../app/e-learning/course/course-details.html">Inking: Choosing Between Analog vs Digital</a></h5>
                <h5 class="fs-9"><a href="../../../app/e-learning/trainer-profile.html">Bill Finger</a></h5>
              </div>
            </div>
            {{-- <div class="row g-0 mb-3 align-items-end">
              <div class="col ps-3">
                <h4 class="fs-8 text-warning d-flex align-items-center"> <span>$39.99</span><del class="ms-2 fs-10 text-700">$139.90</del></h4>
                <p class="mb-0 fs-10 text-800">9,312 Learners Enrolled</p>
              </div>
              <div class="col-auto pe-3"><a class="btn btn-sm btn-falcon-default me-2 hover-danger" href="#!" data-bs-toggle="tooltip" data-bs-placement="top" title="Add to Wishlist"><span class="far fa-heart" data-fa-transform="down-2"></span></a><a class="btn btn-sm btn-falcon-default hover-primary" href="#!" data-bs-toggle="tooltip" data-bs-placement="top" title="Add to Cart"><span class="fas fa-cart-plus" data-fa-transform="down-2"></span></a></div>
            </div> --}}
          </div>
        </div>
      </article>
      <article class="col-md-6 col-xxl-4">
        <div class="card h-100 overflow-hidden">
          <div class="card-body p-0 d-flex flex-column justify-content-between">
            <div>
              <div class="hoverbox text-center"><a class="text-decoration-none" href="../../../assets/video/beach.mp4" data-gallery="attachment-bg"><img class="w-100 h-100 object-fit-cover" src="../../../assets/img/elearning/courses/course7.png" alt="" /></a>
                <div class="hoverbox-content flex-center pe-none bg-holder overlay overlay-2"><img class="z-1" src="../../../assets/img/icons/play.svg" width="60" alt="" /></div>
              </div>
              <div class="p-3">
                <h5 class="fs-9 mb-2"><a class="text-1100" href="../../../app/e-learning/course/course-details.html">Character Design Masterclass: Your First Supervillain</a></h5>
                <h5 class="fs-9"><a href="../../../app/e-learning/trainer-profile.html">Bill Finger</a></h5>
              </div>
            </div>
            {{-- <div class="row g-0 mb-3 align-items-end">
              <div class="col ps-3">
                <h4 class="fs-8 text-warning d-flex align-items-center"> <span>$99.90</span><del class="ms-2 fs-10 text-700">$139.90</del></h4>
                <p class="mb-0 fs-10 text-800">292,603 Learners Enrolled</p>
              </div>
              <div class="col-auto pe-3"><a class="btn btn-sm btn-falcon-default me-2 hover-danger" href="#!" data-bs-toggle="tooltip" data-bs-placement="top" title="Add to Wishlist"><span class="far fa-heart" data-fa-transform="down-2"></span></a><a class="btn btn-sm btn-falcon-default hover-primary" href="#!" data-bs-toggle="tooltip" data-bs-placement="top" title="Add to Cart"><span class="fas fa-cart-plus" data-fa-transform="down-2"></span></a></div>
            </div> --}}
          </div>
        </div>
      </article>
      <article class="col-md-6 col-xxl-4">
        <div class="card h-100 overflow-hidden">
          <div class="card-body p-0 d-flex flex-column justify-content-between">
            <div>
              <div class="hoverbox text-center"><a class="text-decoration-none" href="../../../assets/video/beach.mp4" data-gallery="attachment-bg"><img class="w-100 h-100 object-fit-cover" src="../../../assets/img/elearning/courses/course8.png" alt="" /></a>
                <div class="hoverbox-content flex-center pe-none bg-holder overlay overlay-2"><img class="z-1" src="../../../assets/img/icons/play.svg" width="60" alt="" /></div>
              </div>
              <div class="p-3">
                <h5 class="fs-9 mb-2"><a class="text-1100" href="../../../app/e-learning/course/course-details.html">Character Design Masterclass: Your First Superhero</a></h5>
                <h5 class="fs-9"><a href="../../../app/e-learning/trainer-profile.html">Bill Finger</a></h5>
              </div>
            </div>
            {{-- <div class="row g-0 mb-3 align-items-end">
              <div class="col ps-3">
                <h4 class="fs-8 text-warning d-flex align-items-center"> <span>$69.99</span><del class="ms-2 fs-10 text-700">$139.90</del></h4>
                <p class="mb-0 fs-10 text-800">90,304 Learners Enrolled</p>
              </div>
              <div class="col-auto pe-3"><a class="btn btn-sm btn-falcon-default me-2 hover-danger" href="#!" data-bs-toggle="tooltip" data-bs-placement="top" title="Add to Wishlist"><span class="far fa-heart" data-fa-transform="down-2"></span></a><a class="btn btn-sm btn-falcon-default hover-primary" href="#!" data-bs-toggle="tooltip" data-bs-placement="top" title="Add to Cart"><span class="fas fa-cart-plus" data-fa-transform="down-2"></span></a></div>
            </div> --}}
          </div>
        </div>
      </article>
      <article class="col-md-6 col-xxl-4">
        <div class="card h-100 overflow-hidden">
          <div class="card-body p-0 d-flex flex-column justify-content-between">
            <div>
              <div class="hoverbox text-center"><a class="text-decoration-none" href="../../../assets/video/beach.mp4" data-gallery="attachment-bg"><img class="w-100 h-100 object-fit-cover" src="../../../assets/img/elearning/courses/course9.png" alt="" /></a>
                <div class="hoverbox-content flex-center pe-none bg-holder overlay overlay-2"><img class="z-1" src="../../../assets/img/icons/play.svg" width="60" alt="" /></div>
              </div>
              <div class="p-3">
                <h5 class="fs-9 mb-2"><a class="text-1100" href="../../../app/e-learning/course/course-details.html">Character Design Masterclass: Your First Sidekick</a></h5>
                <h5 class="fs-9"><a href="../../../app/e-learning/trainer-profile.html">Bill Finger</a></h5>
              </div>
            </div>
            {{-- <div class="row g-0 mb-3 align-items-end">
              <div class="col ps-3">
                <h4 class="fs-8 text-warning d-flex align-items-center"> <span>$69.99</span><del class="ms-2 fs-10 text-700">$139.90</del></h4>
                <p class="mb-0 fs-10 text-800">66,304 Learners Enrolled</p>
              </div>
              <div class="col-auto pe-3"><a class="btn btn-sm btn-falcon-default me-2 hover-danger" href="#!" data-bs-toggle="tooltip" data-bs-placement="top" title="Add to Wishlist"><span class="far fa-heart" data-fa-transform="down-2"></span></a><a class="btn btn-sm btn-falcon-default hover-primary" href="#!" data-bs-toggle="tooltip" data-bs-placement="top" title="Add to Cart"><span class="fas fa-cart-plus" data-fa-transform="down-2"></span></a></div>
            </div> --}}
          </div>
        </div>
      </article>
    </div>
    <div class="card">
      <div class="card-body">
        <div class="row g-3 flex-center justify-content-md-between">
          <div class="col-auto">
            <form class="row gx-2">
              <div class="col-auto"><small>Show:</small></div>
              <div class="col-auto"> <select class="form-select form-select-sm" aria-label="Show courses">
                  <option selected="selected" value="9">9</option>
                  <option value="20">20</option>
                  <option value="50">50</option>
                </select></div>
            </form>
          </div>
          <div class="col-auto"> <button class="btn btn-falcon-default btn-sm me-2" type="button" disabled="disabled" data-bs-toggle="tooltip" data-bs-placement="top" title="Prev"><span class="fas fa-chevron-left"></span></button><a class="btn btn-sm btn-falcon-default text-primary me-2" href="#!">1</a><a class="btn btn-sm btn-falcon-default me-2" href="#!">2</a><a class="btn btn-sm btn-falcon-default me-2" href="#!"> <span class="fas fa-ellipsis-h"></span></a><a class="btn btn-sm btn-falcon-default me-2" href="#!">303</a><button class="btn btn-falcon-default btn-sm" type="button" data-bs-toggle="tooltip" data-bs-placement="top" title="Next"><span class="fas fa-chevron-right"></span></button></div>
        </div>
      </div>
    </div>
  </div>


@endsection
