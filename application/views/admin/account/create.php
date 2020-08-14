<div class="row ">
  
<div class="col-md-8 col-sm-12 col-12">
    
  <div class="card card-info">
    <div class="card-header">
      <h3 class="card-title">Horizontal Form</h3>
    </div>
    <!-- /.card-header -->
    <!-- form start -->
    <form class="form-horizontal" method="post">
      <div class="card-body">
        <div class="form-group row">
          <label for="user_name" class="col-sm-2 col-form-label">Username</label>
          <div class="col-sm-10">
            <input type="text" class="form-control" id="user_name" name="user_name" placeholder="Username" value="">
          </div>
        </div>
        <div class="form-group row">
          <label for="user_email" class="col-sm-2 col-form-label">Email</label>
          <div class="col-sm-10">
            <input type="text" class="form-control" id="user_email" name="user_email" placeholder="Email" value="">
          </div>
        </div>
        <div class="form-group row">
          <label for="user_fname" class="col-sm-2 col-form-label">First name</label>
          <div class="col-sm-10">
            <input type="text" class="form-control" id="user_fname" name="user_fname" placeholder="First name" value="">
          </div>
        </div>
        <div class="form-group row">
          <label for="user_mname" class="col-sm-2 col-form-label">Middle name</label>
          <div class="col-sm-10">
            <input type="text" class="form-control" id="user_mname" name="user_mname" placeholder="First name" value="">
          </div>
        </div>
         <div class="form-group row">
          <label for="user_lname" class="col-sm-2 col-form-label">Last name</label>
          <div class="col-sm-10">
            <input type="text" class="form-control" id="user_lname" name="user_lname" placeholder="Last name" value="">
          </div>
         </div>
        <div class="form-group row">
          <label for="user_pass" class="col-sm-2 col-form-label">Password</label>
          <div class="col-sm-10">
            <input type="password" class="form-control" id="user_pass" name="user_pass" placeholder="Password" value="">
          </div>
        </div>
        <!-- <div class="form-group row">
          <label for="user_password_conf" class="col-sm-2 col-form-label">Confirm password</label>
          <div class="col-sm-10">
            <input type="password" class="form-control" id="user_password_conf" name="user_password_conf" placeholder="Password" value="">
          </div>
        </div> -->
        <div class="form-group row">
          <label for="user_role" class="col-sm-2 col-form-label">Role</label>
          <div class="col-sm-10">
            <select class="form-control select2 select2-hidden-accessible" name="user_role" style="width: 100%;" data-select2-id="1" tabindex="-1" aria-hidden="true">
              <option selected="selected" data-select2-id="3">Select Role</option>
              <option value="admin">Admin/Teacher</option>
              <option value="student">Student</option>
            </select>
          </div>
        </div>

        <div class="form-group row">
          <label for="user_role" class="col-sm-2 col-form-label">Curriculum</label>
          <div class="col-sm-10">
            <select class="form-control select2 select2-hidden-accessible" name="user_pos" style="width: 100%;" data-select2-id="1" tabindex="-1" aria-hidden="true">
              <option selected="selected" data-select2-id="3">Select Curriculum Level</option>
              <option value="col">College Student</option>
              <option value="hs">Secondary Student / Grade Student</option>
              <option value="elem">Elementary Student / Grade Student</option>
            </select>
          </div>
        </div>
        
        <div class="form-group row">
          <div class="offset-sm-2 col-sm-10">
            <div class="form-check">
              <input type="checkbox" class="form-check-input" id="exampleCheck2">
              <label class="form-check-label" for="exampleCheck2">Show</label>
            </div>
          </div>
        </div>
      </div>
      <!-- /.card-body -->
      <div class="card-footer">
        <button type="submit" value="create_account" name="create_account" class="btn btn-info">Create in</button>
      </div>
      <!-- /.card-footer -->
    </form>
  </div>

</div>

</div>