$(function () {
    $('.not_space').keyup(function (e) {
        if (e.keyCode == 32) {
            $(this).val($(this).val().replace(" ", ""));
        }
    });
    $("#order_out").validate({
        rules: {
            order_customer: "required"
            //reg_Username: "required",
            //reg_lastname: "required",
            //reg_username: "required",
            //reg_password: "required"
           // reg_password: {
               // required: true,
               // minlength: 5
            //}
        },
        messages: {
            order_customer: "***xxxxxxx"
            //reg_Username: "*** ��س��к� ���� ���",
            //reg_lastname: "*** ��س��к� ���ʡ�� ���",
            //reg_username: "*** ��س��к� ���ͼ���� ���",
            //reg_password: "*** ��س��к� ���ʼ�ҹ ���"
            //reg_password: {
                //required: "*** ��س��к� ���ʼ�ҹ ���",
                //minlength: "*** ��س��к� ���ʼ�ҹ ���ҧ���� 5 ����ѡ�� ���"
           // }
        }
    });
    
});

/*
 function validate_xx(message_code) {
 var messgae_name = "";
 
 /*$.ajax({
 type: "POST",
 url: "<?php echo base_url();?>index.php/ValidateController/get_message",
 data: {message_code: message_code}
 })
 .done(function (data) {
 messgae_name = data;
 });
 
 $.ajax({
 type:'POST',
 url:'ValidateController/get_message',
 data:{'message_code':message_code},
 success:function(data){
 //$('#resultdiv').html(data);
 return data;
 }
 });
 
 
 }*/