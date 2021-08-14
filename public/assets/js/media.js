$.ajaxSetup({
    headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
  }
});

function loadimage(){
    $(document).ready(function(){
        $.ajax({
            url:"media/loadmedia",
            method:'post',
            success: function(data){
                $("#listimg").remove();
                $("#contentimg").append( data );
            },
            error: function(error){
                alert('Lỗi khi lấy dữ liệu!');
            }
        });
    });
}

function loadicon(){
  $(document).ready(function(){
      $.ajax({
          url:"media/loadicon",
          method:'post',
          success: function(data){
              $("#listicon").remove();
              $( "#contenticon" ).append( data );
          },
          error: function(error){
              alert('Lỗi khi lấy dữ liệu!');
          }
      });
  });
}

function saveicon(){
  var icon = $('#texticon').val();
  if(icon != '') {
    $(document).ready(function(){
      $.ajax({
        url:"media/saveicon",
        method:'post',
        data: {
          icon:icon,
          },
        success: function(data){
          $('#texticon').val('');
          if (data == 1) {
            toastr.success('Tải icon mới thành công!');
          } else {
            toastr.error('Icon đã tồn tại vui lòng kiểm tra lại!');
          }
        },
      });
    });
  }else {
    alert('Vui lòng nhập icon!');
  }
}

function filterimage(){
    var imgfilter = document.getElementById('imgfilter').value;
    var imgdate = document.getElementById('imgdate').value;
    var q = document.getElementById('q').value;
    $(document).ready(function(){
      $.ajax({
          url:"media/filtermedia",
          method:'post',
          data: {
            imgdate:imgdate,
            imgfilter:imgfilter,
            q:q,
          },
          success: function(data){
            $("#medialist").remove();
            $( "#medialeftcolumn" ).append( data );
            document.getElementById('numberselect').style.display = 'none';
            document.getElementById('numberimg').innerHTML = 0;
            document.getElementById('divimgselect').innerHTML = '';
            document.getElementById('check').value = '';
            $("#insertmedia").attr("disabled", true);
          },
      });
    });
}

function selectimage(id){
    var number = Number(document.getElementById('numberimg').innerHTML);
    if ($('#img'+id).hasClass('selectimg')){
      $('#img'+id).removeClass('selectimg');
      number = number - 1;

      if(number == 0){
        document.getElementById('numberselect').style.display = 'none';
        document.getElementById('check').value = '';
        $("#insertmedia").attr("disabled", true);
      }else{
        var checkimg = document.getElementById('check').value;
        var items = checkimg.split(',');
        var newarr = '';
        for(var i = 0;i < items.length;i++){
          if(items[i] != id && newarr == ''){
            newarr = items[i];
          }else if(items[i] != id && newarr != ''){
            newarr = newarr+','+items[i];
          }
        }
        document.getElementById('check').value = newarr;
      }
    } else {
      if(document.getElementById('check').value == ''){
        document.getElementById('check').value = id;
      }else{
        document.getElementById('check').value = document.getElementById('check').value+','+id;
      }
      $( "#img"+id ).addClass( "selectimg" );
      number = number + 1;
      document.getElementById('numberselect').style.display = 'block';
      $("#insertmedia").attr("disabled", false);
    }
    document.getElementById('numberimg').innerHTML = number;
}

function selecticon(id){
  var check = $('#checkicon').val();
  $('#listicon'+check).removeClass('selecticon');
  if ($('#listicon'+id).hasClass('selecticon')){
    $('#listicon'+id).removeClass('selecticon');
  } else {
    $("#listicon"+id).addClass( "selecticon" );
    $('#checkicon').val(id);
  }

  var checka = $('#checkicon').val();
  if(checka == ''){
    $("#inserticon").attr("disabled", true);
  }else{
    $("#inserticon").attr("disabled", false);
  }
}

function inserticon() { 
  var check = $('#checkicon').val();
  if(check == ''){
    $("#iconpro").html('<i class="fa fa-plus" aria-hidden="true"></i>');
  }else{
    var icon = $('#listicon'+check).html();
    $("#iconpro").html(icon);
  }
  $('#modalicon').modal('hide');
}

function insertmedia(){
  $("#insertmedia").attr("disabled", true);
  var listimg = document.getElementById('check').value;
  var imgs = listimg.split(',');
  for(var i = 0;i < imgs.length;i++){
      var url = $( "#img"+imgs[i] ).prop('src');
      CKEDITOR.instances.content.insertHtml( '<img src="'+url+'" style="width: 150px;height: 150px" alt="">' );    
  }
  $('#modalimg').modal('hide');
}

function unchecked(){
  var checkimg = document.getElementById('check').value;
  var items = checkimg.split(',');

  document.getElementById('check').value = '';
  document.getElementById('numberimg').innerHTML = 0;
  document.getElementById('numberselect').style.display = 'none';
  $("#insertmedia").attr("disabled", true);

  for(var i = 0;i < items.length;i++){
    if($('#img'+items[i]).hasClass('selectimg')){
      $('#img'+items[i]).removeClass('selectimg');
    }
  }
}

function deleteall(){
  var checkimg = document.getElementById('check').value;
  var items = checkimg.split(',');

  if (confirm("Bạn có chắc chắn muốn xóa không!!!!")) {
    document.getElementById('check').value = '';
    document.getElementById('numberimg').innerHTML = 0;
    document.getElementById('numberselect').style.display = 'none';
    $("#insertmedia").attr("disabled", true);

    for(var i = 0;i < items.length; i++){
      removeelement(items[i]);
    }
  }
  return false;
}

function resetbutton(){
  unchecked()
  document.getElementById('divinsertmedia').innerHTML = '';
  $('#divinsertmedia').append('<button disabled onclick="return insertmedia()" type="button" id="insertmedia" class="btn btn-primary">Chèn ảnh</button>');
  $('#modalimg').modal('show');
}

function changebutton(){
  unchecked()
  document.getElementById('divinsertmedia').innerHTML = '';
  var val = "'featured_image'";
  var variable = '<button onclick="return insertpostmedia('+val+')" type="button" id="insertpostmedia" class="btn btn-primary">Chèn ảnh</button>';
  $('#divinsertmedia').append(variable);
  $('#modalimg').modal('show');
}

function changebuttoncover(){
  unchecked()
  document.getElementById('divinsertmedia').innerHTML = '';
  var val = "'cover_image'";
  var variable = '<button onclick="return insertpostmedia('+val+')" type="button" id="insertpostmedia" class="btn btn-primary">Chèn ảnh</button>';
  $('#divinsertmedia').append(variable);
  $('#modalimg').modal('show');
}

function insertpostmedia(add) {
  $("#insertpostmedia").attr("disabled", true);
  var listimg = document.getElementById('check').value;
  var imgs = listimg.split(',');
  var len = Number(imgs.length) - 1;
  var url = $( "#img"+imgs[len] ).prop('src');
  document.getElementById(add).value = url;
  document.getElementById('imgpreview').style.display = 'block';
  document.getElementById('buttonupload').style.display = 'none';
  document.getElementById('imgpreview').src = url;
  if($('#imgpreviewmobile').length > 0) {
    document.getElementById('imgpreviewmobile').src = url;
    document.getElementById('buttonuploadmobile').style.display = 'none';
    document.getElementById('imgpreviewmobile').style.display = 'block';
  }
  $('#modalimg').modal('hide');
}

function changebuttoninsert() {  
  unchecked()
  document.getElementById('divinsertmedia').innerHTML = '';
  var variable = '<button onclick="return addmediaplace()" type="button" id="insertpostmedia" class="btn btn-primary">Thêm ảnh</button>';
  $('#divinsertmedia').append(variable);
  $('#modalimg').modal('show');
}

function addmediaplace() {
  var listimg = document.getElementById('check').value;
  var imgs = listimg.split(',');
  var checkimg = document.getElementById('media_place').value;
  for(var i = 0;i < imgs.length;i++){
      var arr = imgs[i].split('/');
      var len = Number(arr.length) - 1;
      var arr = arr[len].split('_');
      if (checkimg == '') {
          checkimg = arr[0];
          var url = $( "#img"+imgs[i] ).prop('src');
          $('#listimgplace').prepend('<div style="position: relative" id="img-'+imgs[i]+'" class="col-md-2 itemimgaa">'
                        +'<img class="imgpre" src="'+url+'" alt="">'
                        +'<span onclick="return deletemediaplace('+imgs[i]+')" style="position: absolute;right: 20px;top: 5px;cursor: pointer;"><i style="color: red;" class="fa fa-times deleteimg" aria-hidden="true"></i></span>'
                        +'</div>');
      } else {
          var arrid = checkimg.split(',');
          var n = arrid.includes(arr[0]);
          if (!n) {
              checkimg = checkimg + ',' + arr[0];
              var url = $( "#img"+imgs[i] ).prop('src');
              $('#listimgplace').prepend('<div style="position: relative" id="img-'+imgs[i]+'" class="col-md-2 itemimgaa">'
                              +'<img class="imgpre" src="'+url+'" alt="">'
                              +'<span onclick="return deletemediaplace('+imgs[i]+')" style="position: absolute;right: 20px;top: 5px;cursor: pointer;"><i style="color: red;" class="fa fa-times deleteimg" aria-hidden="true"></i></span>'
                              +'</div>');
          }
      }      
  }
  document.getElementById('media_place').value = checkimg;
  $('#modalimg').modal('hide');
}

function deletemediaplace(id) {
  $('#img-'+id).remove();
  var checkimg = document.getElementById('media_place').value;
  var items = checkimg.split(',');
  var newarr = '';
  for(var i = 0;i < items.length;i++){
    if(items[i] != id && newarr == ''){
      newarr = items[i];
    }else if(items[i] != id && newarr != ''){
      newarr = newarr+','+items[i];
    }
  }
  document.getElementById('media_place').value = newarr;
}

function uploadmediaadmin(){
  alert=function(){};
  var data = new FormData();
  var numberfile = 0;
  jQuery.each(jQuery('#mediaupload')[0].files, function(i, file) {
      numberfile++;
  });
  if(numberfile > 0){
    $('#global-loader').removeAttr( 'style' );
    jQuery.each(jQuery('#mediaupload')[0].files, function(i, file) {
      data.append('file-'+i, file);
    });
    data.append('numberfile', numberfile);
    $(document).ready(function(){
      $.ajax({
          url:"admin/media/uploadmedia",
          method:'post',
          data: data,
          cache: false,
          contentType: false,
          processData: false, 
          success: function(data){
              if(data['check'] == 'true'){
                toastr.success("Upload ảnh thành công!");
                appendviewmedia(data['view1'], data['checkview'], data['view2']);
              }else{
                toastr.warning(data['error']);
              }
              loadimage();
              $('#global-loader').css('display', 'none');
          },
      });
    });
  }
}

function appendviewmedia(view1, element, view2){
  $("#listmedia").prepend(view1);
  $("#list"+element).prepend(view2);
}

function opennotifi(idelement){
  if (confirm("Bạn có chắc chắn muốn xóa không!!!!")) {
    removeelement(idelement);
  }
  return false;
}

function removeelement(idelement){
  $('#global-loader').removeAttr( 'style' );
  $(document).ready(function(){
    $.ajax({
        url:"admin/media/delete",
        method:'post',
        data: {
          idelement:idelement,
        },
        success: function(data){
          if(data['iddelete'] == 0){
            toastr.warning(data['notif']);
          } else {
            $("#listmedia"+data['iddelete']).remove();
            $("#list"+data['type']+data['iddelete']).remove();
            toastr.success('Xóa ảnh thành công');
            unchecked();
          }
          $('#global-loader').css('display', 'none'); 
        },
    });
  });
}

function chanegeimgprofile(){
  alert=function(){};
  if ($('#img_profile').get(0).files.length != 0) {
    var output = document.getElementById('img_profile');
    output.src = URL.createObjectURL(event.target.files[0]);
    $('#imgpreview').attr("src", output.src);
  }
}

function openicon(){ 
  $('#modalicon').modal('show');
}