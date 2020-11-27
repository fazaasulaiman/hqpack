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
<div id="iframeContainer"></div>  
          <div class="">
            <div class="page-title">
              <div class="title_left">
              </div>
            </div>
            <div class="clearfix"></div>
          <div class="col-md-12 col-sm-12 col-xs-12">
                <div class="x_panel">
                  <div class="x_title">
                    <h2><i class="fa fa-align-left"></i> Atur Invoice<small></small></h2>
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
                          <h4 class="panel-title">Form Invoice</h4>
                        </a>
                        <div id="collapseOne" class="panel-collapse collapse in" role="tabpanel" aria-labelledby="headingOne">
                          <div class="panel-body">
                            
                            <form class="form-horizontal form-label-left" id="tambah" data-parsley-validate>
                            <input type="hidden" name="<?=$this->security->get_csrf_token_name();?>" value="<?=$this->security->get_csrf_hash();?>" style="display: none">
                              <span class="section">Tambah Invoice</span>
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
                                    <input type="text" class="form-control col-md-7 col-xs-12" name="nota" required="required" id="nota" readonly>
                                  </div>
                                </div>
                                <div class="item form-group">
                                  <label class="control-label col-md-3 col-sm-3 col-xs-12" for="konsumen">Konsumen
                                  </label>
                                  <div class="col-md-6 col-sm-6 col-xs-12">
                                     <select id="s2konsumen" class="form-control col-md-7 col-xs-12" name="id_konsumen" required="required">
                                    </select>
                                  </div>
                                </div>
                                <div class="item form-group">
                                  <label class="control-label col-md-3 col-sm-3 col-xs-12" for="konsumen">Status
                                  </label>
                                  <div class="col-md-6 col-sm-6 col-xs-12">

                                     <select  class="form-control col-md-7 col-xs-12" id="status" name="status" required="required">
                                    </select>
                                  </div>
                                </div>
                                <div class="item form-group">
                                  <label class="control-label col-md-3 col-sm-3 col-xs-12" for="konsumen">Tanggal payment<span class="required">*</span>
                                  </label>
                                  <div class="col-md-6 col-sm-6 col-xs-12">
                                    <input type="text" class="form-control col-md-7 col-xs-12 datepicker"  name="tanggal_payment"  readonly="readonly" disabled id="tanggal_payment">
                                  </div>
                                </div>
                                <div class="item form-group">
                                  <label class="control-label col-md-3 col-sm-3 col-xs-12" for="konsumen">Tanggal deadline
                                  </label>
                                  <div class="col-md-6 col-sm-6 col-xs-12">
                                    <input type="text" class="form-control col-md-7 col-xs-12 datepicker"  name="tanggal_deadline"  readonly="readonly"  id="tanggal_deadline" required="required">
                                  </div>
                                </div>
                                <div class="item form-group">
                                  <label class="control-label col-md-3 col-sm-3 col-xs-12" for="konsumen">Catatan
                                  </label>
                                  <div class="col-md-6 col-sm-6 col-xs-12">
                                   <textarea type="text" name="catatan"  id="catatan" class="form-control col-md-7 col-xs-12"></textarea>
                                  </div>
                                </div>
                                <span class="section"></span>
                                <div class="item form-group">
                                  <label class="control-label col-md-3 col-sm-3 col-xs-12" for="barang">Barang<span class="required">*</span>
                                  </label>
                                  <div class="col-md-6 col-sm-6 col-xs-12">
                                    <input type="text" class="form-control col-md-7 col-xs-12"  name="barang" id="barang">
                                  </div>
                                </div>
                                <div class="item form-group">
                                  <label class="control-label col-md-3 col-sm-3 col-xs-12" for="qty">QTY<span class="required">*</span>
                                  </label>
                                  <div class="col-md-6 col-sm-6 col-xs-12">
                                    <input type="text" class="form-control col-md-7 col-xs-12" name="qty" id="qty" data-parsley-type="integer" name="qty">
                                  </div>
                                </div>
                                <div class="item form-group">
                                  <label class="control-label col-md-3 col-sm-3 col-xs-12" for="harga">Harga<span class="required">*</span>
                                  </label>
                                  <div class="col-md-6 col-sm-6 col-xs-12">
                                    <div class="input-group">
                                      <span class="input-group-addon">Rp</span>
                                      <input type="text" class="form-control col-md-7 col-xs-12" id="harga" name="harga">
                                      </div>
                                  </div>
                                   <div class="col-md-4 col-md-offset-5">
                                      
                                      <a class="btn btn-primary" id="tambah-barang">Tambah</a>
                                    </div>
                                </div>
                                 <table class="table table-striped">
                            <thead>
                              <tr>
                                <!-- <th>NO</th> -->
                                <th style="width: 20%">Barang</th>
                                <th>Jumah</th>
                                <th>Harga</th>
                                <th>Total</th>
                              </tr>
                            </thead>
                            <tbody id="transaksi-item">
                              
                            </tbody>
                            <tfoot>
                                <tr>
                                  <td></td>
                                  <td></td>
                                  <td>Total: <input type="hidden" name="total" id="inputtotal" value=""></td>
                                  <td id="total"> </td>
                                </tr>
                            </tfooter>
                          </table>
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
                          <h4 class="panel-title">Tabel Invoice</h4>
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
                                     <select  class="form-control col-md-7 col-xs-12" id="statusfilter" name="status" required="required">
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
                                        <th width="20%">Total</th>
                                        <th width="20%">Status</th>
                                        <th width="20%">Tanggal Pembayaran</th>
                                        <th width="20%">Tanggal Dealine</th>
                                        <th width="20%">Catatan</th>
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
                                        <th width="20%">Total</th>
                                        <th width="20%">Status</th>
                                        <th width="20%">Tanggal Pembayaran</th>
                                        <th width="20%">Tanggal Dealine</th>
                                        <th width="20%">Catatan</th>
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
 <div class="modal fade bd-example-modal-md" role="dialog" id="ubahstatus" aria-hidden="true">
                    <div class="modal-dialog modal-md modal-dialog-centered">
                      <div class="modal-content">

                        <div class="modal-header">
                          <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">×</span>
                          </button>
                          <h4 class="modal-title" id="myModalLabel">Ubah status</h4>
                        </div>
                        <div class="modal-body">
                          <form action="#" id="formubah" class="form-horizontal" data-parsley-validate>
                          <input type="hidden" name="<?=$this->security->get_csrf_token_name();?>" value="<?=$this->security->get_csrf_hash();?>" style="display: none">
                          <input name="id" id="id" type="hidden">
                           <div class="item form-group">
                            <label class="control-label col-md-3 col-sm-3 col-xs-12" for="Status">Status Invoice<span class="required">*</span>
                            </label>
                            <div class="col-md-6 col-sm-6 col-xs-12">
                             <select  class="form-control col-md-7 col-xs-12" id="statusupdate" name="status" required="required">
                                </select>  
                            </div>
                          </div>
                          <div class="item form-group">
                                <label class="control-label col-md-3 col-sm-3 col-xs-12" for="konsumen">Tanggal payment<span class="required">*</span>
                                </label>
                                <div class="col-md-6 col-sm-6 col-xs-12">
                                  <input type="text" class="form-control col-md-7 col-xs-12 datepicker"  name="tanggal_payment"  readonly="readonly" disabled id="tanggal_paymentupdate">
                                </div>
                          </div>
                          <div class="item form-group">
                                <label class="control-label col-md-3 col-sm-3 col-xs-12" for="konsumen">Tanggal deadline
                                </label>
                                <div class="col-md-6 col-sm-6 col-xs-12">
                                  <input type="text" class="form-control col-md-7 col-xs-12 datepicker"  name="tanggal_deadline"  readonly="readonly"  id="tanggal_deadlineupdate">
                                </div>
                          </div>
                          <div class="item form-group">
                                  <label class="control-label col-md-3 col-sm-3 col-xs-12" for="konsumen">Catatan
                                  </label>
                                  <div class="col-md-6 col-sm-6 col-xs-12">
                                   <textarea type="text" name="catatan"  id="catatan_update" class="form-control col-md-7 col-xs-12"></textarea>
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
<div class="modal fade bd-example-modal-md" role="dialog" id="ubahstatus" aria-hidden="true">
                    <div class="modal-dialog modal-md modal-dialog-centered">
                      <div class="modal-content">

                        <div class="modal-header">
                          <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">×</span>
                          </button>
                          <h4 class="modal-title" id="myModalLabel">Catatan</h4>
                        </div>
                        <div class="modal-body">
                          <form action="#" id="formubah" class="form-horizontal" data-parsley-validate>
                          <input type="hidden" name="<?=$this->security->get_csrf_token_name();?>" value="<?=$this->security->get_csrf_hash();?>" style="display: none">
                          <input name="id" id="id" type="hidden">
                         
                            <div class="item form-group">
                                 <!--  <label class="control-label col-md-3 col-sm-3 col-xs-12" for="konsumen">Tanggal payment<span class="required">*</span>
                                  </label> -->
                                  <div class="col-md-6 col-sm-6 col-xs-12">
                                   <textarea type="text" name="alamat"  class="form-control col-md-7 col-xs-12"></textarea>
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