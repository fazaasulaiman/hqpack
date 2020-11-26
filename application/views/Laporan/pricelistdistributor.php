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
                    <h2><i class="fa fa-align-left"></i> Atur Tambah Distributor <span class="text"><?=$plorder['text'];?></span></h2>
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
                          <h4 class="panel-title">Form Tambah Distributor <span class="text"><?=$plorder['text'];?></span></h4>
                        </a>
                        <div id="collapseOne" class="panel-collapse collapse in" role="tabpanel" aria-labelledby="headingOne">
                          <div class="panel-body">
                           
                            <form class="form-horizontal form-label-left" id="tambah" data-parsley-validate>
                            <input type="hidden" name="<?=$this->security->get_csrf_token_name();?>" value="<?=$this->security->get_csrf_hash();?>" style="display: none">
                            <input type="hidden" name="id_pricelist" id="id_pricelist"  value="<?=$plorder['id_pricelist'];?>">
                              <input type="hidden" name="id_plorder" id="id_plorder"  value="<?=$plorder['id_plorder'];?>">
                              <span class="section">Tambah Distributor</span>
                              
                                <div class="item form-group">
                                <label class="control-label col-md-3 col-sm-3 col-xs-12">Jumlah order<span class="required">*</span>
                                </label>
                                <div class="col-md-6 col-sm-6 col-xs-12">
                                   <input type="text" value="<?=$plorder['jumlah_order'];?>" class="form-control col-md-7 col-xs-12" readonly>
                                </div>
                              </div>
                               <div class="item form-group">
                                <label class="control-label col-md-3 col-sm-3 col-xs-12">Insheet<span class="required">*</span>
                                </label>
                                <div class="col-md-6 col-sm-6 col-xs-12">
                                   <input type="text" value="<?=$plorder['insheet']?>" class="form-control col-md-7 col-xs-12" readonly>
                                </div>
                              </div>
                               <div class="item form-group">
                                <label class="control-label col-md-3 col-sm-3 col-xs-12">Plano<span class="required">*</span>
                                </label>
                                <div class="col-md-6 col-sm-6 col-xs-12">
                                   <input type="text" value="<?=$plorder['plano']?>" class="form-control col-md-7 col-xs-12" readonly>
                                </div>
                              </div>
                              <div class="item form-group">
                                <label class="control-label col-md-3 col-sm-3 col-xs-12" for="jenis">Jenis Distributor<span class="required">*</span>
                                </label>
                                <div class="col-md-6 col-sm-6 col-xs-12">
                                  <select id="jenis"  class="form-control col-md-7 col-xs-12" name="jenis" required="required">
                                    </select>
                                </div>
                              </div>
                              <div class="item form-group">
                                <label class="control-label col-md-3 col-sm-3 col-xs-12" for="distributor">Distributor<span class="required">*</span>
                                </label>
                                <div class="col-md-6 col-sm-6 col-xs-12">
                                  <select  class="form-control col-md-7 col-xs-12" id="distributor" required="required">
                                  </select>  
                                </div>
                              </div>
                              <div class="item form-group">
                                <label class="control-label col-md-3 col-sm-3 col-xs-12" for="barang">Barang<span class="required">*</span>
                                </label>
                                <div class="col-md-6 col-sm-6 col-xs-12">
                                  <select  class="form-control col-md-7 col-xs-12" name="id_hargadistributor" id="barang" required="required" disabled="true">
                                  </select>  
                                </div>
                              </div>
                              <div class="item form-group">
                                  <label class="control-label col-md-3 col-sm-3 col-xs-12" for="harga">Harga<span class="required">*</span>
                                  </label>
                                  <div class="col-md-6 col-sm-6 col-xs-12">
                                    <div class="input-group">
                                      <span class="input-group-addon">Rp</span>
                                        <input type="text" class="form-control col-md-7 col-xs-12"  id="harga" readonly="readonly" required="required">
                                      </input>
                                    </div>
                                  </div>
                              </div> 
                              <div class="item form-group">
                                  <label class="control-label col-md-3 col-sm-3 col-xs-12" for="qty">Jumlah<span class="required">*</span>
                                  </label>
                                  <div class="col-md-6 col-sm-6 col-xs-12">
                                    <input type="text" class="form-control col-md-7 col-xs-12" id="jumlah"  data-parsley-type="integer" name="jumlah" required="required">
                                  </div>
                                </div>
                              <div class="item form-group">
                                  <label class="control-label col-md-3 col-sm-3 col-xs-12" for="total">Total<span class="required">*</span>
                                  </label>
                                  <div class="col-md-6 col-sm-6 col-xs-12">
                                    <div class="input-group">
                                      <span class="input-group-addon">Rp</span>
                                        <input type="text" class="form-control col-md-7 col-xs-12" id="total" readonly="readonly" required="required">
                                      </input>
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
                          <h4 class="panel-title">Tabel Price list distributor</h4>
                        </a>
                        <div id="collapseTwo" class="panel-collapse collapse" role="tabpanel" aria-labelledby="headingTwo">
                          <div class="panel-body">
                            
                            <hr>
                            <table id="table" class="table table-striped dt-responsive nowrap" cellspacing="0" width="100%">
                                <thead>
                                    <tr>  
                                        <th width="5%">No</th>
                                        <th width="20%">Jenis</th>
                                        <th width="20%">Distributor</th>
                                        <th width="20%">Barang</th>
                                        <th width="20%">Jumlah</th>
                                        <th width="20%">Harga</th>
                                        <th width="20%">Total</th>
                                        <th width="5%">Aksi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                </tbody>
                                <tfoot>
                                      <tr>  
                                        <th width="5%">No</th>
                                        <th width="20%">Jenis</th>
                                        <th width="20%">Distributor</th>
                                        <th width="20%">Barang</th>
                                        <th width="20%">Jumlah</th>
                                        <th width="20%">Harga</th>
                                        <th width="20%">Total</th>
                                        <t
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
                                <label class="control-label col-md-3 col-sm-3 col-xs-12" for="jenis">Jenis Distributor<span class="required">*</span>
                                </label>
                                <div class="col-md-6 col-sm-6 col-xs-12">
                                  <select id="jenisup"  class="form-control col-md-7 col-xs-12" name="jenis" required="required">
                                  </select>
                                </div>
                              </div>
                              <div class="item form-group">
                                <label class="control-label col-md-3 col-sm-3 col-xs-12" for="distributor">Distributor<span class="required">*</span>
                                </label>
                                <div class="col-md-6 col-sm-6 col-xs-12">
                                  <select  class="form-control col-md-7 col-xs-12" id="distributorup" required="required">
                                  </select>  
                                </div>
                              </div>
                              <div class="item form-group">
                                <label class="control-label col-md-3 col-sm-3 col-xs-12" for="barang">Barang<span class="required">*</span>
                                </label>
                                <div class="col-md-6 col-sm-6 col-xs-12">
                                  <select  class="form-control col-md-7 col-xs-12" name="id_hargadistributor" id="barangup" required="required" disabled="true">
                                  </select>  
                                </div>
                              </div>
                              <div class="item form-group">
                                  <label class="control-label col-md-3 col-sm-3 col-xs-12" for="harga">Harga<span class="required">*</span>
                                  </label>
                                  <div class="col-md-6 col-sm-6 col-xs-12">
                                    <div class="input-group">
                                      <span class="input-group-addon">Rp</span>
                                        <input type="text" class="form-control col-md-7 col-xs-12"  id="hargaup" readonly="readonly" required="required">
                                      </input>
                                    </div>
                                  </div>
                              </div> 
                              <div class="item form-group">
                                  <label class="control-label col-md-3 col-sm-3 col-xs-12" for="qty">Jumlah<span class="required">*</span>
                                  </label>
                                  <div class="col-md-6 col-sm-6 col-xs-12">
                                    <input type="text" class="form-control col-md-7 col-xs-12" id="jumlahup"  data-parsley-type="integer" name="jumlah" required="required">
                                  </div>
                                </div>
                              <div class="item form-group">
                                  <label class="control-label col-md-3 col-sm-3 col-xs-12" for="total">Total<span class="required">*</span>
                                  </label>
                                  <div class="col-md-6 col-sm-6 col-xs-12">
                                    <div class="input-group">
                                      <span class="input-group-addon">Rp</span>
                                        <input type="text" class="form-control col-md-7 col-xs-12" id="totalup" readonly="readonly" required="required">
                                      </input>
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