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
            
            <!-- Container fluid  -->
            <div class="container-fluid">
                
                <!-- HEADER -->
                <div class="card">
                    <div class="card-body">
                        <h1>PAGAMENTO</h1>
                    </div>
                </div>

                <div class="row">
                    <div class="col-lg-12 col-md-12">
                        <div class="card">
                            <div class="card-body">
                                <div id="payment_form" class="row">
                                    <div class="col-lg-2 col-md-12"></div>
                                    <div class="col-lg-8 col-md-12">
                                            <div class="row">
                                                <div class="col-md-12">
                                                    <div class="sec-title text-center">
                                                        <h2>Adicione seus dados de pagamento</h2>
                                                        <span class="border"></span>
                                                    </div>
                                                </div>                                        
                                            </div>
                                            <div class="card-body">
                                                <div class="form-group">
                                                    <label>Seu nome como no cartão (*):</label>
                                                    <input id="cc-name" type="text" autofocus="" class="form-control" onkeyup="javascript:this.value=this.value.toUpperCase();" style="text-transform: uppercase; cursor: not-allowed;">
                                                </div>                                                
                                                <div class="row">
                                                    <div class="form-group col-lg-8 col-md-12">
                                                        <label>Número do cartão (*):</label>
                                                        <input id="cc-number" type="text"  class="form-control" placeholder="">
                                                    </div>
                                                    <div class="form-group col-lg-4 col-md-12">
                                                        <label>CVC / CVV (*):</label>
                                                        <input id="cc-cvv" type="text" class="form-control" placeholder="">
                                                    </div>
                                                </div>
                                                <div class="row">
                                                    <div class="form-group col-lg-6 col-md-12">
                                                        <label>Mês de validade (*):</label>
                                                        <select id="cc-month"  class="form-control" placeholder="">
                                                            <option>01</option><option>02</option><option>03</option><option>04</option>
                                                            <option>05</option><option>06</option><option>07</option><option>08</option>
                                                            <option>09</option><option>10</option><option>11</option><option>12</option>
                                                        </select>
                                                    </div>
                                                    <div class="form-group col-lg-6 col-md-12">
                                                        <label>Ano de validade (*):</label>
                                                        <select id="cc-year"  class="form-control" placeholder="">
                                                            <option>2019</option><option>2020</option><option>2021</option><option>2021</option>
                                                            <option>2023</option><option>2024</option><option>2025</option><option>2026</option>
                                                            <option>2027</option><option>2028</option><option>2029</option><option>2030</option>
                                                            <option>2031</option><option>2032</option><option>2033</option><option>2034</option>
                                                        </select>
                                                    </div>
                                                </div>
                                                <div class="form-group">
                                                    <label>Seu CPF:</label>
                                                    <input id="cc-cpf" type="text" class="form-control cpf">
                                                </div>
                                                <div class="form-group">
                                                    <label>Tem algum código promocional?</label>
                                                    <input id="promotional-code" type="text" autofocus="" class="form-control" placeholder="">
                                                </div>
                                                <div class="text-right">
                                                    <label> (*) Campos obrigatórios</label>
                                                </div>
                                                <div class="text-center">
                                                    <button id="payment_btn" type="button" style="min-width: 150px" class="btn btn-info m-t-20"><i class="fa fa-envelope-o"></i> Enviar</button>
                                                </div>
                                            </div>
                                    </div>
                                    <div class="col-lg-2 col-md-12"></div>                                    
                                </div>
                            </div>
                        </div>
                    </div>                        
                </div>


            </div>
            <!-- End Container fluid  -->
            <!-- footer -->
            <footer class="footer text-center">
                DOORIG - TODOS OS DIREITOS RESERVADOS
            </footer>
            <!-- End footer -->
        </div>
        <!-- End Wrapper -->
        
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
        <script src="<?php echo base_url()?>assets/js/dashboard/dasboard.js"></script>
    </body>
</html>