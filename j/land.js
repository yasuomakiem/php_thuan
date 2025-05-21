    $('body').ready(function(){
        $('#sublogin').click(function(){
            $('#alear').html('');
            var phone = $('#phone').val();
            var password = $('#password').val();
            if(phone==''){
                    $('#showphone').html('<p style="padding-left: 5%;font-size: 0.8em;color: #ffa300;font-style: italic;"><i class="fas fa-exclamation-triangle"></i> Hãy nhập số điện thoại</p>');
                    $('#phone').focus();
                    setTimeout(function(){$('#showphone').html('');},4000);
                    return false;
            }else if(password==''){
                    $('#showpass').html('<p style="padding-left: 5%;font-size: 0.8em;color: #ffa300;font-style: italic;"><i class="fas fa-exclamation-triangle"></i> Hãy nhập mật khẩu</p>');
                    $('#password').focus();
                    setTimeout(function(){$('#showpass').html('');},4000);
                    return false;
            }else{
                    $.ajax({
                            url : "./ajax.php", 
                            type : "post",
                            dateType:"text",
                            data : { 
                            typeform : 'loginscore',
                            phone : phone,
                            password : password
                        },
                        success : function (data1){
                        if(Number(data1)==1){
                            $('#alear').html('<p style="padding-left: 5%;font-size: 0.8em;color: #ffa300;font-style: italic;"><i class="fas fa-exclamation-triangle"></i> SĐT hoặc mật khẩu không đúng</p>');
                            setTimeout(function(){$('#alear').html('');},4000);
                            return false;
                        }else{
                            $('#aleara').html('<p style="text-align: center;color: #4caf50;font-size: 1.2em;"><i class="fas fa-check"></i> Đăng nhập thành công</p>');
                            setTimeout(function(){
                                window.location="/m/cpanel/";
                            },0);
                        }
                        }
                        });
            }
            });
        $('#register').click(function(){
            $('#alear').html('');
                var phone = $('#phone').val();
                var fullname = $('#fullname').val();
                var password = $('#password').val();
                var repassword = $('#repassword').val();
                var reff = $('#reff').val();
                if (reff == ''){reff=1;}
                var vnf_regex = /((09|03|07|08|05)+([0-9]{8})\b)/g;
                if(fullname==''){
                    $('#showfullname').html('<p style="padding-left: 5%;font-size: 0.8em;color: #ffa300;font-style: italic;"><i class="fas fa-exclamation-triangle"></i> Hãy nhập họ tên của bạn</p>');
                    $('#fullname').focus();
                    setTimeout(function(){$('#showfullname').html('');},4000);
                    return false;
                }else if(phone==''){
                    $('#showphone').html('<p style="padding-left: 5%;font-size: 0.8em;color: #ffa300;font-style: italic;"><i class="fas fa-exclamation-triangle"></i> Hãy nhập số điện thoại</p>');
                    $('#phone').focus();
                    setTimeout(function(){$('#showphone').html('');},4000);
                    return false;
                }else if(vnf_regex.test(phone) == false){
                        $('#showphone').html('<p style="padding-left: 5%;font-size: 0.8em;color: #ffa300;font-style: italic;"><i class="fas fa-exclamation-triangle"></i> Số điện thoại không đúng định dạng!</p>');
                        setTimeout(function(){$('#showphone').html('');},4000);
                        return false;
                }else if(password==''){
                    $('#showpass').html('<p style="padding-left: 5%;font-size: 0.8em;color: #ffa300;font-style: italic;"><i class="fas fa-exclamation-triangle"></i> Hãy nhập mật khẩu</p>');
                    $('#password').focus();
                    setTimeout(function(){$('#showpass').html('');},4000);
                    return false;
                }else if(repassword==''){
                    $('#showrepass').html('<p style="padding-left: 5%;font-size: 0.8em;color: #ffa300;font-style: italic;"><i class="fas fa-exclamation-triangle"></i> Hãy nhập lại mật khẩu</p>');
                    $('#repassword').focus();
                    setTimeout(function(){$('#showrepass').html('');},4000);
                    return false;
                }else if(password!=repassword){
                    $('#showrepass').html('<p style="padding-left: 5%;font-size: 0.8em;color: #ffa300;font-style: italic;"><i class="fas fa-exclamation-triangle"></i> Mật khẩu nhập lại không khớp</p>');
                    $('#repassword').focus();
                    setTimeout(function(){$('#showrepass').html('');},4000);
                    return false;
                }else{
                        $.ajax({
                            url : "./ajax.php", 
                            type : "post",
                            dateType:"text",
                            data : { 
                            typeform : 'register',
                            fullname : fullname,
                            phone : phone,
                            password : password,
                            reff : reff
                        },
                        success : function (data1){
                        if(Number(data1)==1){
                            $('#showphone').html('<p style="padding-left: 5%;font-size: 0.8em;color: #ffa300;font-style: italic;"><i class="fas fa-exclamation-triangle"></i> Số điện thoại đã được đăng ký</p>');
                            $('#phone').focus();
                            setTimeout(function(){$('#showphone').html('');},5000);
                            return false;
                        }else{
                            $('#aleara').html('<p style="text-align: center;color:#4caf50;font-size: 1.2em;"><i class="fas fa-check"></i> Đăng ký tài khoản thành công</p>');
                
                            setTimeout(function(){
                                window.location="/m/cpanel/";
                            },0);
                        }
                        }
                        });        
                }
                })
                function isEmail(email)
                {
                        var regExp = /^[A-Za-z][\w$.]+@[\w]+\.\w+$/;
                        return regExp.test(email);
                }
                
                function checkpass(pass)
                {
                        var rt='';
                        var re1 = /[a-z]/;
                        var re2 = /[A-Z]/;
                        var re3 = /[0-9]/;
                        var re4 = /[!.#$@_+,?-]/;
                        if(pass.length<8){
                            rt='Mật khẩu tối thiểu 8 ký tự';
                        }else if(re1.test(pass)==true && re2.test(pass)==true && re3.test(pass)==true && re4.test(pass)==true ){}else{ 
                            rt='Mật khẩu phải có kí tự in hoa, thường, số và 1 trong các ký tự !.#$@_+,?-';
                        }
                        return rt;
                }
                function removeusername(str) {
                    str = str.replace(/à|á|ạ|ả|ã|â|ầ|ấ|ậ|ẩ|ẫ|ă|ằ|ắ|ặ|ẳ|ẵ/g,"a"); 
                    str = str.replace(/è|é|ẹ|ẻ|ẽ|ê|ề|ế|ệ|ể|ễ/g,"e"); 
                    str = str.replace(/ì|í|ị|ỉ|ĩ/g,"i"); 
                    str = str.replace(/ò|ó|ọ|ỏ|õ|ô|ồ|ố|ộ|ổ|ỗ|ơ|ờ|ớ|ợ|ở|ỡ/g,"o"); 
                    str = str.replace(/ù|ú|ụ|ủ|ũ|ư|ừ|ứ|ự|ử|ữ/g,"u"); 
                    str = str.replace(/ỳ|ý|ỵ|ỷ|ỹ/g,"y"); 
                    str = str.replace(/đ/g,"d");
                    str = str.replace(/À|Á|Ạ|Ả|Ã|Â|Ầ|Ấ|Ậ|Ẩ|Ẫ|Ă|Ằ|Ắ|Ặ|Ẳ|Ẵ/g, "A");
                    str = str.replace(/È|É|Ẹ|Ẻ|Ẽ|Ê|Ề|Ế|Ệ|Ể|Ễ/g, "E");
                    str = str.replace(/Ì|Í|Ị|Ỉ|Ĩ/g, "I");
                    str = str.replace(/Ò|Ó|Ọ|Ỏ|Õ|Ô|Ồ|Ố|Ộ|Ổ|Ỗ|Ơ|Ờ|Ớ|Ợ|Ở|Ỡ/g, "O");
                    str = str.replace(/Ù|Ú|Ụ|Ủ|Ũ|Ư|Ừ|Ứ|Ự|Ử|Ữ/g, "U");
                    str = str.replace(/Ỳ|Ý|Ỵ|Ỷ|Ỹ/g, "Y");
                    str = str.replace(/Đ/g, "D");
                    str = str.replace(/\u0300|\u0301|\u0303|\u0309|\u0323/g, ""); 
                    str = str.replace(/\u02C6|\u0306|\u031B/g, ""); 
                    str = str.replace(/ + /g," ");
                    str = str.trim();
                    str = str.replace(/!|@|%|\^|\*|\(|\)|\+|\=|\<|\>|\?|\/|,|\.|\:|\;|\'|\"|\&|\#|\[|\]|~|\$|_|`|-|{|}|\||\\/g," ");
                    return str;
                }
    
})