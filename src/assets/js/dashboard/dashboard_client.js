$(document).ready(function(){    
    
    //console.log(client);

    $('#contact_form').keypress(function (e) {
        if (e.which == 13) {
            $("#contact_btn").click();
            return false;
        }
    });
    
    $("#contact_btn").click(function(){
        message=validate_not_empty('#contact_message');
        contact_subject=validate_not_empty('#contact_subject');
          if(contact_subject && message){
            //var l = Ladda.create(this);  l.start(); l.start();
            $.ajax({
                url : base_url+'index.php/welcome/contact_us',
                data :{ 
                        'subject':$("#contact_subject").val(),
                        'message':$("#contact_message").val()
                    },
                type : 'POST',
                dataType : 'json',
                success : function(response){
                    if(response.code===0){                        
                        modal_success_message(response['message']);                        
                    } else
                        modal_alert_message(response['message']);    
                    //l.stop();
                    $("#contact_subject").val("");
                    $("#contact_message").val("");
                },
                error : function(xhr, status) {
                    modal_alert_message(T('Erro enviando a mensagem, tente depois...'));
                    //l.stop();                    
                    $("#contact_subject").val("");
                    $("#contact_message").val("");
                }                
            });
        } else{
            modal_alert_message(T('Alguns dados incorretos'));            
        }                             
    });
              
    $('#payment_form').keypress(function (e) {
        if (e.which == 13) {
            $("#payment_btn").click();
            return false;
        }
    });    
    
    $("#payment_btn").click(function(){
        var final_url = base_url.replace(module,"visibility");
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
                    'client_id':client_id,
                    'user_email':email
                };
                $.ajax({
                    url: final_url + 'index.php/Payment/add_payment/',
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
              
    $("#see_more_visibility").click(function () {
        modal_text_information("Atraia novos seguidores reais para a sua marca no Instagram, aumentando suas chances de atrair mais fãs ou clientes ao seu negócio. Segmente seu público alvo através de Perfis de Referência, Geolocalização e Hastags. Aplique filtros para escolher a qualidade dos novos seguidores. Configure comentários ou dé Likes nas últimas postagens do seu público alvo para aumentar sua taxa de conversão. O perfil da sua marca vai seguir outros perfis, aplicando as configurações selecionadas por você, e automáticamente os deixa de seguir após 48 horas. Acompanhamos suas estatísticas.");
        return false;
    });
    
    $("#see_more_posting").click(function () {
        modal_text_information("Essas são duas das principais funcionalidades que o Instagram permite aos seus usuários. Para economizar seu tempo, programe quando suas postagens devem ser realizadas na data e hora do seu interesse. Agende a publicação de Stories no perfil da sua marca. Selecione o post desejado e agende uma nova data para repostar! A ferramenta vai fazer estas tarefas automática e periódicamente na hora e data selecionada para cada evento.");
        return false;
    });
    
    $("#see_more_directs").click(function () {
        modal_text_information("Instagram Direct, é a função que permite que sua marca se aproxime dos seguidores através de mensagens dirigidos, além de direcioná-los com links a suas páginas de conversão e atrair a atenção deles para o seu produto. É um recurso que permite trocar mensagens e fotos de forma privada com os seguidores, e está disponível tanto para os perfis comerciais, quanto para os pessoais. Automatize o envio de Directs nesse módulo e anuncie seus produtos e serviços, envie códigos promocionais ou cupom de desconto.");
        return false;
    });
    
    $("#see_more_deep_analisys").click(function () {
        modal_text_information("Análise de seguidores, curtidas, comentários e postages. Salve suas hashtags mais usadas em grupos! Você não precisa digitar sempre as mesmas hashtags. Crie grupos de hashtags para incluir em seus conteúdos e otimize tempo! Em dependência da complexidade da tarefa escolhida para fazer a análisis, os resultados podem demorar um tempo.");
        return false;
    });
    
    
    
 }); 