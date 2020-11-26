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
                    <h2><i class="fa fa-align-left"></i> Atur Detail Laporan Laba Rugi<small></small></h2>
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
                          <h4 class="panel-title">Form  Detail Laporan Laba Rugi</h4>
                        </a>
                        <div id="collapseOne" class="panel-collapse collapse in" role="tabpanel" aria-labelledby="headingOne">
                          <div class="panel-body">
                            
                            <form class="form-horizontal form-label-left" id="tambah" data-parsley-validate>
                            <input type="hidden" name="<?=$this->security->get_csrf_token_name();?>" value="<?=$this->security->get_csrf_hash();?>" style="display: none">
                              <span class="section">Tambah Detail Laporan Laba Rugi</span>
                                <div class="item form-group">
                                  <label class="control-label col-md-3 col-sm-3 col-xs-12" for="konsumen">Tanggal<span class="required">*</span>
                                  </label>
                                  <div class="col-md-6 col-sm-6 col-xs-12">
                                    <input type="text" class="form-control col-md-7 col-xs-12 datepicker"  name="tanggal" required="required" readonly="readonly">
                                  </div>
                                </div>
                                <div class="item form-group">
                                  <label class="control-label col-md-3 col-sm-3 col-xs-12" for="nota">Nota<span class="required">*</span>
                                  </label>
                                  <div class="col-md-6 col-sm-6 col-xs-12">
                                    <input type="text" class="form-control col-md-7 col-xs-12" name="nota" required="required" id="nota">
                                  </div>
                                </div>
                                <!-- <div class="item form-group">
                                  <label class="control-label col-md-3 col-sm-3 col-xs-12" for="konsumen">Konsumen
                                  </label>
                                  <div class="col-md-6 col-sm-6 col-xs-12">
                                     <select id="s2konsumen" class="form-control col-md-7 col-xs-12" name="id_konsumen" required="required">
                                    </select>
                                  </div>
                                </div> -->
                                <div class="item form-group">
                                  <label class="control-label col-md-3 col-sm-3 col-xs-12" for="barang">Barang<span class="required">*</span>
                                  </label>
                                  <div class="col-md-6 col-sm-6 col-xs-12">
                                    <input type="text" class="form-control col-md-7 col-xs-12"  name="barang" required="required">
                                  </div>
                                </div>
                                <div class="item form-group">
                                  <label class="control-label col-md-3 col-sm-3 col-xs-12" for="qty">QTY<span class="required">*</span>
                                  </label>
                                  <div class="col-md-6 col-sm-6 col-xs-12">
                                    <input type="text" class="form-control col-md-7 col-xs-12" name="qty" id="qty" data-parsley-type="integer" name="qty" required="required">
                                  </div>
                                </div>
                                <div class="item form-group">
                                  <label class="control-label col-md-3 col-sm-3 col-xs-12" for="harga">Harga<span class="required">*</span>
                                  </label>
                                  <div class="col-md-6 col-sm-6 col-xs-12">
                                    <div class="input-group">
                                      <span class="input-group-addon">Rp</span>
                                      <input type="text" class="form-control col-md-7 col-xs-12" id="harga" name="harga" required="required">
                                      </div>
                                  </div>
                                </div>
                                <div class="item form-group">
                                  <label class="control-label col-md-3 col-sm-3 col-xs-12" for="penjualan">Penjualan<span class="required">*</span>
                                  </label>
                                  <div class="col-md-6 col-sm-6 col-xs-12">
                                    <div class="input-group">
                                      <span class="input-group-addon">Rp</span>
                                      <input type="text" class="form-control col-md-7 col-xs-12" id="penjualan" name="penjualan" readonly="readonly" required="required">
                                    </div>
                                  </div>
                                </div>
                               <!--  <div class="item form-group">
                                  <label class="control-label col-md-3 col-sm-3 col-xs-12" for="laba_kotor">Laba Kotor<span class="required">*</span>
                                  </label>
                                  <div class="col-md-6 col-sm-6 col-xs-12">
                                    <input type="text" class="form-control col-md-7 col-xs-12"  name="laba_koto" required="required">
                                  </div>
                                </div> --> 
                               
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
                          <h4 class="panel-title">Tabel Detail Laba Rugi</h4>
                        </a>
                        <div id="collapseTwo" class="panel-collapse collapse" role="tabpanel" aria-labelledby="headingTwo">
                          <div class="panel-body">
                            <form class="form-horizontal form-label-left">
                            <input type="hidden" name="<?=$this->security->get_csrf_token_name();?>" value="<?=$this->security->get_csrf_hash();?>" style="display: none">
                              
                              <span class="section">Pencarian</span>
                                <div class="item form-group">
                                  <label class="control-label col-md-3 col-sm-3 col-xs-12" for="distributor">Peridoe
                                  </label>
                                  <div class="col-md-2 form-group">
                                    <input type="text" name="tgl1" id="caritgl1" class="form-control datepicker"  placeholder="Tanggal 1" required="required"> 
                                  </div>
                                  <div class="col-xs-1 form-group">
                                    <h5>Sampai</h5>
                                  </div>
                                  <div class="col-md-2 form-group">
                                    <input type="text" name="tgl2" id="caritgl2" class="form-control datepicker"  placeholder="Tanggal 2" required="required"> 
                                  </div>
                                </div>
                                <div class="item form-group">
                                  <label class="control-label col-md-3 col-sm-3 col-xs-12" for="nota">Nota
                                  </label>
                                  <div class="col-md-6 col-sm-6 col-xs-12">
                                    <input type="text" id="carinota" class="form-control col-md-7 col-xs-12" name="nota">
                                  </div>
                                </div>
                                <div class="item form-group">
                                  <label class="control-label col-md-3 col-sm-3 col-xs-12" for="konsumen">Konsumen
                                  </label>
                                  <div class="col-md-6 col-sm-6 col-xs-12">
                                    <input type="text" id="carikonsumen" class="form-control col-md-7 col-xs-12" name="konsumen">
                                  </div>
                                </div>

                                <div class="item form-group">
                                  <label class="control-label col-md-3 col-sm-3 col-xs-12" for="status">status
                                  </label>
                                  <div class="col-md-6 col-sm-6 col-xs-12">
                                     <select id="caristatus" class="form-control col-md-7 col-xs-12" name="status">
                                        <option value='' selected disabled hidden>Pilih Status</option>
                                        <option value='Edit'>Edit</option>
                                        <option value='Fix'>Fix</option>
                                    </select>
                                  </div>
                                </div>


                                
                               
                                <div class="ln_solid"></div>
                                  <div class="form-group">
                                    <div class="col-md-6 col-md-offset-3">
                                       <button type="reset" class="btn btn-default" value="Reset">Reset</button>
                                      <a class="btn btn-primary" id="filter">Cari</a>
                                    </div>
                                  </div>
                                 </form>
                            <table id="table" class="table table-bordered dt-responsive nowrap" cellspacing="0" width="100%">
                                <thead>
                                    <tr>
                                        
                                        <th width="5%">No</th>
                                        <th width="20%">Tanggal</th>
                                        <th width="20%">Nota</th>
                                        <th width="20%">Konsumen</th>
                                        <th width="20%">Barang</th>
                                        <th width="20%">Hpp</th>
                                        <th width="20%">Qty</th>
                                        <th width="20%">Harga</th>
                                        <th width="20%">Penjualan</th>
                                        <th width="20%">Laba Kotor</th>
                                        <th width="20%">Status</th>
                                        <th width="5%">Aksi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                </tbody>
                                <tfoot>
                                    <tr>
                                        
                                        <th width="5%">No</th>
                                        <th width="20%">Tanggal</th>
                                        <th width="20%">Nota</th>
                                        <th width="20%">Konsumen</th>
                                        <th width="20%">Barang</th>
                                        <th width="20%">Hpp</th>
                                        <th width="20%">Qty</th>
                                        <th width="20%">Harga</th>
                                        <th width="20%">Penjualan</th>
                                        <th width="20%">Laba Kotor</th>
                                        <th width="20%">Status</th>
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
      </div>
      <div class="modal fade bs-example-modal-lg" tabindex="-1" role="dialog" id="modubah" aria-hidden="true">
                    <div class="modal-dialog modal-lg">
                      <div class="modal-content">

                        <div class="modal-header">
                          <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">×</span>
                          </button>
                          <h4 class="modal-title" id="myModalLabel">Ubah Beban</h4>
                        </div>
                        <div class="modal-body">
                          <form action="#" id="formubah" class="form-horizontal" data-parsley-validate>
                          <input type="hidden" name="<?=$this->security->get_csrf_token_name();?>" value="<?=$this->security->get_csrf_hash();?>" style="display: none">
                          <input name="id" id="id" type="hidden">
                          <input name="id_konsumen" id="konsumenup" type="hidden">
                                <div class="item form-group">
                                  <label class="control-label col-md-3 col-sm-3 col-xs-12" for="Tanggal">Tanggal<span class="required">*</span>
                                  </label>
                                  <div class="col-md-6 col-sm-6 col-xs-12">
                                    <input id="tanggalup" class="form-control col-md-7 col-xs-12 datepicker" required="required" name="tanggal" readonly="readonly" type="text">
                                  </div>
                                </div>
                                <div class="item form-group">
                                  <label class="control-label col-md-3 col-sm-3 col-xs-12" for="nota">Nota<span class="required">*</span>
                                  </label>
                                  <div class="col-md-6 col-sm-6 col-xs-12">
                                     <input id="notaup" type="text" name="nota" disabled="disabled" class="form-control col-md-7 col-xs-12" minlength="2"></input>
                                  </div>
                                </div>
                                
                                <!--  <div class="item form-group">
                                  <label class="control-label col-md-3 col-sm-3 col-xs-12" for="konsumen">Konsumen<span class="required">*</span>
                                  </label>
                                  <div class="col-md-6 col-sm-6 col-xs-12">
                                    <select class="form-control col-md-7 col-xs-12" id="konsumenup" name="id_konsumen" required="required">
                                    </select>
                                  </div>
                                </div> -->
                                <div class="item form-group">
                                  <label class="control-label col-md-3 col-sm-3 col-xs-12" for="barang">Barang 
                                    <span class="required">*</span>
                                  </label>
                                  <div class="col-md-6 col-sm-6 col-xs-12">
                                   <input type="text" class="form-control col-md-7 col-xs-12" id="barangup" name="barang" required="required">
                                  </div>
                                </div>
                                <div class="item form-group">
                                  <label class="control-label col-md-3 col-sm-3 col-xs-12" for="qty">Qty
                                    <span class="required">*</span>
                                  </label>
                                  <div class="col-md-6 col-sm-6 col-xs-12">
                                   <div class="input-group">
                                      <span class="input-group-addon">Rp</span>
                                      <input id="qtyup" type="text" class="form-control col-md-7 col-xs-12" data-parsley-type="integer" name="qty" required="required">
                                      </input>
                                    </div>
                                  </div>
                                </div>
                                  <div class="item form-group">
                                  <label class="control-label col-md-3 col-sm-3 col-xs-12" for="harga">Harga
                                    <span class="required">*</span>
                                  </label>
                                    <div class="col-md-6 col-sm-6 col-xs-12">
                                     <div class="input-group">
                                        <span class="input-group-addon">Rp</span>
                                        <input id="hargaup" type="text" class="form-control col-md-7 col-xs-12"  name="harga" required="required">
                                        </input>
                                      </div>
                                    </div>
                                  </div>
                                <div class="item form-group">
                                  <label class="control-label col-md-3 col-sm-3 col-xs-12" for="penjualan">Penjualan
                                    <span class="required">*</span>
                                  </label>
                                  <div class="col-md-6 col-sm-6 col-xs-12">
                                   <div class="input-group">
                                      <span class="input-group-addon">Rp</span>
                                      <input id="penjualanup" type="text" class="form-control col-md-7 col-xs-12" name="penjualan" readonly="readonly" required="required">
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