
function getServicesData() {


    axios.get('/getServiceData')
        .then(function(response) {

            if (response.status == 200) {
                $('#mainDiv').removeClass('d-none');
                $('#loaderDiv').addClass('d-none');
                $('#serviceDataTableID').DataTable().destroy();
                $('#service_table').empty();
                var JSONData = response.data;



                $.each(JSONData, function(i, item) {
                    $('<tr>').html(

                        "<td> <img  class='table-img' src=" + JSONData[i].service_img + "> </td>" +
                        "<td> " + JSONData[i].service_name + "</td> " +
                        "<td> " + JSONData[i].service_desc + "  </td>" +
                        "<td> <a class='serviceEditBtn' data-id=" + JSONData[i].id + " ><i class='fas fa-edit'> </td>" +
                        "<td> <a class='serviceDeleteBtn'  data-id=" + JSONData[i].id + " ><i class='fas fa-trash-alt'></td>"


                    ).appendTo('#service_table');
                });

                // Service Table Delete Icon
                $('.serviceDeleteBtn').click(function() {
                    var id = $(this).data('id');
                    $('#serviceDeleteId').html(id);
                    $('#deleteModal').modal('show');
                })

                $('#noClick').click(function (){
                    $('#deleteModal').modal('hide');
                })



                //Service Edit Button
                $('.serviceEditBtn').click(function (){
                    var id = $(this).data('id');
                    $('#serviceEditID').html(id);
                    ServiceUpdateDetails(id);
                    $('#editModal').modal('show');
                })

                $('#noClick1').click(function (){
                    $('#editModal').modal('hide');
                })



                $('#serviceDataTableID').DataTable({"order":false});
                $('.dataTables_length').addClass('bs-select');

            } else {
                $('#loaderDiv').addClass('d-none');
                $('#wrongDiv').removeClass('d-none');

            }

        }).catch(function(error) {
        $('#loaderDiv').addClass('d-none');
        $('#wrongDiv').removeClass('d-none');
    });

}


// Service Delete Modal Yes Btn
$('#serviceDeleteConfirmBtn').click(function() {
    var id = $('#serviceDeleteId').html();
    getServiceDelete(id);
})

//Service Delete ajax call

function getServiceDelete(deleteID) {

    $('#serviceDeleteConfirmBtn').html("<div class='spinner-border text-white role='status>\n" +
        "</div>")

    axios.post('/serviceDelete', {
        id: deleteID
    })
        .then(function(response) {

            $('#serviceDeleteConfirmBtn').html("Yes");

            if(response.status == 200)
            {
                if (response.data == 1) {
                    $('#deleteModal').modal('hide');
                    toastr.success('Delete Success.');
                    getServicesData();
                } else {
                    $('#deleteModal').modal('hide');
                    toastr.error('Delete Failed.');
                    getServicesData();
                }
            }
            else
            {
                $('#deleteModal').modal('hide');
                toastr.error('Something  Went Wrong Mothefucker!')
            }


        })
        .catch(function() {
            $('#deleteModal').modal('hide');
            toastr.error('Something  Went Wrong Motherfucker!')
        });
}

// Each Services Update Details

function ServiceUpdateDetails(detailsID) {
    axios.post('/serviceDetails', {
        id: detailsID
    })
        .then(function(response) {
            if(response.status==200)
            {

                $('#serviceEditLoader').addClass('d-none');
                $('#serviceEditForm').removeClass('d-none');
                var jsonData = response.data;
                $('#serviceNameID').val(jsonData[0].service_name);
                $('#serviceDescID').val(jsonData[0].service_desc);
                $('#serviceImgID').val(jsonData[0].service_img);
            }

            else
            {
                $('#serviceEditLoader').addClass('d-none');
                $('#serviceWentWrong').removeClass('d-none');
            }

        })
        .catch(function() {
            $('#serviceEditLoader').addClass('d-none');
            $('#serviceWentWrong').removeClass('d-none');
        });
}


//Service Edit modal save button

$('#serviceEditConfirmBtn').click(function() {
    var id = $('#serviceEditID').html();
    var name = $('#serviceNameID').val();
    var desc = $('#serviceDescID').val();
    var img = $('#serviceImgID').val();
    serviceUpdate(id,name,desc,img);
})

//Service Update Method

function serviceUpdate(serviceID,serviceName,serviceDesc,serviceImg){


    if(serviceName == 0)
    {
        toastr.error('Service Name Required.');
    }
    else if(serviceDesc == 0)
    {
        toastr.error('Service Description Required.');
    }
    else if(serviceImg == 0)
    {
        toastr.error('Service Image Required.');
    }
    else
    {
        $('#serviceEditConfirmBtn').html("<div class='spinner-border text-white role='status>\n" +
            "</div>")
        axios.post('/serviceUpdate',{
            id:serviceID,
            name: serviceName,
            desc: serviceDesc,
            img: serviceImg
        }).then(function (response){
            $('#serviceEditConfirmBtn').html('Save');
            if(response.status == 200)
            {
                if (response.data == 1)
                {
                    $('#editModal').modal('hide');
                    toastr.success('Save Success.');
                    getServicesData();

                }
                else
                {
                    $('#editModal').modal('hide');
                    toastr.error('Nothing to Save.');
                    getServicesData();

                }
            }
            else
            {
                $('#editModal').modal('hide');
                toastr.error('Something Went Wrong.');
            }



        }).catch(function (){
            $('#editModal').modal('hide');
            toastr.error('Something Went Wrong.');
        })
    }



}


// Add New Button Click

$('#addNewButtonID').click(function (){
    $('#addModal').modal('show');
});

$('#serviceAddConfirmBtn').click(function() {

    var name = $('#serviceNameAddID').val();
    var desc = $('#serviceDescAddID').val();
    var img = $('#serviceImgAddID').val();
    serviceAdd(name,desc,img);
})



$('#noClick3').click(function (){
    $('#addModal').modal('hide');
})




//Service Add Method

function serviceAdd(serviceName,serviceDesc,serviceImg){


    if(serviceName.length == 0)
    {
        toastr.error('Service Name Required.');
    }
    else if(serviceDesc.length == 0)
    {
        toastr.error('Service Description Required.');
    }
    else if(serviceImg.length == 0)
    {
        toastr.error('Service Image Required.');
    }
    else
    {
        $('#serviceAddConfirmBtn').html("<div class='spinner-border text-white role='status>\n" +
            "</div>")
        axios.post('/serviceAdd',{
            name: serviceName,
            desc: serviceDesc,
            img: serviceImg
        }).then(function (response){
            $('#serviceAddConfirmBtn').html('Add New');
            if(response.status == 200)
            {
                if (response.data == 1)
                {
                    $('#addModal').modal('hide');
                    toastr.success('Insert Success.');
                    getServicesData();

                }
                else
                {
                    $('#addModal').modal('hide');
                    toastr.error('Insert Failed.');
                    getServicesData();

                }
            }
            else
            {
                $('#addModal').modal('hide');
                toastr.error('Something Went Wrong.');
            }



        }).catch(function (){
            $('#addModal').modal('hide');
            toastr.error('Something Went Wrong.');
        })
    }

}

//Service Confirm Btn




// ----------------- Courses Data ---------------- //


function getCoursesData() {
    axios.get('/getCoursesData')
        .then(function(response) {
            if (response.status == 200) {
                $('#mainDivCourse').removeClass('d-none');
                $('#loaderDivCourse').addClass('d-none');


                $('#courseDataTableID').DataTable().destroy();
                $('#course_table').empty();
                var jsonData = response.data;
                $.each(jsonData, function(i, item) {
                    $('<tr>').html(
                        "<td>"+jsonData[i].course_name+"</td>"+
                        "<td>"+jsonData[i].course_fee+"</td>"+
                        "<td>"+jsonData[i].course_total_class+"</td>"+
                        "<td>"+jsonData[i].course_totalenroll+"</td>" +

                        "<td><a  class='courseViewDetailsBtn' data-id=" + jsonData[i].id + "><i class='fas fa-eye'></i></a></td>" +
                        "<td><a  class='courseEditBtn' data-id=" + jsonData[i].id + "><i class='fas fa-edit'></i></a></td>" +
                        "<td><a  class='courseDeleteBtn'  data-id=" + jsonData[i].id +" ><i class='fas fa-trash-alt'></i></a></td>"
                    ).appendTo('#course_table');

                    // Service Table Delete Icon
                    $('.courseDeleteBtn').click(function() {
                        var id = $(this).data('id');
                        $('#courseDeleteId').html(id);
                        $('#CourseDeleteModal').modal('show');
                    })

                    $('#noClick4').click(function (){
                        $('#CourseDeleteModal').modal('hide');
                    })


                    $('.courseViewDetailsBtn').click(function (){
                        $('#DetailsModal').modal('show');
                    })

                    $('#noClick7').click(function (){
                        $('#DetailsModal').modal('hide');
                    })

                    $('.courseEditBtn').click(function (){
                        var id = $(this).data('id');
                        CourseUpdateDetails(id);
                        $('#courseEditID').html(id);
                        $('#updateCourseModal').modal('show');
                    })

                    $('.courseViewDetailsBtn').click(function (){
                        var id = $(this).data('id');
                        CourseDetails(id);
                        $('#DetailsCourseModal').modal('show');
                    })
                });


                $('#courseDataTableID').DataTable({"order":false});
                $('.dataTables_length').addClass('bs-select');

            } else {
                $('#loaderDivCourse').addClass('d-none');
                $('#wrongDivCourse').removeClass('d-none');
            }
        })
        .catch(function(error) {
            $('#loaderDivCourse').addClass('d-none');
            $('#wrongDivCourse').removeClass('d-none');
        });
}


// Course Delete Confirm Button

$('#CourseDeleteConfirmBtn').click(function() {
    var id = $('#courseDeleteId').html();
    getCourseDelete(id);
})

//Course Delete ajax call

function getCourseDelete(deleteId) {

    $('#CourseDeleteConfirmBtn').html("<div class='spinner-border text-white role='status>\n" +
        "</div>")

    axios.post('/courseDelete', {
        id: deleteId
    })
        .then(function(response) {

            $('#CourseDeleteConfirmBtn').html("Yes");

            if(response.status == 200)
            {
                if (response.data == 1) {
                    $('#CourseDeleteModal').modal('hide');
                    toastr.success('Delete Success.');
                    getCoursesData();
                } else {
                    $('#CourseDeleteModal').modal('hide');
                    toastr.error('Delete Failed.');
                    getCoursesData();
                }
            }
            else
            {
                $('#CourseDeleteModal').modal('hide');
                toastr.error('Something  Went Wrong Mothefucker!')
            }


        })
        .catch(function() {
            $('#CourseDeleteModal').modal('hide');
            toastr.error('Something  Went Wrong Motherfucker!')
        });
}

// Add New Course

$('#addNewCourseBtn').click(function (){
    $('#addCourseModal').modal('show');
})


$('#CourseAddConfirmBtn').click(function(){
    var name=$('#CourseNameId').val();
    var desc=$('#CourseDescId').val();
    var fee=$('#CourseFeeId').val();
    var enroll=$('#CourseEnrollId').val();
    var Class =$('#CourseClassId').val();
    var link=$('#CourseLinkId').val();
    var img =$('#CourseImgId').val();

    CourseAdd(name,desc,fee,enroll,Class,link,img);
})
function CourseAdd(CourseName,CourseDesc,CourseFee,CourseEnroll,CourseClass,CourseLink,CourseImg){


    if(CourseName.length == 0)
    {
        toastr.error('Course Name Required.');
    }
    else if(CourseDesc.length == 0)
    {
        toastr.error('Course Description Required.');
    }
    else if(CourseFee.length == 0)
    {
        toastr.error('Course Fee Required.');
    }
    else if(CourseEnroll.length == 0)
    {
        toastr.error('Course Enroll Required.');
    }
    else if(CourseClass.length == 0)
    {
        toastr.error('Course Class Required.');
    }
    else if(CourseLink.length == 0)
    {
        toastr.error('Course Link Required.');
    }

    else if(CourseImg.length == 0)
    {
        toastr.error('Course Image Required.');
    }
    else
    {

        $('#CourseAddConfirmBtn').html("<div class='spinner-border text-white role='status>\n" +
            "</div>")

        axios.post('/CoursesAdd',{
            name: CourseName,
            desc: CourseDesc,
            fee : CourseFee,
            enroll : CourseEnroll,
            class : CourseClass,
            link : CourseLink,
            img : CourseImg
        }).then(function (response){
            $('#CourseAddConfirmBtn').html('Save');
            if(response.status == 200)
            {
                if (response.data == 1)
                {
                    $('#addCourseModal').modal('hide');
                    toastr.success('Insert Success.');
                    getCoursesData();

                }
                else
                {
                    $('#addCourseModal').modal('hide');
                    toastr.error('Insert Failed.');
                    getCoursesData();
                }
            }
            else
            {
                $('#addCourseModal').modal('hide');
                toastr.error('Something Went Wrong.');
            }



        }).catch(function (){
            $('#addCourseModal').modal('hide');
            toastr.error('Something Went Wrong.');
        })
    }

}



//  Update Course

function CourseUpdateDetails(detailsID) {
    axios.post('/courseDetails', {
        id: detailsID
    })
        .then(function (response) {
            if (response.status == 200) {

                $('#courseEditLoader').addClass('d-none');
                $('#courseEditForm').removeClass('d-none');
                var jsonData = response.data;
                $('#CourseNameUpdateId').val(jsonData[0].course_name);
                $('#CourseDescUpdateId').val(jsonData[0].course_desc);
                $('#CourseFeeUpdateId').val(jsonData[0].course_fee);
                $('#CourseEnrollUpdateId').val(jsonData[0].course_totalenroll);
                $('#CourseClassUpdateId').val(jsonData[0].course_total_class);
                $('#CourseLinkUpdateId').val(jsonData[0].course_link);
                $('#CourseImgUpdateId').val(jsonData[0].course_img);



            } else {
                $('#courseEditLoader').addClass('d-none');
                $('#courseWentWrong').removeClass('d-none');
            }

        })
        .catch(function () {
            $('#courseEditLoader').addClass('d-none');
            $('#courseWentWrong').removeClass('d-none');
        });


}

function CourseDetails(detailsID) {
    axios.post('/Details', {
        id: detailsID
    })
        .then(function (response) {
            if (response.status == 200) {

                $('#DetailsLoader').addClass('d-none');
                $('#DetailsForm').removeClass('d-none');
                var jsonData = response.data;
                $('#CourseNameDetailsId').val(jsonData[0].course_name);
                $('#CourseDescDetailsId').val(jsonData[0].course_desc);
                $('#CourseFeeDetailsId').val(jsonData[0].course_fee);
                $('#CourseEnrollDetailsId').val(jsonData[0].course_totalenroll);
                $('#CourseClassDetailsId').val(jsonData[0].course_total_class);
                $('#CourseLinkDetailsId').val(jsonData[0].course_link);
                $('#CourseImgDetailsId').val(jsonData[0].course_img);



            } else {
                $('#DetailsLoader').addClass('d-none');
                $('#DetailsWentWrong').removeClass('d-none');
            }

        })
        .catch(function () {
            $('#DetailsLoader').addClass('d-none');
            $('#DetailsWentWrong').removeClass('d-none');
        });


}


//Course Edit modal save button

$('#CourseUpdateConfirmBtn').click(function() {
    var courseID = $('#courseEditID').html();
    var courseName = $('#CourseNameUpdateId').val();
    var courseDesc = $('#CourseDescUpdateId').val();
    var courseFee = $('#CourseFeeUpdateId').val();
    var courseEnroll = $('#CourseEnrollUpdateId').val();
    var courseClass = $('#CourseClassUpdateId').val();
    var courseLink = $('#CourseLinkUpdateId').val();
    var courseImg = $('#CourseImgUpdateId').val();
    CourseUpdate(courseID,courseName,courseDesc,courseFee,courseEnroll,courseClass,courseLink,courseImg);
})

//Course Update Method

function CourseUpdate(courseID,courseName,courseDesc,courseFee,courseEnroll,courseClass,courseLink,courseImg){


    if(courseName == 0)
    {
        toastr.error('Course Name Required.');
    }
    else if(courseDesc == 0)
    {
        toastr.error('Course Desc Required.');
    }
    else if(courseFee == 0)
    {
        toastr.error('Course Fee Required.');
    }
    else if(courseEnroll == 0)
    {
        toastr.error('Course Enroll Required.');
    }
    else if(courseClass == 0)
    {
        toastr.error('Course Class Required.');
    }
    else if(courseLink == 0)
    {
        toastr.error('Course Link Required.');
    }
    else if(courseImg == 0)
    {
        toastr.error('Course Image Required.');
    }
    else
    {
        $('#CourseUpdateConfirmBtn').html("<div class='spinner-border text-white role='status>\n" +
            "</div>")
        axios.post('/courseUpdate',{
            id:courseID,
            name: courseName,
            desc: courseDesc,
            fee : courseFee,
            enroll : courseEnroll,
            class : courseClass,
            link : courseLink,
            img: courseImg
        }).then(function (response){
            $('#CourseUpdateConfirmBtn').html('Save');
            if(response.status == 200)
            {
                if (response.data == 1)
                {
                    $('#updateCourseModal').modal('hide');
                    toastr.success('Save Success.');
                    getCoursesData();

                }
                else
                {
                    $('#updateCourseModal').modal('hide');
                    toastr.error('Nothing to Save.');
                    getCoursesData();

                }
            }
            else
            {
                $('#updateCourseModal').modal('hide');
                toastr.error('Something Went Wrong.');
            }



        }).catch(function (){
            $('#updateCourseModal').modal('hide');
            toastr.error('Something Went Wrong.');
        })
    }

}

//      Projects Section


function getProjectData() {
    axios.get('/getProjectData')
        .then(function(response) {
            if (response.status == 200) {
                $('#mainDivProject').removeClass('d-none');
                $('#loaderDivProject').addClass('d-none');
                $('#ProjectDataTable').DataTable().destroy();
                $('#Project_table').empty();

                var jsonData = response.data;
                $.each(jsonData, function(i, item) {
                    $('<tr>').html(
                        "<td>"+jsonData[i].project_name+"</td>" +
                        "<td>"+jsonData[i].project_desc+"</td>" +
                        "<td><a class='ProjectEditBtn' data-id="+jsonData[i].id+"><i class='fas fa-edit'></i></a></td>" +
                        "<td><a class='ProjectDeleteBtn' data-id="+jsonData[i].id+"><i class='fas fa-trash-alt'></i></a></td>"
                    ).appendTo('#Project_table');
                });


                // Delete Project

                $('.ProjectDeleteBtn').click(function (){
                    var id = $(this).data('id');
                    $('#projectDeleteId').html(id);
                    $('#deleteProjectModal').modal('show');
                })

                $('#noClick8').click(function (){
                    $('#deleteProjectModal').modal('hide');
                })


                // Edit Project

                $('.ProjectEditBtn').click(function (){
                    var id = $(this).data('id');
                    $('#projectEditID').html(id);
                    getProjectDetails(id);
                    $('#projectEditModal').modal('show');

                })
                $('#noClick9').click(function (){
                    $('#projectEditModal').modal('hide');
                })


                $('#ProjectDataTable').DataTable({"order":false});
                $('.dataTables_length').addClass('bs-select');

            } else {
                $('#loaderDivProject').addClass('d-none');
                $('#WrongDivProject').removeClass('d-none');
            }
        })
        .catch(function(error) {
            $('#loaderDivProject').addClass('d-none');
            $('#WrongDivProject').removeClass('d-none');
        });
}

// Project Delete Modal Yes Btn
$('#projectDeleteConfirmBtn').click(function() {
    var id = $('#projectDeleteId').html();
    getProjectDelete(id);
})

//Project  Delete ajax call

function getProjectDelete(DeleteId) {

    $('#projectDeleteConfirmBtn').html("<div class='spinner-border text-white role='status>\n" +
        "</div>")

    axios.post('/getProjectDelete', {
        id: DeleteId
    })
        .then(function(response) {

            $('#projectDeleteConfirmBtn').html("Yes");

            if(response.status == 200)
            {
                if (response.data == 1) {
                    $('#deleteProjectModal').modal('hide');
                    toastr.success('Delete Success.');
                   getProjectData();
                } else {
                    $('#deleteProjectModal').modal('hide');
                    toastr.error('Delete Failed.');
                    getProjectData();
                }
            }
            else
            {
                $('#deleteProjectModal').modal('hide');
                toastr.error('Something  Went Wrong Motherfucker!')
            }


        })
        .catch(function() {
            $('#deleteProjectModal').modal('hide');
            toastr.error('Something  Went Wrong Motherfucker!')
        });
}

// Get Each Project Details

function getProjectDetails(detailsID) {
    axios.post('/getProjectDetails', {
        id: detailsID
    })
        .then(function(response) {
            if(response.status==200)
            {

                $('#projectEditLoader').addClass('d-none');
                $('#projectEditForm').removeClass('d-none');
                var jsonData = response.data;
                $('#projectNameID').val(jsonData[0].project_name);
                $('#projectDescID').val(jsonData[0].project_desc);
                $('#projectLinkID').val(jsonData[0].project_link);
                $('#projectImgID').val(jsonData[0].project_img);
            }

            else
            {
                $('#projectEditLoader').addClass('d-none');
                $('#projectWentWrong').removeClass('d-none');
            }

        })
        .catch(function() {
            $('#projectEditLoader').addClass('d-none');
            $('#projectWentWrong').removeClass('d-none');
        });
}


// Project Update Section


$('#projectEditConfirmBtn').click(function() {
    var id = $('#projectEditID').html();
    var name = $('#projectNameID').val();
    var desc = $('#projectDescID').val();
    var link = $('#projectLinkID').val();
    var img = $('#projectImgID').val();
    getUpdateDetails(id,name,desc,link,img);
})

//Service Update Method

function getUpdateDetails(projectID,projectName,projectDesc,projectLink,projectImg){


    if(projectName == 0)
    {
        toastr.error('Project Name Required.');
    }
    else if(projectDesc == 0)
    {
        toastr.error('Project Description Required.');
    }
    else if(projectLink == 0)
    {
        toastr.error('Project Link Required.');
    }
    else if(projectImg == 0)
    {
        toastr.error('Project Image Required.');
    }
    else
    {
        $('#projectEditConfirmBtn').html("<div class='spinner-border text-white role='status>\n" +
            "</div>")
        axios.post('/getUpdateDetails',{
            id:projectID,
            name: projectName,
            desc: projectDesc,
            link: projectLink,
            img: projectImg
        }).then(function (response){
            $('#projectEditConfirmBtn').html('Save');
            if(response.status == 200)
            {
                if (response.data == 1)
                {
                    $('#projectEditModal').modal('hide');
                    toastr.success('Save Success.');
                    getProjectData();

                }
                else
                {
                    $('#projectEditModal').modal('hide');
                    toastr.error('Nothing to Save.');
                    getProjectData();

                }
            }
            else
            {
                $('#projectEditModal').modal('hide');
                toastr.error('Something Went Wrong.');
            }



        }).catch(function (){
            $('#projectEditModal').modal('hide');
            toastr.error('Something Went Wrong.');
        })
    }
}


// Add  Project Section

// Add New Button Click



$('#addNewProjectBtnId').click(function(){
    $('#addProjectModal').modal('show');
});


$('#ProjectAddConfirmBtn').click(function(){
    var Name=$('#ProjectNameId').val();
    var Des=$('#ProjectDesId').val();
    var Link=$('#ProjectLinkId').val();
    var Img=$('#ProjectImgId').val();
    ProjectAdd(Name,Des,Link,Img);
})



function ProjectAdd(ProjectName,ProjectDes,ProjectLink,ProjectImg) {

    if(ProjectName.length==0)
    {
        toastr.error('Project Name is Empty !');
    }
    else if(ProjectDes.length==0)
    {
        toastr.error('Project Description is Empty !');
    }
    else if(ProjectLink.length==0){
        toastr.error('Project Link is Empty !');
    }
    else if(ProjectImg.length==0)
    {
        toastr.error('Project Image is Empty !');
    }
    else{
        $('#ProjectAddConfirmBtn').html("<div class='spinner-border spinner-border-sm' role='status'></div>") //Animation....
        axios.post('/ProjectAdd', {

            project_name: ProjectName,
            project_desc: ProjectDes,
            project_link: ProjectLink,
            project_img: ProjectImg,

        })
            .then(function(response) {
                $('#ProjectAddConfirmBtn').html("Save");
                if(response.status==200){
                    if (response.data == 1) {
                        $('#addProjectModal').modal('hide');
                        toastr.success('Add Success');
                        getProjectData();
                    } else {
                        $('#addProjectModal').modal('hide');
                        toastr.error('Add Fail');
                        getProjectData();
                    }
                }
                else {
                    $('#addProjectModal').modal('hide');
                    toastr.error('Something Went Wrong !');
                }
            })
            .catch(function(error) {
                $('#addProjectModal').modal('hide');
                toastr.error('Something Went Wrong !');
            });
    }
}



//  Review Section

function getReviewData() {


    axios.get('/reviewData')
        .then(function(response) {

            if (response.status == 200) {
                $('#mainDivReview').removeClass('d-none');
                $('#loaderDivReview').addClass('d-none');
                $('#Review_table').empty();
                var JSONData = response.data;



                $.each(JSONData, function(i, item) {
                    $('<tr>').html(
                        "<td> " + JSONData[i].name + "</td> " +
                        "<td> " + JSONData[i].desc + "  </td>" +
                        "<td> <a class='reviewEditBtn' data-id=" + JSONData[i].id + " ><i class='fas fa-edit'> </td>" +
                        "<td> <a class='reviewDeleteBtn'  data-id=" + JSONData[i].id + " ><i class='fas fa-trash-alt'></td>"


                    ).appendTo('#Review_table');
                });

                // Service Table Delete Icon
                $('.reviewDeleteBtn').click(function() {
                    var id = $(this).data('id');
                    $('#ReviewDeleteId').html(id);
                    $('#deleteReviewModal').modal('show');
                })





                //Service Edit Button
                $('.reviewEditBtn').click(function (){
                    var id = $(this).data('id');
                    $('#ReviewEditID').html(id);
                    ReviewUpdateDetails(id);
                    $('#ReviewEditModal').modal('show');
                })

                $('#noClick20').click(function (){
                    $('#ReviewEditModal').modal('hide');
                })


            } else {
                $('#loaderDiv').addClass('d-none');
                $('#wrongDiv').removeClass('d-none');

            }

        }).catch(function(error) {
        $('#loaderDiv').addClass('d-none');
        $('#wrongDiv').removeClass('d-none');
    });

}


// Review Delete

$('#ReviewDeleteConfirmBtn').click(function() {
    var id = $('#ReviewDeleteId').html();
    getReviewDelete(id);
})



function getReviewDelete(deleteID) {

    $('#ReviewDeleteConfirmBtn').html("<div class='spinner-border text-white role='status>\n" +
        "</div>")

    axios.post('/reviewDelete', {
        id: deleteID
    })
        .then(function(response) {

            $('#ReviewDeleteConfirmBtn').html("Yes");

            if(response.status == 200)
            {
                if (response.data == 1) {
                    $('#deleteReviewModal').modal('hide');
                    toastr.success('Delete Success.');
                    getReviewData();
                } else {
                    $('#deleteReviewModal').modal('hide');
                    toastr.error('Delete Failed.');
                    getReviewData();
                }
            }


            else
            {
                $('#deleteReviewModal').modal('hide');
                toastr.error('Something  Went Wrong Mothefucker!')
            }


        })
        .catch(function() {
            $('#deleteReviewModal').modal('hide');
            toastr.error('Something  Went Wrong Motherfucker!')
        });
}


//  Add Review Method

$('#addNewReviewBtn').click(function (){
    $('#addReviewModal').modal('show');
});

$('#ReviewAddConfirmBtn').click(function (){
    var name = $('#ReviewNameId').val();
    var desc = $('#ReviewDescId').val();
    var img = $('#ReviewImgId').val();

    ReviewAdd(name,desc,img);
})


function ReviewAdd(name,desc,img){


    if(name.length == 0)
    {
        toastr.error('Reviewer Name is required!');
    }
    else if(desc.length == 0)
    {
        toastr.error('Description is empty!');
    }
    else if(img.length == 0)
    {
        toastr.error('Reviewer Image required !');
    }

    else
    {

        $('#ReviewAddConfirmBtn').html("<div class='spinner-border text-white role='status>\n" +
            "</div>")
        axios.post('/reviewAdd',{

            name : name,
            desc : desc,
            img : img

        }).then(function (response){

            $('#ReviewAddConfirmBtn').html('Save');
            if(response.status == 200)
            {
                if(response.data == 1)
                {
                    $('#addReviewModal').modal('hide');
                    toastr.success('Insert Success');
                    getReviewData();
                }

                else
                {
                    $('#addReviewModal').modal('hide');
                    toastr.error('Insert Failed. Try again later !');
                    getReviewData();
                }
            }
            else
            {
                $('addReviewModal').modal('hide');
                toastr.error('Insert Failed. Try again later!');
            }

        }).catch(function (error){
            $('addReviewModal').modal('hide');
            toastr.error('Insert Failed. Try again later!');
        });
    }

}

function ReviewUpdateDetails(detailsID){
    axios.post('/reviewDetails',{
        id: detailsID

    }).then(function (response){

            if(response.status==200)
            {

                $('#ReviewEditLoader').addClass('d-none');
                $('#ReviewEditForm').removeClass('d-none');
                var jsonData = response.data;
                $('#ReviewEditNameID').val(jsonData[0].name);
                $('#ReviewEditDescID').val(jsonData[0].desc);
                $('#ReviewEditImgID').val(jsonData[0].img);
            }

            else
            {
                $('#ReviewEditLoader').addClass('d-none');
                $('#ReviewWentWrong').removeClass('d-none');
            }

        }).catch(function() {
            $('#ReviewEditLoader').addClass('d-none');
            $('#ReviewWentWrong').removeClass('d-none');
        });
}




$('#ReviewEditConfirmBtn').click(function (){

    var id = $('#ReviewEditID').html();
    var name = $('#ReviewEditNameID').val();
    var desc = $('#ReviewEditDescID').val();
    var img = $('#ReviewEditImgID').val();

    ReviewUpdate(id,name,desc,img);
});


function ReviewUpdate(ReviewID,ReviewName,ReviewDesc,ReviewImg){

    if(ReviewName.length == 0)
    {
        toastr.error('Reviewer Name Required !');
    }
    else if(ReviewDesc.length == 0)
    {
        toastr.error('Review Description Required !');
    }
    else if(ReviewImg.length == 0)
    {
        toastr.error('Reviewer Image Required !')
    }

    else
    {
        $('#ReviewEditConfirmBtn').html("<div class='spinner-border text-white role='status>\n" +
            "</div>")
        axios.post('/reviewUpdate',{

            id : ReviewID,
            name : ReviewName,
            desc : ReviewDesc,
            img : ReviewImg

        }).then(function (response){

            $('#ReviewEditConfirmBtn').html("Save");
            if(response.status == 200)

            {
                if(response.data = 1)
                {
                    $('#ReviewEditModal').modal('hide');
                    toastr.success('Save Success.');
                    getReviewData();
                }
                else
                {
                    $('#ReviewEditModal').modal('hide');
                    toastr.error('Save Failed ! Try Again');
                    getReviewData();
                }
            }
            else
            {

                $('#ReviewEditModal').modal('hide');
                toastr.error('Save Failed ! Try Again');


            }

        }).catch(function (){
            $('#ReviewEditModal').modal('hide');
            toastr.error('Save Failed ! Try Again');

        });
    }

}
