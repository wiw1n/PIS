<!-- dashboard inner -->
<div class="midde_cont">
<div class="container-fluid">
        <div class="row column_title">
            <div class="col-md-12">
                <div class="page_title">
                    <h2>PPE Account Group</h2>
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
                                        <button class="btn btn-lg btn-info mr-3" id="ppeInsert"><li class="fa fa-plus"></li></button>
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
                            <table class="table table-hover table-striped" id="ppe_tbl">
                                <thead>
                                    <tr>
                                        <th>ID</th>
                                        <th>PPE Account Group Name</th>
                                        <th>PPE Account Group Code</th>
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

<div class="modal fade" id="ppe_modal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
        <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLabel">Add PPE Account Group</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
            </button>
        </div>
        <form id="ppForm">
            <div class="modal-body">
                <fieldset>
                    <div class="field">
                        <!-- <label class="label_field">ID Number</label> -->
                        <input type="text" name="txtPpeName" id="txtPpeName" placeholder="PPE Account Group Name" required/>
                    </div>
                    <div class="field">
                        <!-- <label class="label_field">ID Number</label> -->
                        <input type="text" name="txtPpeCode" id="txtPpeCode" placeholder="PPE Account Group Code" required/>
                    </div>
                </fieldset>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                <button type="submit" name="submit" class="btn btn-primary">Insert PPE</button>
            </div>
        </form>
        </div>
    </div>
</div>

<div class="modal fade" id="updatePpe_modal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
        <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLabel">Update PPE Account Group</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
            </button>
        </div>
        <form id="updatePpeForm">
            <div class="modal-body">
                <fieldset>
                    <input type="text" name="updatePpeID" id="updatePpeID" hidden required/>
                    <div class="field">
                        <!-- <label class="label_field">ID Number</label> -->
                        <input type="text" name="updatePpeName" id="updatePpeName" placeholder="PPE Account Group Name" required/>
                    </div>
                    <div class="field">
                        <!-- <label class="label_field">ID Number</label> -->
                        <input type="text" name="updatePpeCode" id="updatePpeCode" placeholder="PPE Account Group Code" required/>
                    </div>
                </fieldset>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                <button type="submit" name="submit" class="btn btn-primary">Update PPE</button>
            </div>
        </form>
        </div>
    </div>
</div>

<div class="modal fade" id="ppeSub_modal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
        <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLabel">PPE Sub-Account Group</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
            </button>
        </div>
        <form id="updatePpeForm">
            <div class="modal-body">
                <div class="full graph_head">
                    <div class="heading2 margin_0">
                        <div class="row">
                            <div class="col-lg-6 col-md-6">
                                <button class="btn btn-lg btn-info mr-3" id="ppeSubInsert"><li class="fa fa-plus"></li></button>
                            </div>
                            <div class="col-lg-3 col-md-3">
                            </div>
                            <div class="col-lg-3 col-md-3">
                            </div>
                        </div>
                    </div>
                </div>
                <div class="table_section padding_infor_info">
                    <div class="table-responsive-sm">
                        <table class="table table-hover table-striped" id="ppe_sub_tbl" width="100%">
                            <thead>
                                <tr>
                                    <th>ID</th>
                                    <th>PPE Sub-Account Group Name</th>
                                    <th>PPE Sub-Account Group Code</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
            </div>
        </form>
        </div>
    </div>
</div>

<div class="modal fade" id="ppe_sub_modal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
        <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLabel">Add PPE Sub-Account Group</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
            </button>
        </div>
        <form id="ppeSubForm">
            <div class="modal-body">
                <fieldset>
                    <input type="text" name="txtPpeIdforSub" id="txtPpeIdforSub" hidden/>
                    <div class="field">
                        <!-- <label class="label_field">ID Number</label> -->
                        <input type="text" name="txtPpeSubName" id="txtPpeSubName" placeholder="PPE Sub-Account Group Name" required/>
                    </div>
                    <div class="field">
                        <!-- <label class="label_field">ID Number</label> -->
                        <input type="text" name="txtPpeSubCode" id="txtPpeSubCode" placeholder="PPE Sub-Account Group Code" required/>
                    </div>
                </fieldset>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                <button type="submit" name="submit" class="btn btn-primary">Insert PPE Sub</button>
            </div>
        </form>
        </div>
    </div>
</div>

<div class="modal fade" id="updatePpe_sub_modal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
        <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLabel">Update PPE Sub-Account Group</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
            </button>
        </div>
        <form id="updatePpeSubForm">
            <div class="modal-body">
                <fieldset>
                    <input type="text" name="updatePpeSubID" id="updatePpeSubID" hidden required/>
                    <input type="text" name="updatePpeIdforSub" id="txtPpeIdforSub" hidden/>
                    <div class="field">
                        <!-- <label class="label_field">ID Number</label> -->
                        <input type="text" name="updatePpeSubName" id="updatePpeSubName" placeholder="PPE Sub-Account Group Name" required/>
                    </div>
                    <div class="field">
                        <!-- <label class="label_field">ID Number</label> -->
                        <input type="text" name="updatePpeSubCode" id="updatePpeSubCode" placeholder="PPE Sub-Account Group Code" required/>
                    </div>
                </fieldset>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                <button type="submit" name="submit" class="btn btn-primary">Update PPE Sub</button>
            </div>
        </form>
        </div>
    </div>
</div>