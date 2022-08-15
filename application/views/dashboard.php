<!-- dashboard inner -->
<div class="midde_cont">
    <div class="container-fluid">
        <div class="row column_title">
            <div class="col-md-12">
                <div class="page_title">
                    <h2>Dashboard</h2>
                </div>
            </div>
        </div>
        <div class="row column1">            
            <div class="col-md-6 col-lg-3">
                <div class="full counter_section margin_bottom_30">
                    <div class="couter_icon">
                        <div> 
                        <i class="fa fa-desktop blue1_color"></i>
                        </div>
                    </div>
                    <div class="counter_no">
                        <div>
                        <p class="total_no"><?php echo count($property); ?></p>
                        <p class="head_couter">Equipment</p>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-6 col-lg-3">
                <div class="full counter_section margin_bottom_30">
                    <div class="couter_icon">
                        <div> 
                        <i class="fa fa-signal green_color"></i>
                        </div>
                    </div>
                    <div class="counter_no">
                        <div>
                        <p class="total_no">---</p>
                        <p class="head_couter">Used IP Address</p>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-6 col-lg-3">
                <div class="full counter_section margin_bottom_30">
                    <div class="couter_icon">
                        <div> 
                        <i class="fa fa-institution red_color"></i>
                        </div>
                    </div>
                    <div class="counter_no">
                        <div>
                        <p class="total_no"><?php echo count($department); ?></p>
                        <p class="head_couter">Offices</p>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-6 col-lg-3">
                <div class="full counter_section margin_bottom_30">
                    <div class="couter_icon">
                        <div> 
                        <i class="fa fa-user yellow_color"></i>
                        </div>
                    </div>
                    <div class="counter_no">
                        <div>
                        <p class="total_no"><?php echo count($user); ?></p>
                        <p class="head_couter">Registered</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>