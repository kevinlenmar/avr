
<title>AVR Booking</title>
<link rel = "stylesheet" type = "text/css" href ="assets/css/avr-login.css"/>
<script src="<?php echo base_url();?>assets/plugins/jQuery/jquery-2.2.3.min.js"></script>
<script src='assets/js/avr/login/login.js'></script>

<body>
    <div style="margin-left: 400px;" id="login">
        <div class="container">
            <form method="post" action="<?php echo base_url();?>login">
                <div class="row">
                    <div class="col-sm-5 col-sm-offset-4 form-box">
                        <div class="form-top">
                            <div class="form-top-left">
                                <img src="assets/images/citu.png" width="100px" height="100px"/>
                                <h3 style="margin-left: -115px; margin-top: 5px;">CEBU INSTITUTE OF TECHNOLOGY</h3>
                                <h3 style="margin-left: -115px; margin-top: -50px;">_______________________________</h3>
                                <h3 style="margin-left: -5px; margin-top: -25px;">UNIVERSITY</h3>
                                <h3 style="margin-left: -170px; margin-top: -10px;">LIBRARY AND LEARNING RESOURCES CENTER</h3>
                                <h3 style="margin-left: -10px; margin-top: -20px;">AVR BOOKING</h3>
                            </div>
                        </div>
                        <div class="form-bottom">
                            <div class="form-group" style="margin-top: -10px;">
                                <small class="fg-black">Employee ID</small>
                                <div>
                                    <input type="text" class="form-control" name="emp_id" id="emp_id" autofocus="TRUE" style="width: 500px" />
                                    <span class="text-danger"><?php echo form_error('emp_id'); ?></span>
                                </div>
                            </div>
                            <div class="form-group neg-margin-top14">
                                <small class="fg-black">Password</small>
                                <div>
                                    <input type="password" class="form-control" name="password" id="password" style="width: 500px" />
                                    <span class="text-danger"><?php echo form_error('password'); ?></span>
                                </div>
                            </div>
                            <div class="form-group">
                                <input type="submit" name="login" value="Sign In" class="btn btn-warning" style="margin-top: 15px; font-size: 18px; padding-bottom: 5px; width: 500px;" />
                                <?php
                                echo '<label class="text-danger">'.$this->session->flashdata("error");
                                ?>
                            </div>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>
</body>