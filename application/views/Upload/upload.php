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
                    <h2><i class="fa fa-align-left"></i> Bukti Transfer dan Laporan Penjualan<small></small></h2>
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
                        <a class="panel-heading" role="tab" id="headingOne" data-toggle="collapse" data-parent="#accordion" href="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
                          <h4 class="panel-title">Form Bukti Transfer dan Laporan Penjualan</h4>
                        </a>
                        <div id="collapseOne" class="panel-collapse collapse in" role="tabpanel" aria-labelledby="headingOne">
                          <div class="panel-body">
                            
                            <form class="form-horizontal form-label-left" id="form" enctype="multipart/form-data" data-parsley-validate>
                            <input type="hidden" name="<?=$this->security->get_csrf_token_name();?>" value="<?=$this->security->get_csrf_hash();?>" style="display: none">
                              <span class="section">Upload Transfer & Laporan Penjualan</span>
                                <div class="item form-group">
                                  <label class="control-label col-md-3 col-sm-3 col-xs-12" for="user">Tanggal<span class="required">*</span>
                                  </label>
                                  <div class="col-md-2 col-sm-2 col-xs-12">
                                    <input class="form-control col-md-12 col-xs-12 datepicker" name="tgl1" required="required"  type="text">
                                  </div>
                                  <div class="col-md-1">Sampai</div>
                                   <div class="col-md-2 col-sm-2 col-xs-12">
                                    <input class="form-control col-md-12 col-xs-12 datepicker" name="tgl2" required="required"  type="text">
                                  </div>
                                </div>
                                <div class="item form-group">
                                  <label class="control-label col-md-3 col-sm-3 col-xs-12" for="password">Upload Bukti Transfer<span class="required">*</span>
                                  </label>
                                  <div class="col-md-9 col-sm-9 col-xs-12">
                                  <div class="fileinput fileinput-new input-group" data-provides="fileinput">
                                      <div class="form-control" data-trigger="fileinput"><i class="glyphicon glyphicon-file fileinput-exists"></i> <span class="fileinput-filename"></span></div>
                                      <span class="input-group-addon btn btn-default btn-file"><span class="fileinput-new">Select file</span><span class="fileinput-exists">Change</span><input type="file" name="transfer" required="required" accept="application/pdf,image/jpeg" data-parsley-max-file-size="3000"></span>
                                      <a href="#" class="input-group-addon btn btn-default fileinput-exists" data-dismiss="fileinput">Remove</a>
                                    </div>
                                  </div>
                                </div>
                                <div class="item form-group">
                                  <label class="control-label col-md-3 col-sm-3 col-xs-12" for="password">Laporan Penjualan Transaksi<span class="required">*</span>
                                  </label>
                                  <div class="col-md-9 col-sm-9 col-xs-12">
                                  <div class="fileinput fileinput-new input-group" data-provides="fileinput">
                                      <div class="form-control" data-trigger="fileinput"><i class="glyphicon glyphicon-file fileinput-exists"></i> <span class="fileinput-filename"></span></div>
                                      <span class="input-group-addon btn btn-default btn-file"><span class="fileinput-new">Select file</span><span class="fileinput-exists">Change</span><input type="file" name="transaksi" required="required" id="transaksi"  data-parsley-max-file-size="3000" accept="application/pdf"></span>
                                      <a href="#" class="input-group-addon btn btn-default fileinput-exists" data-dismiss="fileinput">Remove</a>
                                    </div>
                                  </div>
                                </div>
                                <div class="item form-group">
                                  <label class="control-label col-md-3 col-sm-3 col-xs-12" for="password">Laporan Penjualan Item Barang<span class="required">*</span>
                                  </label>
                                  <div class="col-md-9 col-sm-9 col-xs-12">
                                  <div class="fileinput fileinput-new input-group" data-provides="fileinput">
                                      <div class="form-control" data-trigger="fileinput"><i class="glyphicon glyphicon-file fileinput-exists"></i> <span class="fileinput-filename"></span></div>
                                      <span class="input-group-addon btn btn-default btn-file"><span class="fileinput-new">Select file</span><span class="fileinput-exists">Change</span><input type="file" name="lain" id="item" data-parsley-max-file-size="3000" required="required" accept="application/pdf"></span>
                                      <a href="#" class="input-group-addon btn btn-default fileinput-exists" data-dismiss="fileinput">Remove</a>
                                    </div>
                                  </div>
                                </div>
                                <div class="item form-group">
                                  <label class="control-label col-md-3 col-sm-3 col-xs-12" for="password">Laporan Penjualan Item Barang<span class="required">*</span>
                                  </label>
                                  <div class="col-md-9 col-sm-9 col-xs-12">
                                  <div class="fileinput fileinput-new input-group" data-provides="fileinput">
                                      <div class="form-control" data-trigger="fileinput"><i class="glyphicon glyphicon-file fileinput-exists"></i> <span class="fileinput-filename"></span></div>
                                      <span class="input-group-addon btn btn-default btn-file"><span class="fileinput-new">Select file</span><span class="fileinput-exists">Change</span><input type="file" name="foc" id="foc" data-parsley-max-file-size="3000" accept="application/zip,application/rar"></span>
                                      <a href="#" class="input-group-addon btn btn-default fileinput-exists" data-dismiss="fileinput">Remove</a>
                                    </div>
                                  </div>
                                </div>
                                <div class="ln_solid"></div>
                                  <div class="form-group">
                                    <div class="col-md-6 col-md-offset-3">
                                      <a class="btn btn-primary" id="validate">Submit</a>
                                    </div>
                                  </div>
                                   </form>
                          </div>
                        </div>
                      </div>
                      
                    </div>
                    <!-- end of accordion -->


                  </div>
                </div>
              </div>

            
          </div>
        </div>