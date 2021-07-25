@extends('Layout.app')

@section('content')

    <div id="mainDivReview"  class="container  d-none">
        <div class="row">
            <div class="col-md-12 p-3">
                <button id="addNewReviewBtn" class="btn my-3 btn-sm btn-danger">Add New </button>
                <table id="ReviewDataTableID" class="table table-striped table-bordered" cellspacing="0" width="100%">
                    <thead>
                    <tr>
                        <th class="th-sm">Name</th>
                        <th class="th-sm">Description</th>
                        <th class="th-sm">Edit</th>
                        <th class="th-sm">Delete</th>
                    </tr>
                    </thead>
                    <tbody id="Review_table">

                    </tbody>
                </table>
            </div>
        </div>
    </div>


    <div id="loaderDivReview" class="container">
        <div class="row">
            <div class="col-md-12 text-center p-5">
                <img class="loading-icon m-5" src="{{asset('images/loader.svg')}}">
            </div>
        </div>
    </div>


    <div id="WrongDivReview" class="container d-none">
        <div class="row">
            <div class="col-md-12 text-center p-5">
                <h3>Something Went Wrong !</h3>
            </div>
        </div>
    </div>




    <div class="modal fade" id="deleteReviewModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
         aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-body p-3 text-center">
                    <h5 class="mt-4">Do You Want To Delete?</h5>
                    <h5 id="ReviewDeleteId" class="mt-4 d-none">   </h5>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-sm btn-primary" data-dismiss="modal">No</button>
                    <button  id="ReviewDeleteConfirmBtn" type="button" class="btn  btn-sm  btn-danger">Yes</button>
                </div>
            </div>
        </div>
    </div>




    <div class="modal fade" id="addReviewModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
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
                                <input id="ReviewNameId" type="text" id="" class="form-control mb-3" placeholder="Reviewer Name">
                                <input id="ReviewDescId" type="text" id="" class="form-control mb-3" placeholder="Review">
                                <input id="ReviewImgId" type="text" id="" class="form-control mb-3" placeholder="Reviewer Image">
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-sm btn-primary" data-dismiss="modal">Cancel</button>
                        <button  id="ReviewAddConfirmBtn" type="button" class="btn  btn-sm  btn-danger">Save</button>
                    </div>
                </div>
            </div>
        </div>
    </div>



    <div  class="modal fade" id="ReviewEditModal"  tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true" >
        <div class="modal-dialog modal-md ">
            <div class="modal-content">

                <div class="modal-body text-center p-5">

                    <h5 id="ReviewEditID" class="d-none"></h5>


                    <div id="ReviewEditForm" class="d-none w-100">

                        <input type="text" id="ReviewEditNameID" class="form-control md-4 mt-2" placeholder="Project Name"/>
                        <input type="text" id="ReviewEditDescID" class="form-control md-4 mt-3" placeholder="Project Description"/>
                        <input type="text" id="ReviewEditImgID" class="form-control md-4 mt-3" placeholder="Image Link"/>
                    </div>
                    <img id="ReviewEditLoader" class="loadingIcon" src="{{asset('images/loader.svg')}}">
                    <h6 id="ReviewWentWrong" class="d-none">Something Went Wrong</h6>


                </div>
                <div class="modal-footer">
                    <button id="noClick20" type="button" class="btn btn-secondaryb" data-mdb-dismiss="modal">
                        Cancel
                    </button>
                    <button id="ReviewEditConfirmBtn"  type="button" class="btn btn-primary">Save</button>
                </div>
            </div>
        </div>
    </div>


@endsection

@section('script')

    <script type="text/javascript">
        getReviewData();
    </script>

@endsection
