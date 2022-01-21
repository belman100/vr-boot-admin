<div class="row">
    <div class="col-lg-1 responsive-wrap">
    </div>
    <div class="col-lg-10" >
        <div class="row">
            <div class="col-lg-12">
                <div class="widget style1 navy-bg">
                    <div class="row">
                        <div class="col-12">
                            <h2 class="" style="font-family: Cloud-Bold;">
                                ข้อมูลรายงานการเก็บสถิติการใช้งาน VR BOOT </h2>
                        </div>
                    </div>
                </div>
            </div>        
            <div class="col-lg-6" v-for="(attr,i) in attraction_view" :key="attr.attr_id">
                <div class="widget style1 navy-bg">
                    <div class="row">
                        <div class="col-4">
                            <i class="fa fa-map fa-5x"></i>
                        </div>
                        <div class="col-8 text-right">
                            <span> {{attr.attr_name}} </span>
                            <h2 class="" style="font-family: Cloud-Bold;">{{attr.attr_view_count}} <small class=""
                                    style="font-family: Cloud-Bold;">ผู้เข้าชม</small></h2>
                        </div>
                    </div>
                </div>
            </div>            
        </div>       
    </div>
    <div class="col-lg-1 responsive-wrap">
    </div>
</div>