<!-- dashboard inner -->
<div class="midde_cont">
    <div class="container-fluid">
        <div class="row column_title">
            <div class="col-md-12">
                <div class="page_title">
                    <h2>List of Users</h2>
                </div>
            </div>
        </div>
        <div class="row column1">
            <div class="col-lg-12">
                <div class="white_shd full margin_bottom_30">
                    <div class="full graph_head">
                        <div class="heading1 margin_0">
                            <button class="btn btn-info" id="empInsert"><li class="fa fa-plus"></li></button>
                        </div>
                    </div>
                    <div class="table_section padding_infor_info">
                        <div class="table-responsive-sm">
                            <table class="table table-hover table-striped" id="employee_tbl">
                                <thead>
                                    <tr>
                                        <th>ID</th>
                                        <th>ID Number</th>
                                        <th>Lastname</th>
                                        <th>Firstname</th>
                                        <th>Middlename</th>
                                        <th>Email</th>
                                        <th>Department</th>
                                        <th>Position</th>
                                        <th>Role</th>
                                        <th width="200">Action</th>
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


<div class="modal fade" id="employee_modal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
        <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLabel">Add User</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
            </button>
        </div>
        <form id="employeeForm">
            <div class="modal-body">
                <fieldset>
                    <div class="field">
                        <!-- <label class="label_field">ID Number</label> -->
                        <input type="text" name="txtIdNo" id="txtIdNo" placeholder="ID Number" required/>
                    </div>
                    <div class="field">
                        <!-- <label class="label_field">password</label> -->
                        <input type="password" name="txtPassword1" id="txtPassword1" placeholder="Password" required/>
                    </div>
                    <div class="field">
                        <!-- <label class="label_field">Repeat</label> -->
                        <input type="password" name="txtPassword2" id="txtPassword2" placeholder="Repeat Password" required/>
                        <p id="message"></p>
                    </div>
                    <div class="field">
                        <!-- <label class="label_field">Lastname</label> -->
                        <input type="text" name="txtLastname" id="txtLastname" placeholder="Lastname" required/>
                    </div>
                    <div class="field">
                        <!-- <label class="label_field">Firstname</label> -->
                        <input type="text" name="txtFirstname" id="txtFirstname" placeholder="Firstname" required/>
                    </div>
                    <div class="field">
                        <!-- <label class="label_field">Middlename</label> -->
                        <input type="text" name="txtMiddlename" id="txtMiddlename" placeholder="Middlename" required/>
                    </div>
                    <div class="field">
                        <!-- <label class="label_field">Email</label> -->
                        <input type="email" name="txtEmail" id="txtEmail" placeholder="Email" required/>
                    </div>
                    <div class="field">
                        <!-- <label class="label_field">department</label> -->
                        <select name="txtDepartment" id="txtDepartment">
                            <option value="" selected="" disabled>-- Select Department --</option>
                            <?php foreach ($department as $key): ?>
                                <option value="<?php echo $key->id ?>"><?php echo $key->department_name?></option>
                            <?php endforeach; ?>
                        </select>
                    </div>
                    <div class="field">
                        <!-- <label class="label_field">position</label> -->
                        <input type="text" name="txtPosition" id="txtPosition" placeholder="Position" required/>
                    </div>
                    <div class="field">
                        <!-- <label class="label_field">role</label> -->
                        <select name="txtRole" id="txtRole" required>
                            <option value="" selected="" disabled>-- Select Role --</option>
                            <option value="0">Admin</option>
                            <option value="1">Viewing</option>
                            <option value="2">None</option>
                        </select>
                        <!-- <input type="text" name="role" id="role"required/> -->
                    </div>
                </fieldset>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                <button type="submit" name="submit" class="btn btn-primary">Insert user</button>
            </div>
        </form>
        </div>
    </div>
</div>

<div class="modal fade" id="updateEmployee_modal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog  modal-lg" role="document">
        <div class="modal-content">
        <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLabel">Update User</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
            </button>
        </div>
        <form id="updateEmployeeForm">
            <div class="modal-body">
                <fieldset>
                    <div class="field">
                        <label class="label_field">ID</label>
                        <input type="text" name="updateID" id="updateID" readonly/>
                    </div>
                    <div class="field">
                        <label class="label_field">ID Number</label>
                        <input type="text" name="updateIdNo" id="updateIdNo" required/>
                    </div>
                    <div class="field">
                        <label class="label_field">Lastname</label>
                        <input type="text" name="updateLastname" id="updateLastname"required/>
                    </div>
                    <div class="field">
                        <label class="label_field">Firstname</label>
                        <input type="text" name="updateFirstname" id="updateFirstname"required/>
                    </div>
                    <div class="field">
                        <label class="label_field">Middlename</label>
                        <input type="text" name="updateMiddlename" id="updateMiddlename"required/>
                    </div>
                    <div class="field">
                        <label class="label_field">Email</label>
                        <input type="text" name="updateEmail" id="updateEmail"required/>
                    </div>
                    <div class="field">
                        <label class="label_field">department</label>
                        <select name="updateDepartment" id="updateDepartment">
                            <?php foreach ($department as $key): ?>
                                <option value="<?php echo $key->id ?>"><?php echo $key->department_name?></option>
                            <?php endforeach; ?>
                        </select>
                    </div>
                    <div class="field">
                        <label class="label_field">position</label>
                        <input type="text" name="updatePosition" id="updatePosition"required/>
                    </div>
                    <div class="field">
                        <label class="label_field">role</label>
                        <select name="updateRole" id="updateRole">
                            <option value="0">Admin</option>
                            <option value="1">Viewing</option>
                            <option value="2">None</option>
                        </select>
                        <!-- <input type="text" name="role" id="role"required/> -->
                    </div>
                </fieldset>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                <button type="submit" name="submit" class="btn btn-primary">Save changes</button>
            </div>
        </form>
        </div>
    </div>
</div>


<div class="modal fade" id="changePass_modal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
        <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLabel">Add User</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
            </button>
        </div>
        <form id="changePass_form">
            <div class="modal-body">
                <fieldset>
                    <div class="field">
                        <!-- <label class="label_field">ID Number</label> -->
                        <input type="text" name="changePassID" id="changePassID" placeholder="ID Number" hidden/>
                    </div>
                    <div class="field">
                        <!-- <label class="label_field">password</label> -->
                        <input type="password" name="updatePassword" id="updatePassword" placeholder="Password" required/>
                    </div>
                    <div class="field">
                        <!-- <label class="label_field">Repeat</label> -->
                        <input type="password" name="updatePassword2" id="updatePassword2" placeholder="Repeat Password" required/>
                        <p id="updateMessage"></p>
                    </div>                    
                </fieldset>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                <button type="submit" name="submit" class="btn btn-primary">Save changes</button>
            </div>
        </form>
        </div>
    </div>
</div>
