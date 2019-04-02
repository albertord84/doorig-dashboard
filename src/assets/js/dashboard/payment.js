$(document).ready(function(){    
                  
    $('#payment_form').keypress(function (e) {
        if (e.which == 13) {
            $("#payment_btn").click();
            return false;
        }
    });    
    
    $("#payment_btn").click(function(){
        if (($('#cc-name').val()).toUpperCase()==='VISA' || ($('#cc-name').val()).toUpperCase()==='MASTERCARD') {
            modal_alert_message(T("Informe seu nome no cartão e não a bandeira dele."));
            return;
        }
        var name = validate_element('#cc-name', cc_name_regular_expression);
        var cvv = validate_element('#cc-cvv', cvv_regular_expression);
        var month = validate_month('#cc-month', month_regular_expression);
        var year = validate_year('#cc-year', year_regular_expression);
        var date = validate_date($('#cc-month').val(),$('#cc-year').val()); 
        var number = validate_element('#cc-number', "^[0-9]{10,20}$");
        if (number)  { number = validate_element('#cc-number', Visa_regular_expression);
        if (!number) { number = validate_element('#cc-number', MasterCard_regular_expression);
        if (!number) { number = validate_element('#cc-number', AmericanExpress_regular_expression);
        if (!number) { number = validate_element('#cc-number', Discover_regular_expression);
        if (!number) { number = validate_element('#cc-number', DinersClub_regular_expression);
        if (!number) { number = validate_element('#cc-number', Elo_regular_expression);
        if (!number) { number = validate_element('#cc-number', Hypercard_regular_expression);
        }}}}}}}
        if (name && number && cvv && month && year) {
            if (date) {
                datas={
                    'credit_card_number': $('#cc-number').val(),
                    'credit_card_cvc': $('#cc-cvv').val(),
                    'credit_card_name': $('#cc-name').val(),
                    'credit_card_exp_month': $('#cc-month').val(),
                    'credit_card_exp_year': $('#cc-year').val(),
                    'cpf': $('#cc-cpf').val(),
                    'promotional-code': $('#promotional-code').val(),                    
                };
                $.ajax({
                    url: base_url + 'index.php/Payment/payment/',
                    data: datas,
                    type: 'POST',
                    dataType: 'json',
                    success: function (response) {
                        if (response.code===0) {
                            modal_success_message(response.message);                            
                        } else {
                            modal_alert_message(response.message);
                        }
                    },
                    error: function (xhr, status) {
                    }
                });
            } else {
                modal_alert_message(T('Data errada'));
            }   
        } else{
            modal_alert_message(T('Verifique os dados fornecidos'));
        }                           
    });
              
    
 }); 