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
  <script src="<?php echo base_url()?>vendors/clipboard/clipboard.min.js"></script>
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
                    <h2><i class="fa fa-align-left"></i> Atur Stock<small></small></h2>
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
                          <h4 class="panel-title">Form Kirim Stock</h4>
                        </a>
                        <div id="collapseOne" class="panel-collapse collapse in" role="tabpanel" aria-labelledby="headingOne">
                          <div class="panel-body">
                            
                            <form class="form-horizontal form-label-left" id="tambah" data-parsley-validate>
                            <input type="hidden" name="<?=$this->security->get_csrf_token_name();?>" value="<?=$this->security->get_csrf_hash();?>" style="display: none">
                              <span class="section">Cari dengan No Nota</span>
                                
                                 <div class="item form-group">
                                  <label class="control-label col-md-1" for="nota">Nota<span class="required">*</span>
                                  </label>
                                  <div class="col-md-4 col-sm-4 col-xs-12">
                                     <select id="s2nota" class="form-control col-md-7 col-xs-12" name="nota" required="required">
                                    </select>
                                  </div>
                                  <div class="col-md-4">
                                      <a class="btn btn-primary" id="get-barang">Cari</a>
                                    </div>
                                </div>
                                <span class="section" id="nama-konsumen"></span>
                                 <table class="table table-striped">
                            <thead>
                              <tr>
                                <!-- <th>NO</th> -->
                                  <th>Tanggal Order</th>
                                  <th>Barang</th>
                                  <th>Qty</th>
                                  <th>Qty Kirim</th>
                                  <th>Note</th>
                                  <th></th>
                              </tr>
                            </thead>
                            <tbody id="send-item">
                              
                            </tbody>
                        
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
                          <h4 class="panel-title">Data Semua stock kirim</h4>
                        </a>
                        <div id="collapseTwo" class="panel-collapse collapse" role="tabpanel" aria-labelledby="headingTwo">
                          <div class="panel-body">
                            <span class="section">Riwayat Stock No Nota</span>
                                <div class="item form-group row">
                                  <label class="control-label col-md-1" for="nota">Nota<span class="required">*</span>
                                  </label>
                                  <div class="col-md-4 col-sm-4 col-xs-12">
                                     <select id="s2notariwayat" class="form-control col-md-7 col-xs-12" name="nota" required="required">
                                    </select>
                                  </div>
                                  <div class="col-md-4">
                                      <a class="btn btn-primary" id="riwayat-barang">Cari</a>
                                    </div>
                                </div>
                                <div class="row" id="riwayat">
 

                                </div>

                               <span class="section">Tabel Stock Kirim</span>
                            <form class="form-horizontal form-label-left">
                            <input type="hidden" name="<?=$this->security->get_csrf_token_name();?>" value="<?=$this->security->get_csrf_hash();?>" style="display: none">
                              
                              <span class="section">Pencarian</span>
                               
                                 <div class="item form-group">
                                  <label class="control-label col-md-3 col-sm-3 col-xs-12" for="nota">Tanggal
                                  </label>
                                  <div class="col-md-6 col-sm-6 col-xs-12">
                                    <input type="text" id="caritanggal" class="form-control col-md-7 col-xs-12 datepicker" name="tanggal">
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
                                  <label class="control-label col-md-3 col-sm-3 col-xs-12" for="barang">barang
                                  </label>
                                  <div class="col-md-6 col-sm-6 col-xs-12">
                                    <input type="text" id="caribarang" class="form-control col-md-7 col-xs-12" name="barang">
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
                                        <th width="20%">Jumlah Kirim</th>
                                        <th width="20%">Note</th>
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
                                        <th width="20%">Jumlah Kirim</th>
                                        <th width="20%">Note</th>
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
                          <h4 class="modal-title" id="myModalLabel">Ubah Data stock kirim</h4>
                        </div>
                        <div class="modal-body">
                          <form action="#" id="formubah" class="form-horizontal" data-parsley-validate>
                          <input type="hidden" name="<?=$this->security->get_csrf_token_name();?>"  enctype="multipart/form-data" value="<?=$this->security->get_csrf_hash();?>" style="display: none">
                          <input name="id" id="id" type="hidden">
                                <div class="item form-group">
                                  <label class="control-label col-md-3 col-sm-3 col-xs-12" for="tanggal">tanggal<span class="required">*</span>
                                  </label>
                                  <div class="col-md-6 col-sm-6 col-xs-12">
                                   
                                    <input class="form-control col-md-7 col-xs-12" readonly required="required" id="tanggalup"  type="text">
                                    
                                  </div>
                                </div>
                                <div class="item form-group">
                                  <label class="control-label col-md-3 col-sm-3 col-xs-12" for="nota">nota<span class="required">*</span>
                                  </label>
                                  <div class="col-md-6 col-sm-6 col-xs-12">
                                   
                                    <input class="form-control col-md-7 col-xs-12" readonly required="required" id="notaup"  type="text">
                                    
                                  </div>
                                </div>
                                <div class="item form-group">
                                  <label class="control-label col-md-3 col-sm-3 col-xs-12" for="konsumen">konsumen<span class="required">*</span>
                                  </label>
                                  <div class="col-md-6 col-sm-6 col-xs-12">
                                   
                                    <input class="form-control col-md-7 col-xs-12" readonly required="required" id="konsumenup"  type="text">
                                  </div>
                                </div>
                                <div class="item form-group">
                                  <label class="control-label col-md-3 col-sm-3 col-xs-12" for="jumlah">jumlah kirim<span class="required">*</span>
                                  </label>
                                  <div class="col-md-6 col-sm-6 col-xs-12">
                                   
                                    <input class="form-control col-md-7 col-xs-12"  required="required" id="jumlahup"  data-parsley-max="0" data-parsley-type="integer" name="jumlah" type="text">
                                  </div>
                                </div>
                                
                                 <div class="item form-group">
                                  <label class="control-label col-md-3 col-sm-3 col-xs-12" for="note">Note
                                  </label>
                                  <div class="col-md-6 col-sm-6 col-xs-12">
                                     <textarea type="text" name="note"  class="form-control col-md-7 col-xs-12" id="noteup" required></textarea>
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