<div class="row">
 <div class="col-12 col-sm-12 col-md-4">
        <div class="card">
          <div class="card-header">
            <h3 class="card-title">Sort By:</h3>

            <div class="card-tools">
              <button type="button" class="btn btn-tool" data-card-widget="collapse">
                <i class="fas fa-minus"></i>
              </button>
              <!-- <button type="button" class="btn btn-tool" data-card-widget="remove">
                <i class="fas fa-times"></i>
              </button> -->
            </div>
          </div>
          <!-- /.card-header -->
          <div class="card-body p-0">
            <ul class="products-list product-list-in-card pl-2 pr-2">
              <li class="item">
                <div class="product-info">
                  <i class="far fa-laugh text-success"></i>
                  <a href="<?php echo base_url() ?>admin/intervention/index/all/close/status" class="product-title text-success"> Close Case
                    <!-- <span class="badge badge-success float-right"><?php echo number_format($positive); ?></span></a> -->
                </div>
              </li>
              <!-- /.item -->
              <li class="item">
                <div class="product-info">
                  <i class="far fa-meh text-warning"></i>
                  <a href="<?php echo base_url() ?>admin/intervention/index/all/recommend/status" class="product-title text-warning"> Recommended to SDO or Pyschologist
                    <!-- <span class="badge badge-warning float-right"><?php echo number_format($neutral); ?></span></a> -->
                </div>
              </li>
              <!-- /.item -->
              <li class="item">
                <div class="product-info">
                  <i class="far fa-angry text-danger"></i>
                  <a href="<?php echo base_url() ?>admin/intervention/index/all/plan/status" class="product-title text-danger"> Intervention planning
                    <!-- <span class="badge badge-danger float-right"><?php echo number_format($negative); ?></span> -->
                  </a>
                </div>
              </li>
              <li class="item">
                <div class="product-info">
                  <i class="far fa-angry text-info"></i>
                  <a href="<?php echo base_url() ?>admin/intervention/index/all/mood/status" class="product-title text-info"> Total Analysis
                    <!-- <span class="badge badge-danger float-right"><?php echo number_format($total); ?></span> -->
                  </a>
                </div>
              </li>
              <!-- /.item -->
            </ul>
          </div>
          <!-- /.card-body -->
          <div class="card-footer text-center">
            <a href="<?php echo base_url() ?>admin/intervention/index/all/mood/status" class="uppercase">View All</a>
          </div>
          <!-- /.card-footer -->
        </div>
    
  </div>

         
</div>

