@extends('user.layout.template')
@section('content')
<div class="card mb-3">
    <div class="card-header">
        <h5 class="mb-0">Second Level Member</h5>
    </div>
    <div class="card-body pt-0">
        <div class="tab-content">
            <div class="tab-pane preview-tab-pane active">
                <div id="tableLevelOne" data-list='{"valueNames":["name","email","age"],"page":10,"pagination":true}'>
                    <div class="row justify-content-end g-0">
                        <div class="col-auto col-sm-5 mb-3">
                            <form>
                                <div class="input-group">
                                    <input class="form-control form-control-sm shadow-none search" type="search" placeholder="Search..." aria-label="search" />
                                    <div class="input-group-text bg-transparent">
                                        <span class="fa fa-search fs-10 text-600"></span>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                    <div class="table-responsive scrollbar">
                        <table class="table table-bordered table-striped fs-10 mb-0">
                            <thead class="bg-200">
                                <tr>
                                    <th class="text-900 sort" data-sort="name">S.No</th>
                                    <th class="text-900 sort" data-sort="email">Name</th>
                                    <th class="text-900 sort" data-sort="status">User ID</th>
                                  
                                </tr>
                            </thead>
                            <tbody class="list">
                                 
                                  @foreach($level1 as $key => $level)
                                    <tr>
                                        <td class="name">{{ $key + 1 }}</td>
                                        <td class="email">{{ $level->name }}</td>
                                        <td class="status">{{ $level->referral_code }}</td>
                                    </tr>
                                  @endforeach
                            </tbody>
                        </table>
                    </div>
                    <div class="d-flex justify-content-center mt-3">
                        <button class="btn btn-sm btn-falcon-default me-1" type="button" title="Previous" data-list-pagination="prev">
                            <span class="fas fa-chevron-left"></span>
                        </button>
                        <ul class="pagination mb-0"></ul>
                        <button class="btn btn-sm btn-falcon-default ms-1" type="button" title="Next" data-list-pagination="next">
                            <span class="fas fa-chevron-right"> </span>
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="card mb-3">
    <div class="card-header">
        <h5 class="mb-0">Thired Level Member</h5>
    </div>
    <div class="card-body pt-0">
        <div class="tab-content">
            <div class="tab-pane preview-tab-pane active">
                <div id="tableLevelTwo" data-list='{"valueNames":["name","email","age"],"page":10,"pagination":true}'>
                    <div class="row justify-content-end g-0">
                        <div class="col-auto col-sm-5 mb-3">
                            <form>
                                <div class="input-group">
                                    <input class="form-control form-control-sm shadow-none search" type="search" placeholder="Search..." aria-label="search" />
                                    <div class="input-group-text bg-transparent">
                                        <span class="fa fa-search fs-10 text-600"></span>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                    <div class="table-responsive scrollbar">
                        <table class="table table-bordered table-striped fs-10 mb-0">
                            <thead class="bg-200">
                                <tr>
                                    <th class="text-900 sort" data-sort="name">S.No</th>
                                    <th class="text-900 sort" data-sort="email">Name</th>
                                    <th class="text-900 sort" data-sort="status">User ID</th>
                                </tr>
                            </thead>
                            <tbody class="list">
                                    @foreach($level2 as $key => $level)
                                        <tr>
                                            <td class="name">{{ $key + 1 }}</td>
                                            <td class="email">{{ $level->name }}</td>
                                            <td class="status">{{ $level->referral_code }}</td>
                                        </tr>
                                    @endforeach
                            </tbody>
                        </table>
                    </div>
                    <div class="d-flex justify-content-center mt-3">
                        <button class="btn btn-sm btn-falcon-default me-1" type="button" title="Previous" data-list-pagination="prev">
                            <span class="fas fa-chevron-left"></span>
                        </button>
                        <ul class="pagination mb-0"></ul>
                        <button class="btn btn-sm btn-falcon-default ms-1" type="button" title="Next" data-list-pagination="next">
                            <span class="fas fa-chevron-right"> </span>
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
