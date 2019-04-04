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
        <link href="<?php echo base_url()?>assets/css/style.css"<?php echo '?'.$SCRIPT_VERSION;?> rel="stylesheet">
        <link href="<?php echo base_url()?>assets/css/style-doorig.css"<?php echo '?'.$SCRIPT_VERSION;?> rel="stylesheet">        
        <!-- Dashboard 1 Page CSS -->
        <link href="<?php echo base_url()?>assets/css/pages/dashboard1.css" rel="stylesheet">        
        <!-- You can change the theme colors from here -->
        <link href="<?php echo base_url()?>assets/css/colors/default.css" id="theme" rel="stylesheet">        
        
        <script type="text/javascript">
            var base_url = "<?php echo base_url();?>";            
            var client = <?php echo $client;?>;            
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
                    
                    <div class="col-lg-6 col-md-12">
                        <div class="card">
                            <div class="card-body text-center">                                
                                <div class="d-flex m-b-30 no-block">
                                    <div class="col-lg-10 col-md-12 text-left">
                                        <h5 class="card-title m-b-0">Mais Visibilidade</h5>
                                    </div>
                                    <div class="col-lg-2 col-md-12 text-right">
                                        <a id="see_more_visibility" class="see_more"><i class="far fa-question-circle"></i></a>
                                    </div>
                                </div>
                                <a class="has-arrow waves-effect waves-dark visivility-access" aria-expanded="false">
                                    <i id="icon_module_visivility" style="font-size:140px;" class="icon-Globe"></i>                                
                                    <br>
                                    <span id="text_module_visivility" style="color:black">Contratar</span>
                                </a>
                            </div>
                        </div>
                    </div>
                    
                    <div class="col-lg-6 col-md-12">
                        <div class="card">
                            <div class="card-body text-center">
                                <div class="d-flex m-b-30 no-block">
                                    <div class="col-lg-10 col-md-12 text-left">
                                        <h5 class="card-title m-b-0">Post-Stories</h5>
                                    </div>
                                    <div class="col-lg-2 col-md-12 text-right">
                                        <a id="see_more_posting" class="see_more"><i class="far fa-question-circle"></i></a>
                                    </div>
                                </div>
                                <a class="has-arrow waves-effect waves-dark post-stories-access" aria-expanded="false">
                                    <i id="icon_module_posting" style="font-size:140px" class="icon-Landscape-2"></i>
                                    <br>
                                    <span id="text_module_posting" style="color:black">Em breve ...</span>
                                </a>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="row">        
                    
                    <div class="col-lg-6 col-md-12">
                        <div class="card">
                            <div class="card-body text-center">
                                <div class="d-flex m-b-30 no-block">
                                    <div class="col-lg-10 col-md-12 text-left">
                                        <h5 class="card-title m-b-0">Envio de Directs</h5>
                                    </div>
                                    <div class="col-lg-2 col-md-12 text-right">
                                        <a id="see_more_directs" class="see_more"><i class="far fa-question-circle"></i></a>
                                    </div>
                                </div>
                                <a class="has-arrow waves-effect waves-dark directs-access" aria-expanded="false">
                                    <i id="icon_module_directs" style="font-size:140px" class="icon-Mail-Send"></i>
                                    <br>
                                    <span id="text_module_directs" style="color:black">Em breve ...</span>
                                </a>
                            </div>
                        </div>
                    </div>
                    
                    <div class="col-lg-6 col-md-12">
                        <div class="card">
                            <div class="card-body text-center">
                                <div class="d-flex m-b-30 no-block">
                                    <div class="col-lg-10 col-md-12 text-left">
                                        <h5 class="card-title m-b-0">Deep-Analisys</h5>
                                    </div>
                                    <div class="col-lg-2 col-md-12 text-right">
                                        <a id="see_more_deep_analisys" class="see_more"><i class="far fa-question-circle"></i></a>
                                    </div>
                                </div>
                                <a class="has-arrow waves-effect waves-dark deep-analysis-access" aria-expanded="false">
                                    <i id="icon_module_deep_analisys" style="font-size:140px" class="icon-Brain-2"></i>
                                    <br>
                                    <span id="text_module_deep_analisys" style="color:black">Em breve ...</span>
                                </a>
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
        <script src="<?php echo base_url()?>assets/js/dashboard/PT/internalization.js"<?php echo '?'.$SCRIPT_VERSION;?>></script>
        <script src="<?php echo base_url()?>assets/js/dashboard/mask.js"<?php echo '?'.$SCRIPT_VERSION;?>></script>
        <script src="<?php echo base_url()?>assets/js/dashboard/basics.js"<?php echo '?'.$SCRIPT_VERSION;?>></script>
        <script src="<?php echo base_url()?>assets/js/dashboard/dasboard.js"<?php echo '?'.$SCRIPT_VERSION;?>></script>
        <script src="<?php echo base_url()?>assets/js/dashboard/dashboard_client.js"<?php echo '?'.$SCRIPT_VERSION;?>></script>
    </body>
</html>