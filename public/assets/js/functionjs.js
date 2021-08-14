function convertslug(value){
  var Text = value;
  //Đổi chữ hoa thành chữ thường
  slug = Text.toLowerCase();

  //Đổi ký tự có dấu thành không dấu
  slug = slug.replace(/á|à|ả|ạ|ã|ă|ắ|ằ|ẳ|ẵ|ặ|â|ấ|ầ|ẩ|ẫ|ậ/gi, 'a');
  slug = slug.replace(/é|è|ẻ|ẽ|ẹ|ê|ế|ề|ể|ễ|ệ/gi, 'e');
  slug = slug.replace(/i|í|ì|ỉ|ĩ|ị/gi, 'i');
  slug = slug.replace(/ó|ò|ỏ|õ|ọ|ô|ố|ồ|ổ|ỗ|ộ|ơ|ớ|ờ|ở|ỡ|ợ/gi, 'o');
  slug = slug.replace(/ú|ù|ủ|ũ|ụ|ư|ứ|ừ|ử|ữ|ự/gi, 'u');
  slug = slug.replace(/ý|ỳ|ỷ|ỹ|ỵ/gi, 'y');
  slug = slug.replace(/đ/gi, 'd');
  //Xóa các ký tự đặt biệt
  slug = slug.replace(/\`|\~|\!|\@|\#|\||\$|\%|\^|\&|\*|\(|\)|\+|\=|\,|\.|\/|\?|\>|\<|\'|\"|\:|\;|_/gi, '');
  //Đổi khoảng trắng thành ký tự gạch ngang
  slug = slug.replace(/ /gi, "-");
  //Đổi nhiều ký tự gạch ngang liên tiếp thành 1 ký tự gạch ngang
  //Phòng trường hợp người nhập vào quá nhiều ký tự trắng
  slug = slug.replace(/\-\-\-\-\-/gi, '-');
  slug = slug.replace(/\-\-\-\-/gi, '-');
  slug = slug.replace(/\-\-\-/gi, '-');
  slug = slug.replace(/\-\-/gi, '-');
  //Xóa các ký tự gạch ngang ở đầu và cuối
  slug = '@' + slug + '@';
  slug = slug.replace(/\@\-|\-\@|\@/gi, '');

  return slug;
}

function convert(e){
    slug = convertslug(e.value);
    $("#slug").val(slug); 
}

function resetbutton(){
    document.getElementById('divinsertmedia').innerHTML = '';
    $('#divinsertmedia').append('<button disabled onclick="return insertmedia()" type="button" id="insertmedia" class="btn btn-primary">Chèn ảnh</button>');
    loadimage();
}

function insertmedia(){
    $("#insertmedia").attr("disabled", true);
    var listimg = document.getElementById('check').value;
    var imgs = listimg.split(',');
    for(var i = 0;i < imgs.length;i++){
        CKEDITOR.instances.content.insertHtml( '<img src="'+imgs[i]+'" style="width: 150px;height: 150px" alt="">' );    
    }
    $('#mymodal').modal('hide');
}

function changebuttonfeaturedimage(){
    document.getElementById('divinsertmedia').innerHTML = '';
    var val = "'featured_image'";
    var variable = '<button onclick="return insertpostmedia('+val+')" type="button" id="insertpostmedia" class="btn btn-primary">Đặt ảnh đại diện</button>';
    $('#divinsertmedia').append(variable);
}

function insertpostmedia(add) {
    $("#insertpostmedia").attr("disabled", true);
    var listimg = document.getElementById('check').value;
    var imgs = listimg.split(',');
    var len = Number(imgs.length) - 1;
    document.getElementById(add).value = imgs[len];
    document.getElementById('formpreview').style.display = 'block';
    document.getElementById('imgaepriview').src = imgs[len];
    $('#mymodal').modal('hide');
}

function changebuttoncoverimage(){
    document.getElementById('divinsertmedia').innerHTML = '';
    var val = "'cover_image'";
    var variable = '<button onclick="return insertpostmedia('+val+')" type="button" id="insertpostmedia" class="btn btn-primary">Đặt ảnh bìa quán</button>';
    $('#divinsertmedia').append(variable);
}

function changebuttonaddimage(){
    document.getElementById('divinsertmedia').innerHTML = '';
    var variable = '<button onclick="return addmediaplace()" type="button" id="addmediaplace" class="btn btn-primary">Thêm ảnh quán</button>';
    $('#divinsertmedia').append(variable);
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
            var img = '<div style="height: 100px;overflow: hidden;" class="col-md-1"><img style="height: 100%;width: 100%;object-fit: cover;" id="imgplace" src="'+imgs[i]+'" alt=""></div>';
            $('#listimgplace').prepend(img);  
        } else {
            var arrid = checkimg.split(',');
            var n = arrid.includes(arr[0]);
            if (!n) {
                checkimg = checkimg + ',' + arr[0];
                var img = '<div style="height: 100px;overflow: hidden;" class="col-md-1"><img style="height: 100%;width: 100%;object-fit: cover;" id="imgplace" src="'+imgs[i]+'" alt=""></div>';
                $('#listimgplace').prepend(img);  
            }
        }      
    }
    document.getElementById('media_place').value = checkimg;
    $('#mymodal').modal('hide');
}

function addcategorypost(){
    var catename = $('#category_name').val();
    var parent_id = $('#parent_id').val();
    var post_id = $('#post_id').val();

    if(post_id == undefined){
        post_id = 0;
    }
    $(document).ready(function(){
        $.ajax({
            url:"admin/ajax/addfastcategorypost",
            method:'post',
            data: {
                catename:catename,
                parent_id:parent_id,
                post_id:post_id,
            },
            success: function(data){
              $('#contentcategory').remove();
              $('#addcategory').append(data);
            },
        });
    });
}

    
function addcategoryplace(){
  var catename = $('#category_name').val();
  var parent_id = $('#parent_id').val();
  var post_id = $('#post_id').val();

  if(post_id == undefined){
      post_id = 0;
  }
  $(document).ready(function(){
      $.ajax({
          url:"admin/ajax/addfastcategoryplace",
          method:'post',
          data: {
              catename:catename,
              parent_id:parent_id,
              post_id:post_id,
          },
          success: function(data){
            $('#contentcategory').remove();
            $('#addcategory').append(data);
          },
      });
  });
}

function showadd(){
    var addshow = $('#addshow').css('display');
    var addshowmobile = $('#addshowmobile').css('display');
    if(addshow == 'block'){
        $('#addshow').css('display','none');
    }else{
        $('#addshow').css('display','block');
    }
}

function checkall(){
    $('.checkboxper').attr( "checked", true );

}

function uncheckall(){
    $('.checkboxper').removeAttr( "checked" );
}

  $("form").bind("keypress", function (e) {
    if (e.keyCode == 13) {
        return false;
    }
  });

  function randompass() {
    var text = "";
    var possible = "ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz0123456789";
  
    for (var i = 0; i < 9; i++)
      text += possible.charAt(Math.floor(Math.random() * possible.length));
    return text;
  }

  function randompassword(){
    var text = randompass();
    $('#password').val(text);
  }

  function selectgroup(e){
    var id = e.value;
      $(document).ready(function(){
      $.ajax({
          url:"admin/ajax/loadpermission",
          method:'post',
          data: {
            id:id,
          },
          success: function(data){
            $('#contentpermission').remove();
            $('#divpermission').append(data);
          },
      });
    });
  }

  function showpass() {
    var type = $('#password').attr('type');
    if(type == 'password'){
      $('#password').attr('type', 'text');
      $('#showpass').css('display','none');
      $('#hidepass').css('display','block');

    } else {
      $('#password').attr('type', 'password');
      $('#hidepass').css('display','none');
      $('#showpass').css('display','block');
    }
  }

  function showformtime(){
    if($('#formtime').css('display') == 'none'){ 
      $('#formtime').show('slow'); 
    } else { 
      $('#formtime').hide('slow'); 
    }
  }

  function addformtime(){
    var key = $('#time').val();
    var time = '';
    var timeopen = $('#timeopen').val();
    var timeclose = $('#timeclose').val();

    if(key == 0){
      alert('Vui lòng chọn ngày!');
    }else if(timeopen == ''){
      alert('Vui lòng chọn giờ mở cửa!');
    }else if(timeclose == ''){
      alert('Vui lòng chọn giờ đóng cửa!');
    }else {
      if(key == '2'){
        time = 'Thứ 2';
      }else if(key == '3'){
        time = 'Thứ 3';
      }else if(key == '4'){
        time = 'Thứ 4';
      }else if(key == '5'){
        time = 'Thứ 5';
      }else if(key == '6'){
        time = 'Thứ 6';
      }else if(key == '7'){
        time = 'Thứ 7';
      }else if(key == '8'){
        time = 'Chủ nhật';
      }
      deleteschedule(key);
      $('#listtime').append('<tr id="time'+key+'">'
        +'<td style="padding-right: 10px">'+time+'</td>'
        +'<td style="padding-right: 10px">'+timeopen+'</td>'
        +'<td>-</td>'
        +'<td style="padding-left: 10px">'+timeclose+'</td>'
        +'<td style="padding-left: 10px"><span onclick="return deleteschedule('+key+')" style="color:red;cursor: pointer;">Xóa</span></td>'
      +'</tr>');
      var check = $('#schedule').val();
      var oktime = key+'+'+timeopen+'+'+timeclose;
      if (check == '') {
        $('#schedule').val(oktime);
      } else {
        $('#schedule').val(check+','+oktime);
      }
      $('#formtime').hide('slow'); 
    }
  }

  function deleteschedule(key) {
    $('#time'+key).remove();
    var checkschedule = document.getElementById('schedule').value;
    var items = checkschedule.split(',');
    var newarr = '';
    for(var i = 0;i < items.length;i++){
      var checkkey = items[i].split('+');
      if(checkkey[0] != key && newarr == ''){
        newarr = items[i];
      }else if(checkkey[0] != key && newarr != ''){
        newarr = newarr+','+items[i];
      }
    }
    document.getElementById('schedule').value = newarr;
    $('#formtime').hide('slow'); 
  }

  function showformservice(){
    if($('#formservice').css('display') == 'none'){ 
      $('#formservice').show('slow'); 
    } else { 
      $('#formservice').hide('slow'); 
    }
  }

  function showforminfor() { 
    if($('#forminfor').css('display') == 'none'){ 
      $('#forminfor').show('slow'); 
    } else { 
      $('#forminfor').hide('slow'); 
    }
  }

  function addforminfor (){
    var nameinfor = $('#nameinfor').val();
    nameinfor = nameinfor.trim();
    var slug = convertslug(nameinfor);
    console.log(slug);
    var value = $('#value').val();
    value = value.trim();
    var numinfor = Number($('#numinfor').val()) + 1;
    $('#numinfor').val(numinfor);

    if(nameinfor == ''){
      alert('Vui lòng nhập tên thông tin!');
    }else if(value == ''){
      alert('Vui lòng nhập thông tin!');
    }else {
      $('#listinfor').append('<tr id="infor'+numinfor+'">'
        +'<td style="padding-right: 10px">'+nameinfor+'</td>'
        +'<td>:</td>'
        +'<td style="padding-left: 10px">'+value+'</td>'
        +'<td style="padding-left: 10px"><span onclick="return deleteinfor('+numinfor+')" style="color:red;cursor: pointer;">Xóa</span></td>'
        +'</tr>');
      var check = $('#infor').val();
      var okinfor = numinfor+'+'+slug+'+'+value;
      if (check == '') {
        $('#infor').val(okinfor);
      } else {
        $('#infor').val(check+','+okinfor);
      }
      $('#forminfor').hide('slow'); 
    }
  }

  function deleteinfor(key) {
    $('#infor'+key).remove();
    var checkinfor = $('#infor').val();
    var items = checkinfor.split(',');
    var newarr = '';
    for(var i = 0;i < items.length;i++){
      var checkkey = items[i].split('+');
      if(checkkey[0] != key && newarr == ''){
        newarr = items[i];
      }else if(checkkey[0] != key && newarr != ''){
        newarr = newarr+','+items[i];
      }
    }
    document.getElementById('infor').value = newarr;
    $('#forminfor').hide('slow'); 
  }