<div class="row">
              <div class="col-md-12">
                <div class="x_panel">
                  <div class="x_title">
                    <h2>Request</h2>
                    <ul class="nav navbar-right panel_toolbox">
                      <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
                      </li>
                      <li class="dropdown">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false"><i class="fa fa-wrench"></i></a>
                        <ul class="dropdown-menu" role="menu">
                          <li><a href="#">Settings 1</a>
                          </li>
                          <li><a href="#">Settings 2</a>
                          </li>
                        </ul>
                      </li>
                      <li><a class="close-link"><i class="fa fa-close"></i></a>
                      </li>
                    </ul>
                    <div class="clearfix"></div>
                  </div>
                  <div class="x_content">

                    <section class="content invoice">
                      <!-- title row -->
                      <div class="row">
                    
                        <div class="col-xs-12 invoice-header">
                          <h1>
                                <i class="fa fa-shopping-bag"></i> Request Barang.
                                <small class="pull-right">Date: <?php echo date("d/m/Y")?></small>
                              </h1>
                        </div>
                        <!-- /.col -->
                      </div>
                      <div class="row">
                      <form id="form" data-parsley-validate>
                      <input type="hidden" name="<?=$this->security->get_csrf_token_name();?>" value="<?=$this->security->get_csrf_hash();?>" style="display: none">
                        <input type="hidden" id="id" name="id">
                        <input type="hidden" id="kode" name="kode">
                        <div class="col-md-3 form-group">
                        <input type="text" class="form-control"  id="barang" name="barang" placeholder="Nama Barang" required="required"> 
                        </div>
                        <div class="col-md-2 form-group">
                          <input type="text" class="form-control" id="jumlah" data-parsley-type="integer" name="jumlah" placeholder="Jumlah" required="required"> 
                        </div>
                        <a class="btn btn-primary" id="tambah-barang"><i class="fa fa-cart-plus">(F1)</i></a>
                        </form>
                      </div>
                      <!-- Table row -->
                      <div class="row">
                        <div class="col-xs-12 table">
                          <table class="table table-striped">
                            <thead>
                              <tr>
                                <th>Kode</th>
                                <th>Barang</th>
                                <th>Jumah</th>
                              </tr>
                            </thead>
                            <tbody id="req-item">
                            </tbody>
                          </table>
                        </div>
                        <!-- /.col -->
                      </div>
                      <!-- /.row -->
                      <!-- this row will not appear when printing -->
                      <div class="row no-print">
                        <div class="col-xs-12">
                         
                          <a class="btn btn-success pull-right" id="req-barang"><i class="fa fa-paper-plane"></i> Kirim (F6)</a>
                          
                        </div>
                      </div>
                    </section>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>