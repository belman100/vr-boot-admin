<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">
    <meta name="keywords" content="#">

    <title>360 VR Destinations Loei Province</title>
    <link rel="apple-touch-icon" href="../asset/img/icon VR.png">
    <link rel="shortcut icon" type="image/ico" href="../asset/img/icon VR.png" />

    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css?family=Roboto:300,400,400i,500,700,900" rel="stylesheet">

    <!-- Bootstrap core CSS -->
    <link href="../asset/css/bootstrap.min.css" rel="stylesheet">

    <!-- Animation CSS -->
    <link href="../asset/css/animate.css" rel="stylesheet">
    <link href="../asset/font-awesome/css/font-awesome.min.css" rel="stylesheet">

    <!-- Simple line Icon -->
    <link rel="stylesheet" href="../asset/css/simple-line-icons.css">

    <!-- Themify Icon -->
    <link rel="stylesheet" href="../asset/css/themify-icons.css">

    <!-- Main CSS -->
    <link rel="stylesheet" href="../asset/css/style.css">
    <link rel="stylesheet" href="../asset/css/style1.css">

    <link href="../asset/css/plugins/slick/slick.css" rel="stylesheet">
    <link href="../asset/css/plugins/slick/slick-theme.css" rel="stylesheet">
    <!--sweetalert2-->
    <link href="../asset/css/sweetalert2.min.css" rel="stylesheet">
    <script src="../asset/js/sweetalert2.min.js"></script>
    <!-- vue js -->    
    <script src="https://cdn.jsdelivr.net/npm/vue@3.2.27/dist/vue.global.min.js"></script>
    <!--- axios -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/axios/0.24.0/axios.min.js" integrity="sha512-u9akINsQsAkG9xjc1cnGF4zw5TFDwkxuc9vUp5dltDWYCSmyd0meygbvgXrlc/z7/o4a19Fb5V0OUE58J7dcyw==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
</head>

<body>
    <!--============================= HEADER =============================-->
    <div class="nav-menu">
        <div class="bg light-bg">
            <div class="container-fluid ">
                <div class="row">
                    <div class="col-md-12">
                        <nav class="navbar navbar-expand-lg navbar-light">
                            <a class="navbar-brand" href="">
                                <img class="icon" src="../asset/img/icon VR.png" alt="" title="">
                            </a>
                            <button class="navbar-toggler" type="button" data-toggle="collapse"
                                data-target="#navbarNavDropdown" aria-controls="navbarNavDropdown" aria-expanded="false"
                                aria-label="Toggle navigation">
                                <i class="fa fa-bars"></i>
                            </button>
                            <div class="collapse navbar-collapse justify-content-end" id="navbarNavDropdown">
                                <ul class="nav navbar-top-links navbar-right">
                                    <li class="dropdown" >
                                        <a href="https://lanexanginfo.com/" target="_blank">
                                            <button class="btn btn-primary1 btn-xs dropdown-toggle"
                                                data-toggle="dropdown">เข้าสู่เว็ป VR
                                                DESTINATIONS LOEI</button>
                                        </a>
                                    </li>
                                </ul>
                            </div>
                        </nav>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- SLIDER -->
    <section id="news-details-component" class="main-block light-bg">
        <div class="m-t">
            <div class="container">
                <div class="row">
                    <div class="col-lg-1 responsive-wrap">
                    </div>
                    <div class="col-lg-10">
                        <div class="row">
                            <h3 class="col-12" style="color: #3E8B9B; font-family: Cloud-Bold;">
                                {{news.name}} </h3>
                            <p class="text-back" style="font-family: Cloud-Bold;"></p>
                            <div class="">
                                <img v-if="news.image_name == ''" src="../asset/img/pics_topic_1855.png" alt="" class="img-news img-fluid">
                                <img v-else="news.image_name != ''" v-bind:src="'../resource/image/news/' + news.image_name" alt="" class="img-news img-fluid">
                            </div>
                            <h5 class="col-12" style="color: #3E8B9B; font-family: Cloud-Bold;">
                                รายละเอียด </h5>
                            <p class="text-back" style="font-family: Cloud-Bold;">{{news.details}}</p>
                            <iframe class="effect-ruby d-block w-100 img-lggg" style="margin-bottom: 10px;"
                                v-bind:src="'https://www.youtube.com/embed/' + news.video_youtube" frameborder="0"
                                allow="accelerometer; autoplay; encrypted-media; gyroscope; picture-in-picture"
                                allowfullscreen=""></iframe>
                            <div class="float-right">
                                <p class="text-back" style="font-family: Cloud-Bold;">ประกาศเมื่อ {{formatDateThai(news.updated_at)}}<br>
                                    ผู้เขียนโดย admin</p>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-1 responsive-wrap">
                    </div>
                </div>
            </div>
        </div>
        </div>
    </section>

        <!--// SLIDER -->
        <!--//END HEADER -->
        <!--============================= menu =============================-->

        <!--//END FIND PLACES -->
        <footer class="main-block light1-bg">
            <div class="container">
                <a class="navbar-brand" href="">
                    <img class="icon" src="" alt="" title="">
                </a>
                <div class="row justify-content-center">
                    <div class="col-md-12">
                        <img class="iconfooter" src="../asset/img/icon VR FOOTER.png" alt="" title="">
                        <br>
                        <p>Copyright &copy; 2019-2020
                            <a href="" class="text-white" target="_blank">VR Destinations Loei Province </a> Listing.
                            All
                            rights
                            reserved
                        </p>
                    </div>
                </div>
            </div>
        </footer>
        <!--//END FOOTER -->
        <!-- jQuery, Bootstrap JS. -->
        <!-- jQuery first, then Popper.js, then Bootstrap JS -->
        <script src="../asset/js/jquery-3.2.1.min.js"></script>
        <script src="../asset/js/popper.min.js"></script>
        <script src="../asset/js/bootstrap.min.js"></script>

        <!-- slick carousel-->
        <script src="../asset/js/plugins/slick/slick.min.js"></script>
        <script src="../asset/js/custom_js/view-news-details-component.js"></script>


</body>

</html>