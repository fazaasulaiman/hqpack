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
                        
                          <h4 class="panel-title">Laporan Retur Barang KPM</h4>
                        
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
                                <input type="text" name="barang" id="barang" placeholder="Nama Barang" class="form-control">
                              </div>
                              <?php if($this->session->userdata('LEVEL')==2){ ?> 
                              <div class="col-md-2 form-group">
                                <input type="text" name="kpm" id="kpmcari" placeholder="Nama KPM" class="form-control">
                              </div>
                              <?php } else{?>
                              <input type="hidden" name="kpm" id="kpmcari" value="<?php echo $this->session->userdata('NAMA') ?>" placeholder="Nama KPM" class="form-control">
                              <?php }?>
                              
                              </form>
                              <a class="btn btn-primary" id="filter">Filter</a>
                            <table id="table" class="table table-striped table-bordered dt-responsive nowrap" cellspacing="0" width="100%">
                                <thead>
                                    <tr>
                                        <th width="5%">No</th>
                                        <th width="20%">Tanggal & Waktu</th>
                                        <th width="20%">KPM</th>
                                        <th width="20%">Nomor Nota</th>
                                        <th width="20%">Nama Barang</th>
                                        <th width="20%">Quantity</th>
                                        <th width="20%">Jumlah Retur</th>
                                    </tr>
                                </thead>
                                <tbody>
                                </tbody>
                                <tfoot>
                                    <tr>
                                        <th width="5%">No</th>
                                        <th width="20%">Tanggal & Waktu</th>
                                        <th width="20%">KPM</th>
                                        <th width="20%">Nomor Nota</th>
                                        <th width="20%">Nama Barang</th>
                                        <th width="20%">Quantity</th>
                                        <th width="20%">Jumlah Retur</th>
                                    </tr>
                                </tfoot>
                            </table>
                          
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