@extends('Layout.app')

@section('content')


    <div id="mainDivCourse" class="container d-none">
        <div class="row">
            <div class="col-md-12" >

                <button id="addNewCourseBtn" class="btn my-3 btn-sm btn-danger">Add New</button>
                <table id="courseDataTableID" class="table table-striped table-bordered" cellspacing="0" width="100%">
                    <thead>

                    <tr>

                        <th class="th-sm">Name</th>
                        <th class="th-sm">Fee</th>
                        <th class="th-sm">Class</th>
                        <th class="th-sm">Enroll</th>
                        <th class="th-sm">Details</th>
                        <th class="th-sm">Edit</th>
                        <th class="th-sm">Delete</th>


                    </tr>


                    </thead>

                    <tbody id="course_table">

                    </tbody>

                </table>

            </div>

        </div>


    </div>


    <div id="loaderDivCourse" class="container">
        <div class="row">
            <div class="col-md-12 p-5 text-center">

                <img class="loadingIcon m-5" src="{{asset('images/loader.svg')}}">

            </div>
        </div>
    </div>

    <div id="wrongDivCourse" class="container d-none">
        <div class="row">
            <div class="col-md-12 p-5 text-center">

                <h3>Something Went Wrong</h3>

            </div>
        </div>
    </div>




    <div  class="modal fade"  id="CourseDeleteModal"  tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true" >
        <div class="modal-dialog">
            <div class="modal-content">

                <div class="modal-body text-center">
                    <h5 class="mt-5">Do You want to delete??</h5>
                    <h5 id="courseDeleteId" class="mt-5 d-none"></h5>



                </div>
                <div class="modal-footer">
                    <button id="noClick4" type="button" class="btn btn-secondary" data-mdb-dismiss="modal">
                        No
                    </button>
                    <button id="CourseDeleteConfirmBtn"  type="button" class="btn btn-danger">Yes</button>
                </div>
            </div>
        </div>
    </div>



    <div class="modal fade" id="addCourseModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
         aria-hidden="true">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Add New Course</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body  text-center">
                    <div class="container">
                        <div class="row">
                            <div class="col-md-6">
                                <input id="CourseNameId" type="text"  class="form-control mb-3" placeholder="Course Name">
                                <input id="CourseDescId" type="text"  class="form-control mb-3" placeholder="Course Description">
                                <input id="CourseFeeId" type="text"  class="form-control mb-3" placeholder="Course Fee">
                                <input id="CourseEnrollId" type="text"  class="form-control mb-3" placeholder="Total Enroll">
                            </div>
                            <div class="col-md-6">
                                <input id="CourseClassId" type="text" class="form-control mb-3" placeholder="Total Class">
                                <input id="CourseLinkId" type="text"  class="form-control mb-3" placeholder="Course Link">
                                <input id="CourseImgId" type="text" class="form-control mb-3" placeholder="Course Image">
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-sm btn-primary" data-dismiss="modal">Cancel</button>
                    <button  id="CourseAddConfirmBtn" type="button" class="btn  btn-sm  btn-danger">Save</button>
                </div>
            </div>
        </div>
    </div>





    <div class="modal fade" id="updateCourseModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
         aria-hidden="true">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Update Course</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body  text-center">
                    <div id="courseEditForm" class="container d-none">
                        <h5 id="courseEditID" class="mt-4 d-none"></h5>
                        <div class="row">
                            <div class="col-md-6">
                                <input id="CourseNameUpdateId" type="text"  class="form-control mb-3" placeholder="Course Name">
                                <input id="CourseDescUpdateId" type="text"  class="form-control mb-3" placeholder="Course Description">
                                <input id="CourseFeeUpdateId" type="text"  class="form-control mb-3" placeholder="Course Fee">
                                <input id="CourseEnrollUpdateId" type="text"  class="form-control mb-3" placeholder="Total Enroll">
                            </div>
                            <div class="col-md-6">
                                <input id="CourseClassUpdateId" type="text" class="form-control mb-3" placeholder="Total Class">
                                <input id="CourseLinkUpdateId" type="text"  class="form-control mb-3" placeholder="Course Link">
                                <input id="CourseImgUpdateId" type="text" class="form-control mb-3" placeholder="Course Image">
                            </div>
                        </div>
                    </div>

                    <img id="courseEditLoader" class="loadingIcon" src="{{asset('images/loader.svg')}}">
                    <h6 id="courseWentWrong" class="d-none">Something Went Wrong</h6>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-sm btn-primary" data-dismiss="modal">Cancel</button>
                    <button  id="CourseUpdateConfirmBtn" type="button" class="btn  btn-sm  btn-danger">Save</button>
                </div>
            </div>
        </div>
    </div>




    <div class="modal fade" id="DetailsCourseModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
         aria-hidden="true">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Update Course</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body  text-center">
                    <div id="DetailsForm" class="container d-none">
                        <div class="row">
                            <div class="col-md-6">
                                <input id="CourseNameDetailsId" type="text"  class="form-control mb-3" placeholder="Course Name">
                                <input id="CourseDescDetailsId" type="text"  class="form-control mb-3" placeholder="Course Description">
                                <input id="CourseFeeDetailsId" type="text"  class="form-control mb-3" placeholder="Course Fee">
                                <input id="CourseEnrollDetailsId" type="text"  class="form-control mb-3" placeholder="Total Enroll">
                            </div>
                            <div class="col-md-6">
                                <input id="CourseClassDetailsId" type="text" class="form-control mb-3" placeholder="Total Class">
                                <input id="CourseLinkDetailsId" type="text"  class="form-control mb-3" placeholder="Course Link">
                                <input id="CourseImgDetailsId" type="text" class="form-control mb-3" placeholder="Course Image">
                            </div>
                        </div>
                    </div>

                    <img id="DetailsLoader" class="loadingIcon" src="{{asset('images/loader.svg')}}">
                    <h6 id="DetailsWentWrong" class="d-none">Something Went Wrong</h6>
                </div>

            </div>
        </div>
    </div>


@endsection

@section('script')

    <script type="text/javascript">
        getCoursesData();
    </script>

@endsection

