@extends('layout.adminLayout.app')
@section('title','Exercises | Management')
@section('moreCss')
        <!-- DataTables -->
        <link rel="stylesheet" href="{{ asset('adminstyle/assets/modules/datatables/datatables.min.css') }}">
        <link rel="stylesheet" href="{{ asset('adminstyle/assets/modules/datatables/DataTables-1.10.16/css/dataTables.bootstrap4.min.css') }}">
        <link rel="stylesheet" href="{{ asset('adminstyle/assets/modules/datatables/Select-1.2.4/css/select.bootstrap4.min.css') }}">
@endsection
@section('content')
{{-- @include('administrator.rule_section.modalForm') --}}
<section class="section">
    <div class="section-body">
        <h2 class="section-title">Exercises</h2>
        <p class="section-lead">
            {{ ucfirst(strtolower($ruleData->title)) }} / Exercises
        </p>
        <div class="row">
           <div class="col-lg-8 col-md-8 col-sm-12">
                <div class="card">
                    <div class="card-body">

                        <div id="accordion">
                            <div class="accordion">
                              <div class="accordion-header" role="button" data-toggle="collapse" data-target="#panel-body-1" aria-expanded="true">
                                <h4>Quesion 1</h4>
                              </div>
                              <div class="accordion-body collapse show" id="panel-body-1" data-parent="#accordion">
                                <p class="mb-0">Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod
                                tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam,
                                quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo
                                consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse
                                cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non
                                proident, sunt in culpa qui officia deserunt mollit anim id est laborum.</p>
                              </div>
                            </div>
                            <div class="accordion">
                              <div class="accordion-header" role="button" data-toggle="collapse" data-target="#panel-body-2">
                                <h4>Quesion 2</h4>
                              </div>
                              <div class="accordion-body collapse" id="panel-body-2" data-parent="#accordion">
                                <p class="mb-0">Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod
                                tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam,
                                quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo
                                consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse
                                cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non
                                proident, sunt in culpa qui officia deserunt mollit anim id est laborum.</p>
                              </div>
                            </div>
                            <div class="accordion">
                              <div class="accordion-header" role="button" data-toggle="collapse" data-target="#panel-body-3">
                                <h4>Quesion 3</h4>
                              </div>
                              <div class="accordion-body collapse" id="panel-body-3" data-parent="#accordion">
                                <p class="mb-0">Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod
                                tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam,
                                quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo
                                consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse
                                cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non
                                proident, sunt in culpa qui officia deserunt mollit anim id est laborum.</p>
                              </div>
                            </div>
                            <div class="accordion">
                              <div class="accordion-header" role="button" data-toggle="collapse" data-target="#panel-body-4">
                                <h4>Quesion 4</h4>
                              </div>
                              <div class="accordion-body collapse" id="panel-body-4" data-parent="#accordion">
                                <p class="mb-0">Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod
                                tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam,
                                quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo
                                consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse
                                cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non
                                proident, sunt in culpa qui officia deserunt mollit anim id est laborum.</p>
                              </div>
                            </div>
                            <div class="accordion">
                              <div class="accordion-header" role="button" data-toggle="collapse" data-target="#panel-body-5">
                                <h4>Quesion 4</h4>
                              </div>
                              <div class="accordion-body collapse" id="panel-body-5" data-parent="#accordion">
                                <p class="mb-0">Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod
                                tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam,
                                quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo
                                consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse
                                cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non
                                proident, sunt in culpa qui officia deserunt mollit anim id est laborum.</p>
                              </div>
                            </div>
                          </div>

                    </div>
                </div>
           </div>
           <div class="col-lg-4 col-md-4 col-sm-12">
            <div class="card">
                <div class="card-body">
                    <form>
                        <div class="form-group">
                            <label for="exampleInputEmail1">Category</label>
                            <input type="text" class="form-control" value="{{ ucfirst(strtolower($ruleData->title)) }}" readonly>
                          </div>
                        <div class="form-group">
                          <label for="exampleInputEmail1">Answer</label>
                          <input type="text" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp">
                        </div>
                        <div class="form-group">
                          <label for="exampleInputPassword1">Question</label>
                          <textarea name="" data-height="130" class="form-control"></textarea>
                        </div>
                      
                        <button type="submit" class="btn btn-primary">Submit</button>
                      </form>
                </div>
            </div>
           
       </div>
        </div>
    </div>

</section>
@endsection

@section('moreJs')
   <script src="{{ asset('adminstyle/assets/modules/datatables/datatables.min.js') }}"></script>
    <script src="{{ asset('adminstyle/assets/modules/datatables/DataTables-1.10.16/js/dataTables.bootstrap4.min.js') }}"></script>
   
@endsection