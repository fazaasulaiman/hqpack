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
                    <h2><i class="fa fa-align-left"></i> Atur Barang<small></small></h2>
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
                          <h4 class="panel-title">Form tambah barang</h4>
                        </a>
                        <div id="collapseOne" class="panel-collapse collapse in" role="tabpanel" aria-labelledby="headingOne">
                          <div class="panel-body">
                            
                            <form class="form-horizontal form-label-left" id="anggota" data-parsley-validate>
                            <input type="hidden" name="<?=$this->security->get_csrf_token_name();?>" value="<?=$this->security->get_csrf_hash();?>" style="display: none">
                              <span class="section">Tambah Barang</span>
                                <div class="item form-group">
                                  <label class="control-label col-md-3 col-sm-3 col-xs-12" for="user">Kode Barang<span class="required">*</span>
                                  </label>
                                  <div class="col-md-6 col-sm-6 col-xs-12">
                                    <input class="form-control col-md-7 col-xs-12" name="kode" required="required"  type="text">
                                  </div>
                                </div>
                                <div class="item form-group">
                                  <label class="control-label col-md-3 col-sm-3 col-xs-12" for="password">Nama barang<span class="required">*</span>
                                  </label>
                                  <div class="col-md-6 col-sm-6 col-xs-12">
                                    <input type="text" name="nama" required="required" data-parsley-minlength="4" class="form-control col-md-7 col-xs-12" required="required">
                                  </div>
                                </div>
                                <div class="item form-group">
                                  <label class="control-label col-md-3 col-sm-3 col-xs-12" for="nis">Harga Jual<span class="required">*</span>
                                  </label>
                                  <div class="col-md-6 col-sm-6 col-xs-12">
                                  <div class="input-group">
                                  <span class="input-group-addon">Rp</span>
                                    <input class="form-control col-md-7 col-xs-12" data-parsley-type="integer" name="jual" required="required" " type="text">
                                     </div>
                                  </div>
                                </div>
                                <div class="item form-group">
                                  <label class="control-label col-md-3 col-sm-3 col-xs-12" for="nis">Harga Produksi<span class="required">*</span>
                                  </label>
                                  <div class="col-md-6 col-sm-6 col-xs-12">
                                  <div class="input-group">
                                  <span class="input-group-addon">Rp</span>
                                    <input class="form-control col-md-7 col-xs-12" data-parsley-type="integer" name="produksi" required="required" " type="text">
                                     </div>
                                  </div>
                                </div>
                                
                               
                                <div class="ln_solid"></div>
                                  <div class="form-group">
                                    <div class="col-md-6 col-md-offset-3">
                                      <button type="reset" class="btn btn-default" value="Reset">Reset</button>
                                      <a class="btn btn-primary" id="validate">Submit</a>
                                    </div>
                                  </div>
                                 </form>
                          </div>
                        </div>
                      </div>
                      <div class="panel">
                        <a class="panel-heading collapsed" role="tab" id="headingTwo" data-toggle="collapse" data-parent="#accordion" href="#collapseTwo" aria-expanded="false" aria-controls="collapseTwo">
                          <h4 class="panel-title">Tabel Barang</h4>
                        </a>
                        <div id="collapseTwo" class="panel-collapse collapse" role="tabpanel" aria-labelledby="headingTwo">
                          <div class="panel-body">
                            <table id="table" class="table table-striped table-bordered dt-responsive nowrap" cellspacing="0" width="100%">
                                <thead>
                                    <tr>
                                        
                                        <th width="5%">No</th>
                                        <th width="20%">Kode</th>
                                        <th width="20%">Barang</th>
                                        <th width="20%">Produksi</th>
                                        <th width="20%">Jual</th>
                                        <th width="5%">Aksi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                </tbody>
                                <tfoot>
                                    <tr>
                                        <th width="5%">No</th>
                                        <th width="20%">Kode</th>
                                        <th width="20%">Barang</th>
                                        <th width="20%">Produksi</th>
                                        <th width="20%">Jual</th>
                                        <th width="5%">Aksi</th>
                                    </tr>
                                </tfoot>
                            </table>
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

 <div class="modal fade bs-example-modal-lg" tabindex="-1" role="dialog" id="modubah" aria-hidden="true">
                    <div class="modal-dialog modal-lg">
                      <div class="modal-content">

                        <div class="modal-header">
                          <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">×</span>
                          </button>
                          <h4 class="modal-title" id="myModalLabel">Modal title</h4>
                        </div>
                        <div class="modal-body">
                          <form action="#" id="formubah" class="form-horizontal" data-parsley-validate>
                          <input type="hidden" name="<?=$this->security->get_csrf_token_name();?>" value="<?=$this->security->get_csrf_hash();?>" style="display: none">
                              <input name="id" id="id" type="hidden">
                                <div class="item form-group">
                                  <label class="control-label col-md-3 col-sm-3 col-xs-12" for="user">Kode Barang<span class="required">*</span>
                                  </label>
                                  <div class="col-md-6 col-sm-6 col-xs-12">
                                    <input class="form-control col-md-7 col-xs-12" id="kode" name="kode" required="required"  type="text">
                                  </div>
                                </div>
                                <div class="item form-group">
                                  <label class="control-label col-md-3 col-sm-3 col-xs-12" for="password">Nama barang<span class="required">*</span>
                                  </label>
                                  <div class="col-md-6 col-sm-6 col-xs-12">
                                    <input type="text" name="nama" id="nama" required="required" data-parsley-minlength="4" class="form-control col-md-7 col-xs-12" required="required">
                                  </div>
                                </div>
                                <div class="item form-group">
                                  <label class="control-label col-md-3 col-sm-3 col-xs-12" for="nis">Harga Jual<span class="required">*</span>
                                  </label>
                                  <div class="col-md-6 col-sm-6 col-xs-12">
                                  <div class="input-group">
                                  <span class="input-group-addon">Rp</span>
                                    <input class="form-control col-md-7 col-xs-12" id="jual" name="jual" required="required" data-parsley-type="integer" type="text">
                                     </div>
                                  </div>
                                </div>
                                <div class="item form-group">
                                  <label class="control-label col-md-3 col-sm-3 col-xs-12" for="nis">Harga Produksi<span class="required">*</span>
                                  </label>
                                  <div class="col-md-6 col-sm-6 col-xs-12">
                                  <div class="input-group">
                                  <span class="input-group-addon">Rp</span>
                                    <input class="form-control col-md-7 col-xs-12" id="produksi" name="produksi" required="required" data-parsley-type="integer" type="text">
                                     </div>
                                  </div>
                                </div>
                                </form>

                        </div>
                        <div class="modal-footer">
                          <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                          <a class="btn btn-primary" id="validate2">Submit</a>
                          
                        </div>

                      </div>
                    </div>
                  </div>
                </div>