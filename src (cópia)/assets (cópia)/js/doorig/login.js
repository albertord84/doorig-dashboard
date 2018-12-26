$(document).ready(function(){ 
    $('.form-forget-pass').height($('.form-login').height());
    
    $("#lnk-forget-pass").click(function () {                   
        $('.form-login').css({'display':'none','visibility': 'hidden','opacity': '0','transition':'visibility 0s, opacity 0.5s linear'});  
        $('.form-forget-pass').css({'display':'block','visibility': 'visible', 'opacity': '1'});            
        return 0;
    });
    
    $("#lnk-back-to-login").click(function () {                
        $('.form-forget-pass').css({'display':'none','visibility': 'hidden','opacity': '0','transition':'visibility 0s, opacity 0.5s linear'});  
        $('.form-login').css({'display':'block','visibility': 'visible', 'opacity': '1'});            
        return 0;
    });
    
    
    
    
 }); 