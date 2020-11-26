<style type="text/css">
  /*
 * detail styles
 */
td.details-control {
    background: url('https://cdn.rawgit.com/DataTables/DataTables/6c7ada53ebc228ea9bc28b1b216e793b1825d188/examples/resources/details_open.png') no-repeat center center;
    cursor: pointer;
}
tr.shown td.details-control {
    background: url('https://cdn.rawgit.com/DataTables/DataTables/6c7ada53ebc228ea9bc28b1b216e793b1825d188/examples/resources/details_close.png') no-repeat center center;
}
</style>
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
                    <h2><i class="fa fa-align-left"></i> Atur Transaksi Nota <span class="text-nota"></span></h2>
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
                          <h4 class="panel-title">Form Transaksi Nota <span class="text-nota"></span></h4>
                        </a>
                        <div id="collapseOne" class="panel-collapse collapse in" role="tabpanel" aria-labelledby="headingOne">
                          <div class="panel-body">
                            
                            <form class="form-horizontal form-label-left" id="tambah" data-parsley-validate>
                            <input type="hidden" name="<?=$this->security->get_csrf_token_name();?>" value="<?=$this->security->get_csrf_hash();?>" style="display: none">
                              <span class="section">Tambah Transaksi Nota <span class="text-nota"></span></span>
                              <div class="item form-group">
                                  <label class="control-label col-md-3 col-sm-3 col-xs-12" for="nota">Nota<span class="required">*</span>
                                  </label>
                                  <div class="col-md-6 col-sm-6 col-xs-12">
                                    <input type="text" class="form-control col-md-7 col-xs-12" readonly="readonly" name="nota" required="required" id="nota">
                                  </div>
                                </div>
                                <div class="item form-group">
                                  <label class="control-label col-md-3 col-sm-3 col-xs-12" for="tanggal">Tanggal<span class="required">*</span>
                                  </label>
                                  <div class="col-md-6 col-sm-6 col-xs-12">
                                    <input type="text" class="form-control col-md-7 col-xs-12 datepicker"  name="tanggal" required="required" readonly="readonly">
                                  </div>
                                </div>
                                
                                <div class="item form-group">
                                  <label class="control-label col-md-3 col-sm-3 col-xs-12" for="keterangan">keterangan<span class="required">*</span>
                                  </label>
                                  <div class="col-md-6 col-sm-6 col-xs-12">
                                      <textarea type="text" name="keterangan"  class="form-control col-md-7 col-xs-12" required="required"></textarea>
                                  </div>
                                </div>
                                
                                
                                <div class="item form-group">
                                  <label class="control-label col-md-3 col-sm-3 col-xs-12" for="harga">Kredit<span class="required">*</span>
                                  </label>
                                  <div class="col-md-6 col-sm-6 col-xs-12">
                                    <div class="input-group">
                                      <span class="input-group-addon">Rp</span>
                                        <input type="text" class="form-control col-md-7 col-xs-12"  id="kredit" name="kredit" required="required">
                                      </input>
                                    </div>
                                  </div>
                                </div> 
                                <div class="item form-group">
                                  <label class="control-label col-md-3 col-sm-3 col-xs-12" for="catatan">Catatan
                                  </label>
                                  <div class="col-md-6 col-sm-6 col-xs-12">
                                     <textarea type="text" name="catatan"  class="form-control col-md-7 col-xs-12"></textarea>
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
                          <h4 class="panel-title">Tabel Transaksi Nota <span class="text-nota"></span></h4>
                        </a>
                        <div id="collapseTwo" class="panel-collapse collapse" role="tabpanel" aria-labelledby="headingTwo">
                          <div class="panel-body">
                            
                            <hr>
                            <table id="table" class="table table-striped dt-responsive nowrap" cellspacing="0" width="100%">
                                <thead>
                                    <tr>  
                                        <th width="5%">No</th>
                                        <th width="20%">Tanggal</th>
                                        <th width="20%">Keterangan</th>
                                        <th width="20%">Kredit</th>
                                        <th width="20%">Catatan</th>
                                        <th width="5%">Aksi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                </tbody>
                                <tfoot>
                                    <tr>
                                        <th colspan="4" style="text-align:right">Total Kredit:</th>
                                        
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
      </div>
                <div class="modal fade bs-example-modal-lg" tabindex="-1" role="dialog" id="modubah" aria-hidden="true">
                    <div class="modal-dialog modal-lg">
                      <div class="modal-content">

                        <div class="modal-header">
                          <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">×</span>
                          </button>
                          <h4 class="modal-title" id="myModalLabel">Ubah Hpp</h4>
                        </div>
                        <div class="modal-body">
                          <form action="#" id="formubah" class="form-horizontal" data-parsley-validate>
                          <input type="hidden" name="<?=$this->security->get_csrf_token_name();?>" value="<?=$this->security->get_csrf_hash();?>" style="display: none">
                          <input name="id" id="id" type="hidden">
                                <div class="item form-group">
                                  <label class="control-label col-md-3 col-sm-3 col-xs-12" for="Tanggal">Tanggal<span class="required">*</span>
                                  </label>
                                  <div class="col-md-6 col-sm-6 col-xs-12">
                                    <input id="tanggalup" class="form-control col-md-7 col-xs-12 datepicker" name="tanggal" readonly="readonly" type="text">
                                  </div>
                                </div>
                                <div class="item form-group">
                                  <label class="control-label col-md-3 col-sm-3 col-xs-12" for="Keterangan">Keterangan<span class="required">*</span>
                                  </label>
                                  <div class="col-md-6 col-sm-6 col-xs-12">
                                   <textarea type="text" name="keterangan" id="keteranganup" required="required" class="form-control col-md-7 col-xs-12"></textarea>
                                  </div>
                                </div>
                                <div class="item form-group">
                                  <label class="control-label col-md-3 col-sm-3 col-xs-12" for="kredit">Kredit
                                    <span class="required">*</span>
                                  </label>
                                  <div class="col-md-6 col-sm-6 col-xs-12">
                                   <div class="input-group">
                                      <span class="input-group-addon">Rp</span>
                                      <input id="kreditup" type="text" class="form-control col-md-7 col-xs-12" name="kredit" required="required">
                                      </input>
                                    </div>
                                  </div>
                                </div>
                                <div class="item form-group">
                                  <label class="control-label col-md-3 col-sm-3 col-xs-12" for="catatan">Catatan
                                  </label>
                                  <div class="col-md-6 col-sm-6 col-xs-12">
                                   <textarea type="text" name="catatan" id="catatanup" class="form-control col-md-7 col-xs-12"></textarea>
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