@extends('Layout.app')

@section('content')

    <div id="mainDivProject"  class="container  d-none">
        <div class="row">
            <div class="col-md-12 p-3">
                <button id="addNewProjectBtnId" class="btn my-3 btn-sm btn-danger">Add New </button>
                <table id="ProjectDataTable" class="table table-striped table-bordered" cellspacing="0" width="100%">
                    <thead>
                    <tr>
                        <th class="th-sm">Name</th>
                        <th class="th-sm">Description</th>
                        <th class="th-sm">Edit</th>
                        <th class="th-sm">Delete</th>
                    </tr>
                    </thead>
                    <tbody id="Project_table">

                    </tbody>
                </table>
            </div>
        </div>
    </div>


    <div id="loaderDivProject" class="container">
        <div class="row">
            <div class="col-md-12 text-center p-5">
                <img class="loading-icon m-5" src="{{asset('images/loader.svg')}}">
            </div>
        </div>
    </div>


    <div id="WrongDivProject" class="container d-none">
        <div class="row">
            <div class="col-md-12 text-center p-5">
                <h3>Something Went Wrong !</h3>
            </div>
        </div>
    </div>




    <div  class="modal fade"  id="deleteProjectModal"  tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true" >
        <div class="modal-dialog">
            <div class="modal-content">

                <div class="modal-body text-center">
                    <h5 class="mt-5">Do You want to delete??</h5>
                    <h5 id="projectDeleteId" class="mt-5 d-none"></h5>



                </div>
                <div class="modal-footer">
                    <button id="noClick8" type="button" class="btn btn-secondary" data-mdb-dismiss="modal">
                        No
                    </button>
                    <button id="projectDeleteConfirmBtn"  type="button" class="btn btn-danger">Yes</button>
                </div>
            </div>
        </div>
    </div>



    <div  class="modal fade" id="projectEditModal"  tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true" >
        <div class="modal-dialog modal-md ">
            <div class="modal-content">

                <div class="modal-body text-center p-5">

                    <h5 id="projectEditID" class="d-none"></h5>


                    <div id="projectEditForm" class="d-none w-100">

                        <input type="text" id="projectNameID" class="form-control md-4 mt-2" placeholder="Project Name"/>
                        <input type="text" id="projectDescID" class="form-control md-4 mt-3" placeholder="Project Description"/>
                        <input type="text" id="projectLinkID" class="form-control md-4 mt-3" placeholder="Project Description"/>
                        <input type="text" id="projectImgID" class="form-control md-4 mt-3" placeholder="Image Link"/>
                    </div>
                    <img id="projectEditLoader" class="loadingIcon" src="{{asset('images/loader.svg')}}">
                    <h6 id="projectWentWrong" class="d-none">Something Went Wrong</h6>


                </div>
                <div class="modal-footer">
                    <button id="noClick9" type="button" class="btn btn-secondaryb" data-mdb-dismiss="modal">
                        Cancel
                    </button>
                    <button id="projectEditConfirmBtn"  type="button" class="btn btn-primary">Save</button>
                </div>
            </div>
        </div>
    </div>


    <div class="modal fade" id="addProjectModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
         aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Add New Project</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body  text-center">
                    <div class="container">
                        <div class="row">
                            <div class="col-md-12">
                                <input id="ProjectNameId" type="text" id="" class="form-control mb-3" placeholder="Project Name">
                                <input id="ProjectDesId" type="text" id="" class="form-control mb-3" placeholder="Project Description">
                                <input id="ProjectLinkId" type="text" id="" class="form-control mb-3" placeholder="Project Link">
                                <input id="ProjectImgId" type="text" id="" class="form-control mb-3" placeholder="Project Image">
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-sm btn-primary" data-dismiss="modal">Cancel</button>
                        <button  id="ProjectAddConfirmBtn" type="button" class="btn  btn-sm  btn-danger">Save</button>
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection

@section('script')

    <script type="text/javascript">
        getProjectData();

    </script>

@endsection

