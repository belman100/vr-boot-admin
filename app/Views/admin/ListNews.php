<div class="row">                    
    <div class="col-lg-1 responsive-wrap">
    </div>
    <div class="col-lg-10" style="background-color:powderblue;">
        <div class="row">
            <div class="col-lg-6">
                <div class="widget p-lg text-center">
                    <div class="m-b-md">
                        <h4 class="text-back">ข้อมูลข่าวสาร</h4>
                    </div>
                </div>
            </div> 
            <div class="col-lg-6">
                <div class="widget p-lg text-center">
                    <div class="m-b-md">
                        <a class="btn btn-primary1 float-right" href="../admin/add-news">เพิ่มข้อมูลข่าวสาร</a>
                        <a class="btn btn-primary2 float-right" href="../preview-news/61d85ed74a41313a64469803" target="_blank">ดู preview ข่าวสาร</a>
                    </div>                    
                </div>
            </div>
        </div>
        <div class="ibox-content" id="news-list-component">
            <table class="table table-striped">
                <thead>
                    <tr>
                        <th></th>
                        <th>รูปภาพ</th>
                        <th>หัวข้อข่าวสาร</th>
                        <th>รายละเอียด</th>
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
                            <a type="button"
                                class="btn btn-info btn-xs"
                                style="color: rgb(255, 255, 255);margin-right: 5px;" @click="gotoNewsViewPage(ne._id.$oid)">ดูพรีวิว</a>                                                                
                            <a type="button" 
                                class="btn btn-primary1 btn-xs"
                                style="color: rgb(255, 255, 255);margin-right: 5px;" @click="editNews(ne._id.$oid)">แก้ไขข้อมูล</a>                                                                
                            <a type="button" 
                                class="btn btn-danger btn-xs"
                                style="color: rgb(255, 255, 255);margin-right: 5px;" @click="deleteNews(ne._id.$oid)">ลบ</a>                                                            
                        </td>
                    </tr>
                </tbody>
            </table>                                
        </div>
    </div>
</div>