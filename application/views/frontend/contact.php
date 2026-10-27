<div class="page-content">
    <!-- inner page banner -->
    <div class="dez-bnr-inr overlay-black-middle"
        style="background-image:url(<?php echo base_url();?>assets/images/nursebanner.jpg);">
        <div class="container">
            <div class="dez-bnr-inr-entry">
                <h1 class="text-white">Contact Us</h1>
            </div>
        </div>
    </div>
    <!-- inner page banner END -->
    <!-- Breadcrumb row -->
    <div class="breadcrumb-row">
        <div class="container">
            <ul class="list-inline">
                <li><a href="#">Home</a></li>
                <li>Contact us</li>
            </ul>
        </div>
    </div>
    <!-- Breadcrumb row END -->
    <!-- contact area -->
    <div class="section-full content-inner bg-white contact-style-1">
        <div class="container">
            <div class="row">
                <!-- Left part start -->
                <div class="col-md-8">
                    <div class="p-a30 bg-gray clearfix m-b30 ">
                        <h2>Send Message Us</h2>
                        <div class="dzFormMsg"></div>
                        <form method="post" class="dzForm" action="<?php echo base_url();?>send_test_email">
                            <input type="hidden" value="Contact" name="dzToDo">
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <div class="input-group">
                                            <input name="name" type="text" required class="form-control"
                                                placeholder="Your Name">
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <div class="input-group">
                                            <input name="mail_id" type="email" class="form-control" required
                                                placeholder="Your Email Id">
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <div class="input-group">
                                            <input name="mobile" type="text" required class="form-control"
                                                placeholder="Phone">
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <div class="input-group">
                                            <input name="subject" type="text" required class="form-control"
                                                placeholder="Subject">
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <div class="input-group">
                                            <textarea name="message" rows="4" class="form-control" required
                                                placeholder="Your Message..."></textarea>
                                        </div>
                                    </div>
                                </div>

                                <div class="col-md-12">
                                    <div class="form-group text-center">
                                        <?= $data['captcha_image'] ?? '' ?>
                                    </div>
                                </div>

                                <div class="col-md-12 mx-auto">
                                    <div class="form-group">
                                        <input type="text" name="captcha" class="form-control text-center" required
                                            placeholder="Enter Captcha">
                                    </div>
                                </div>


                                <div class="col-md-12">
                                    <button name="submit" type="submit" value="Submit" class="site-button ">
                                        <span>Submit</span> </button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
                <!-- Left part END -->
                <!-- right part start -->
                <div class="col-md-4">
                    <div class="p-a30 m-b30 border-1 contact-area">
                        <h2 class="m-b10">Quick Contact</h2>
                        <p>If you have any questions simply use the following contact details.</p>
                        <ul class="no-margin">
                            <li class="icon-bx-wraper left m-b30">
                                <div class="icon-bx-xs bg-primary"> <a href="#" class="icon-cell"><i
                                            class="fa fa-map-marker"></i></a> </div>
                                <div class="icon-content">
                                    <h6 class="text-uppercase m-tb0 dez-tilte">Address:</h6>
                                    <p>Sadar Hospital Campus Purulia Road, Ranchi, Jharkhand - 834001.</p>
                                </div>
                            </li>
                            <li class="icon-bx-wraper left m-b30">
                                <div class="icon-bx-xs bg-primary">
                                    <a href="javascript:void(0);" class="icon-cell">
                                        <i class="fa fa-envelope"></i>
                                    </a>
                                </div>

                                <div class="icon-content">
                                    <h6 class="text-uppercase m-tb0 dez-tilte">Email:</h6>
                                    <p>
                                        <span id="email1"></span><br>
                                        <span id="email2"></span>
                                    </p>
                                </div>
                            </li>


                            <script>
                            document.getElementById("email1").textContent =
                                "info" + "[at]" + "jnrcranchi" + "[dot]" + "com";

                            document.getElementById("email2").textContent =
                                "registrarjnrc" + "[at]" + "rediffmail" + "[dot]" + "com";
                            </script>
                            <li class="icon-bx-wraper left">
                                <div class="icon-bx-xs bg-primary"> <a href="#" class="icon-cell"><i
                                            class="fa fa-phone"></i></a> </div>
                                <div class="icon-content">
                                    <h6 class="text-uppercase m-tb0 dez-tilte">PHONE</h6>
                                    <p>+91 0000000000</p>
                                </div>
                            </li>
                        </ul>
                        <div class="m-t20">
                            <ul class="dez-social-icon border dez-social-icon-lg">
                                <li><a href="javascript:void(0);" class="fa fa-facebook bg-primary"></a></li>
                                <li><a href="javascript:void(0);" class="fa fa-twitter bg-primary"></a></li>
                                <li><a href="javascript:void(0);" class="fa fa-linkedin bg-primary"></a></li>
                                <li><a href="javascript:void(0);" class="fa fa-pinterest-p bg-primary"></a></li>
                                <li><a href="javascript:void(0);" class="fa fa-google-plus bg-primary"></a></li>
                            </ul>
                        </div>
                    </div>
                </div>
                <!-- right part END -->
            </div>
            <div class="row">
                <div class="col-md-12">
                    <!-- Map part start -->
                    <h2>Our Location</h2>
                    <iframe
                        src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3662.5334394774295!2d85.32169742695314!3d23.368911900000008!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x39f4e10f0f3f4c83%3A0x88feae7fb05c4da5!2sSadar%20Hospital!5e0!3m2!1sen!2sin!4v1652091844029!5m2!1sen!2sin"
                        width="100%" height="400" frameborder="0" style="border:0" allowfullscreen></iframe>
                    <!--<iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3662.5334394774295!2d85.32169742695314!3d23.368911900000008!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x39f4e10f0f3f4c83%3A0x88feae7fb05c4da5!2sSadar%20Hospital!5e0!3m2!1sen!2sin!4v1652091844029!5m2!1sen!2sin" width="600" height="450" style="border:0;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>-->
                    <!-- Map part END -->
                </div>
            </div>
        </div>
    </div>
    <!-- contact area  END -->
</div>
<!-- Content END-->
<style>
.noc {}

.nom {
    padding-left: 0;
    padding-right: 0;
}

p {
    text-align: justify;
}

.scroll {
    margin: 0;
    padding: 7px;
    text-align: center;
    color: red;
}
</style>
<style>
.dez-bnr-inr {
    height: 135px;
    background-position: 0px 0px;
}

.side-bar .widget {
    box-shadow: none;
}
</style>
<script src="https://www.google.com/recaptcha/api.js" async defer></script>