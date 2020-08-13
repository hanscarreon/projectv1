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
                  <a href="<?php echo base_url() ?>admin/dashboard/index/all/positive/status" class="product-title text-success"> Positive
                    <span class="badge badge-success float-right"><?php echo number_format($positive); ?></span></a>
                </div>
              </li>
              <!-- /.item -->
              <li class="item">
                <div class="product-info">
                  <i class="far fa-meh text-warning"></i>
                  <a href="<?php echo base_url() ?>admin/dashboard/index/all/neutral/status" class="product-title text-warning"> Neutral
                    <span class="badge badge-warning float-right"><?php echo number_format($neutral); ?></span></a>
                </div>
              </li>
              <!-- /.item -->
              <li class="item">
                <div class="product-info">
                  <i class="far fa-angry text-danger"></i>
                  <a href="<?php echo base_url() ?>admin/dashboard/index/all/negative/status" class="product-title text-danger"> Negative
                    <span class="badge badge-danger float-right"><?php echo number_format($negative); ?></span>
                  </a>
                </div>
              </li>
              <li class="item">
                <div class="product-info">
                  <i class="far fa-angry text-info"></i>
                  <a href="<?php echo base_url() ?>admin/dashboard/index/all/mood/status" class="product-title text-info"> Total Analysis
                    <span class="badge badge-danger float-right"><?php echo number_format($total); ?></span>
                  </a>
                </div>
              </li>
              <!-- /.item -->
            </ul>
          </div>
          <!-- /.card-body -->
          <div class="card-footer text-center">
            <a href="<?php echo base_url() ?>admin/dashboard/index/all/mood/status" class="uppercase">View All</a>
          </div>
          <!-- /.card-footer -->
        </div>
    
  </div>

          <div class="col-md-8 col-sm-12 col-12">
            <div class="card">
              <div class="card-header">
                <h3 class="card-title">Responsive Hover Table</h3>

                <div class="card-tools">
                  <div class="input-group input-group-sm" style="width: 150px;">
                    <input type="text" name="table_search" class="form-control float-right" placeholder="Search">

                    <div class="input-group-append">
                      <button type="submit" class="btn btn-default"><i class="fas fa-search"></i></button>
                    </div>
                  </div>
                </div>
              </div>
              <!-- /.card-header -->
              <div class="card-body table-responsive p-0">
                <table class="table table-hover text-nowrap">
                  <thead>
                    <tr>
                        <th>ID</th>
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
                      <?php foreach($sentiments as $sentiment): ?>
                      <tr>
                        <td><?php echo $sentiment['senti_id']; ?></td>
                        <td><?php echo ucfirst($sentiment['user_fname']); ?> <?php echo ucfirst($sentiment['user_mname']); ?> <?php echo ucfirst($sentiment['user_lname']); ?></td>
                        <td><?php echo date("F j, Y, g:i a",strtotime($sentiment['senti_create'])) ?></td>
                        <td>
                            <?php  
                            if ($sentiment["senti_mood"] == 'positive') 
                              { 
                                echo '<span class="tag text-success">'.$sentiment["senti_mood"].'</span>';
                             }
                              if ($sentiment["senti_mood"] == 'neutral') 
                              { 
                                echo '<span class="tag text-primary">'.$sentiment["senti_mood"].'</span>';
                             }
                              if ($sentiment["senti_mood"] == 'negative') 
                              { 
                                echo '<span class="tag text-danger">'.$sentiment["senti_mood"].'</span>';
                             }
                          ?>
                          </span>
                        </td>
                         <td>
                          <p><?php echo $sentiment["senti_text"]; ?></p>
                        </td>

                        <td><a  href="<?php echo base_url()?>admin/schedule/set/<?php echo $sentiment['user_id'].'/'.$sentiment['senti_id'] ?>/normal" class="btn btn-block btn-outline-info">Set Schedule</a></td>
                        <td><a  class="btn btn-block btn-outline-danger">Delete</a></td>
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

