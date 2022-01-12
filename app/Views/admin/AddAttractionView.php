<div class="modal inmodal fade" id="add-attration-component" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header-map1">
                <button type="button" class="close" data-dismiss="modal" style="color: #3E8B9B;"><span
                        aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
            </div>
            <div class="ibox-content-hhh">
                <div class="form-group">
                    <h6 class="text-back text-center">ต้องการเพิ่มข้อมูลสถานที่</h6>
                </div>
                <div class="form-group" style="padding: 5px 15px 0px;">
                    <label class="">ชื่อสถานที่</label>
                    <input type="text" class="form-control form-control-lg form-control-a"
                        placeholder="ชื่อสถานที่" v-model="att_name_form">
                    </br>
                    <label class="error">{{error_msg}}</label>

                </div>
                <div class="form-group" style="padding: 5px 15px 0px;">
                    <button type="button" class="btn btn-primary1 float-right " @click="addAttraction">เพิ่มข้อมูล</button>
                </div>

            </div>
        </div>
    </div>
</div>
