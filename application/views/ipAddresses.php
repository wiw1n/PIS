<!-- dashboard inner -->
<div class="midde_cont">
    <div class="container-fluid">
        <div class="row column_title">
            <div class="col-md-12">
                <div class="page_title">
                    <h2>IP Address Managementssssssssssssssssssssss</h2>
                </div>
            </div>
        </div>
        <div class="row column1">
            <div class="col-lg-12">
                <div class="white_shd full margin_bottom_30">
                    <div class="full graph_head">
                        <div class="heading2 margin_0">
                            <?php if ($this->session->userdata('role') == 0): ?>
                                <div class="row">
                                    <div class="col-lg-6 col-md-6">
                                        <button class="btn btn-lg btn-info mr-3" id="addressInsert"><li class="fa fa-plus"></li></button>
                                    </div>
                                    <div class="col-lg-3 col-md-3">
                                        <!-- <div class="field">
                                            <select name="selectDepartment" id="selectDepartment" required>
                                                <option value="" selected="" disabled>-- Select Role --</option>
                                                <option value="0">Admin</option>
                                                <option value="1">Viewing</option>
                                                <option value="2">None</option>
                                            </select>
                                        </div> -->
                                    </div>
                                    <div class="col-lg-3 col-md-3">
                                        <!-- <div class="field">
                                            <select name="selectAccountable" id="selectAccountable" required>
                                                <option value="" selected="">-- Select All Accountable --</option>
                                                <?php foreach ($user as $key): ?>
                                                    <option value="<?php echo $key->id?>"><?php echo $key->firstname . " " . $key->lastname?></option>
                                                <?php endforeach; ?>                                            
                                            </select>
                                        </div> -->
                                    </div>
                                </div>
                            <?php endif; ?>
                        </div>
                    </div>
                    <div class="table_section padding_infor_info">
                        <div class="table-responsive-sm">
                            <table class="table table-hover table-striped" id="address_tbl" width="100%">
                                <thead>
                                    <tr>
                                        <th>ID</th>
                                        <th>IP Address</th>
                                        <th>Subnet</th>
                                        <th>Status</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

<div class="modal fade" id="address_modal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
        <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLabel">IP Address</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
            </button>
        </div>
        <form id="address_form">
            <div class="modal-body">
                <fieldset>
                    <div class="field">
                        <!-- <label class="label_field">ID Number</label> -->
                        <input type="text" name="txtIpAddress" id="txtIpAddress" placeholder="IP Address" required/>
                        <input type="text" name="txtSubnetMask" id="txtSubnetMask" placeholder="Subnet Mask" required/>
                        <select name="txtStatus" id="txtStatus">
                            <option value="1">Active</option>
                            <option value="0">Disable</option>
                        </select>
                    </div>
                    
                </fieldset>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                <button type="submit" name="submit" class="btn btn-primary">Insert IP Address</button>
            </div>
        </form>
        </div>
    </div>
</div>

<div class="modal fade" id="address_update_modal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
        <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLabel">Update IP Address</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
            </button>
        </div>
        <form id="address_update_form">
            <div class="modal-body">
                <fieldset>
                    <div class="field">
                        <!-- <label class="label_field">ID Number</label> -->
                        <input type="text" name="addressID" id="addressID" placeholder="IP Address" readonly/>
                        <input type="text" name="txtIpAddress_update" id="txtIpAddress_update" placeholder="IP Address" required/>
                        <input type="text" name="txtSubnetMask_update" id="txtSubnetMask_update" placeholder="Subnet Mask" required/>
                        <select name="txtStatus_update" id="txtStatus_update">
                            <option value="1">Active</option>
                            <option value="0">Disable</option>
                        </select>
                    </div>
                    
                </fieldset>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                <button type="submit" name="submit" class="btn btn-primary">UPDATE IP Address</button>
            </div>
        </form>
        </div>
    </div>
</div>

<div class="modal fade" id="loader_modal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="false" data-backdrop="static" data-keyboard="false">
    <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="container-fluid text-center">
        <img src="<?php echo base_url('assets/loader.gif')?>" alt="">
    </div>
        <!-- <div class="modal-content"> -->
        <!-- </div> -->
    </div>
</div>