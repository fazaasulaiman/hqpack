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
                    <h2><i class="fa fa-align-left"></i> Atur <span class="text"></span></h2>
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
                          <h4 class="panel-title">Form Hitung Produk Cetak/Sablon<!--  <span class="text"></span> --></h4>
                        </a>
                        <div id="collapseOne" class="panel-collapse collapse in" role="tabpanel" aria-labelledby="headingOne">
                          <div class="panel-body">
                            
                            <form class="form-horizontal form-label-left" id="tambah" data-parsley-validate>
                            <input type="hidden" name="<?=$this->security->get_csrf_token_name();?>" value="<?=$this->security->get_csrf_hash();?>" style="display: none">
                            <input type="hidden" name="id_pricelist" id="id_pricelist">
                          
                              <span class="section">Tambah Perhitungan</span>
                              <div class="item form-group">
                                <label class="control-label col-md-3 col-sm-3 col-xs-12" for="produk">Produk Konsumen<span class="required">*</span>
                                </label>
                                <div class="col-md-6 col-sm-6 col-xs-12">
                                  <input type="text" class="form-control col-md-7 col-xs-12" readonly="readonly" required="required" id="produk">
                                </div>
                              </div>
                              <div class="item form-group">
                                <label class="control-label col-md-3 col-sm-3 col-xs-12" for="nama">Nama Produk<span class="required">*</span>
                                </label>
                                <div class="col-md-6 col-sm-6 col-xs-12">
                                  <input type="text" class="form-control col-md-7 col-xs-12" readonly="readonly" required="required" id="nama">
                                </div>
                              </div>
                              <div class="item form-group">
                                <label class="control-label col-md-3 col-sm-3 col-xs-12" for="size">Size Kertas Jadi<span class="required">*</span>
                                </label>
                                <div class="col-md-6 col-sm-6 col-xs-12">
                                  <input type="text" class="form-control col-md-7 col-xs-12" id="size_kertas"  name="size_kertas" required="required">
                                </div>
                              </div>
                             
                              <div class="item form-group">
                                <label class="control-label col-md-3 col-sm-3 col-xs-12" for="warna">Warna<span class="required">*</span>
                                </label>
                                <div class="col-md-6 col-sm-6 col-xs-12">
                                  <input type="text" class="form-control col-md-7 col-xs-12" readonly="readonly" required="required" id="warna">
                                </div>
                              </div>
                               <div class="item form-group">
                                <label class="control-label col-md-3 col-sm-3 col-xs-12" for="jumlah">Jumlah Order<span class="required">*</span>
                                </label>
                                <div class="col-md-6 col-sm-6 col-xs-12">
                                  <input type="text" class="form-control col-md-7 col-xs-12" id="jumlah_order"  data-parsley-type="integer" name="jumlah_order" required="required">
                                </div>
                              </div>
                              <div class="item form-group">
                                <label class="control-label col-md-3 col-sm-3 col-xs-12" for="Insheet">Insheet<span class="required">*</span>
                                </label>
                                <div class="col-md-6 col-sm-6 col-xs-12">
                                  <input type="text" class="form-control col-md-7 col-xs-12" id="insheet"  data-parsley-type="integer" name="insheet" required="required">
                                </div>
                              </div>
                               <div class="item form-group">
                                <label class="control-label col-md-3 col-sm-3 col-xs-12" for="plano">Plano<span class="required">*</span>
                                </label>
                                <div class="col-md-6 col-sm-6 col-xs-12">
                                  <input type="text" class="form-control col-md-7 col-xs-12" id="plano"  name="plano" required="required">
                                </div>
                              </div>
                              <div class="item form-group">
                                <label class="control-label col-md-3 col-sm-3 col-xs-12" for="margin">Margin<span class="required">*</span>
                                </label>
                                <div class="col-md-6 col-sm-6 col-xs-12">
                                  <select id="margin"  class="form-control col-md-7 col-xs-12" name="margin" required="required">
                                    </select>
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
                          <h4 class="panel-title">Tabel Price list Produk Cetak/Sablon<!-- <span class="text"></span> --></h4>
                        </a>
                        <div id="collapseTwo" class="panel-collapse collapse" role="tabpanel" aria-labelledby="headingTwo">
                          <div class="panel-body">
                            
                            <hr>
                            <table id="table" class="table table-striped dt-responsive nowrap" cellspacing="0" width="100%">
                                <thead>
                                <tr>
                                  <th>No</th>
                                  <th>Size Kertas</th>
                                  <th>Jumlah Order</th>
                                  <th>Insheet</th>
                                  <th>Plano</th>
                                  <th>Margin</th>
                                  <th>Subtotal</th>
                                  <th>Total Margin</th>
                                  <th>Total</th>
                                  <th>Harga Produk</th>
                                  <th>Aksi</th>
                                </tr>
                              </thead>
                              <tbody>

                              </tbody>
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
                                <label class="control-label col-md-3 col-sm-3 col-xs-12" for="size">Size Kertas Jadi<span class="required">*</span>
                                </label>
                                <div class="col-md-6 col-sm-6 col-xs-12">
                                  <input type="text" class="form-control col-md-7 col-xs-12" id="size_kertasup"  name="size_kertas" required="required">
                                </div>
                              </div>
                               <div class="item form-group">
                                <label class="control-label col-md-3 col-sm-3 col-xs-12" for="jumlah">Jumlah Order<span class="required">*</span>
                                </label>
                                <div class="col-md-6 col-sm-6 col-xs-12">
                                  <input type="text" class="form-control col-md-7 col-xs-12" id="jumlah_orderup"  data-parsley-type="integer" name="jumlah_order" required="required">
                                </div>
                              </div>
                              <div class="item form-group">
                                <label class="control-label col-md-3 col-sm-3 col-xs-12" for="Insheet">Insheet<span class="required">*</span>
                                </label>
                                <div class="col-md-6 col-sm-6 col-xs-12">
                                  <input type="text" class="form-control col-md-7 col-xs-12" id="insheetup"  data-parsley-type="integer" name="insheet" required="required">
                                </div>
                              </div>
                               <div class="item form-group">
                                <label class="control-label col-md-3 col-sm-3 col-xs-12" for="plano">Plano<span class="required">*</span>
                                </label>
                                <div class="col-md-6 col-sm-6 col-xs-12">
                                  <input type="text" class="form-control col-md-7 col-xs-12" id="planoup"  name="plano" required="required">
                                </div>
                              </div>
                              <div class="item form-group">
                                <label class="control-label col-md-3 col-sm-3 col-xs-12" for="margin">Margin<span class="required">*</span>
                                </label>
                                <div class="col-md-6 col-sm-6 col-xs-12">
                                  <select id="marginup"  class="form-control col-md-7 col-xs-12" name="margin" required="required">
                                    </select>
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
           <div class="modal fade bs-example-modal-md" tabindex="-1" role="dialog" id="moddetail" aria-hidden="true">
                    <div class="modal-dialog modal-md">
                      <div class="modal-content">

                        <div class="modal-header">
                          <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">×</span>
                          </button>
                          <h4 class="modal-title" id="myModalLabel">Detail hitung P/L</h4>
                        </div>
                        <div class="modal-body">
                          
                          <dl class="dl-horizontal" id="header">
                            <dt>Produk Konsumen:</dt>
                            <dd id="produkdetail"></dd>
                            <dt>Nama Produk:</dt>
                            <dd id="namadetail"></dd>
                            <dt>Size Kerta Jadi:</dt>
                            <dd id="sizedetail"></dd>
                            <dt>Warna:</dt>
                            <dd id="warnadetail"></dd>
                            <dt>Jumlah Order:</dt>
                            <dd id="jumlah_orderdetail"></dd>
                            <dt>Insheet:</dt>
                            <dd id="insheetdetail"></dd>
                            <dt>Jumlah Potong/Plano:</dt>
                            <dd id="planodetail"></dd>
                          </dl>
                          
                          <dl class="dl-horizontal">
                            <dt>Sub Total:</dt>
                            <dd id="subtotaldetail"></dd>
                            <dt>Margin:</dt>
                            <dd id="margindetail"></dd>
                            <dt>Total Margin:</dt>
                            <dd id="totalmargindetail"></dd>
                            <dt>Total:</dt>
                            <dd id="totaldetail"></dd>
                            <dt>Harga Produk:</dt>
                            <dd id="satuandetail"></dd>
                          </dl>
                        <div class="modal-footer">
                          <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                          
                          
                        </div>

                      </div>
                    </div>
                  </div>
                </div>