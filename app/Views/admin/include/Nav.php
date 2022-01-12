    <div class="nav-menu" id="nav-component">
        <div class="bg light-bg">
            <div class="container-fluid ">
                <div class="row">
                    <div class="col-md-12">
                        <nav class="navbar navbar-expand-lg navbar-light">
                            <a class="navbar-brand" href="../admin/dashboard">
                                <img class="icon" src="../asset/img/icon_boot_1.png" alt="" title="">
                            </a>
                            <button class="navbar-toggler" type="button" data-toggle="collapse"
                                data-target="#navbarNavDropdown" aria-controls="navbarNavDropdown" aria-expanded="false"
                                aria-label="Toggle navigation">
                                <i class="fa fa-bars"></i>
                            </button>
                            <div class="collapse navbar-collapse justify-content-end" id="navbarNavDropdown">
                                <ul class="nav navbar-top-links navbar-right">
                                    <li class="dropdown"><a style="color: #454F63;" @click="goToMainPage">หน้าหลัก</a>
                                    </li>
                                    <li class="dropdown">
                                        <a href="https://lanexanginfo.com/" target="_blank">
                                            <button class="btn btn-primary1 btn-xs dropdown-toggle">เข้าสู่เว็ป VR BOOT LOEI</button>
                                        </a>
                                    </li>
                                    <li data-toggle="dropdown" class="dropdown-toggle" href="#">
                                        <img alt="image" class="img-iconN rounded-circle" src="../asset/img/user.png">
                                        <strong class="" style="color: #454F63;">{{admin_data.username}}</strong>
                                    </li>
                                    <li class="dropdown">
                                        <a style="color: #3E8B9B; font-family: Cloud-Bold;" @click="logout">ออกจากระบบ</a>
                                    </li>                                    
                                </ul>
                            </div>
                        </nav>
                    </div>
                </div>
            </div>
        </div>
    </div>