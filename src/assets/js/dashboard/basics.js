var ig_profile_regular_expression = "^[a-zA-Z0-9\._]{1,300}$";
var ig_geolocation_regular_expression = "^[a-zA-Z-0-9\._áéíóúàèìòùâêîôûãõẽçÇ]{1,300}$";
var ig_hashtag_regular_expression = "^[a-zA-Z0-9\._áéíóúàèìòùâêîôûãõẽçÇ]{1,300}$";
var verification_code_regular_expression = "^[0-9]{4}$";
var checkpoint_required_code_regular_expression = "^[0-9]{6}$";
var email_regular_expression = "^[a-zA-Z0-9\._-]+@([a-zA-Z0-9-]{2,}[.])*[a-zA-Z]{2,}$";
var complete_name_regular_expression = "^[a-z A-Z0-9áÁéÉíÍóÓúÚàÀèÈìÌòÒùÙãÃõÕâÂêÊôÔûÛñ\._]{2,150}$";

var cvv_regular_expression =  "^[0-9]{3,4}$";
var month_regular_expression = "^[0-10-9]{2,2}$";
var year_regular_expression = "^[2-20-01-20-9]{4,4}$";
var cc_name_regular_expression = "^[A-Z ]{4,50}$";

var Visa_regular_expression = "^(?:4[0-9]{12}(?:[0-9]{3})?)$"; // Validating a Visa card starting with 4, length 13 or 16 digits.
var MasterCard_regular_expression = "^(?:5[1-5][0-9]{14})$"; // Validating a MasterCard starting with 51 through 55, length 16 digits.
var AmericanExpress_regular_expression = "^(?:3[47][0-9]{13})$"; // Validating a AmericanExpress credit card starting with 34 or 37, length 15 digits.
var Discover_regular_expression = "^(?:6(?:011|5[0-9][0-9])[0-9]{12})$"; // Validating a Discover card starting with 6011, length 16 digits or starting with 5, length 15 digits.
var DinersClub_regular_expression = "^(?:3(?:0[0-5]|[68][0-9])[0-9]{11})$"; // Validating a DinersClub card starting with 300 through 305, 36, or 38, length 14 digits.
var Elo_regular_expression = "^(?:((((636368)|(438935)|(504175)|(451416)|(636297))[0-9]{0,10})|((5067)|(4576)|(4011))[0-9]{0,12}))$"; // Validating a Elo credit card
var Hypercard_regular_expression = "^(?:(606282[0-9]{10}([0-9]{3})?)|(3841[0-9]{15}))$"; // Validating a Hypercard

var ticket_bank_client_name_regular_expression =  "^[A-Za-z ]{4,50}$";
var cpf_regular_expression = "^[0-9]{2,11}$";
var cep_regular_expression = '^[0-9]{8}$';
var street_address_regular_expression = '^[a-zA-Z0-9. áéíóúãõẽâîô]{5,80}$';
var neighborhood_address_regular_expression = '^[a-zA-Z0-9. áéíóúãõẽâîô]{2,80}$';
var municipality_address_regular_expression = '^[a-zA-Z0-9. áéíóúãõẽâîô]{2,80}$';
var state_address_regular_expression = '^[A-Z]{2}$';
var house_number_regular_expression = '^[0-9/]{1,7}$';
var ticket_bank_option_tmp_regular_expression = '^[1-3]{1}$';

(function ($) {
    $.fn.replaceClass = function (pFromClass, pToClass) {
        return this.removeClass(pFromClass).addClass(pToClass);
    };
}(jQuery));

function validate_element(element_selector,pattern){
    if(!$(element_selector).val().match(pattern)){
        $(element_selector).css("border", "1px solid red");
        return false;
    } else{
        $(element_selector).css("border", "1px solid #d9d9d9");
        return true;
    }
}

function validate_not_empty(element_selector){
    if($(element_selector).val().trim()==""){
        $(element_selector).css("border", "1px solid red");
        return false;
    } else{
        $(element_selector).css("border", "1px solid #d9d9d9");
        return true;
    }
}

function validate_equals(element_selector, element_selector2){
    if($(element_selector2).val().trim()=="" || $(element_selector).val().trim()!==$(element_selector2).val().trim()){
        $(element_selector2).css("border", "1px solid red");
        return false;
    } else{
        $(element_selector2).css("border", "1px solid #d9d9d9");
        return true;
    }
}

function validate_cpf(element_selector, pattern) {
    var cpf=$(element_selector).val();
    cpf = cpf.replace(/[^\d]+/g,'');    
    if(cpf.match(pattern)){
        if(cpf == '') {
            $(element_selector).css("border", "1px solid red");
            return false;
        }
        // Elimina CPFs invalidos conhecidos    
        if (cpf.length != 11 || 
            cpf == "00000000000" || cpf == "11111111111" || cpf == "22222222222" 
            || cpf == "33333333333" || cpf == "44444444444" || cpf == "55555555555" 
            || cpf == "66666666666" || cpf == "77777777777" || cpf == "88888888888" 
            || cpf == "99999999999"){
                $(element_selector).css("border", "1px solid red");
                return false;
            }
        // Valida 1o digito 
        add = 0;
        for (i=0; i < 9; i ++)       
            add += parseInt(cpf.charAt(i)) * (10 - i);  
            rev = 11 - (add % 11);  
            if(rev == 10 || rev == 11)     
                rev = 0;    
            if(rev != parseInt(cpf.charAt(9))){
                $(element_selector).css("border", "1px solid red");
                return false;
            }
        // Valida 2o digito 
        add = 0;
        for (i = 0; i < 10; i ++)
            add += parseInt(cpf.charAt(i)) * (11 - i);  
        rev = 11 - (add % 11);
        if (rev == 10 || rev == 11)
            rev = 0;
        if (rev != parseInt(cpf.charAt(10))){
            $(element_selector).css("border", "1px solid red");
            return false;
        }            
        $(element_selector).css("border", "1px solid #d9d9d9");
        return true;
    }else{
        $(element_selector).css("border", "1px solid red");
        return false;
    }
}

function validate_month(element_selector, pattern) {
    if (!$(element_selector).val().match(pattern) || Number($(element_selector).val()) > 12) {
        $(element_selector).css("border", "1px solid red");
        return false;
    } else {
        $(element_selector).css("border", "1px solid #d9d9d9");
        return true;
    }
}

function validate_year(element_selector, pattern) {
    if (!$(element_selector).val().match(pattern) || Number($(element_selector).val()) < 2017) {
        $(element_selector).css("border", "1px solid red");
        return false;
    } else {
        $(element_selector).css("border", "1px solid #d9d9d9");
        return true;
    }
}

function validate_date(month, year) {
    var d=new Date();
    if (year < d.getFullYear() || (year == d.getFullYear() && month <= d.getMonth()+1)){
        return false;
    }
    return true;
}

function getUrlVars(){
    var vars = [], hash;
    var hashes = window.location.href.slice(window.location.href.indexOf('?') + 1).split('&');
    for (var i = 0; i < hashes.length; i++){
        hash = hashes[i].split('=');
        vars.push(hash[0]);
        vars[hash[0]] = hash[1];
    }
    return vars;
}

function set_global_var(str, value) {
    switch (str) {
        case 'pk':
            pk = value;
            break;                 
    }
}

function spinner_start(handle){
    $(handle).children("i").css({"display":"inline-block","visibility":"visible"});
}

function spinner_stop(handle){
    $(handle).children("i").css({"display":"none","visibility":"hidden"});
}

function modal_alert_message(text_message){
    $('#modal_alert_message').modal('show');
    $('#alert_message_text').text(text_message);        
}

function modal_success_message(text_message){
    $('#modal_success_message').modal('show');
    $('#success_message_text').text(text_message);        
}

function modal_confirm_message(text_message,function_name,param){
    var action = function_name+"('"+param+"')";
    $('#confirm_message_text').text(text_message);
    $('#accept_modal_confirm_message').attr('onclick',action)
    $('#modal_confirm_message').modal('show');
}

function timeConverter(UNIX_timestamp,sep){
    var a = new Date(UNIX_timestamp * 1000);
    var year = a.getFullYear();
    var month = a.getMonth()+1;
    var date = a.getDate();
    var time = date+sep+month+sep+year;
    return time;
}

$("#verify_cep").click(function () {
    if(validate_element("#cep",'^[0-9]{8}$')){
        $.ajax({
            url: base_url+'index.php/welcome/get_cep_datas',                
            data: {
                'cep': $('#cep').val(),
            },
            type: 'POST',
            dataType: 'json',
            success: function (response) {
                if(response['success']){
                    response = response['datas'];
                    $('#street_address').val(response['logradouro']);
                    $('#neighborhood_address').val(response['bairro']);
                    $('#municipality_address').val(response['localidade']);
                    $('#state_address').val(response['uf']);            
                } else
                    modal_alert_message('CEP inválido');
            }
    });
    } else{
        modal_alert_message('CEP inválido');
    }
});

$(document).ready(function(){  
    
    $("#accept_modal_alert_message").click(function () {
        $('#modal_alert_message').modal('hide');
    });
    
    $("#accept_modal_success_message").click(function () {
        $('#modal_success_message').modal('hide');
    });
    
    $("#lnk_loguot").click(function () {
        $(location).attr('href', base_url+'index.php/welcome/log_out')
        return false;
    });
    
 }); 
 