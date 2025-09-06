@extends('user.layout.template')
@section('content')
    <div class="tree">
        <div class="card-header">
            <h5 class="mb-0">Tree View</h5>
        </div>
        <div class="col-xxl-6">
            <div class="card h-100">
                <div class="card-header">
                    <div class="row flex-between-end">
                        <div class="col-auto align-self-center">
                            <h5 class="mb-0" data-anchor="data-anchor" id="basic-example">Basic Example<a
                                    class="anchorjs-link " aria-label="Anchor" data-anchorjs-icon="#" href="#basic-example"
                                    style="margin-left: 0.1875em; padding-right: 0.1875em; padding-left: 0.1875em;"></a>
                            </h5>
                           
                        </div>

                    </div>
                </div>
                <div class="card-body scrollbar-overlay treeview-body-height mb-3 pb-0 simplebar-scrollable-y"
                    data-simplebar="init">
                    <div class="simplebar-wrapper" style="margin: -20px -20px 0px;">
                        <div class="simplebar-height-auto-observer-wrapper">
                            <div class="simplebar-height-auto-observer"></div>
                        </div>
                        <div class="simplebar-mask">
                            <div class="simplebar-offset" style="right: 0px; bottom: 0px;">
                                <div class="simplebar-content-wrapper" tabindex="0" role="region"
                                    aria-label="scrollable content" style="height: 100%; overflow: hidden scroll;">
                                    <div class="simplebar-content" style="padding: 20px 20px 0px;">
                                        <div class="tab-content">
                                            <div class="tab-pane preview-tab-pane active show" role="tabpanel"
                                                aria-labelledby="tab-dom-f12fb427-77f7-41ae-b0d5-923896ccbfaa"
                                                id="dom-f12fb427-77f7-41ae-b0d5-923896ccbfaa">

                                            </div>
                                            <ul class="mb-0 treeview" id="treeviewExample">
                                                @include('level_member.tree_node', ['node' => $tree])
                                            </ul>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="simplebar-placeholder" style="width: 858px; height: 636px;"></div>
                    </div>
                    <div class="simplebar-track simplebar-horizontal" style="visibility: hidden;">
                        <div class="simplebar-scrollbar" style="width: 0px; display: none;"></div>
                    </div>
                    <div class="simplebar-track simplebar-vertical" style="visibility: visible;">
                        <div class="simplebar-scrollbar"
                            style="height: 332px; display: block; transform: translate3d(0px, 0px, 0px);"></div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
