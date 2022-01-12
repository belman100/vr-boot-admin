<!DOCTYPE html>
<html lang="en">

<head>
    <?php echo view('admin/include/Header'); ?>
</head>

<body>    
    <!--============================= HEADER =============================-->
    <!--<?php echo view('admin/include/Nav'); ?>-->
    <!-- SLIDER -->
    <div id="login-component">
    <div class="main-top-wrap">
        <section class="slider d-flex align-items-center">
            <div class="container">
                <div class="row d-flex justify-content-left">
                    <div class="col-md-8">
                        <div class="slider-title_box">
                            <div class="ibox-top-main">
                                <h4 class="text-white" style="font-family: Cloud-Bold;">WELCOME TO VR
                                    BOOT LOEI PROVINCE </h4>
                                <h6 class="">สัมผัสประสบการณ์การท่องเที่ยวรูปแบบใหม่ </h6>
                                <p>ผ่านเทคโนโลยี AR และ VR แบบ 360 องศา </p>
                                <br>
                            </div>
                        </div>
                        <div class="col-md-8">
                            <a href="#login">
                                <div class="ibox-content-top">
                                        <h6 class="float-right">&gt;</h6>
                                    <h5 class="font-bold">ระบบจัดการข้อมูล</h5>
                                    <p class="">ทำการเข้าสู่ระบบเพิ่อทำการจัดการข้อมูล</p>
                                </div>
                            </a>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="ibox-img-360">
                            <img class="iconmain" src="../asset/img/222.gif" alt="" title="">
                        </div>
                    </div>

                </div>
            </div>
        </section>
    </div>
    <!--// SLIDER -->
    <!--//END HEADER -->
    <!--============================= menu =============================-->
    <section id="login" class="main-block light-bg">
        <div class="container">
            <div class="row">
                <div class="col-md-6 responsive-wrap cuxdxtrip">
                    <div class="main-top-wrap">
                        <div class="widget bg-login text-center align-items-center">
                            <div class="ibox-footer-login">
                                <h3 class="text-white" style="font-family: Cloud-Bold;">พพบกับบูธการจำลองแบบ 3D ภายในจังหวัดเลย</h3>
                                <br>
                                <p class="text-white ">สัมผัสประสบการณ์การท่องเที่ยวรูปแบบใหม่<br>ในแบบ 360 องศา</p>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-6 responsive-wrap">
                    <div class="widget bg-login1 ">
                        <div class="row">
                            <div class="col-md-2 responsive-wrap"></div>
                            <div class="col-md-8 responsive-wrap">
                                <form class="m-tt" role="form">
                                    <h4 style="color: #3E8B9B; font-family: Cloud-Bold;">
                                        เพิ่อการใช้งานที่ง่ายขึ้น</h4>
                                    <p class="text-muted">
                                        <small>ทำการเข้าสู่ะบบก่อนใช้งาน</small>
                                    </p>
                                    <div class="form-group">
                                        <input type="" class="form-control" placeholder="ชื่อผู้ใช้" required="" v-model="username">
                                    </div>
                                    <div class="form-group">
                                        <input type="password" class="form-control" placeholder="รหัสผ่าน" required="" v-model="password">
                                    </div>
                                    <button type="button" class="btn  btn-primary1 block full-width m-b" @click="login" >เข้าสู่ระบบ</button>                                        
                                </form>
                            </div>
                            <div class="col-md-2 responsive-wrap"></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!--//END FIND PLACES -->
    <?php echo view('admin/include/Footer'); ?>
    <!--//END FOOTER -->
    <!-- jQuery, Bootstrap JS. -->
    </div>
    <?php echo view('admin/include/FooterJS'); ?>
    <script src="../asset/js/custom_js/login.js"></script>


</body>

</html>