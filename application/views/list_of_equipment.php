<!-- dashboard inner -->
<div class="midde_cont">
    <div class="container-fluid">
        <div class="row column_title">
            <div class="col-md-12">
                <div class="page_title">
                    <h2>List of Equipment</h2>
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
                                        <button class="btn btn-lg btn-info mr-3" id="propertyInsert"><li class="fa fa-plus"></li></button>
                                        <button class="btn btn-lg btn-success" id="exportProperty"><li class="fa fa-download"></li></button>
                                    </div>
                                    <div class="col-lg-3 col-md-3">
                                        <fieldset>
                                            <div class="field">
                                                <!-- <label class="label_field">Input Date</label> -->
                                                <input type="month" name="selectDateInsert" id="selectDateInsert"/>
                                            </div>
                                        </fieldset>
                                    </div>
                                    <div class="col-lg-3 col-md-3">
                                        <div class="field">
                                            <select name="selectAccountable" id="selectAccountable" required>
                                                <option value="" selected="">-- Select All Accountable --</option>
                                                <?php foreach ($user as $key): ?>
                                                    <option value="<?php echo $key->id?>"><?php echo $key->firstname . " " . $key->lastname?></option>
                                                <?php endforeach; ?>                                            
                                            </select>
                                        </div>
                                    </div>
                                </div>
                            <?php endif; ?>
                        </div>
                    </div>
                    <div class="table_section padding_infor_info">
                        <div class="table-responsive-sm">
                            <table class="table table-hover table-striped" id="property_tbl">
                                <thead>
                                    <tr>
                                        <th>ID</th>
                                        <th>PPE Account</th>
                                        <th>PPE Sub Account</th>
                                        <th>Item</th>
                                        <th>Description</th>
                                        <th>Purchase Date</th>
                                        <th>Old Property No</th>
                                        <th>Property No</th>
                                        <th>Unit Measure</th>
                                        <th>Unit Value</th>
                                        <th>QTY/Property Card</th>
                                        <th>QRY/Physical Count</th>
                                        <th>Accountable</th>
                                        <th>Location</th>
                                        <th>User</th>
                                        <th>Condition</th>
                                        <th>Remarks</th>
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


<div class="modal fade" id="property_modal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
        <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLabel">Add User</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
            </button>
        </div>
        <form id="propertyForm">
            <div class="modal-body">
                <fieldset>
                    <div class="field">
                        <!-- <label class="label_field">ID Number</label> -->
                        <input type="month" name="txtPurchaseDate" id="txtPurchaseDate" placeholder="ID Number" required/>
                    </div>
                    <div class="field">
                        <!-- <label class="label_field">password</label> -->
                        <select name="txtPpe" id="txtPpe" required>
                            <!-- <option value="" selected="" disabled>-- Select PPE GROUP --</option>
                            <?php foreach ($ppe as $key): ?>
                                <option value="<?php echo $key->id ?>"><?php echo $key->ppe_name . " (" . $key->ppe_code . ")"?></option>
                            <?php endforeach; ?> -->
                        </select>
                    </div>
                    <div class="field">
                        <!-- <label class="label_field">Repeat</label> -->
                        <select name="txtPpeSub" id="txtPpeSub" required>
                            <option value="" selected="" disabled>-- Select PPE SUB GROUP --</option>
                            <!-- <?php foreach ($ppe_sub as $key): ?>
                                <option value="<?php echo $key->id ?>"><?php echo $key->ppe_sub_name . " (" . $key->ppe_sub_code . ")" ?></option>
                            <?php endforeach; ?> -->
                        </select>
                    </div>
                    <div class="field">
                        <!-- <label class="label_field">Lastname</label> -->
                        <input type="text" name="txtItem" id="txtItem" placeholder="Item" required/>
                    </div>
                    <div class="field">
                        <!-- <label class="label_field">Firstname</label> -->
                        <input type="text" name="txtDescription" id="txtDescription" placeholder="Description"/>
                    </div>
                    <div class="field">
                        <div class="row">
                            <div class="col-lg-6 col-md-6">
                                <input type="text" name="txtOldProperty" id="txtOldProperty" placeholder="Old Property No."/>
                            </div>
                            <div class="col-lg-6 col-md-6">
                                <p id="newProp" hidden><span id="propDate">0000</span>-<span id="propPpe">00</span>-<span id="propSub">00</span>-<span id="propSerial">000</span>-<span id="propDepartment">0000</span></p>
                                <input type="text" name="txtNewProperty" id="txtNewProperty" placeholder="New Property No." required readonly/>
                            </div>
                        </div>
                    </div>
                    <div class="field">
                        <div class="row">
                            <div class="col-lg-6 col-md-6">
                                <input type="text" name="txtUnitMeasure" id="txtUnitMeasure" placeholder="Unit Measure"/>
                            </div>
                            <div class="col-lg-6 col-md-6">
                                <input type="text" name="txtUnitValue" id="txtUnitValue" placeholder="Unit Value" required/>
                            </div>                            
                        </div>
                    </div>
                    <div class="field">
                        <div class="row">
                            <div class="col-lg-6 col-md-6">
                                <input type="text" name="txtPropertyCard" id="txtPropertyCard" placeholder="QTY Per Property Card"/>
                            </div>
                            <div class="col-lg-6 col-md-6">
                                <input type="text" name="txtPhysicalCount" id="txtPhysicalCount" placeholder="QTY Per Physical Count"/>
                            </div>
                        </div>
                    </div>
                    <div class="field">
                        <!-- <label class="label_field">department</label> -->
                        <select name="txtLocation" id="txtLocation" required>
                            <option value="" selected="" disabled>-- Select Department --</option>
                            <?php foreach ($department as $key): ?>
                                <option value="<?php echo $key->id ?>"><?php echo $key->department_name . " (" . $key->department_code . ")" ?></option>
                            <?php endforeach; ?>
                        </select>
                    </div>
                    <div class="field">
                        <div class="row">
                            <div class="col-lg-6 col-md-6">
                            <select name="txtAccountable" id="txtAccountable" required>
                                <option value="" selected="" disabled>-- Select Accountable --</option>
                                <?php foreach ($user as $key): ?>
                                    <option value="<?php echo $key->id ?>"><?php echo $key->firstname . " " . $key->lastname ?></option>
                                <?php endforeach; ?>
                            </select>
                            </div>
                            <div class="col-lg-6 col-md-6">
                                <select name="txtUser" id="txtUser">
                                    <option value="" selected="" disabled>-- Select User --</option>
                                    <?php foreach ($user as $key): ?>
                                        <option value="<?php echo $key->id ?>"><?php echo $key->firstname . " " . $key->lastname ?></option>
                                    <?php endforeach; ?>
                                </select>
                            </div>
                        </div>
                        <!-- <label class="label_field">position</label> -->
                        
                    </div>
                    <div class="field">
                        <input type="text" name="txtCondition" id="txtCondition" placeholder="Condition"/>
                    </div>
                    <div class="field">
                        <input type="text" name="txtRemarks" id="txtRemarks" placeholder="Remarks"/>
                    </div>
                </fieldset>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                <button type="submit" name="submit" class="btn btn-primary">Insert Property</button>
            </div>
        </form>
        </div>
    </div>
</div>


<div class="modal fade" id="updateProperty_modal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
        <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLabel">Update User</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
            </button>
        </div>
        <form id="propertyFormUpdate">
            <div class="modal-body">
                <fieldset>
                    <input type="text" name="updateID" id="updateID" placeholder="ID Number" hidden/>

                    <div class="field">
                        <!-- <label class="label_field">ID Number</label> -->
                        <input type="date" name="updatePurchaseDate" id="updatePurchaseDate" required/>
                    </div>
                    <div class="field">
                        <!-- <label class="label_field">password</label> -->
                        <select name="updatePpe" id="updatePpe" required>
                            <option value="" selected="" disabled>-- Select PPE GROUP --</option>
                            <?php foreach ($ppe as $key): ?>
                                <option value="<?php echo $key->id ?>"><?php echo $key->ppe_name . " (" . $key->ppe_code . ")"?></option>
                            <?php endforeach; ?>
                        </select>
                    </div>
                    <div class="field">
                        <!-- <label class="label_field">Repeat</label> -->
                        <select name="updatePpeSub" id="updatePpeSub" required>
                            <option value="" selected="" disabled>-- Select PPE SUB GROUP --</option>
                            <?php foreach ($ppe_sub as $key): ?>
                                <option value="<?php echo $key->id ?>"><?php echo $key->ppe_sub_name . " (" . $key->ppe_sub_code . ")" ?></option>
                            <?php endforeach; ?>
                        </select>
                    </div>
                    <div class="field">
                        <!-- <label class="label_field">Lastname</label> -->
                        <input type="text" name="updateItem" id="updateItem" placeholder="Item" required/>
                    </div>
                    <div class="field">
                        <!-- <label class="label_field">Firstname</label> -->
                        <input type="text" name="updateDescription" id="updateDescription" placeholder="Description"/>
                    </div>
                    <div class="field">
                        <div class="row">
                            <div class="col-lg-6 col-md-6">
                                <input type="text" name="updateOldProperty" id="updateOldProperty" placeholder="Old Property No."/>
                            </div>
                            <div class="col-lg-6 col-md-6">
                                <p></p>
                                <input type="text" name="updateNewProperty" id="updateNewProperty" placeholder="New Property No." readonly required/>
                                <p id="updateNewProp" hidden><span id="updatePropDate">0000</span>-<span id="updatePropPpe">00</span>-<span id="updatePropSub">00</span>-<span id="updatePropSerial">000</span>-<span id="updatePropDepartment">0000</span></p>
                            </div>
                        </div>
                    </div>
                    <div class="field">
                        <div class="row">
                            <div class="col-lg-6 col-md-6">
                                <input type="text" name="updateUnitMeasure" id="updateUnitMeasure" placeholder="Unit Measure"/>
                            </div>
                            <div class="col-lg-6 col-md-6">
                                <input type="text" name="updateUnitValue" id="updateUnitValue" placeholder="Unit Value" required/>
                            </div>
                            <!-- <div class="col-lg-3 col-md-3">
                                <input type="text" name="updateQty" id="updateQty" placeholder="QTY" required/>
                            </div>
                            <div class="col-lg-3 col-md-3">
                                <input type="text" name="updateTotalCost" id="updateTotalCost" placeholder="Total Cost" required/>
                            </div> -->
                        </div>
                    </div>
                    <div class="field">
                        <div class="row">
                            <div class="col-lg-6 col-md-6">
                                <input type="text" name="updatePropertyCard" id="updatePropertyCard" placeholder="QTY Per Property Card"/>
                            </div>
                            <div class="col-lg-6 col-md-6">
                                <input type="text" name="updatePhysicalCount" id="updatePhysicalCount" placeholder="QTY Per Physical Count"/>
                            </div>
                        </div>
                    </div>
                    <div class="field">
                        <!-- <label class="label_field">department</label> -->
                        <select name="updateLocation" id="updateLocation" required>
                            <option value="" selected="" disabled>-- Select Department --</option>
                            <?php foreach ($department as $key): ?>
                                <option value="<?php echo $key->id ?>"><?php echo $key->department_name . " (" . $key->department_code . ")"?></option>
                            <?php endforeach; ?>
                        </select>
                    </div>
                    <div class="field">
                        <div class="row">
                            <div class="col-lg-6 col-md-6">
                            <select name="updateAccountable" id="updateAccountable" required>
                                <option value="" selected="" disabled>-- Select Accountable --</option>
                                <?php foreach ($user as $key): ?>
                                    <option value="<?php echo $key->id ?>"><?php echo $key->firstname . " " . $key->lastname ?></option>
                                <?php endforeach; ?>
                            </select>
                            </div>
                            <div class="col-lg-6 col-md-6">
                                <select name="updateUser" id="updateUser">
                                    <option value="" selected="" disabled>-- Select User --</option>
                                    <?php foreach ($user as $key): ?>
                                        <option value="<?php echo $key->id ?>"><?php echo $key->firstname . " " . $key->lastname ?></option>
                                    <?php endforeach; ?>
                                </select>
                            </div>
                        </div>
                        <!-- <label class="label_field">position</label> -->
                        
                    </div>
                    <div class="field">
                        <input type="text" name="updateCondition" id="updateCondition" placeholder="Condition"/>
                    </div>
                    <div class="field">
                        <input type="text" name="updateRemarks" id="updateRemarks" placeholder="Remarks"/>
                    </div>
                </fieldset>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                <button type="submit" name="submit" class="btn btn-primary">Save Changes</button>
            </div>
        </form>
        </div>
    </div>
</div>


<div class="modal fade" id="barcode_modal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
        <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLabel">Add User</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
            </button>
        </div>
            <div class="modal-body">
                <div class="column imgBarcode">
                    <h3 style="text-align:center">Palo Inventory System</h3>
                    <a data-fancybox="gallery" id="imgBarcode"><img class="img-responsive" id="imgBarcode2" alt="#"></a>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                <button type="button" name="printBarcode" id="printBarcode" class="btn btn-primary">Print</button>
            </div>
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