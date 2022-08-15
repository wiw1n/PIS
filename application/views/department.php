<!-- dashboard inner -->
<div class="midde_cont">
<div class="container-fluid">
        <div class="row column_title">
            <div class="col-md-12">
                <div class="page_title">
                    <h2>List of Department/Offices</h2>
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
                                        <button class="btn btn-lg btn-info mr-3" id="departmentInsert"><li class="fa fa-plus"></li></button>
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
                            <table class="table table-hover table-striped" id="department_tbl">
                                <thead>
                                    <tr>
                                        <th>ID</th>
                                        <th>Department Name</th>
                                        <th>Department Code</th>
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

<div class="modal fade" id="department_modal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
        <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLabel">Add Department/Office</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
            </button>
        </div>
        <form id="departmentForm">
            <div class="modal-body">
                <fieldset>
                    <div class="field">
                        <!-- <label class="label_field">ID Number</label> -->
                        <input type="text" name="txtDepartmentName" id="txtDepartmentName" placeholder="Department Name" required/>
                    </div>
                    <div class="field">
                        <!-- <label class="label_field">ID Number</label> -->
                        <input type="text" name="txtDepartmentCode" id="txtDepartmentCode" placeholder="Department Code" required/>
                    </div>
                </fieldset>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                <button type="submit" name="submit" class="btn btn-primary">Insert Department</button>
            </div>
        </form>
        </div>
    </div>
</div>

<div class="modal fade" id="updateDepartment_modal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
        <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLabel">Update Department/Office</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
            </button>
        </div>
        <form id="updateDepartmentForm">
            <div class="modal-body">
                <fieldset>
                    <input type="text" name="updateDepartmentID" id="updateDepartmentID" placeholder="Department Name" hidden required/>
                    <div class="field">
                        <!-- <label class="label_field">ID Number</label> -->
                        <input type="text" name="updateDepartmentName" id="updateDepartmentName" placeholder="Department Name" required/>
                    </div>
                    <div class="field">
                        <!-- <label class="label_field">ID Number</label> -->
                        <input type="text" name="updateDepartmentCode" id="updateDepartmentCode" placeholder="Department Code" required/>
                    </div>
                </fieldset>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                <button type="submit" name="submit" class="btn btn-primary">Update Department</button>
            </div>
        </form>
        </div>
    </div>
</div>