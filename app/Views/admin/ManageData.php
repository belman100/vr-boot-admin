<!DOCTYPE html>
<html lang="en">

<head>
    <?php echo view('admin/include/Header'); ?>
</head>

<body>    
    <!--============================= HEADER =============================-->
    <?php echo view('admin/include/Nav'); ?>
    <!--============================= HEADER END =============================-->    
        <!-- SLIDER -->
        <section id="" class="main-block light-bg">
            <div class="m-t">
                <div class="container" id="dasbord-component">
                    <div class="row">
                        <div class="col-lg-1 responsive-wrap">
                        </div>
                        <div class="col-lg-10">
                            <div class="row">
                                <div class="col-lg-6">
                                    <div class="widget navy-bg p-lg text-center">
                                        <div class="m-b-md">
                                            <i class="fa fa-map-signs fa-4x"></i>
                                            <h1 class="m-xs">{{attractionCount}}</h1>
                                            <h3 class="font-bold no-margins" style="font-family: Cloud-Bold;">
                                                สถานที่
                                            </h3>
                                            <small>ข้อมูลล่าสุด</small>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <div class="widget lazur-bg p-lg text-center">
                                        <div class="m-b-md">
                                            <i class="fa fa-map-pin fa-4x"></i>
                                            <h1 class="m-xs">{{hotspotCount}}</h1>
                                            <h3 class="font-bold no-margins" style="font-family: Cloud-Bold;">
                                                hotspot
                                            </h3>
                                            <small>จากทุกสถานที่</small>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-1 responsive-wrap">
                        </div>
                    </div>
                    <?php echo view('admin/ListPreviewAttractionCount'); ?>                    
                </div>                
            </div>            
        </section>
        
            
            <!--// SLIDER -->
            <!--//END HEADER -->
            <!--============================= menu =============================-->
            <?php echo view('admin/ListAttractionAndHostport'); ?>
            <!--ModaladAdd-info-->
            <?php echo view('admin/AddAttractionView'); ?>
            <!--ModaladAdd-->
            <div class="modal inmodal fade" id="ModaladAdd" tabindex="-1" role="dialog" aria-hidden="true">
                <div class="modal-dialog modal-lg">
                    <div class="modal-content">
                        <div class="modal-header-map">
                            <button type="button" class="close" data-dismiss="modal"
                                style="color: #ffffff; font-size: 30px;"><span aria-hidden="true">&times;</span><span
                                    class="sr-only">Close</span></button>
                        </div>
                        <div class="ibox-content-hhhh">
                            <div class="row">
                                <div class="col-md-6 responsive-wrap cuxdxtrip">
                                    <div class="widget bg-infoo text-center align-items-center">
                                    </div>
                                </div>
                                <div class="col-md-6 responsive-wrap">
                                    <div class="col-md-12 responsive-wrap">
                                        <div class="section">
                                            <a href=""><img class="img-iconplay float-right" src="../asset/img/icn_pu.png" alt=""
                                                    title=""></a>
                                            <h1 style="color: #ffffff; font-family: Cloud-Bold;">
                                                แม่น้ำโขง</h1>
                                            <br>
                                            <h6 class="text-white">
                                                แม่น้ำโขงมีต้นกำเนิดมาจากการละลายของน้ำแข็งและหิมะบริเวณที่ราบสูงทิเบตในบริเวณตอนเหนือของทิเบตประเทศจีน
                                                ซึ่งเป็นแหล่งกำเนิดของแม่น้ำที่สำคัญอีก 2 สาย คือ แม่น้ำแยงซี
                                                และแม่น้ำสาละวิน
                                                แม่น้ำโขงช่วงที่ไหลผ่านประเทศจีนชาวจีนเรียกว่า แม่น้ำหลานชางเจียง </h6>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!--ModaladAdd-youtube-->
            <div class="modal inmodal fade" id="ModaladAdd-youtube" tabindex="-1" role="dialog" aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header-map1">
                            <button type="button" class="close" data-dismiss="modal" style="color: #3E8B9B;"><span
                                    aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
                        </div>
                        <div class="ibox-content-hhh">
                            <div class="form-group">
                                <h6 class="text-back text-center">อัพเดต url
                                    video youtube บนหน้า แรก VR</h6>
                            </div>
                            <div class="form-group" style="padding: 5px 15px 0px;">
                                <label class="">youtube</label>
                                <input type="text" class="form-control form-control-lg form-control-a" placeholder="url video youtube" v-model="video.video_url">

                            </div>
                            <div class="form-group" style="padding: 5px 15px 0px;">
                                <button type="button" class="btn btn-primary1 float-right " @click="addEditVideo()">อัพเดตข้อมูล</button>
                            </div>

                        </div>
                    </div>
                </div>
            </div>
            <!--//END FIND PLACES -->
            <?php echo view('admin/include/Footer'); ?>
            <!--//END FOOTER -->        
        <?php echo view('admin/include/FooterJS'); ?>
        <script src="../asset/js/custom_js/dasbord.js"></script>        
        <script src="../asset/js/custom_js/content-component.js"></script>
        <script src="../asset/js/custom_js/add-attraction-component.js"></script>
        <script src="../asset/js/custom_js/add-edit-video.js"></script>
        

</body>

</html>