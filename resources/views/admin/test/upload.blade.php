    <style>
        .btn.btnred.btnborderbrown {
            background-color: #dc4f4f;
            color: #fff;
            border: #dc4f4f solid 1px;
        }

        .btn.btnred.btnborderbrown:hover {
            background-color: #fff;
            color: #dc4f4f;
        }
    </style>
    <div class="modal fade" id="modalupload" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
        <div style="max-width: 475px;" class="modal-dialog modal-dialog-centered" role="document">
        <div style="padding: 0 0" class="modal-content">
            <div style="border: none;padding: 7px 10px 0 10px;" class="modal-header">
            {{--  <h5 class="modal-title" id="exampleModalLongTitle">File mới</h5>  --}}
            <button style="margin-top: -1rem;" type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
            </div>
            <div style="padding: 0rem 1rem;text-align: center" class="modal-body">
                <form enctype="multipart/form-data" action="admin/media/uploadmedia" method="POST">
                    <div class="notimg">
                        @csrf
                        <input type="hidden" name="numberfile" value="1">
                        <img src="assets/images/web/photo_review.svg" alt=""><br>
                        <label style="margin: 10px 0;" for="mediaupload">
                            <span class="btn btnred btnborderbrown">Tải file lên</span>
                        </label>

                        <input onchange="return uploadmediaadmin()" multiple style="display: none" type="file" name="mediaupload" id="mediaupload">
                        {{--  <button>aa</button>  --}}
                    </div>
                </form>
            </div>
        </div>
        </div>
    </div>