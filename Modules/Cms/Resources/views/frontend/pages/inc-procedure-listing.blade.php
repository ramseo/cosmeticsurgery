<div class="container-fluid mtab pt-4 pb-4" style="background-color:#f8f8f8">
    <div class="container">
        <p class="identity m-auto text-center">
            Find Your Procedure
        </p>
        <ul class="nav nav-tabs" role="tablist">
            <li class="nav-item default-active-cls active">
                <a class="nav-link default-active-cls active ancr" data-toggle="tab" href="#home" aria-expanded="true">
                    Face Procedures
                </a>
            </li>
            <li class="nav-item remove-default-active-cls px-2">
                <a class="nav-link ancr" data-toggle="tab" href="#menu1" aria-expanded="false">
                    Breast Procedures
                </a>
            </li>
            <li class="nav-item remove-default-active-cls">
                <a class="nav-link ancr" data-toggle="tab" href="#menu2" aria-expanded="false">
                    Body Procedures
                </a>
            </li>
            <li class="nav-item remove-default-active-cls px-2">
                <a class="nav-link ancr" data-toggle="tab" href="#menu3" aria-expanded="false">
                    Male Specific Procedures
                </a>
            </li>
        </ul>

        <div class="tab-content">
            <div id="home" class="container default-active-cls tab-pane active in">
                <div class="row">
                    <div class="col-lg-6 col-md-6 col-sm-6 padd-null">
                        <img src="<?= asset('img/face.jpg') ?>" style="width:100%">
                    </div>
                    <div class="col-lg-6 col-md-6 col-sm-6">
                        <div class="row">
                            <div class="col-lg-6 col-md-6 col-sm-6">
                                <ul>
                                    <li>
                                        <a class="<?= (\Request::getRequestUri() == "/rhinoplasty-" . strtolower($city)) ? "active-surgery" : "" ?>" href="rhinoplasty-<?= strtolower($city) ?>">
                                            Rhinoplasty
                                        </a>
                                    </li>
                                    <li>
                                        <a class="<?= (\Request::getRequestUri() == "/blepharoplasty-" . strtolower($city)) ? "active-surgery" : "" ?>" href="blepharoplasty-<?= strtolower($city) ?>">
                                            Blepharoplasty
                                        </a>
                                    </li>
                                    <li>
                                        <a class="<?= (\Request::getRequestUri() == "/facelift-" . strtolower($city)) ? "active-surgery" : "" ?>" href="facelift-<?= strtolower($city) ?>">Face lift</a>
                                    </li>
                                    <li>
                                        <a class="<?= (\Request::getRequestUri() == "/brow-lift-" . strtolower($city)) ? "active-surgery" : "" ?>" href="brow-lift-<?= strtolower($city) ?>">Brow Lift</a>
                                    </li>
                                    <li>
                                        <a class="<?= (\Request::getRequestUri() == "/neck-lift-" . strtolower($city)) ? "active-surgery" : "" ?>" href="neck-lift-<?= strtolower($city) ?>">Neck Lift</a>
                                    </li>
                                </ul>
                            </div>
                            <div class="col-lg-6 col-md-6 col-sm-6">
                                <ul>
                                    <li>
                                        <a class="<?= (\Request::getRequestUri() == "/chin-surgery-" . strtolower($city)) ? "active-surgery" : "" ?>" href="chin-surgery-<?= strtolower($city) ?>">Chin Surgery</a>
                                    </li>
                                    <li>
                                        <a class="<?= (\Request::getRequestUri() == "/cheek-augmentation-" . strtolower($city)) ? "active-surgery" : "" ?>" href="cheek-augmentation-<?= strtolower($city) ?>">Cheek augmentation</a>
                                    </li>
                                    <li>
                                        <a class="<?= (\Request::getRequestUri() == "/lip-augmentation-" . strtolower($city)) ? "active-surgery" : "" ?>" href="lip-augmentation-<?= strtolower($city) ?>">Lip augmentation</a>
                                    </li>
                                    <li>
                                        <a class="<?= (\Request::getRequestUri() == "/buccal-fat-removal-" . strtolower($city)) ? "active-surgery" : "" ?>" href="buccal-fat-removal-<?= strtolower($city) ?>">Buccal Fat Removal</a>
                                    </li>
                                    <li>
                                        <a class="<?= (\Request::getRequestUri() == "/ear-surgery-" . strtolower($city)) ? "active-surgery" : "" ?>" href="ear-surgery-<?= strtolower($city) ?>">Ear Surgery</a>
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
            </div>


            <div id="menu1" class="container tab-pane fade">
                <div class="row">
                    <div class="col-lg-6 col-md-6 col-sm-6">
                        <img src="<?= asset('img/breast.jpg') ?>" style="width:100%">
                    </div>
                    <div class="col-lg-6 col-md-6 col-sm-6">
                        <div class="row">
                            <div class="col-lg-6 col-md-6 col-sm-6">
                                <ul>
                                    <li>
                                        <a class="<?= (\Request::getRequestUri() == "/breast-augmentation-" . strtolower($city)) ? "active-surgery" : "" ?>" href="breast-augmentation-<?= strtolower($city) ?>">Breast Augmentation</a>
                                    </li>
                                    <li>
                                        <a class="<?= (\Request::getRequestUri() == "/breast-lift-" . strtolower($city)) ? "active-surgery" : "" ?>" href="breast-lift-<?= strtolower($city) ?>">Breast Lift</a>
                                    </li>
                                    <li>
                                        <a class="<?= (\Request::getRequestUri() == "/breast-reduction-" . strtolower($city)) ? "active-surgery" : "" ?>" href="breast-reduction-<?= strtolower($city) ?>">Breast Reduction</a>
                                    </li>
                                </ul>
                            </div>
                            <div class="col-lg-6 col-md-6 col-sm-6">
                                <ul>
                                    <li>
                                        <a class="<?= (\Request::getRequestUri() == "/breast-implant-removal-" . strtolower($city)) ? "active-surgery" : "" ?>" href="breast-implant-removal-<?= strtolower($city) ?>">Breast Implant Removal</a>
                                    </li>
                                    <li>
                                        <a class="<?= (\Request::getRequestUri() == "/breast-implant-revision-" . strtolower($city)) ? "active-surgery" : "" ?>" href="breast-implant-revision-<?= strtolower($city) ?>">Breast Implant Revision</a>
                                    </li>
                                    <li>
                                        <a class="<?= (\Request::getRequestUri() == "/gynecomastia-" . strtolower($city)) ? "active-surgery" : "" ?>" href="gynecomastia-<?= strtolower($city) ?>">Gynecomastia</a>
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
            </div>


            <div id="menu2" class="container tab-pane fade">
                <div class="row">
                    <div class="col-lg-6 col-md-6 col-sm-6">
                        <img src="<?= asset('img/body.jpg') ?>" style="width:100%">
                    </div>
                    <div class="col-lg-6 col-md-6 col-sm-6">
                        <div class="row">
                            <div class="col-lg-6 col-md-6 col-sm-6">
                                <ul>
                                    <li>
                                        <a class="<?= (\Request::getRequestUri() == "/liposuction-" . strtolower($city)) ? "active-surgery" : "" ?>" href="liposuction-<?= strtolower($city) ?>">Liposuction</a>
                                    </li>
                                    <li>
                                        <a class="<?= (\Request::getRequestUri() == "/tummy-tuck-" . strtolower($city)) ? "active-surgery" : "" ?>" href="tummy-tuck-<?= strtolower($city) ?>">Tummy tuck</a>
                                    </li>
                                    <li>
                                        <a class="<?= (\Request::getRequestUri() == "/buttock-enhancement-" . strtolower($city)) ? "active-surgery" : "" ?>" href="buttock-enhancement-<?= strtolower($city) ?>">Buttock Enhancement</a>
                                    </li>
                                    <li>
                                        <a class="<?= (\Request::getRequestUri() == "/body-lift-" . strtolower($city)) ? "active-surgery" : "" ?>" href="body-lift-<?= strtolower($city) ?>">Body Lift</a>
                                    </li>
                                </ul>
                            </div>
                            <div class="col-lg-6 col-md-6 col-sm-6">
                                <ul>
                                    <li>
                                        <a class="<?= (\Request::getRequestUri() == "/arm-lift-" . strtolower($city)) ? "active-surgery" : "" ?>" href="arm-lift-<?= strtolower($city) ?>">Arm Lift</a>
                                    </li>
                                    <li>
                                        <a class="<?= (\Request::getRequestUri() == "/thigh-lift-" . strtolower($city)) ? "active-surgery" : "" ?>" href="thigh-lift-<?= strtolower($city) ?>">Thigh Lift</a>
                                    </li>
                                    <li>
                                        <a class="<?= (\Request::getRequestUri() == "/body-contouring-" . strtolower($city)) ? "active-surgery" : "" ?>" href="body-contouring-<?= strtolower($city) ?>">Body Contouring</a>
                                    </li>
                                    <li>
                                        <a class="<?= (\Request::getRequestUri() == "/mommy-makeover-" . strtolower($city)) ? "active-surgery" : "" ?>" href="mommy-makeover-<?= strtolower($city) ?>">Mommy Makeover</a>
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div id="menu3" class="container tab-pane fade">
                <div class="row">
                    <div class="col-lg-6 col-md-6 col-sm-6">
                        <img src="<?= asset('img/male.jpg') ?>" style="width:100%">
                    </div>
                    <div class="col-lg-6 col-md-6 col-sm-6">
                        <div class="row">
                            <div class="col-lg-6 col-md-6 col-sm-6">
                                <ul>
                                    <li>
                                        <a class="<?= (\Request::getRequestUri() == "/hair-transplant-" . strtolower($city)) ? "active-surgery" : "" ?>" href="hair-transplant-<?= strtolower($city) ?>">Hair Transplant</a>
                                    </li>
                                    <li>
                                        <a class="<?= (\Request::getRequestUri() == "/gynecomastia-" . strtolower($city)) ? "active-surgery" : "" ?>" href="gynecomastia-<?= strtolower($city) ?>">Gynecomastia</a>
                                    </li>
                                    <li>
                                        <a class="<?= (\Request::getRequestUri() == "/men-and-plastic-surgery-" . strtolower($city)) ? "active-surgery" : "" ?>" href="men-and-plastic-surgery-<?= strtolower($city) ?>">Men and Plastic Surgery</a>
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div id="menu4" class="container tab-pane fade">
                <div class="row">
                    <div class="col-lg-6 col-md-6 col-sm-6">
                        <img src="<?= asset('img/body-hair-to-head.jpg') ?>" style="width:100%">
                    </div>
                    <div class="col-lg-6 col-md-6 col-sm-6">
                        <div class="row">
                            <div class="col-lg-6 col-md-6 col-sm-6">
                                <ul>
                                    <li>
                                        <a class="<?= (\Request::getRequestUri() == "/hair-transplant-" . strtolower($city)) ? "active-surgery" : "" ?>" href="hair-transplant-<?= strtolower($city) ?>">Hair Transplant</a>
                                    </li>
                                    <li>
                                        <a class="<?= (\Request::getRequestUri() == "/gynecomastia-" . strtolower($city)) ? "active-surgery" : "" ?>" href="gynecomastia-<?= strtolower($city) ?>">Gynecomastia</a>
                                    </li>
                                    <li>
                                        <a class="<?= (\Request::getRequestUri() == "/men-and-plastic-surgery-" . strtolower($city)) ? "active-surgery" : "" ?>" href="men-and-plastic-surgery-<?= strtolower($city) ?>">Men and Plastic Surgery</a>
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div id="menu5" class="container tab-pane fade">
                <div class="row">
                    <div class="col-lg-6 col-md-6 col-sm-6">
                        <img src="<?= asset('img/failed-hair-transplant-repair.jpg') ?>" style="width:100%">
                    </div>
                    <div class="col-lg-6 col-md-6 col-sm-6">
                        <div class="row">
                            <div class="col-lg-6 col-md-6 col-sm-6">
                                <ul>
                                    <li>
                                        <a class="<?= (\Request::getRequestUri() == "/hair-transplant-" . strtolower($city)) ? "active-surgery" : "" ?>" href="hair-transplant-<?= strtolower($city) ?>">Hair Transplant</a>
                                    </li>
                                    <li>
                                        <a class="<?= (\Request::getRequestUri() == "/gynecomastia-" . strtolower($city)) ? "active-surgery" : "" ?>" href="gynecomastia-<?= strtolower($city) ?>">Gynecomastia</a>
                                    </li>
                                    <li>
                                        <a class="<?= (\Request::getRequestUri() == "/men-and-plastic-surgery-" . strtolower($city)) ? "active-surgery" : "" ?>" href="men-and-plastic-surgery-<?= strtolower($city) ?>">Men and Plastic Surgery</a>
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </div>
</div>

<div class="container-fluid aco">
    <div id="accordion">
        <div class="card">
            <div class="card-header" id="headingOne">
                <h2 class="btn btn-link" data-toggle="collapse" data-target="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
                    Face Procedures
                </h2>
            </div>

            <div id="collapseOne" class="collapse in show" aria-labelledby="headingOne" data-parent="#accordion" aria-expanded="true" style="">
                <div class="card-body">
                    <img src="<?= asset('img/face.jpg') ?>" style="width:100%">
                    <ul>
                        <li>
                            <a href="rhinoplasty-<?= strtolower($city) ?>">Rhinoplasty</a>
                        </li>
                        <li>
                            <a href="blepharoplasty-<?= strtolower($city) ?>">Blepharoplasty</a>
                        </li>
                        <li>
                            <a href="facelift-<?= strtolower($city) ?>">Facelift</a>
                        </li>
                        <li>
                            <a href="brow-lift-<?= strtolower($city) ?>">Brow Lift</a>
                        </li>
                        <li>
                            <a href="neck-lift-<?= strtolower($city) ?>">Neck Lift</a>
                        </li>
                        <li>
                            <a href="chin-surgery-<?= strtolower($city) ?>">Chin Surgery</a>
                        </li>
                        <li>
                            <a href="cheek-augmentation-<?= strtolower($city) ?>">Cheek augmentation</a>
                        </li>
                        <li>
                            <a href="lip-augmentation-<?= strtolower($city) ?>">Lip augmentation</a>
                        </li>
                        <li>
                            <a href="buccal-fat-removal-<?= strtolower($city) ?>">Buccal Fat Removal</a>
                        </li>
                        <li>
                            <a href="ear-surgery-<?= strtolower($city) ?>">Ear Surgery</a>
                        </li>
                    </ul>
                </div>
            </div>
        </div>

        <div class="card">
            <div class="card-header" id="headingTwo">
                <h2 class="btn btn-link collapsed" data-toggle="collapse" data-target="#collapseTwo" aria-expanded="false" aria-controls="collapseTwo">
                    Breast Procedures
                </h2>
            </div>
            <div id="collapseTwo" class="collapse" aria-labelledby="headingTwo" data-parent="#accordion">
                <div class="card-body">
                    <img src="<?= asset('img/breast.jpg') ?>" style="width:100%">
                    <ul>
                        <li>
                            <a href="breast-augmentation-<?= strtolower($city) ?>">Breast Augmentation</a>
                        </li>
                        <li>
                            <a href="breast-lift-<?= strtolower($city) ?>">Breast Lift</a>
                        </li>
                        <li>
                            <a href="breast-reduction-<?= strtolower($city) ?>">Breast Reduction</a>
                        </li>
                        <li>
                            <a href="breast-implant-removal-<?= strtolower($city) ?>">Breast Implant Removal</a>
                        </li>
                        <li>
                            <a href="breast-implant-revision-<?= strtolower($city) ?>">Breast Implant Revision</a>
                        </li>
                        <li>
                            <a href="gynecomastia-<?= strtolower($city) ?>">Gynecomastia</a>
                        </li>
                    </ul>
                </div>
            </div>
        </div>

        <div class="card">
            <div class="card-header" id="headingThree">
                <h2 class="btn btn-link collapsed" data-toggle="collapse" data-target="#collapseThree" aria-expanded="false" aria-controls="collapseThree">
                    Body Procedures
                </h2>
            </div>
            <div id="collapseThree" class="collapse" aria-labelledby="headingThree" data-parent="#accordion">
                <div class="card-body">
                    <img src="<?= asset('img/body.jpg') ?>" style="width:100%">
                    <ul>
                        <li>
                            <a href="liposuction-<?= strtolower($city) ?>">Liposuction</a>
                        </li>
                        <li>
                            <a href="tummy-tuck-<?= strtolower($city) ?>">Tummy tuck</a>
                        </li>
                        <li>
                            <a href="buttock-enhancement-<?= strtolower($city) ?>">Buttock Enhancement</a>
                        </li>
                        <li>
                            <a href="body-lift-<?= strtolower($city) ?>">Body Lift</a>
                        </li>
                        <li>
                            <a href="arm-lift-<?= strtolower($city) ?>">Arm Lift</a>
                        </li>
                        <li>
                            <a href="thigh-lift-<?= strtolower($city) ?>">Thigh Lift</a>
                        </li>
                        <li>
                            <a href="body-contouring-<?= strtolower($city) ?>">Body Contouring</a>
                        </li>
                        <li>
                            <a href="mommy-makeover-<?= strtolower($city) ?>">Mommy Makeover</a>
                        </li>
                    </ul>
                </div>
            </div>
        </div>

        <div class="card">
            <div class="card-header" id="headingfour">
                <h2 class="btn btn-link collapsed" data-toggle="collapse" data-target="#collapsefour" aria-expanded="false" aria-controls="collapsefour">
                    Male-Specific Procedures<br>
                </h2>
            </div>
            <div id="collapsefour" class="collapse" aria-labelledby="headingfour" data-parent="#accordion">
                <div class="card-body">
                    <img src="<?= asset('img/male.jpg') ?>" style="width:100%">
                    <ul>
                        <li>
                            <a href="hair-transplant-<?= strtolower($city) ?>">Hair Transplant</a>
                        </li>
                        <li>
                            <a href="gynecomastia-<?= strtolower($city) ?>">Gynecomastia</a>
                        </li>
                        <li>
                            <a href="men-and-plastic-surgery-<?= strtolower($city) ?>">Men and Plastic Surgery</a>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
</div>