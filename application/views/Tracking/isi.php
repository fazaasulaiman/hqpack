<div class="row">
<div class="col-md-12 col-sm-12 col-xs-12">
                <div class="x_panel">
                  <div class="x_title">
                    <h2><i class="fa fa-bars"></i> Profil <small>Alumni</small></h2>
                    <ul class="nav navbar-right panel_toolbox">
                      <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
                      </li>
                      <li class="dropdown">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false"><i class="fa fa-wrench"></i></a>
                        <ul class="dropdown-menu" role="menu">
                          <li><a href="#">Settings 1</a>
                          </li>
                          <li><a href="#">Settings 2</a>
                          </li>
                        </ul>
                      </li>
                      <li><a class="close-link"><i class="fa fa-close"></i></a>
                      </li>
                    </ul>
                    <div class="clearfix"></div>
                  </div>
                  <div class="x_content">
                  <div class="col-md-3 col-sm-3 col-xs-12 profile_left">
                      <div class="profile_img">
                        <div id="crop-avatar">
                          <!-- Current avatar -->
                          <img class="img-responsive avatar-view" id="pp" src="" alt="Avatar" title="Change the avatar">
                        </div>
                      </div>
                      <h3 id="nama"></h3>

                      <ul class="list-unstyled user_data">
                        <li id="lokasi"><i class="fa fa-map-marker user-profile-icon"></i>
                        </li>

                        <li id="program"><i class="fa fa-briefcase user-profile-icon" ></i>
                        </li>
                      </ul>

                      <a class="btn btn-success" data-toggle="modal" data-target="#modal" href="<?php echo base_url()?>Regis"><i class="fa fa-edit m-right-xs"></i>Edit Profil</a>
                      <br />

                      <!-- start skills -->
                      
                      <!-- end of skills -->

                    </div>

                  <div class="col-md-9 col-sm-9 col-xs-12">
                    <div class="" role="tabpanel" data-example-id="togglable-tabs">
                      <ul id="myTab1" class="nav nav-tabs bar_tabs right" role="tablist">
                        <li role="presentation" class="active"><a href="#tab_content11" id="home-tabb" role="tab" data-toggle="tab" aria-controls="home" aria-expanded="true">Kerja</a>
                        </li>
                        <li role="presentation" class=""><a href="#tab_content22" role="tab" id="profile-tabb" data-toggle="tab" aria-controls="profile" aria-expanded="false">Melanjutkan</a>
                        </li>
                      </ul>
                      <div id="myTabContent2" class="tab-content">
                        <div role="tabpanel" class="tab-pane fade active in" id="tab_content11" aria-labelledby="home-tab">
                           <form id="formkerja" data-parsley-validate>
                           <input type="hidden" name="<?=$this->security->get_csrf_token_name();?>" value="<?=$this->security->get_csrf_hash();?>" style="display: none">
                           <input type="hidden" name="status" value="kerja">
                           <div class="row">
                              <div class="col-md-4 form-group">
                              <input type="text" id="nama" required="required" placeholder="Nama Institusi" name="nama" class="form-control">
                              </div>
                              <div class="col-md-4 form-group">
                              <select id="propinsi" required="required"  data-parsley-type="alphanum" placeholder="Provinsi" name="propinsi" class="form-control">
                              <option value="" selected disabled>--Pilih Provinsi--</option>
                              </select>
                              </div>
                              <div class="col-md-4 form-group">
                              <select id="kota" required="required"  placeholder="Kota/kab" name="kota" class="form-control">
                              <option value="" selected disabled>--Pilih Kota/Kab--</option>
                              </select>
                              </div>
                            </div>
                            <div class="row">
                              <div class="col-md-4 form-group">
                              <input type="text" id="jabatan" required="required"  placeholder="jabatan" name="jabatan" class="form-control">
                              </div>
                              <div class="col-md-4 form-group">
                              <select id="kec" name="kec" required="required"  placeholder="Kecamatan" name="kec" class="form-control">
                              <option value="" selected disabled>--Pilih Kecamatan--</option>
                              </select>
                              </div>
                              <div class="col-md-2 form-group">
                              <input type="text" id="tgl" placeholder="Tanggal" name="tgl" class="form-control datepicker" required="">
                              </div>
                              <div class="col-md-2 form-group">
                              <input type="text" id="kodepos" required="required" data-parsley-type="integer"    placeholder="Kode pos" name="kodepos" class="form-control">
                              </div>
                            </div>
                          <div class="row">
                          <div class="col-md-6 form-group">
                            <textarea id="pekerjaan" required="required" data-parsley-minlength="6" name="pekerjaan" class="form-control" placeholder="Deskripsi pekerjaan"></textarea>
                              </div>
                            <div class="col-md-6 form-group">
                            <textarea id="alamat" required="required" data-parsley-minlength="6" placeholder="Alamat kantor" name="alamat" class="form-control"></textarea>
                            </div>
                          </div>
                          
                          <div class="pull-right">
                            <button type="reset" class="btn btn-default" value="Reset">Reset</button>
                            <a class="btn btn-primary" id="validate">Submit</a>
                          </div>
                          </form>
                        </div>
                        <div role="tabpanel" class="tab-pane fade" id="tab_content22" aria-labelledby="profile-tab">
                         <form id="formkuliah" data-parsley-validate>
                           <input type="hidden" name="<?=$this->security->get_csrf_token_name();?>" value="<?=$this->security->get_csrf_hash();?>" style="display: none">
                           <input type="hidden" name="status" value="kuliah">
                           <div class="row">
                              <div class="col-md-4 form-group">
                              <input type="text" id="nama" required="required" placeholder="Nama Institusi" name="nama" class="form-control">
                              </div>
                              <div class="col-md-4 form-group">
                              <select id="propinsi2" required="required"  data-parsley-type="alphanum" placeholder="Provinsi" name="propinsi" class="form-control">
                              <option value="" selected disabled>--Pilih Provinsi--</option>
                              </select>
                              </div>
                              <div class="col-md-4 form-group">
                              <select id="kota2" required="required"  placeholder="Kota/kab" name="kota" class="form-control">
                              <option value="" selected disabled>--Pilih Kota/Kab--</option>
                              </select>
                              </div>
                            </div>
                            <div class="row">
                            <div class="col-md-4 form-group">
                              <select id="jabatan" required="required" placeholder="Jenjang" name="jabatan" class="form-control">
                              <option value="" selected disabled>--Pilih Jenjang--</option>
                              <option value="D1">D1</option>
                              <option value="D2">D2</option>
                              <option value="D3">D3</option>
                              <option value="D4">D4</option>
                              <option value="S1">S1</option>
                              <option value="S2">S2</option>
                              </select>
                              </div>
                              <div class="col-md-4 form-group">
                              <select id="kec2" required="required"  placeholder="Kecamatan" name="kec" class="form-control">
                              <option value="" selected disabled>--Pilih Kecamatan--</option>
                              </select>
                              </div>
                              <div class="col-md-2 form-group">
                              <input type="text" id="tgl" placeholder="Tanggal" name="tgl" class="form-control datepicker" required="">
                              </div>
                              <div class="col-md-2 form-group">
                              <input type="text" id="kodepos" required="required" data-parsley-type="integer"     placeholder="Kode pos" name="kodepos" class="form-control">
                              </div>
                            </div>
                          <div class="row">
                           <div class="col-md-6 form-group">
                            <input type="text" id="pekerjaan" required="required" data-parsley-minlength="4" placeholder="jurusan" name="pekerjaan" class="form-control">
                              </div>
                            <div class="col-md-6 form-group">
                            <textarea id="alamat" required="required" data-parsley-minlength="6" placeholder="Alamat kantor" name="alamat" class="form-control"></textarea>
                            </div>
                          </div>
                          <div class="pull-right">
                            <button type="reset" class="btn btn-default" value="Reset">Reset</button>
                            <a class="btn btn-primary" id="validate2">Submit</a>
                          </div>
                           </form>
                        </div>
                      </div>
                    </div>
                    <!-- start recent activity -->
                    
                            <ul class="messages" id="tracking">
                              
                            </ul>
                            <!-- end recent activity -->
                    </div>
                  </div>
                </div>
              </div>
            </div>