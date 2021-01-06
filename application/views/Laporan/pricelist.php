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
                    <h2><i class="fa fa-align-left"></i> Atur Price List<small></small></h2>
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
                      <div class="panel" id="panelone">
                        <a class="panel-heading" role="tab" id="headingOne" data-toggle="collapse" data-parent="#accordion" href="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
                          <h4 class="panel-title">Form Price List</h4>
                        </a>
                        <div id="collapseOne" class="panel-collapse collapse in" role="tabpanel" aria-labelledby="headingOne">
                          <div class="panel-body">
                            
                            <form class="form-horizontal form-label-left" id="tambah" data-parsley-validate>
                            <input type="hidden" name="<?=$this->security->get_csrf_token_name();?>" value="<?=$this->security->get_csrf_hash();?>" style="display: none">
                              <span class="section">Tambah Price List</span>
                                <div class="item form-group">
                                  <label class="control-label col-md-3 col-sm-3 col-xs-12" for="produk">Produk Konsumen<span class="required">*</span>
                                  </label>
                                  <div class="col-md-6 col-sm-6 col-xs-12">
                                    <select  class="form-control col-md-7 col-xs-12" id="s2produk_konsumen" name="produk_konsumen" required="required">
                                    </select>
                                  </div>
                                </div>
                                 <div class="item form-group">
                                  <label class="control-label col-md-3 col-sm-3 col-xs-12" for="nama_produk">Nama Produk<span class="required">*</span>
                                  </label>
                                  <div class="col-md-6 col-sm-6 col-xs-12">
                                    <select  class="form-control col-md-7 col-xs-12" id="s2barangjasa" name="nama_produk" required="required">
                                    </select>
                                    </div>
                                </div>
                                <div class="item form-group">
                                  <label class="control-label col-md-3 col-sm-3 col-xs-12" for="size">Size
                                  </label>
                                  <div class="col-md-6 col-sm-6 col-xs-12">
                                    <select id="s2size" class="form-control col-md-7 col-xs-12" name="size" required="required">
                                    </select>
                                  </div>
                                </div>
                              
                                <div class="item form-group">
                                  <label class="control-label col-md-3 col-sm-3 col-xs-12" for="warna">Warna
                                  </label>
                                  <div class="col-md-6 col-sm-6 col-xs-12">
                                    <select id="s2warna" class="form-control col-md-7 col-xs-12" name="warna" required="required">
                                    </select>
                                  </div>
                                </div>

                                <div class="item form-group">
                                  <label class="control-label col-md-3 col-sm-3 col-xs-12" for="warna">bahan
                                  </label>
                                  <div class="col-md-6 col-sm-6 col-xs-12">
                                    <select id="s2bahan" class="form-control col-md-7 col-xs-12" name="bahan" required="required">
                                    </select>
                                  </div>
                                </div>
                                
                                <div class="item form-group">
                                  <label class="control-label col-md-3 col-sm-3 col-xs-12" for="ketebalan">Ketebalan
                                  </label>
                                  <div class="col-md-6 col-sm-6 col-xs-12">
                                    <select id="s2ketebalan" class="form-control col-md-7 col-xs-12" name="ketebalan" required="required">
                                    </select>
                                  </div>
                                </div>
                                <div class="item form-group">
                                  <label class="control-label col-md-3 col-sm-3 col-xs-12" for="finishing">Finishing<span class="required">*</span>
                                  </label>
                                  <div class="col-md-6 col-sm-6 col-xs-12">
                                    <input type="text" class="form-control col-md-7 col-xs-12"  name="finishing" id="finishing">
                                  </div>
                                </div>
                                <div class="item form-group">
                                  <label class="control-label col-md-3 col-sm-3 col-xs-12" for="finishing">Prioritas<span class="required">*</span>
                                  </label>
                                  <div class="col-md-6 col-sm-6 col-xs-12">
                                    <select class="form-control col-md-7 col-xs-12" name="prioritas" required="required">
                                      <option>Pilih Prioritas</option>
                                      <option value="Low">Low</option>
                                      <option value="Medium">Medium</option>
                                      <option value="High">High</option>
                                    </select>
                                  </div>
                                </div>
                                 <div class="item form-group">
                                  <label class="control-label col-md-3 col-sm-3 col-xs-12" for="finishing">Konsumen<span class="required">*</span>
                                  </label>
                                  <div class="col-md-6 col-sm-6 col-xs-12">
                                     <select id="s2konsumen" class="form-control col-md-7 col-xs-12" name="konsumen[]">
                                    </select>
                                  </div>
                                </div>
                                  <div class="item form-group">
                                  <label class="control-label col-md-3 col-sm-3 col-xs-12" for="notekonsumen">Note Konsumen
                                  </label>
                                  <div class="col-md-6 col-sm-6 col-xs-12">
                                   <textarea type="text" name="note_konsumen"  id="notekonsumen" class="form-control col-md-7 col-xs-12"></textarea>
                                  </div>
                                </div>
                                 <div class="item form-group">
                                  <label class="control-label col-md-3 col-sm-3 col-xs-12" for="notekonsumen">Note
                                  </label>
                                  <div class="col-md-6 col-sm-6 col-xs-12">
                                   <textarea type="text" name="note"  id="note" class="form-control col-md-7 col-xs-12"></textarea>
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
                          <h4 class="panel-title">Tabel Price List</h4>
                        </a>
                        <div id="collapseTwo" class="panel-collapse collapse" role="tabpanel" aria-labelledby="headingTwo">
                          <div class="panel-body">
                            <form class="form-horizontal form-label-left">
                            <input type="hidden" name="<?=$this->security->get_csrf_token_name();?>" value="<?=$this->security->get_csrf_hash();?>" style="display: none">
                              
                              <span class="section">Pencarian</span>
                                <div class="item form-group">
                                  <label class="control-label col-md-3 col-sm-3 col-xs-12" for="produk">Produk Konsumen<span class="required">*</span>
                                  </label>
                                  <div class="col-md-6 col-sm-6 col-xs-12">
                                   <input type="text" class="form-control col-md-7 col-xs-12"  name="produk_konsumen" id="cariproduk">
                                  </div>
                                </div>
                                 <div class="item form-group">
                                  <label class="control-label col-md-3 col-sm-3 col-xs-12" for="nama_produk">Nama Produk<span class="required">*</span>
                                  </label>
                                  <div class="col-md-6 col-sm-6 col-xs-12">
                                     <input type="text" class="form-control col-md-7 col-xs-12" id="carinama_produk" name="nama_produk" >
                                    </div>
                                </div>
                                <div class="item form-group">
                                  <label class="control-label col-md-3 col-sm-3 col-xs-12" for="size">Size
                                  </label>
                                  <div class="col-md-6 col-sm-6 col-xs-12">
                                   <input type="text" id="carisize" class="form-control col-md-7 col-xs-12" name="size">
                                  </div>
                                </div>
                                <div class="item form-group">
                                  <label class="control-label col-md-3 col-sm-3 col-xs-12" for="warna">Warna
                                  </label>
                                  <div class="col-md-6 col-sm-6 col-xs-12">
                                     <input type="text" id="cariwarna" class="form-control col-md-7 col-xs-12" name="warna">
                                    </select>
                                  </div>
                                </div>
                                <div class="item form-group">
                                  <label class="control-label col-md-3 col-sm-3 col-xs-12" for="warna">bahan
                                  </label>
                                  <div class="col-md-6 col-sm-6 col-xs-12">
                                     <input type="text" id="caribahan" class="form-control col-md-7 col-xs-12" name="bahan">
                                    </select>
                                  </div>
                                </div>
                                
                                <div class="item form-group">
                                  <label class="control-label col-md-3 col-sm-3 col-xs-12" for="ketebalan">Ketebalan
                                  </label>
                                  <div class="col-md-6 col-sm-6 col-xs-12">
                                     <input type="text"id="cariketebalan" class="form-control col-md-7 col-xs-12" name="ketebalan">
                                    
                                  </div>
                                </div>
                               
                                <div class="item form-group">
                                  <label class="control-label col-md-3 col-sm-3 col-xs-12" for="finishing">Prioritas<span class="required">*</span>
                                  </label>
                                  <div class="col-md-6 col-sm-6 col-xs-12">
                                    <select class="form-control col-md-7 col-xs-12" name="prioritas" id="cariprioritas" required="required">
                                      <option value="">Pilih Prioritas</option>
                                      <option value="Low">Low</option>
                                      <option value="Medium">Medium</option>
                                      <option value="High">High</option>
                                    </select>
                                  </div>
                                </div>
                                 <div class="item form-group">
                                  <label class="control-label col-md-3 col-sm-3 col-xs-12" for="finishing">Konsumen<span class="required">*</span>
                                  </label>
                                  <div class="col-md-6 col-sm-6 col-xs-12">
                                      <input type="text" id="carikonsumen" class="form-control col-md-7 col-xs-12" name="konsumen[]">
                                  </div>
                                </div>
                                 <div class="item form-group">
                                  <label class="control-label col-md-3 col-sm-3 col-xs-12" for="notekonsumen">Note
                                  </label>
                                  <div class="col-md-6 col-sm-6 col-xs-12">
                                    <input type="text" type="text" name="note"  id="carinote" class="form-control col-md-7 col-xs-12">
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
                                        <th width="20%">Produk konsumen</th>
                                        <th width="20%">Nama Produk</th>
                                        <th width="20%">Size</th>
                                       
                                        <th width="20%">Warna</th>
                                        <th width="20%">Bahan</th>
                                        <th width="20%">Ketebalan</th>
                                        <th width="20%">Finishing</th>
                                        <th width="20%">Prioritas</th>
                                        <th width="20%">Konsumen</th>
                                        <th width="20%">Note Konsumen</th>
                                        <th width="20%">Note</th>
                                        <th width="5%">Aksi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                </tbody>
                                <tfoot>
                                    <tr>
                                        
                                       <th width="5%">No</th>
                                        <th width="20%">Produk konsumen</th>
                                        <th width="20%">Nama Produk</th>
                                        <th width="20%">Size</th>
                                        
                                        <th width="20%">Warna</th>
                                        <th width="20%">Bahan</th>
                                        <th width="20%">Ketebalan</th>
                                        <th width="20%">Finishing</th>
                                        <th width="20%">Prioritas</th>
                                        <th width="20%">Konsumen</th>
                                        <th width="20%">Note Konsumen</th>
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
                   <div class="modal fade bd-example-modal-md" role="dialog"  id="copyboard" aria-hidden="true">
                    <div class="modal-dialog modal-md modal-dialog-centered">
                      <div class="modal-content">

                        <div class="modal-header">
                          <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">×</span>
                          </button>
                          <h4 class="modal-title" id="myModalLabel">Copy Board</h4>
                        </div>
                        <div class="modal-body">
                           <div class="col-md-12 col-sm-12 col-xs-12">
                             <textarea type="text" id="board" class="form-control col-md-12 col-xs-12" style="height: 200px;"></textarea>
                            </div>

                        </div>
                        <div class="modal-footer">
                          <button id="buttoncopy" class="btn btn-default" data-clipboard-action="copy" data-clipboard-target="#board">
                            Copy
                            </button>
                          
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
                          <h4 class="modal-title" id="myModalLabel">Ubah Pricelist</h4>
                        </div>
                        <div class="modal-body">
                          <form action="#" id="formubah" class="form-horizontal" data-parsley-validate>
                          <input type="hidden" name="<?=$this->security->get_csrf_token_name();?>" value="<?=$this->security->get_csrf_hash();?>" style="display: none">
                          <input name="id" id="id" type="hidden">
                                <div class="item form-group">
                                  <label class="control-label col-md-3 col-sm-3 col-xs-12" for="produk">Produk Konsumen<span class="required">*</span>
                                  </label>
                                  <div class="col-md-6 col-sm-6 col-xs-12">
                                    <select  class="form-control col-md-7 col-xs-12" id="s2produk_konsumenup" name="produk_konsumen" required="required">
                                    </select>
                                  </div>
                                </div>
                                 <div class="item form-group">
                                  <label class="control-label col-md-3 col-sm-3 col-xs-12" for="nama_produk">Nama Produk<span class="required">*</span>
                                  </label>
                                  <div class="col-md-6 col-sm-6 col-xs-12">
                                    <select  class="form-control col-md-7 col-xs-12" id="s2barangjasaup" name="nama_produk" required="required">
                                    </select>
                                    </div>
                                </div>
                                <div class="item form-group">
                                  <label class="control-label col-md-3 col-sm-3 col-xs-12" for="size">Size
                                  </label>
                                  <div class="col-md-6 col-sm-6 col-xs-12">
                                    <select id="s2sizeup" class="form-control col-md-7 col-xs-12" name="size" required="required">
                                    </select>
                                  </div>
                                </div>
                              
                                <div class="item form-group">
                                  <label class="control-label col-md-3 col-sm-3 col-xs-12" for="warna">Warna
                                  </label>
                                  <div class="col-md-6 col-sm-6 col-xs-12">
                                    <select id="s2warnaup" class="form-control col-md-7 col-xs-12" name="warna" required="required">
                                    </select>
                                  </div>
                                </div>

                                <div class="item form-group">
                                  <label class="control-label col-md-3 col-sm-3 col-xs-12" for="warna">bahan
                                  </label>
                                  <div class="col-md-6 col-sm-6 col-xs-12">
                                    <select id="s2bahanup" class="form-control col-md-7 col-xs-12" name="bahan" required="required">
                                    </select>
                                  </div>
                                </div>
                                
                                <div class="item form-group">
                                  <label class="control-label col-md-3 col-sm-3 col-xs-12" for="ketebalan">Ketebalan
                                  </label>
                                  <div class="col-md-6 col-sm-6 col-xs-12">
                                    <select id="s2ketebalanup" class="form-control col-md-7 col-xs-12" name="ketebalan" required="required">
                                    </select>
                                  </div>
                                </div>
                                <div class="item form-group">
                                  <label class="control-label col-md-3 col-sm-3 col-xs-12" for="finishing">Finishing<span class="required">*</span>
                                  </label>
                                  <div class="col-md-6 col-sm-6 col-xs-12">
                                    <input type="text" class="form-control col-md-7 col-xs-12"  name="finishing" id="finishingup">
                                  </div>
                                </div>
                                <div class="item form-group">
                                  <label class="control-label col-md-3 col-sm-3 col-xs-12" for="finishing">Prioritas<span class="required">*</span>
                                  </label>
                                  <div class="col-md-6 col-sm-6 col-xs-12">
                                    <select class="form-control col-md-7 col-xs-12" name="prioritas" required="required" id="prioritasup">
                                      <option>Pilih Prioritas</option>
                                      <option value="Low">Low</option>
                                      <option value="Medium">Medium</option>
                                      <option value="High">High</option>
                                    </select>
                                  </div>
                                </div>
                                 <div class="item form-group">
                                  <label class="control-label col-md-3 col-sm-3 col-xs-12" for="finishing">Konsumen<span class="required">*</span>
                                  </label>
                                  <div class="col-md-6 col-sm-6 col-xs-12">
                                     <select id="s2konsumenup" class="form-control col-md-7 col-xs-12" name="konsumen[]">
                                    </select>
                                  </div>
                                </div>
                                  <div class="item form-group">
                                  <label class="control-label col-md-3 col-sm-3 col-xs-12" for="notekonsumen">Note Konsumen
                                  </label>
                                  <div class="col-md-6 col-sm-6 col-xs-12">
                                   <textarea type="text" name="note_konsumen"  id="notekonsumenup" class="form-control col-md-7 col-xs-12"></textarea>
                                  </div>
                                </div>
                                 <div class="item form-group">
                                  <label class="control-label col-md-3 col-sm-3 col-xs-12" for="notekonsumen">Note
                                  </label>
                                  <div class="col-md-6 col-sm-6 col-xs-12">
                                   <textarea type="text" name="note"  id="noteup" class="form-control col-md-7 col-xs-12"></textarea>
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