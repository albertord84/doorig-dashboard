$(document).ready(function(){   
    
    
    $('.sigin-painel-steep-2').height($('.sigin-painel-steep-1').height());
    $('.sigin-painel-steep-3').height($('.sigin-painel-steep-1').height());
    $('.sigin-painel-steep-4').height($('.sigin-painel-steep-1').height());
    $('.sigin-painel-steep-2').width($('.sigin-painel-steep-1').width());
    $('.sigin-painel-steep-3').width($('.sigin-painel-steep-1').width());
    $('.sigin-painel-steep-4').width($('.sigin-painel-steep-1').width());
    
    $("#btn-sigin-steep-1").click(function () {
        if(js_validate_datas_sigin_steep_1())
            if(send_datas_sigin_steep_1()){            
                $('.sigin-painel-steep-1').css({'display':'none','visibility': 'hidden','opacity': '0','transition':'visibility 0s, opacity 0.5s linear'});  
                $('.sigin-painel-steep-2').css({'display':'block','visibility': 'visible', 'opacity': '1'});            
            }
    });
    
    function js_validate_datas_sigin_steep_1(){
        return true;
    }
    
    function send_datas_sigin_steep_1(){
        return true;
    }
    
    $("#btn-sigin-steep-2a").click(function () {
        if(js_validate_datas_sigin_steep_1())
            if(send_datas_sigin_steep_1()){            
                $('.sigin-painel-steep-2').css({'display':'none','visibility': 'hidden','opacity': '0','transition':'visibility 0s, opacity 0.5s linear'});  
                $('.sigin-painel-steep-3').css({'display':'block','visibility': 'visible', 'opacity': '1'});            
            }
    });
    
    $("#btn-sigin-steep-2b").click(function () {
        if(js_validate_datas_sigin_steep_1())
            if(send_datas_sigin_steep_1()){            
                $('.sigin-painel-steep-2').css({'display':'none','visibility': 'hidden','opacity': '0','transition':'visibility 0s, opacity 0.5s linear'});  
                $('.sigin-painel-steep-3').css({'display':'block','visibility': 'visible', 'opacity': '1'});            
            }
    });
    
    $("#btn-sigin-steep-3").click(function () {
        if(js_validate_datas_sigin_steep_1())
            if(send_datas_sigin_steep_1()){            
                $('.sigin-painel-steep-3').css({'display':'none','visibility': 'hidden','opacity': '0','transition':'visibility 0s, opacity 0.5s linear'});  
                $('.sigin-painel-steep-4').css({'display':'block','visibility': 'visible', 'opacity': '1'});            
            }
    });
    
    
    
    
 }); 