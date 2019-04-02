$(document).ready(function(){    
    
    
    
    function display_modules(){
        var modules = client.ClientModules.Modules;
        if(!modules.visibility) return;
        if(modules.visibility.Active=="1"){
            $("#icon_module_visivility").css({"color":"#20aee3"});
            $("#text_module_visivility").text("Acessar");
        }            
    }

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
    
    display_modules();
    
 }); 