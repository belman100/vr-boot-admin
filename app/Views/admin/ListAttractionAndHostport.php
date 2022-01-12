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
                        <!--<li>
                            <a class="nav-link active" data-toggle="tab" href="#tab-1" @click="getTypeAttraction(0)">จัดการข้อมูล VR
                                DESTINATIONS</a>
                        </li>-->
                        <li><a class="nav-link active" data-toggle="tab" href="#tab-1" @click="getTypeAttraction(1)">จัดการข้อมูล VR BOOT</a></li>
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
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-1 responsive-wrap">
            </div>
        </div>
    </div>
</section>
