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
                    <h2><i class="fa fa-align-left"></i> Atur  Konsumen<small></small></h2>
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
                          <h4 class="panel-title">Form tambah konsumen</h4>
                        </a>
                        <div id="collapseOne" class="panel-collapse collapse in" role="tabpanel" aria-labelledby="headingOne">
                          <div class="panel-body">
                            
                            <form class="form-horizontal form-label-left" id="konsumen" data-parsley-validate>
                            <input type="hidden" name="<?=$this->security->get_csrf_token_name();?>" value="<?=$this->security->get_csrf_hash();?>" style="display: none">
                              <span class="section">Tambah konsumen</span>
                                <div class="item form-group">
                                  <label class="control-label col-md-3 col-sm-3 col-xs-12" for="konsumen">Nama Konsumen<span class="required">*</span>
                                  </label>
                                  <div class="col-md-6 col-sm-6 col-xs-12">
                                   
                                    <input class="form-control col-md-7 col-xs-12" minlength="2"  name="konsumen" required="required"  type="text">
                                    
                                  </div>
                                </div>
                                <div class="item form-group">
                                  <label class="control-label col-md-3 col-sm-3 col-xs-12" for="pemilik">Nama Pemilik
                                  </label>
                                  <div class="col-md-6 col-sm-6 col-xs-12">
                                   
                                    <input class="form-control col-md-7 col-xs-12" name="pemilik"   type="text">
                                    
                                  </div>
                                </div>
                                <div class="item form-group">
                                  <label class="control-label col-md-3 col-sm-3 col-xs-12" for="telp">No Telp
                                  </label>
                                  <div class="col-md-6 col-sm-6 col-xs-12">
                                  <div class="input-group">
                                    <span class="input-group-addon">+62</span>
                                    <input class="form-control col-md-7 col-xs-12" data-parsley-type="integer" name="telp" type="text">
                                  </div> 
                                  </div>
                                </div>
                                <div class="item form-group">
                                  <label class="control-label col-md-3 col-sm-3 col-xs-12" for="email">E-mail
                                  </label>
                                  <div class="col-md-6 col-sm-6 col-xs-12">
                                     <div class="input-group">
                                      <span class="input-group-addon"><i class="fa fa-envelope" aria-hidden="true"></i></span>
                                      <input class="form-control col-md-7 col-xs-12" data-parsley-type="email" name="email"  type="text">
                                    </div>
                                    
                                  </div>
                                </div>
                                <div class="item form-group">
                                  <label class="control-label col-md-3 col-sm-3 col-xs-12" for="instagram">Instagram
                                  </label>
                                  <div class="col-md-6 col-sm-6 col-xs-12">
                                   <div class="input-group">
                                    <span class="input-group-addon"><i class="fa fa-instagram" aria-hidden="true"></i></span>
                                      <input class="form-control col-md-7 col-xs-12"  name="instagram"  type="text">
                                    </div>
                                    
                                  </div>
                                </div>
                                <div class="item form-group">
                                  <label class="control-label col-md-3 col-sm-3 col-xs-12" for="facebook">Facebook
                                  </label>
                                  <div class="col-md-6 col-sm-6 col-xs-12">
                                    <div class="input-group">
                                    <span class="input-group-addon"><i class="fa fa-facebook" aria-hidden="true"></i></span>
                                      <input class="form-control col-md-7 col-xs-12" name="facebook"  type="text">
                                    </div>
                                    
                                  </div>
                                </div>
                                <div class="item form-group">
                                  <label class="control-label col-md-3 col-sm-3 col-xs-12" for="alamat">Alamat
                                  </label>
                                  <div class="col-md-6 col-sm-6 col-xs-12">
                                    <textarea type="text" name="alamat"  class="form-control col-md-7 col-xs-12"></textarea>
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
                          <h4 class="panel-title">Tabel Konsumen</h4>
                        </a>
                        <div id="collapseTwo" class="panel-collapse collapse" role="tabpanel" aria-labelledby="headingTwo">
                          <div class="panel-body">
                            <button id="btn-show-all-children" type="button">Expand All</button>
                            <button id="btn-hide-all-children" type="button">Collapse All</button>
                            <hr>
                            <table id="table" class="table table-striped table-bordered dt-responsive nowrap" cellspacing="0" width="100%">
                                <thead>
                                    <tr>
                                        <th width="5%"></th>
                                        <th width="5%">No</th>
                                        <th width="20%">Konsumen</th>
                                        <th width="20%">Pemilik</th>
                                        <th width="20%">Telp</th>
                                        <th width="20%">Email</th>
                                        <th width="20%">Instagram</th>
                                        <th width="20%">Facebook</th>
                                        <th width="20%">Alamat</th>
                                        <th width="5%">Aksi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                </tbody>
                                <tfoot>
                                    <tr>
                                        <th width="5%"></th>
                                        <th width="5%">No</th>
                                        <th width="20%">Konsumen</th>
                                        <th width="20%">Pemilik</th>
                                        <th width="20%">Telp</th>
                                        <th width="20%">Email</th>
                                        <th width="20%">Instagram</th>
                                        <th width="20%">Facebook</th>
                                        <th width="20%">Alamat</th>
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
                          <h4 class="modal-title" id="myModalLabel">Ubah Data Konsumen</h4>
                        </div>
                        <div class="modal-body">
                          <form action="#" id="formubah" class="form-horizontal" data-parsley-validate>
                          <input type="hidden" name="<?=$this->security->get_csrf_token_name();?>" value="<?=$this->security->get_csrf_hash();?>" style="display: none">
                          <input name="id" id="id" type="hidden">
                                <div class="item form-group">
                                  <label class="control-label col-md-3 col-sm-3 col-xs-12" for="konsumen">Konsumen<span class="required">*</span>
                                  </label>
                                  <div class="col-md-6 col-sm-6 col-xs-12">
                                    <input id="konsumenup" class="form-control col-md-7 col-xs-12" minlength="2" name="konsumen" required="required" type="text">
                                  </div>
                                </div>
                                <div class="item form-group">
                                  <label class="control-label col-md-3 col-sm-3 col-xs-12" for="pemilik">Pemilik
                                  </label>
                                  <div class="col-md-6 col-sm-6 col-xs-12">
                                    <input id="pemilikup" class="form-control col-md-7 col-xs-12" name="pemilik" minlength="2"  type="text">
                                  </div>
                                </div>
                                
                                 <div class="item form-group">
                                  <label class="control-label col-md-3 col-sm-3 col-xs-12" for="telp">Telp
                                  </label>
                                  <div class="col-md-6 col-sm-6 col-xs-12">
                                    <div class="input-group">
                                    <span class="input-group-addon">+62</span>
                                      <input id="telpup" type="text" name="telp" minlength="5" class="form-control col-md-7 col-xs-12">
                                    </div>
                                  </div>
                                </div>
                                <div class="item form-group">
                                  <label class="control-label col-md-3 col-sm-3 col-xs-12" for="email">Email
                                  </label>
                                  <div class="col-md-6 col-sm-6 col-xs-12">
                                    <div class="input-group">
                                      <span class="input-group-addon"><i class="fa fa-envelope" aria-hidden="true"></i></span>
                                    <input id="emailup" type="text" name="email" data-parsley-type="email" class="form-control col-md-7 col-xs-12">
                                    </div>
                                  </div>
                                </div>
                                <div class="item form-group">
                                  <label class="control-label col-md-3 col-sm-3 col-xs-12" for="instagram">Instagram
                                  </label>
                                  <div class="col-md-6 col-sm-6 col-xs-12">
                                    <div class="input-group">
                                      <span class="input-group-addon"><i class="fa fa-instagram" aria-hidden="true"></i></span>
                                      <input id="instagramup" type="text" name="instagram"  class="form-control col-md-7 col-xs-12">
                                    </div>
                                  </div>
                                </div>
                                <div class="item form-group">
                                  <label class="control-label col-md-3 col-sm-3 col-xs-12" for="facebook">Facebook
                                  </label>
                                  <div class="col-md-6 col-sm-6 col-xs-12">
                                    <div class="input-group">
                                      <span class="input-group-addon"><i class="fa fa-facebook" aria-hidden="true"></i></span>
                                    <input id="facebookup" type="text"  name="facebook" class="form-control col-md-7 col-xs-12">
                                    </div>
                                  </div>
                                </div>
                                <div class="item form-group">
                                  <label class="control-label col-md-3 col-sm-3 col-xs-12" for="level">Alamat
                                  </label>
                                  <div class="col-md-6 col-sm-6 col-xs-12">
                                    <textarea type="text" id="alamatup" name="alamat"  class="form-control col-md-7 col-xs-12" ></textarea>
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