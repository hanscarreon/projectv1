<!-- <?php echo print_r($sentiments) ?> -->
<div class="row">
          <div class="col-12 col-md-4 col-sm-12">
            <div class="card">
              <div class="card-header">
                <h3 class="card-title">Choose Case:</h3>

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
                      <!-- <i class="far fa-clock text-info"></i> -->
                      <a href="<?php echo base_url() ?>admin/sentiment/index/name/closed/" class="product-title text-success">Closed Case</a>
                        <!-- <span class="badge badge-success float-right"><?php echo number_format($positive); ?></span></a> -->
                    </div>
                  </li>
                  <li class="item">
                    <div class="product-info">
                      <!-- <i class="fas fa-user-clock text-warning"></i> -->
                      <a href="<?php echo base_url() ?>admin/sentiment/index/name/recommended/" class="product-title text-warning">Recommended to SDO/Psychiatrist</a>
                    </div>
                  </li>
                  <!-- /.item -->
                  <li class="item">
                    <div class="product-info">
                      <a href="<?php echo base_url() ?>/admin/intervention/index/name/ongoing" class="product-title text-danger"> Intervention Plan
                      </a>
                    </div>
                  </li>
                  <!-- /.item -->
                </ul>
              </div>
              <!-- /.card-body -->
              <div class="card-footer text-center">
                <!-- <a href="<?php echo base_url() ?>admin/schedule/index/name/case/status" class="uppercase">View All</a> -->
              </div>
              <!-- /.card-footer -->
            </div>
          </div>
          <div class="col-md-8 col-sm-12 col-12">
            <div class="card">
              <div class="card-header">
                <h3 class="card-title">Responsive Hover Table</h3>

                <div class="card-tools">
                  <form method="POST">
                  <div class="input-group input-group-sm" style="width: 150px;">
                    <input type="text" name="search_name" value="<?php echo $this->uri->segment("4") != 'name' ? $this->uri->segment("4"): '' ?>" class="form-control float-right" placeholder="Search Name">

                    <div class="input-group-append">
                      <button type="submit" name="search_mode" value="search_mode" class="btn btn-default"><i class="fas fa-search"></i></button>
                    </div>
                  </div>
                </form>
                </div>
              </div>
              <!-- /.card-header -->
              <div class="card-body table-responsive p-0">
                <table class="table table-hover text-nowrap">
                  <thead>
                    <tr>
                        <th>Case-ID No.</th>
                        <th>Name</th>
                        <th>Date created</th>
                        <th>Result</th>
                        <th>Sentiment</th>
                        <th>Action</th>
                        <th></th>
                    </tr>
                  </thead>
                  <tbody>
                     <?php  if ( isset( $sentiments ) && count($sentiments) >= 1 ):?>
                      <?php $x=1; foreach($sentiments as $sentiment): ?>
                      <tr>
                      <td><?php echo $sentiment['case_id'] ?></td>
                        <td><?php echo ucfirst($sentiment['user_fname']); ?> <?php echo ucfirst($sentiment['user_mname']); ?> <?php echo ucfirst($sentiment['user_lname']); ?></td>
                        <td><?php echo date("F j, Y, g:i a",strtotime($sentiment['case_created'])) ?></td>
                        <td>
                            <?php  
                            if ($sentiment["case_study"] == 'positive') 
                              { 
                                echo '<span class="tag text-success">'.$sentiment["case_study"].'</span>';
                             }
                              if ($sentiment["case_study"] == 'neutral') 
                              { 
                                echo '<span class="tag text-warning">'.$sentiment["case_study"].'</span>';
                             }
                              if ($sentiment["case_study"] == 'negative') 
                              { 
                                echo '<span class="tag text-danger">'.$sentiment["case_study"].'</span>';
                             }
                          ?>
                          </span>
                        </td>
                         <td>
                          <p><?php echo $sentiment["case_text"]; ?></p>
                        </td>

                        <td><a  href="<?php echo base_url()?>admin/cases/view/<?php echo $sentiment['case_id']?>" class="btn btn-block btn-outline-info">View Info</a></td>
                        <td></td>
                      </tr>
                      <?php endforeach; ?>
                    
                   <?php else: ?>
                    <tr>
                      <td></td>
                      <td></td>
                      <td></td>
                      <td>no data</td>
                      <td></td>
                      <td></td>
                      <td></td>
                    </tr>

                  <?php endif;?>
                  </tbody>
                </table>
              </div>
              <!-- /.card-body -->
            </div>
            <!-- /.card -->
            <?php echo $this->pagination->create_links(); ?>

          </div>
        </div>
</div>