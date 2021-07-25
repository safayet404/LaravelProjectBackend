@extends('Layout.app')
@section('title','Gallery')
@section('content')




    <div class="container-fluid m-0 ">
        <div class="row">
            <div class="col-md-12">
                <button data-toggle="modal" data-target="#PhotoModal" id="addNewPhotoBtnId" class="btn my-3 btn-sm btn-danger">Add New </button>
            </div>
        </div>

    </div>



    <div class="container-fluid">
        <div id="PhotoRow" class="row">

        </div>

        <button class="btn btn-primary mt-4" id="LoadMoreBtn">Load More</button>
    </div>




    <!-- Modal -->
    <div class="modal fade" id="PhotoModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
         aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Add New Photo</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">

                    <input class="form-control" id="imgInput" type="file">
                    <img class="imgPreview w-100 mt-3" id="imgPreview" src="{{asset('images/default-image.jpg')}}">


                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-sm btn-danger" data-dismiss="modal">Close</button>
                    <button id="SavePhoto" type="button" class="btn btn-sm btn-success">Save</button>
                </div>
            </div>
        </div>
    </div>


@endsection


@section('script')
    <script type="text/javascript">

        LoadPhoto();

        $('#imgInput').change(function (){
            var reader = new FileReader();
            reader.readAsDataURL(this.files[0]);
            reader.onload = function (event){
                var ImgSource = event.target.result;
                $('#imgPreview').attr('src',ImgSource)
            }
        })


        $('#SavePhoto').click(function (){

            $('#SavePhoto').html("<div class='spinner-border text-white role='status>\n" +
                "</div>")

            var PhotoFile = $('#imgInput').prop('files')[0];
            var formData = new FormData();
            formData.append('photo',PhotoFile);

            axios.post('/photoUpload',formData).then(function (response){

                if(response.status == 200 && response.data == 1)
                {
                    $('#SavePhoto').html('Save');
                    $('#PhotoModal').modal('hide');
                    toastr.success('Photo Upload Success');
                }
                else
                {
                    $('#SavePhoto').html('Save');
                    $('#PhotoModal').modal('hide');
                    toastr.error('Photo Upload Failed');
                }


            }).catch(function (error){
                $('#SavePhoto').html('Save');
                $('#PhotoModal').modal('hide');
                toastr.error('Photo Upload Failed');
            });


        })




        function LoadPhoto(){

            axios.get('/photoJson').then(function (response) {
                $.each(response.data, function (i, item) {
                    $("<div class='col-md-3 p-1'>").html(
                        "<img data-id="+item['id']+" class='imgOnRow' src=" + item['location'] + ">"+
                        "<button data-id="+ item['id']+" data-photo="+ item['location']+" class='btn deletePhoto btn-sm'> Delete</button>"
                    ).appendTo('#PhotoRow');
                });

                $('.deletePhoto').on('click',function (event) {
                    let id=$(this).data('id');
                    let photo=$(this).data('photo');
                    PhotoDelete(photo,id);
                    event.preventDefault();
                })


                }).catch(function (error) {

                })

            }


            var ImgID = 0;
            function LoadByID(FirstImageID,loadMoreBtn){

           ImgID  =ImgID + 3;
           let PhotoID = ImgID+FirstImageID;
            let URL = "/photoJsonByID/"+PhotoID;
               loadMoreBtn.html("<div class='spinner-border text-white role='status>\n" +
                    "</div>")
                axios.get(URL).then(function (response) {
                    loadMoreBtn.html('Load More');
                    $.each(response.data, function (i, item) {
                        $("<div class='col-md-3 p-1'>").html(
                            "<img data-id="+item['id']+" class='imgOnRow' src=" + item['location'] + ">" +
                            "<button data-id="+ item['id']+" data-photo="+ item['location']+" class='btn deletePhoto btn-sm'> Delete</button>"

                        ).appendTo('#PhotoRow');
                    });

                    $('.deletePhoto').on('click',function (event) {
                        let id=$(this).data('id');
                        let photo=$(this).data('photo');
                        PhotoDelete(photo,id);
                        event.preventDefault();
                    })
                }).catch(function (error) {

                })

            }


            $('#LoadMoreBtn').on('click',function (){
              let loadMoreBtn = $(this);
               let FirstImageID =  $(this).closest('div').find('img').data('id');
                LoadByID(FirstImageID,loadMoreBtn);
            })


        function PhotoDelete(OldPhotoURL,id) {
            let URL="/PhotoDelete";
            let MyFormData=new FormData();
            MyFormData.append('OldPhotoURL',OldPhotoURL);
            MyFormData.append('id',id);
            axios.post(URL,MyFormData).then(function (response) {
                if(response.status==200 && response.data==1){
                    toastr.success('Photo Delete Success');
                    //$('#PhotoRow').empty();
                    //LoadPhoto();
                    //ImgID = 0;

                    window.location.href="/photo";

                }
                else{
                    toastr.error('Delete Fail Try Again');
                }
            }).catch(function () {
                toastr.error('Delete Fail Try Again');
            })
        }

    </script>

@endsection
