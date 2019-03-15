<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">        
        <!-- Tell the browser to be responsive to screen width -->
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="description" content="">
        <meta name="author" content="">        
        <!-- Favicon icon -->
        <link rel="icon" type="image/png" sizes="16x16" href="<?php echo base_url()?>assets/images/favicon.png">
        <title>Maior visibilidade no Instagram</title>        
        <!-- Bootstrap Core CSS -->
        <link href="<?php echo base_url()?>assets/node_modules/bootstrap/css/bootstrap.min.css" rel="stylesheet">
        <link href="<?php echo base_url()?>assets/node_modules/perfect-scrollbar/css/perfect-scrollbar.css" rel="stylesheet">        
        <!-- chartist CSS -->
        <link href="<?php echo base_url()?>assets/node_modules/morrisjs/morris.css" rel="stylesheet">      
        <!--c3 CSS -->
        <link href="<?php echo base_url()?>assets/node_modules/c3-master/c3.min.css" rel="stylesheet">        
        <!--Toaster Popup message CSS -->
        <link href="<?php echo base_url()?>assets/node_modules/toast-master/css/jquery.toast.css" rel="stylesheet">        
        <!-- Custom CSS -->
        <link href="<?php echo base_url()?>assets/css/style.css" rel="stylesheet">
        <link href="<?php echo base_url()?>assets/css/style-doorig.css" rel="stylesheet">        
        <!-- Dashboard 1 Page CSS -->
        <link href="<?php echo base_url()?>assets/css/pages/dashboard1.css" rel="stylesheet">        
        <!-- You can change the theme colors from here -->
        <link href="<?php echo base_url()?>assets/css/colors/default.css" id="theme" rel="stylesheet">        
        
        <script type="text/javascript">
            var base_url = "<?php echo base_url()?>";
            var module = "dashboard";
        </script>
    </head>

    <body class="fix-header fix-sidebar card-no-border">
        
        <!-- Main wrapper -->
        <div id="main-wrapper">
            <?php echo $lateral_menu;?>
        </div>
        
            <!-- Page wrapper  -->
        <div class="page-wrapper">
            <div class="container-fluid">
                
                <!-- welcome  -->
                <div class="row page-titles">
                    <div class="col-md-5 align-self-center">
                        <!--<h3 class="text-themecolor">Bem-vindo ao seu Dashboard!</h3>-->
<!--                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="javascript:void(0)">Home</a></li>
                            <li class="breadcrumb-item active">Dashboard</li>
                        </ol>-->
                    </div>                        
                </div>


                <!-- HEADER -->
                <div class="card">
                    <div class="card-body">
                        <h1>DASHBOARD</h1>
                    </div>
                </div>
                <!-- modules  -->
                <div class="row">
                    
                    
                    <div class="col-lg-6 col-md-12" >
                        <div class="card">
                            <div class="card-body" style="<?php if(isset($client->ClientModules->Modules["visibility"])) echo 'background-color:green;'?>">
                                <div class="d-flex m-b-30 no-block">
                                    <h5 class="card-title m-b-0 align-self-center">Mais Visibilidade</h5>
                                </div>
                                <div id="module-vissivility">
                                    <p class="text-justify">
                                        Atraia "novos seguidores reais" para a sua marca no Instagram, aumentando suas chances de atrair mais fãs ou clientes ao seu negócio. 
                                        Segmente seu público alvo através de Perfis de Referência, Geolocalização e Hastags.                                            
                                        Aplique filtros para escolher a qualidade dos novos seguidores. 
                                        Configure comentários ou dé Likes nas últimas postagens do seu público alvo para aumentar sua taxa de conversão.
                                    </p>                                        
                                    <p class="text-justify">
                                        O perfil da sua marca vai seguir outros perfis, aplicando as configurações selecionadas por você, e automáticamente os deixa de seguir após 48 horas. Acompanhamos suas estatísticas.
                                    </p>                                                                              
                                </div>
                                <div class="text-center">
                                    <!--<a href="#">Ver mais</a>-->                                    
                                    <a class="has-arrow waves-effect waves-dark visivility-access" aria-expanded="false">
                                        <button type="button" class="btn btn-info">
                                            Acessar
                                        </button>                                        
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                    
                    <!--<div class="col-lg-6 col-md-12">
                        <div class="card">
                            <div class="card-body">
                                <div class="d-flex m-b-30 no-block">
                                    <h5 class="card-title m-b-0 align-self-center">Captação de Leads</h5>
                                </div>
                                <div id="module-leads">
                                    <p class="text-justify">
                                        A captação de leads é o processo de atrair seu público alvo fazendo que despertam seu interesse pela sua marca, produtos ou serviços.
                                        Milhares de leads estão disponíveis publicamente no Instagram e podem ser suas agora.
                                        Extraia suas leads para Email-Marketing e SMS-Marketing segmentando através de Perfis de Referência, Geolocalização e Hastags, e aplique filtros para escolher a qualidade. 
                                    </p>                                        
                                    <p class="text-justify">
                                        A ferramenta vai minerar as leads através de perfis, aplicando as configurações selecionadas por você, e lhe permitira esportar-as a um arquivo formatado.
                                    </p>                                                                              
                                </div>                                    
                                <div class="text-center">
                                    <a href="#">Ver mais</a>
                                </div>
                            </div>
                        </div>
                    </div>-->
                    
                    <div class="col-lg-6 col-md-12">
                        <div class="card">
                            <div class="card-body" style="<?php if(isset($client->ClientModules->Modules["post_stories"])) echo 'background-color:green;'?>">
                                <div class="d-flex m-b-30 no-block">
                                    <h5 class="card-title m-b-0 align-self-center">Post-Stories</h5>
                                </div>
                                <div id="module-vissivility">
                                    <p class="text-justify">
                                        Essas são duas das principais funcionalidades que o Instagram permite aos seus usuários.
                                        Para economizar seu tempo, programe quando suas postagens devem ser realizadas na data e hora do seu interesse.
                                        Agende a publicação de Stories no perfil da sua marca.
                                        Selecione o post desejado e agende uma nova data para repostar! 
                                    </p>                                        
                                    <p class="text-justify">
                                        A ferramenta vai fazer estas tarefas automática e periódicamente na hora e data selecionada para cada evento.
                                    </p>                                                                              
                                </div>                                    
                                <div class="text-center">
                                    <!--<a href="#">Ver mais</a>-->                                    
                                    <a class="has-arrow waves-effect waves-dark post-stories-access" aria-expanded="false">
                                        <button type="button" class="btn btn-info">
                                            Acessar
                                        </button>                                        
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="row">                    
                    <div class="col-lg-6 col-md-12">
                        <div class="card">
                            <div class="card-body" style="<?php if(isset($client->ClientModules->Modules["directs"])) echo 'background-color:green;'?>">
                                <div class="d-flex m-b-30 no-block">
                                    <h5 class="card-title m-b-0 align-self-center">Envio de Directs</h5>
                                </div>
                                <div id="module-leads">
                                    <p class="text-justify">
                                        Instagram Direct, é a função que permite que sua marca se aproxime dos seguidores através de mensagens dirigidos, além de direcioná-los com links a suas páginas de conversão e atrair a atenção deles para o seu produto.
                                        É um recurso que permite trocar mensagens e fotos de forma privada com os seguidores, e está disponível tanto para os perfis comerciais, quanto para os pessoais. 
                                    </p>                                        
                                    <p class="text-justify">
                                        Automatize o envio de Directs nesse módulo e anuncie seus produtos e serviços, envie códigos promocionais ou cupom de desconto.
                                    </p>                                                                             
                                </div>                                    
                                <div class="text-center">
                                    <!--<a href="#">Ver mais</a>-->                                    
                                    <a class="has-arrow waves-effect waves-dark directs-access" aria-expanded="false">
                                        <button type="button" class="btn btn-info">
                                            Acessar
                                        </button>                                        
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                    
                    <div class="col-lg-6 col-md-12">
                        <div class="card">
                            <div class="card-body" style="<?php if(isset($client->ClientModules->Modules["analysis"])) echo 'background-color:green;'?>">
                                <div class="d-flex m-b-30 no-block">
                                    <h5 class="card-title m-b-0 align-self-center">Deep-Analisys</h5>
                                </div>
                                <div id="module-vissivility">
                                    <p class="text-justify">
                                        Análise de seguidores, curtidas, comentários e postages.
                                        Salve suas hashtags mais usadas em grupos! Você não precisa digitar sempre as mesmas hashtags. Crie grupos de hashtags para incluir em seus conteúdos e otimize tempo! 
                                    </p>                                        
                                    <p class="text-justify">
                                        Em dependência da complexidade da tarefa escolhida para fazer a análisis, os resultados podem demorar um tempo.
                                    </p>                                                                              
                                </div>                                    
                                <div class="text-center">
                                    <!--<a href="#">Ver mais</a>-->                                    
                                    <a class="has-arrow waves-effect waves-dark deep-analisys-access" aria-expanded="false">
                                        <button type="button" class="btn btn-info">
                                            Acessar
                                        </button>                                        
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            
            <?php echo $modals?>
            
            <footer class="footer text-center">
                DOORIG - TODOS OS DIREITOS RESERVADOS
            </footer>
        </div>
        
        <!-- All Jquery -->
        <script src="<?php echo base_url()?>assets/node_modules/jquery/jquery.min.js"></script>
        <!-- Bootstrap popper Core JavaScript -->
        <script src="<?php echo base_url()?>assets/node_modules/bootstrap/js/popper.min.js"></script>
        <script src="<?php echo base_url()?>assets/node_modules/bootstrap/js/bootstrap.min.js"></script>
        <!-- slimscrollbar scrollbar JavaScript -->
        <script src="<?php echo base_url()?>assets/node_modules/ps/perfect-scrollbar.jquery.min.js"></script>
        <!--Wave Effects -->
        <script src="<?php echo base_url()?>assets/js/waves.js"></script>
        <!--Menu sidebar -->
        <script src="<?php echo base_url()?>assets/js/sidebarmenu.js"></script>
        <!--Custom JavaScript -->
        <script src="<?php echo base_url()?>assets/js/custom.min.js"></script>
        <!-- This page plugins -->
        <!--morris JavaScript -->
        <script src="<?php echo base_url()?>assets/node_modules/raphael/raphael-min.js"></script>
        <script src="<?php echo base_url()?>assets/node_modules/morrisjs/morris.min.js"></script>
        <!--c3 JavaScript -->
        <script src="<?php echo base_url()?>assets/node_modules/d3/d3.min.js"></script>
        <script src="<?php echo base_url()?>assets/node_modules/c3-master/c3.min.js"></script>
        <!-- Popup message jquery -->
        <script src="<?php echo base_url()?>assets/node_modules/toast-master/js/jquery.toast.js"></script>
        <!-- Chart JS -->
        <script src="<?php echo base_url()?>assets/js/dashboard1.js"></script>
        <!-- Style switcher -->
        <script src="<?php echo base_url()?>assets/node_modules/styleswitcher/jQuery.style.switcher.js"></script>
        
        <!-- system scripts --> 
        <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.mask/1.14.10/jquery.mask.js"></script>
        <script src="<?php echo base_url()?>assets/js/dashboard/PT/internalization.js"></script>
        <script src="<?php echo base_url()?>assets/js/dashboard/mask.js"></script>
        <script src="<?php echo base_url()?>assets/js/dashboard/basics.js"></script>
        <script src="<?php echo base_url()?>assets/js/dashboard/talkme_painel_dashboard.js"></script>
        <script src="<?php echo base_url()?>assets/js/dashboard/dasboard.js"></script>
    </body>
</html>