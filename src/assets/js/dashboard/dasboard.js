$(document).ready(function(){
    
    $(".dashboard-access").click(function(){
        var final_url = base_url.replace(module,"dashboard");
        $(location).attr('href', final_url+"index.php");
        
        //        if(module=="dashboard")
        //            return;
        //        //var btn =this;
        //        $.ajax({ 
        //            url : base_url+'index.php',
        //            data :{
        //                "module_id":0 // go to dashboard
        //            },
        //            type : 'POST',
        //            dataType : 'json',
        //            success : function(response){
        //                //spinner_stop(btn);
        //                if(response.code===0){
        //                    $(location).attr('href', final_url+"index.php/welcome/internal_index/"+response.LoginToken+"/"+response.ClientId);
        //                } else
        //                    modal_alert_message(response.message);                    
        //            },
        //            error : function(xhr, status) {
        //                //spinner_stop(btn);
        //                modal_alert_message('Erro enviando a mensagem, tente depois...');                    
        //            }
        //        });  
    });
    
    $(".visivility-access").click(function(){
        var final_url = base_url.replace(module,"visibility");
        //var btn =this;
        $.ajax({
            url :base_url+'index.php/welcome/call_to_generate_access_token',
            data :{
                "module_id":1 // go to visivility
            },
            type : 'POST',
            dataType : 'json',
            success : function(response){
                //spinner_stop(btn);
                if(response.code===0){
                    $(location).attr('href', final_url+"index.php/welcome/index/"+response.LoginToken+"/"+response.ClientId);
                } else
                    modal_alert_message(response.message);                    
            },
            error : function(xhr, status) {
                //spinner_stop(btn);
                modal_alert_message('Erro enviando a mensagem, tente depois...');                    
            }
        });
    });
    
    $(".post-stories-access").click(function(){        
        modal_success_message("Módulo em desenvolvimento"); return false;
        var final_url = base_url.replace(module,"posting");
        $(location).attr('href', final_url+"index.php/welcome/index/");
    });
    
    $(".directs-access").click(function(){        
        modal_success_message("Módulo em desenvolvimento"); return false;
    });
    
    $(".deep-analysis-access").click(function(){        
        modal_success_message("Módulo em desenvolvimento"); return false;
    });
    
    $(".payment-access").click(function(){
        if(module=="dashboard"){
            $(location).attr('href', base_url+"index.php/welcome/payment_view/");
        }else{            
            var final_url = base_url.replace(module,"dashboard");
            //var btn =this;
            $.ajax({ 
                url : base_url+'index.php/welcome/call_to_generate_access_token',
                data :{
                    "module_id":0 // go to dashboard
                },
                type : 'POST',
                dataType : 'json',
                success : function(response){
                    //spinner_stop(btn);
                    if(response.code===0){
                        $(location).attr('href', final_url+"index.php/welcome/payment_view/"+response.LoginToken+"/"+response.ClientId);
                    } else
                        modal_alert_message(response.message);                    
                },
                error : function(xhr, status) {
                    //spinner_stop(btn);
                    modal_alert_message('Erro enviando a mensagem, tente depois...');                    
                }
            });
        }        
    });
    
    $(".sumarize-account-access").click(function(){        
        
    });
            
    $(".message-access").click(function(){
        if(module=="dashboard"){
            $(location).attr('href', base_url+"index.php/welcome/message_view/");
        }else{       
            var final_url = base_url.replace(module,"dashboard");
            //var btn =this;
            $.ajax({ 
                url : base_url+'index.php/welcome/call_to_generate_access_token',
                data :{
                    "module_id":0 // go to dashboard
                },
                type : 'POST',
                dataType : 'json',
                success : function(response){
                    //spinner_stop(btn);
                    if(response.code===0){
                        $(location).attr('href', final_url+"index.php/welcome/message_view/"+response.LoginToken+"/"+response.ClientId);
                    } else
                        modal_alert_message(response.message);                    
                },
                error : function(xhr, status) {
                    //spinner_stop(btn);
                    modal_alert_message('Erro enviando a mensagem, tente depois...');                    
                }
            });             
        }
    });
});