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

    <section class="main-block light-bg" id="add-news-componet">
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
                                                    ข่าวประชาสัมพันธ์	</h5>
                                            </div>
                                        </div>
                                        <div class="col-md-12 mb-2">
                                            <div class="form-group">
                                                <label class="">หัวข้อเรื่อง</label>
                                                <input type="text" v-model="news.name" class="form-control form-control-lg form-control-a"
                                                    placeholder="หัวข้อเรื่อง">
                                            </div>
                                        </div>
                                        <div class="col-md-12 mb-2">
                                            <div class="form-group">
                                                <label class="">รายละเอียด</label>
                                                <textarea id="textMessage" v-model="news.description" class="form-control"
                                                    placeholder="รายละเอียด" cols="45" rows="8"
                                                    required=""></textarea>
                                            </div>
                                        </div>
                                        <div class="col-md-12 mb-2">
                                            <div class="form-group">
                                                <h5 class="" style="color: #3E8B9B; font-family: Cloud-Bold;">
                                                    ช่วงเวลาในการแสดงข่าวประชาสัมพันธ์นี้	</h5>
                                            </div>
                                        </div>
                                        <div class="col-md-12 mb-2">
                                            <div class="form-group">
                                                <label class="">* เลือกช่วงเวลาในการแสดงข่าวประชาสัมพันธ์นี้</label>
                                                <div class="input-daterange input-group" id="datepicker">
                                                    <input type="date" v-model="news.date_time_start" class="form-control-sm form-control" name="start"/>
                                                    <span class="input-group-addon">ถึง</span>
                                                    <input type="date" v-model="news.date_time_end" class="form-control-sm form-control" name="end"/>
                                                </div>
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
                                                    style="margin-bottom: 5px;" onclick="document.getElementById('img-file-input').click()">เพิ่มรูปภาพ</button>
                                                <label class="color-bb">** กรณีอัพเดตไฟล์รูปภาพสามารถเพิ่มรูปภาพได้ 1 ภาพ **</label>
                                                <img class="img-up" v-bind:src="'../asset/img/MAIN.png'" id="image-preview">
                                            </div>

                                        </div>
                                        <div class="col-md-12 mb-2">
                                            <div class="form-group">
                                                <label class="">url video youtube (ถ้ามี)</label>
                                                <input type="text" v-model="news.video_url" class="form-control form-control-lg form-control-a"
                                                    placeholder="url youtube">
                                            </div>                                          
                                            <button type="button" class="btn btn-primary1 block full-width m-b"
                                                @click="addNews()">เพิ่มข้อมูล</button>
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
    
    <!--//END FIND PLACES -->
    <?php echo view('admin/include/Footer'); ?>
    <!--//END FOOTER -->
    <?php echo view('admin/include/FooterJS'); ?>
    <script>
        $('.chosen-select').chosen({ width: "100%" });
    </script>
    <script src="../asset/js/custom_js/add-news-component.js"></script>
</body>

</html>