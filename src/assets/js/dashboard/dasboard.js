$(document).ready(function(){
    
    $(".dashboard-access").click(function(){
        if(module=="dashboard")
            return;
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
                    $(location).attr('href', final_url+"index.php/welcome/internal_index/"+response.LoginToken+"/"+response.ClientId);
                } else
                    modal_alert_message(response.message);                    
            },
            error : function(xhr, status) {
                //spinner_stop(btn);
                modal_alert_message('Erro enviando a mensagem, tente depois...');                    
            }
        });  
    });
    
    $(".visivility-access").click(function(){
        //var btn =this;
        $.ajax({
            url :base_url+'index.php/welcome/call_to_generate_access_token',
            data :{
                "module_id":1 // go to visivility
            },
            type : 'POST',
            dataType : 'json',
            success : function(response){
                console.log(response);
                //spinner_stop(btn);
                if(response.code===0){
                    var final_url = base_url.replace(module,"visibility");
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
        return false;
    });
    
    $(".directs-access").click(function(){        
        return false;
    });
    
    $(".deep-analisys-access").click(function(){        
        return false;
    });
    
    $(".payment-access").click(function(){        
        return false;
    });
    
    $(".sumarize-account-access").click(function(){        
        return false;
    });
            
    $(".message-access").click(function(){
        if(module=="dashboard")
            $(location).attr('href', base_url+"index.php/welcome/message_view/ok/ok");
        else        
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
    });
});



