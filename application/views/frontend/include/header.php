<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="keywords" content="education, jnrc, jharkhand nurses registration Council, nurses portal " />
    <meta name="author" content="" />
    <meta name="robots" content="" />
    <meta name="description" content="Jharkhand Nurses Registration Council, Educational Portal, JNRC, Nurses portal" />
    <meta name="format-detection" content="telephone=no">
    <!-- Favicons Icon -->
    <link rel="shortcut icon" type="image/x-icon" href="<?php echo base_url();?>assets/images/favicon.png" />
    <!-- Page Title Here -->
    <title>Jharkhand Nursing Council</title>
    <!-- Mobile Specific -->
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <link rel="stylesheet" type="text/css" href="<?php echo base_url();?>assets/css/bootstrap.min.css">
    <link rel="stylesheet" type="text/css" href="<?php echo base_url();?>assets/css/flaticon/flaticon.css" />
    <link rel="stylesheet" type="text/css" href="<?php echo base_url();?>assets/css/owl.carousel.css">
    <link rel="stylesheet" type="text/css" href="<?php echo base_url();?>assets/css/bootstrap-select.min.css">
    <link rel="stylesheet" type="text/css" href="<?php echo base_url();?>assets/css/magnific-popup.css">
    <link rel="stylesheet" type="text/css" href="<?php echo base_url();?>assets/css/style.css">
    <link class="skin" rel="stylesheet" type="text/css" href="<?php echo base_url();?>assets/css/skin/skin-1.css">
    <link rel="stylesheet" type="text/css" href="<?php echo base_url();?>assets/css/templete.css">
    <!-- <link rel="stylesheet" type="text/css" href="<?php echo base_url();?>assets/css/switcher.css"/> // DN Theme off
 -->
    <!-- Revolution Slider Css -->
    <link rel="stylesheet" type="text/css" href="<?php echo base_url();?>assets/plugins/revolution/css/settings.css">
    <!-- Revolution Navigation Style -->
    <link rel="stylesheet" type="text/css" href="<?php echo base_url();?>assets/plugins/revolution/css/navigation.css">
    <!-- Google fonts -->
    <link
        href="https://fonts.googleapis.com/css?family=Montserrat:100,200,300,400,500,600,700,800,900|Open+Sans:300,400,600,700,800|Roboto:100,300,400,500,700,900"
        rel="stylesheet">


    <script src="<?php echo base_url();?>assets/js/jquery.min.js"></script>

    <!-- Revolution Slider 5.x CSS settings -->
    <link href="<?php echo base_url();?>assets/js/revolution-slider/css/settings.css" rel="stylesheet"
        type="text/css" />
    <link href="<?php echo base_url();?>assets/js/revolution-slider/css/layers.css" rel="stylesheet" type="text/css" />
    <link href="<?php echo base_url();?>assets/js/revolution-slider/css/navigation.css" rel="stylesheet"
        type="text/css" />
    <link rel="stylesheet" href="<?php echo base_url();?>assets/admin/font-awesome/4.5.0/css/font-awesome.min.css" />


    <script src="<?php echo base_url();?>assets/js/revolution-slider/js/jquery.themepunch.tools.min.js"></script>
    <script src="<?php echo base_url();?>assets/js/revolution-slider/js/jquery.themepunch.revolution.min.js"></script>

</head>

<body id="bg" class="boxed">

    <!-- <div id="loading-area"></div> -->
    <div class="page-wraper">
        <!-- header -->
        <header class="site-header header header-style-4 style-1">
            <div class="bg-white">
                <div class="container header-contant-block">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="logo-header1 "><a href="<?php echo base_url();?>"><img
                                        src="<?php echo base_url();?>assets/images/nar2.png"></a></div>
                        </div>

                    </div>
                </div>
            </div>
            <!-- main header -->
            <!-- <div> -->
            <div class="sticky-header main-bar-wraper">
                <div class="main-bar clearfix ">
                    <div class="navigation-bar bg-primary1">
                        <div class="container clearfix">
                            <!-- website logo -->
                            <div class="logo-header mostion"><a href="<?php echo base_url();?>"><img
                                        src="<?php echo base_url();?>assets/images/nar2.png" width="193" height="89"
                                        alt=""></a></div>
                            <!-- nav toggle button -->
                            <button data-target=".header-nav" data-toggle="collapse" type="button"
                                class="navbar-toggle collapsed"> <span class="sr-only">Toggle navigation</span> <span
                                    class="icon-bar"></span> <span class="icon-bar"></span> <span
                                    class="icon-bar"></span> </button>
                            <!-- extra nav -->

                            <!-- main nav -->
                            <div class="header-nav navbar-collapse collapse">
                                <ul class=" nav navbar-nav">
                                    <li class="active"> <a href="<?php echo base_url();?>">Home</a></li>
                                    <li class=""> <a href="<?php echo base_url();?>about_us">About - Us</a></li>

                                    <li><a href="#">Institution <i class="fa fa-caret-down" aria-hidden="true"
                                                style="font-size: 20px;"></i></a>
                                        <ul class="sub-menu">
                                            <?php
										if($this->session->userdata('school_code')==null || $this->session->userdata('loginstatus')==null)
										{
											?>
                                            <li><a href="<?php echo base_url('institution_login');?>">Login</a></li>
                                            <?php
										}
										else
										{
											?>
                                            <li><a href="<?php echo base_url('institution_dashboard');?>">Dashboard</a>
                                            </li>
                                            <li><a href="<?php echo base_url('logout_institution');?>">Logout</a></li>
                                            <?php
										}
										?>
                                            <li><a href="<?php echo base_url('institution');?>">Institutions / School
                                                    List</a></li>
                                            <li><a href="<?php echo base_url('assets/nursing_doc.pdf');?>">Download
                                                    Affiliation Form PDF</a></li>
                                        </ul>
                                    </li>

                                    <li class=""> <a href="<?php echo base_url('circulars');?>">Circulars</a></li>
                                    <li class=""> <a href="<?php echo base_url();?>download">Downloads</a></li>
                                    <li class=""> <a href="<?php echo base_url();?>fees">Fee</a></li>

                                    <li><a href="#">Student Corner <i class="fa fa-caret-down" aria-hidden="true"
                                                style="font-size: 20px;"></i></a>
                                        <ul class="sub-menu">
                                            <li class=""> <a href="<?php echo base_url();?>view_result">View Result</a>
                                            </li>

                                            <!--<li class=""> <a href="<?php echo base_url();?>student_renewal">Renewal</a></li>-->
                                            <li class=""> <a href="student_renewal/login.php">Renewal</a></li>
                                        </ul>
                                    </li>



                                    <li class=""> <a href="<?php echo base_url();?>members">Members<i
                                                class="fa fa-chevron-down"></i></a></li>

                                    <li class=""> <a href="<?php echo base_url();?>gallery">Gallery</a></li>
                                    <li class=""> <a href="<?php echo base_url();?>contact">Contact-Us</a></li>
                                    <li class=""> <a href="https://onlinesbi.sbi.bank.in/sbicollect/"
                                            target="_blank">Payment</a></li>
                                    <!--<li class=""> <a href="https://www.onlinesbi.sbi/sbicollect/icollecthome.htm"-->
                                    <!--        target="_blank">Payment</a></li>-->

                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- main header END -->
        </header>
        <!-- header END -->