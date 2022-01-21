<!DOCTYPE html>
<html lang="en">

<head>
<?php echo view('admin/include/Header'); ?>
</head>

<body style="background: #e2e2e2;">
    <!--============================= menu =============================-->
    <div class="" style="min-height: 400px; ">
        <div>
            <div class="swiper-container">
                <div id="carouselExampleIndicators" class="carousel slide" data-ride="carousel">
                    <ol class="carousel-indicators">
                        <li data-target="#carouselExampleIndicators" data-slide-to="0" class="active"></li>
                        <li data-target="#carouselExampleIndicators" data-slide-to="1"></li>
                    </ol>
                    <div class="carousel-inner">
                        <div class="carousel-item active">
                            <a href="news.html" target="_blank">
                                <section class="slider2 d-flex align-items-center">
                                    <div class="container">
                                        <div class="row d-flex justify-content-left">
                                            <div class="col-md-8">
                                                <div class="slider-title_box">
                                                    <div class="ibox-top-main">
                                                        <h4 class="text-white" style="font-family: Cloud-Bold;">
                                                            ร่วมเวียนเทียนออนไลน์
                                                        </h4>
                                                        <h6 class="">ข่าวประชาสัมพันธ์ </h6>
                                                        <p>ดูรายละเอียดเพิ่มเติม</p>
                                                        <br>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </section>
                            </a>
                        </div>
                        <div class="carousel-item ">
                            <a href="news.html" target="_blank">
                                <section class="slider2 d-flex align-items-center">
                                    <div class="container">
                                        <div class="row d-flex justify-content-left">
                                            <div class="col-md-8">
                                                <div class="slider-title_box">
                                                    <div class="ibox-top-main">
                                                        <h4 class="text-white" style="font-family: Cloud-Bold;">
                                                            ร่วมเวียนเทียนออนไลน์
                                                        </h4>
                                                        <h6 class="">ข่าวประชาสัมพันธ์ </h6>
                                                        <p>ดูรายละเอียดเพิ่มเติม</p>
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
    <?php echo view('admin/include/FooterJS'); ?>
</body>

</html>