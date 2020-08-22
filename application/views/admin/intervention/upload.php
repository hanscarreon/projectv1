<div class="row ">
  

<div class="col-md-4 col-sm-4 col-4">
  
</div>
<!-- end of profile -->
<div class="col-md-12 col-sm-12 col-12">
    
  <div class="card card-info">
    <div class="card-header">
      <h3 class="card-title">Analyze Case</h3>
    </div>
    <!-- /.card-header -->
    <!-- form start -->
    <form class="form-horizontal" method="post" enctype="multipart/form-data" >
      <div class="card-body">
      <div class="form-group">
      <label for="exampleInputFile">File input</label>
        <div class="input-group">
        <div class="custom-file">
            <input type="file" class="" id="plan_file" name="plan_file">
            <input type="hidden" class="custom-file-input" id="plan_id" name="plan_id" value="<?php echo $this->uri->segment("4") ?>">
        </div>
        </div>
      </div>
      <!-- /.card-body -->
      <div class="card-footer">
        <button type="submit" name="upload_file" value="upload_file" class="btn btn-info">Save</button>
      </div>
      <!-- /.card-footer -->
    </form>
  </div>

</div>

</div>