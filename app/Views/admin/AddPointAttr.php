<!DOCTYPE html>
<html>
<head>
<?php echo view('admin/include/Header'); ?>
</head>

<body class="gray-bg">

    <!--============================= HEADER =============================-->
    <?php echo view('admin/include/Nav'); ?>
    <!--============================= HEADER END =========================-->
    <section class="main-block light-bg">
        <div class="container">
            <div class="ibox-content">

            </div>
        </div>
    </section>

    <section class="main-block light-bg" id="add-point-attr-component">
        <div class="container">
            <div class="row">
                <div class="col-md-3 responsive-wrap cuxdxtrip">
                </div>
                <div class="col-md-6 responsive-wrap">
                    <div class="widget bg-trip1 ">
                        <div class="row">
                            <div class="col-md-12 responsive-wrap">
                                <form class="form-a">
                                    <div class="row">
                                        <div class="col-md-12 mb-2">
                                            <div class="form-group">
                                                <h5 class="" style="color: #3E8B9B; font-family: Cloud-Bold;">
                                                    ข้อมูลภายในสถานที่ {{attraction.attr_name}}	</h5>
                                            </div>
                                        </div>
                                        <div class="col-md-12 mb-2">
                                            <div class="form-group">
                                                <label class="">หัวข้อเรื่อง</label>
                                                <input type="text" class="form-control form-control-lg form-control-a"
                                                    placeholder="ตักบาตรข้าวเหนียว" v-model="hostpot.point_name">
                                            </div>
                                        </div>
                                        <div class="col-md-12 mb-2">
                                            <div class="form-group">
                                                <label class="">รายละเอียด</label>
                                                <textarea id="textMessage" class="form-control"
                                                    placeholder="รายละเอียด" cols="45" rows="8"
                                                    required="" v-model="hostpot.details"></textarea>
                                            </div>
                                        </div>
                                        <div class="col-md-12 mb-2">
                                            <div class="form-group">
                                                <h5 class="" style="color: #3E8B9B; font-family: Cloud-Bold;">
                                                     ไฟล์เสียงคำบรรยาย
                                                </h5>
                                            </div>
                                        </div>
                                        <div class="col-md-12 mb-2">
                                            <div class="form-group">
                                                <input type="file" accept="audio/mp3" id="audio-file-input" style="display:none;" @click="getAudioFile()" @change="getAudioFile()">
                                                <button type="button" class="btn btn-primary1 float-right" style="margin-bottom: 5px;" 
                                                onclick="document.getElementById('audio-file-input').click()">
                                                    เพิ่มไฟล์เสียงคำบรรยาย
                                                </button>
                                                <label class="color-bb">** กรณีอัพเตดเสียงคำบรรยาย รองรับ mp3 เท่านั้น **</label>
                                            </div>
                                        </div>
                                        <div class="col-md-12 mb-2">
                                            <div class="form-group">
                                                <h5 class="" style="color: #3E8B9B; font-family: Cloud-Bold;">
                                                    รูปภาพประกอบ
                                                </h5>
                                            </div>
                                        </div>
                                        <div class="col-md-12 mb-2">
                                            <div class="form-group">
                                                <input type="file" accept="image/*" id="img-file-input" style="display:none;" @click="getImgFile()" @change="getImgFile()">
                                                <button type="button" class="btn btn-primary1 float-right"
                                                    style="margin-bottom: 5px;" 
                                                    onclick="document.getElementById('img-file-input').click()">
                                                    เพิ่มรูปภาพ
                                                </button>
                                                <label class="color-bb">** กรณีอัพเดตไฟล์รูปภาพสามารถเพิ่มรูปภาพได้ 1 ภาพ **</label>
                                                <img class="img-up" v-bind:src="'../asset/img/MAIN.png'" id="image-preview">
                                            </div>
                                            <button type="button" class="btn btn-primary1 block full-width m-b"
                                                data-toggle="modal"  @click="addHostpotToApi()">เพิ่มข้อมูล</button>
                                                <!-- Modal data-target="#ModaladAdd"-->
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-3 responsive-wrap cuxdxtrip">
                </div>
            </div>
        </div>
    </section>
    <!--ModaladAdd-->
    <div class="modal inmodal fade" id="ModaladAdd" tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header-map1">
                    <button type="button" class="close" data-dismiss="modal" style="color: #3E8B9B;"><span
                            aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
                </div>
                <div class="ibox-content-hhh">
                    <div class="form-group">
                        <h6 class="text-back text-center">กำลังอัพเดตข้อมูล</h6>
                    </div>
                    <div class="form-group" style="padding: 5px 15px 0px;">
                        <p class="text-back text-center">ได้ทำการอัพเดต เพิ่มข้อมูลเรียบร้อยเเล้ว สามารถตรวจเช็คจากหน้า VR ได้เลย</p>
           
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!--//END FIND PLACES -->
    <?php echo view('admin/include/FooterJS'); ?>
    <script>
        $('.chosen-select').chosen({ width: "100%" });
    </script>
    <script src="../asset/js/custom_js/add-point-attr-component.js"></script>
</body>

</html>