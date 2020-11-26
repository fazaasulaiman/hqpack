<div class="row">
<div role="main">
          <div class="">
            <div class="page-title">
              <div class="title_left">
              </div>
            </div>
            <div class="clearfix"></div>
          <div class="col-md-12 col-sm-12 col-xs-12">
                <div class="x_panel">
                  <div class="x_title">
                    <h2><i class="fa fa-align-left"></i> Laporan Penjualan<small></small></h2>
                    <ul class="nav navbar-right panel_toolbox">
                      <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
                      </li>
                      <li><a class="close-link"><i class="fa fa-close"></i></a>
                      </li>
                    </ul>
                    <div class="clearfix"></div>
                  </div>
                  <div class="x_content">
                    <!-- start accordion -->
                    <div class="accordion" id="accordion" role="tablist" aria-multiselectable="true">
                      <div class="panel">
                        <a class="panel-heading" role="tab" id="headingOne" data-toggle="collapse" data-parent="#accordion" href="#collapseOne" aria-expanded="false" aria-controls="collapseOne">
                          <h4 class="panel-title">Laporan Transaksi Penjualan</h4>
                        </a>
                        <div id="collapseOne" class="panel-collapse collapse in" role="tabpanel" aria-labelledby="headingOne">
                          <div class="panel-body">
                            <form class="form-horizontal form-label-left" id="filter" data-parsley-validate>
                            <input type="hidden" name="<?=$this->security->get_csrf_token_name();?>" value="<?=$this->security->get_csrf_hash();?>" style="display: none">
                            <input id="id" name="id" required="required" type="hidden">
                              <div class="row">
                              <div class="col-md-2 form-group">
                                <input type="text" name="tgl" id="tgl" class="form-control datepicker"  placeholder="Tanggal 1"> 
                              </div>
                              <div class="col-xs-1 form-group">
                              <h5>Sampai</h5>
                              </div>
                              <div class="col-md-2 form-group">
                                <input type="text" name="tgl2" id="tgl2" class="form-control datepicker"  placeholder="Tanggal 2"> 
                              </div>
                              <div class="col-md-2 form-group">
                                <input type="text" name="nota" id="nota" placeholder="nota" class="form-control">
                              </div>
                              <?php if($this->session->userdata('LEVEL')==2){ ?>
                              <div class="col-md-2 form-group">
                                <input type="text" name="kpm" id="kpm" placeholder="kpm" class="form-control">
                              </div>
                              <?php } else{?>
                               <input type="hidden" name="kpm" id="kpm" value="<?php echo $this->session->userdata('NAMA')?>" placeholder="kpm" class="form-control">
                               <?php }?>
                              </form>
                              <a class="btn btn-primary" id="filter">Filter</a>
                              <br>
                            <table id="table2" class="table table-striped table-bordered dt-responsive nowrap" cellspacing="0" width="100%">
                                <thead>
                                    <tr>
                                        <th width="5%">No</th>
                                        <th width="20%">Tanggal & Waktu</th>
                                        <th width="20%">KPM</th>
                                        <th width="20%">Nomor Nota</th>
                                        <th width="20%">Tunai</th>
                                        <th width="20%">ATM</th>
                                        <th width="20%">Voucher</th>
                                        <th width="20%">Diskon</th>
                                        <th width="20%">Jumlah</th>
                                        <th width="20%">Total Produksi</th>
                                        <th width="20%">Jumlah L/R Kotor</th>
                                    </tr>
                                </thead>
                                <tfoot>
                                  <tr>
                                      <th></th>
                                      <th></th>
                                      <th></th>
                                      <th  style="text-align:right">Total:</th>
                                      <th></th>
                                      <th></th>
                                      <th></th>
                                      <th></th>
                                      <th></th>
                                      <th></th>
                                      <th></th>
                                  </tr>
                              </tfoot>
                                <tbody>
                                </tbody>
                            </table>
                          </div>
                        </div>
                      </div>
                      <div class="panel">
                        <a class="panel-heading collapsed" role="tab" id="headingTwo" data-toggle="collapse" data-parent="#accordion" href="#collapseTwo" aria-expanded="false" aria-controls="collapseTwo">
                          <h4 class="panel-title">Laporan Transaksi Per-item</h4>
                        </a>
                        <div id="collapseTwo" class="panel-collapse collapse" role="tabpanel" aria-labelledby="headingTwo">
                          <div class="panel-body">

                            <form class="form-horizontal form-label-left" id="filter" data-parsley-validate>
                            <input type="hidden" name="<?=$this->security->get_csrf_token_name();?>" value="<?=$this->security->get_csrf_hash();?>" style="display: none">
                            <input id="iddata" name="id" required="required" type="hidden">
                              <div class="row">
                              <div class="col-md-2 form-group">
                                <input type="text" name="tgl" id="tgldata" class="form-control datepicker"  placeholder="Tanggal 1"> 
                              </div>
                              <div class="col-xs-1 form-group">
                              <h5>Sampai</h5>
                              </div>
                              <div class="col-md-2 form-group">
                                <input type="text" name="tgl2" id="tgl2data" class="form-control datepicker"  placeholder="Tanggal 2"> 
                              </div>
                              <div class="col-md-2 form-group">
                                <input type="text" name="barang" id="barangdata" placeholder="Nama Barang" class="form-control">
                              </div>
                               <?php if($this->session->userdata('LEVEL')==2){ ?>
                              <div class="col-md-2 form-group">
                                <input type="text" name="kpmdata" id="kpmdata" placeholder="kpm" class="form-control">
                              </div>
                              <?php } else{?>
                               <input type="hidden" name="kpmdata" id="kpmdata" value="<?php echo $this->session->userdata('NAMA')?>" class="form-control">
                               <?php }?>
                              </form>
                              <a class="btn btn-primary" id="filterdata">Filter</a>
                            <table id="table" class="table table-striped table-bordered dt-responsive nowrap" cellspacing="0" width="100%">
                                <thead>
                                    <tr>
                                        <th width="5%">No</th>
                                        <th width="20%">Tanggal & Waktu</th>
                                        <?php if($this->session->userdata('LEVEL')==2){ ?> 
                                        <th width="20%">KPM</th>
                                        <?php } ?>
                                        <th width="20%">Nomor Nota</th>
                                        <th width="20%">Kode</th>
                                        <th width="20%">Nama Barang</th>
                                        <th width="20%">Quantity</th>
                                        <th width="20%">Harga Item</th>
                                        <th width="20%">Total Harga</th>
                                    </tr>
                                </thead>
                                <tbody>
                                </tbody>
                                <tfoot>
                                    <tr>
                                        <th width="5%">No</th>
                                        <th width="20%">Tanggal</th>
                                        <?php if($this->session->userdata('LEVEL')==2){ ?> 
                                        <th width="20%">KPM</th>
                                        <?php } ?>
                                        <th width="20%">Nomor Nota</th>
                                        <th width="20%">Kode</th>
                                        <th width="20%">Nama Barang</th>
                                        <th width="20%">Quantity</th>
                                        <th width="20%">Harga Item</th>
                                        <th width="20%">Total Harga</th>
                                    </tr>
                                </tfoot>
                            </table>
                            
                          </div>
                        </div>
                      </div>
                    </div>
                    <!-- end of accordion -->
                    <!-- end of accordion -->
                  </div>
                </div>
              </div>

            
          </div>
        </div>
      </div>