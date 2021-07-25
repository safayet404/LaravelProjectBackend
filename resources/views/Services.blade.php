@extends('Layout.app')

@section('content')



    <div id="mainDiv" class="container d-none">
        <div class="row">
            <div class="col-md-12 p-5">

                <button id="addNewButtonID" class=" my-3 btn btn-sm btn-danger">ADD NEW</button>

                <table id="serviceDataTableID" class="table table-striped table-bordered" cellspacing="0" width="100%">
                    <thead>
                    <tr>
                        <th class="th-sm">Image</th>
                        <th class="th-sm">Name</th>
                        <th class="th-sm">Description</th>
                        <th class="th-sm">Edit</th>
                        <th class="th-sm">Delete</th>
                    </tr>
                    </thead>
                    <tbody id="service_table">

                    </tbody>
                </table>

            </div>
        </div>
    </div>


    <div id="loaderDiv" class="container">
        <div class="row">
            <div class="col-md-12 p-5 text-center">

                <img class="loadingIcon m-5" src="{{asset('images/loader.svg')}}">

            </div>
        </div>
    </div>

    <div id="wrongDiv" class="container d-none">
        <div class="row">
            <div class="col-md-12 p-5 text-center">

                <h3>Something Went Wrong</h3>

            </div>
        </div>
    </div>



    <div  class="modal fade"  id="deleteModal"  tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true" >
        <div class="modal-dialog">
            <div class="modal-content">

                <div class="modal-body text-center">
                    <h5 class="mt-5">Do You want to delete??</h5>
                    <h5 id="serviceDeleteId" class="mt-5 d-none"></h5>



                </div>
                <div class="modal-footer">
                    <button id="noClick" type="button" class="btn btn-secondary" data-mdb-dismiss="modal">
                        No
                    </button>
                    <button id="serviceDeleteConfirmBtn"  type="button" class="btn btn-danger">Yes</button>
                </div>
            </div>
        </div>
    </div>






    <div  class="modal fade" id="editModal"  tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true" >
        <div class="modal-dialog modal-md ">
            <div class="modal-content">

                <div class="modal-body text-center p-5">

                 <h5 id="serviceEditID" class="d-none"></h5>


                    <div id="serviceEditForm" class="d-none w-100">

                        <input type="text" id="serviceNameID" class="form-control md-4 mt-2" placeholder="Service Name"/>
                        <input type="text" id="serviceDescID" class="form-control md-4 mt-3" placeholder="Service Description"/>
                        <input type="text" id="serviceImgID" class="form-control md-4 mt-3" placeholder="Image Link"/>
                    </div>
                    <img id="serviceEditLoader" class="loadingIcon" src="{{asset('images/loader.svg')}}">
                    <h6 id="serviceWentWrong" class="d-none">Something Went Wrong</h6>


                </div>
                <div class="modal-footer">
                    <button id="noClick1" type="button" class="btn btn-secondaryb" data-mdb-dismiss="modal">
                        Cancel
                    </button>
                    <button id="serviceEditConfirmBtn"  type="button" class="btn btn-primary">Save</button>
                </div>
            </div>
        </div>
    </div>



    <div  class="modal fade" id="addModal"  tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true" >
        <div class="modal-dialog modal-md ">
            <div class="modal-content">



                <div class="modal-body text-center p-5">


                    <div id="serviceAddForm" class=" w-100">
                        <h6 class="mb-4">Add New Service</h6>
                        <input type="text" id="serviceNameAddID" class="form-control md-4 mt-2" placeholder="Service Name"/>
                        <input type="text" id="serviceDescAddID" class="form-control md-4 mt-3" placeholder="Service Description"/>
                        <input type="text" id="serviceImgAddID" class="form-control md-4 mt-3" placeholder="Image Link"/>
                    </div>


                </div>
                <div class="modal-footer">
                    <button id="noClick3" type="button" class="btn btn-secondaryb" data-mdb-dismiss="modal">
                        Cancel
                    </button>
                    <button id="serviceAddConfirmBtn"  type="button" class="btn btn-primary">Add New</button>
                </div>
            </div>
        </div>
    </div>

@endsection

@section('script')

    <script type="text/javascript">
        getServicesData();
    </script>

@endsection
