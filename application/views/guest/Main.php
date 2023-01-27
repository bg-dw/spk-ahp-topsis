<html lang="en" dir="ltr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="msapplication-TileColor" content="#0061da">
    <meta name="theme-color" content="#1643a3">
    <meta name="apple-mobile-web-app-status-bar-style" content="black-translucent">
    <meta name="apple-mobile-web-app-capable" content="yes">
    <meta name="mobile-web-app-capable" content="yes">
    <meta name="HandheldFriendly" content="True">
    <meta name="MobileOptimized" content="320">
    <link rel="icon" href="favicon.ico" type="image/x-icon">
    <link rel="shortcut icon" type="image/x-icon" href="favicon.ico">

    <!-- Title -->
    <title>ADMINOR TEMPLATE</title>
    <?php $this->load->view('admin/_layout/_header_link'); ?>
    <style>
        .slidecontainer {
            width: 100%;
            /* Width of the outside container */
        }

        /* The slider itself */
        .slider {
            -webkit-appearance: none;
            /* Override default CSS styles */
            appearance: none;
            width: 100%;
            /* Full-width */
            height: 10px;
            border-radius: 5px;
            /* Specified height */
            background: #d3d3d3;
            /* Grey background */
            outline: none;
            /* Remove outline */
            opacity: 0.7;
            /* Set transparency (for mouse-over effects on hover) */
            -webkit-transition: .2s;
            /* 0.2 seconds transition on hover */
            transition: opacity .2s;
        }

        /* Mouse-over effects */
        .slider:hover {
            opacity: 1;
            /* Fully shown on mouse-over */
        }

        /* The slider handle (use -webkit- (Chrome, Opera, Safari, Edge) and -moz- (Firefox) to override default look) */
        .slider::-webkit-slider-thumb {
            -webkit-appearance: none;
            /* Override default look */
            appearance: none;
            width: 25px;
            /* Set a specific slider handle width */
            height: 25px;
            border-radius: 50%;
            /* Slider handle height */
            background: purple;
            /* Green background */
            cursor: pointer;
            /* Cursor on hover */
        }

        .slider::-moz-range-thumb {
            width: 25px;
            /* Set a specific slider handle width */
            height: 25px;
            border-radius: 50%;
            /* Slider handle height */
            background: purple;
            /* Green background */
            cursor: pointer;
            /* Cursor on hover */
        }
    </style>

</head>

<body class="">
    <div id="global-loader"></div>
    <div class="page">
        <div class="page-main">
            <div class="app-header1 header py-1 d-flex">
                <div class="container-fluid">
                    <div class="d-flex">
                        <a class="header-brand" href="<?= base_url('') ?>">
                            <img src="<?= base_url('') ?>\assets\images\brand\logo.png" class="header-brand-img" alt="adminor logo">
                        </a>
                        <div class="d-flex order-lg-2 ml-auto header-right-icons header-search-icon">
                            <div class="dropdown d-none d-md-flex">
                                <a class="nav-link icon full-screen-link nav-link-bg">
                                    <i class="fa fa-expand" id="fullscreen-button"></i>
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="wrapper">
                <!-- Sidebar Holder -->
                <div class="content-area">
                    <?php $this->load->view($content); ?>
                </div>
            </div>
        </div>

        <?php $this->load->view('admin/_layout/_footer'); ?>
    </div>
    <!-- Back to top -->
    <a href="#top" id="back-to-top" style="display: inline;"><i class="fa fa-angle-up"></i></a>

    <?php $this->load->view('Alerts'); ?>
    <?php $this->load->view('admin/_layout/_footer_link'); ?>
</body>

</html>