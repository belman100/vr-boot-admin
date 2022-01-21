<section id="content-component" class="main-block light-bg">
    <div class="container">
        <div class="row">
            <div class="col-lg-1 responsive-wrap">
            </div>
            <div class="col-lg-10 responsive-wrap">
                <div class="tabs-container">
                    <button type="button" class="btn btn-primary1 float-right" data-toggle="modal"
                        data-target="#add-attration-component" >เพิ่มตารางสถานที่</button>
                    <ul class="nav nav-tabs" role="tablist">
                        <li>
                            <a class="nav-link active" data-toggle="tab" href="#tab-1" >จัดการข้อมูล VR
                                DESTINATIONS</a>
                        </li>
                        <li><a class="nav-link" data-toggle="tab" href="#tab-2" >จัดการข้อมูลข่าวสาร</a></li>
                    </ul>
                    <div class="tab-content">
                        <div role="tabpanel" id="tab-1" class="tab-pane active" >
                            <div class="row" v-if="attraction != null">
                                <div class="col-lg-12 responsive-wrap" >
                                    <!--item1-->
                                    <div class="ibox " v-for="(attr,i) in attraction" :key="attr._id">
                                        <div class="ibox-title">
                                            <h4 class="text-back " style="font-family: Cloud-Bold;">
                                                {{attr.attr_name}}
                                            </h4>
                                            <div class="ibox-tools">
                                                <a type="button" class="btn btn-primary float-right text-white" @click="gotoAddPointAttr(attr)">เพิ่มข้อมูลในสถานที่</a>
                                            </div>
                                        </div>
                                        <div class="ibox-content">
                                            <table class="table table-striped">
                                                <thead>
                                                    <tr>
                                                        <th></th>
                                                        <th>รูปภาพ</th>
                                                        <th>หัวข้อเรื่อง</th>
                                                        <th>รายละเอียด</th>
                                                        <th>เครื่องมือ</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    <tr v-for="(point,j) in attr.attraction_point" :key="point._id">
                                                        <td>{{j + 1}}</td>
                                                        <td>
                                                            <img alt="image" class="img-iconN rounded-circle" 
                                                                v-if="point.image_file_name == ''" 
                                                                src="../asset/img/MAIN.png">
                                                            <img alt="image" class="img-iconN rounded-circle"
                                                                v-else
                                                                v-bind:src="'../resource/image/'+point.image_file_name">
                                                        </td>
                                                        <td class="text-navy"> {{point.point_name}}</td>
                                                        <td>
                                                            <p class="overflow-ellipsis">{{point.details}}</p>
                                                        </td>
                                                        <td> 
                                                            <a type="button" 
                                                                class="btn btn-info btn-xs"
                                                                style="color: rgb(255, 255, 255);margin-right: 5px;" @click="gotoViewPage(point._id.$oid)">ดูพรีวิว</a>                                                                
                                                            <a type="button" 
                                                                class="btn btn-primary1 btn-xs"
                                                                style="color: rgb(255, 255, 255);margin-right: 5px;" @click="editPointAttr(point._id.$oid)">แก้ไขข้อมูล</a>                                                                
                                                            <a type="button" 
                                                                class="btn btn-danger btn-xs"
                                                                style="color: rgb(255, 255, 255);margin-right: 5px;" @click="deletePointAttr(i,j)">ลบ</a>                                                            
                                                        </td>
                                                    </tr>
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                    <!--item1 END-->                                    
                                </div>
                            </div>
                        </div>
                        <div role="tabpanel" id="tab-2" class="tab-pane">
                            <div class="row">
                                <div class="col-lg-12 responsive-wrap">
                                    <!--item1-->
                                    <div class="ibox ">
                                        <div class="ibox-title">
                                            <h4 class="text-back " style="font-family: Cloud-Bold;">
                                                ข่าวสารประชาสัมพันธ์
                                            </h4>
                                            <div class="ibox-tools">
                                                <a type="button" href="../admin/add-news"
                                                    class="btn btn-success float-right" >เพิ่มข้อมูลข่าวสาร</a>
                                                <button type="button" class="btn btn-primary1"
                                                    data-toggle="modal" data-target="#ModaladAdd-youtube">อัพเดต
                                                    url
                                                    video youtube บนหน้า แรก VR</button>
                                            </div>
                                        </div>
                                        <div class="ibox-content">
                                            <table class="table table-striped">
                                                <thead>
                                                    <tr>
                                                        <th></th>
                                                        <th>รูปภาพ</th>
                                                        <th>หัวข้อเรื่อง</th>
                                                        <th>รายละเอียด</th>
                                                        <th>สถานะ</th>
                                                        <th>เครื่องมือ</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    <tr v-for="(ne,i) in news" :key="ne._id.$oid">
                                                        <td>{{i + 1}}</td>
                                                        <td>
                                                        <img alt="image" class="img-iconN rounded-circle" 
                                                            v-if="ne.image_name == ''" 
                                                            src="../asset/img/MAIN.png">
                                                        <img alt="image" class="img-iconN rounded-circle"
                                                            v-else
                                                            v-bind:src="'../resource/image/news/'+ne.image_name">
                                                        </td>
                                                        <td class="text-navy"> {{ne.name}}</td>
                                                        <td>
                                                            <p class="overflow-ellipsis">{{ne.details}}</p>
                                                        </td>
                                                        <td>
                                                            <span class="label label-primary" v-if="checkActiveByDateTime(ne.date_time_start_valid,ne.date_time_end_valid)">แสดงแล้ว</span>
                                                            <span class="label label-warning" v-else>ยังไม่ถึงเวลา</span>
                                                            <br>
                                                            <small>{{previewDate(ne.date_time_start_valid)}} ถึง {{previewDate(ne.date_time_end_valid)}}</small>
                                                        </td>
                                                        <td> <a type="button" 
                                                                class="btn btn-primary1 btn-xs"
                                                                style="color: rgb(255, 255, 255);" @click="editNews(ne._id.$oid)">แก้ไขข้อมูล</a>
                                                            <a type="button"  class="btn btn-info btn-xs"
                                                                style="color: rgb(255, 255, 255);" @click="gotoNewsViewPage(ne._id.$oid)">ดูพรีวิว</a>
                                                            <a type="button" 
                                                                class="btn btn-danger btn-xs"
                                                                style="color: rgb(255, 255, 255);" @click="deleteNews(ne._id.$oid)">ลบ</a>
                                                        </td>
                                                    </tr>                                                    
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                    <!--item1 END-->
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-1 responsive-wrap">
            </div>
        </div>
    </div>
</section>
