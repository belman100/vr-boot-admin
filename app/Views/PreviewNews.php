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
    <!--sweetalert2-->
    <link href="../asset/css/sweetalert2.min.css" rel="stylesheet">
    <script src="../asset/js/sweetalert2.min.js"></script>
    <!-- vue js -->    
    <script src="https://cdn.jsdelivr.net/npm/vue@3.2.27/dist/vue.global.prod.min.js"></script>
    <!--- axios -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/axios/0.24.0/axios.min.js" integrity="sha512-u9akINsQsAkG9xjc1cnGF4zw5TFDwkxuc9vUp5dltDWYCSmyd0meygbvgXrlc/z7/o4a19Fb5V0OUE58J7dcyw==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>

</head>

<body style="background: #e2e2e2;">
    <!--============================= menu =============================-->
    <div class="" style="min-height: 400px; " id="news-show-all">
        <div>
            <div class="swiper-container">
                <div id="carouselExampleIndicators" class="carousel slide" data-ride="carousel">
                    <ol class="carousel-indicators">
                        <li data-target="#carouselExampleIndicators" data-slide-to="0" class="active"></li>
                        <li data-target="#carouselExampleIndicators" data-slide-to="1"></li>
                    </ol>
                    <div class="carousel-inner">                        
                        <div class="carousel-item" v-for="(ne,i) in news" ::key="ne._id.$oid" :class="{ active: i==0 }">
                            <a v-bind:href="'../preview-news-details/' + ne._id.$oid" target="_blank">
                                <section class="slider2 d-flex align-items-center" 
                                    v-bind:style="{ backgroundImage: 'url(../resource/image/' + ne.image_name + ')' }">                                    
                                    <div class="container">
                                        <div class="row d-flex justify-content-left">
                                            <div class="col-md-8">
                                                <div class="slider-title_box">
                                                    <div class="ibox-top-main">
                                                        <h4 class="text-white" style="font-family: Cloud-Bold;">
                                                            {{ne.name}}
                                                        </h4>
                                                        <h6 class="">ข่าวประชาสัมพันธ์</h6>
                                                        <p >ดูรายละเอียดเพิ่มเติม</p>
                                                        <br>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </section>
                            </a>
                        </div>                        
                    </div>
                    <a class="carousel-control-prev" href="#carouselExampleIndicators" role="button" data-slide="prev">
                        <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                        <span class="sr-only">Previous</span>
                    </a>
                    <a class="carousel-control-next" href="#carouselExampleIndicators" role="button" data-slide="next">
                        <span class="carousel-control-next-icon" aria-hidden="true"></span>
                        <span class="sr-only">Next</span>
                    </a>
                </div>
            </div>
        </div>
    </div>
    <!-- jQuery, Bootstrap JS. -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="../asset/js/jquery-3.2.1.min.js"></script>
    <script src="../asset/js/popper.min.js"></script>
    <script src="../asset/js/bootstrap.min.js"></script>
    <!-- slick carousel-->
    <script src="../asset/js/plugins/slick/slick.min.js"></script>
    <script src="../asset/js/custom_js/pre-view-all-news-public.js"></script>
</body>

</html>