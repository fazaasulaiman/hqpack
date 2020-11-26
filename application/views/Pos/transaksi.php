<div class="row">
              <div class="col-md-12">
                <div class="x_panel">
                  <div class="x_title">
                    <h2>Point Of Sales</h2>
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

                    <section class="content invoice">
                      <!-- title row -->
                      <div class="row">
                    
                        <div class="col-xs-12 invoice-header">
                          <h1>
                                <i class="fa fa-shopping-bag"></i> POS SYSTEM.
                                <small class="pull-right">Date: <?php echo date("d/m/Y")?></small>
                              </h1>
                        </div>
                        <!-- /.col -->
                      </div>
                      <div class="row">
                      <form id="form" data-parsley-validate>
                      <input type="hidden" name="<?=$this->security->get_csrf_token_name();?>" value="<?=$this->security->get_csrf_hash();?>" style="display: none">
                        <input type="hidden" id="id" name="id">
                        <input type="hidden" id="harga" name="harga">
                        <input type="hidden" id="kode" name="kode">
                        <input type="hidden" id="namabarang" name="barang">
                        <input type="hidden" id="produksi" name="produksi">
                        <div class="col-md-3 form-group">
                          <input type="text" class="form-control"  id="barang" placeholder="Nama Barang" required="required"> 
                        </div>
                        <div class="col-md-2 form-group">
                          <input type="text" class="form-control" id="jumlah" name="jumlah" placeholder="Jumlah" data-parsley-type="integer" required="required"> 
                        </div>
                        <div class="col-md-2 col-md-offset-2 form-group">
                          <input type="text" class="form-control" id="diskon" name="diskon" data-parsley-type="integer" placeholder="Diskon">
                        </div>
                        <div class="col-md-2 form-group">
                          <input type="text" class="form-control" id="itemharga" name="itemharga" placeholder="Total Harga" required="required" readonly>
                        </div>
                        <a class="btn btn-primary" id="tambah-barang"><i class="fa fa-cart-plus">(F1)</i></a>
                        </form>
                      </div>
                      <!-- Table row -->
                      <div class="row">
                        <div class="col-xs-12 table">
                          <table class="table table-striped">
                            <thead>
                              <tr>
                                <th>Kode</th>
                                <th style="width: 20%">Barang</th>
                                <th>Jumah</th>
                                <th>Harga item</th>
                                <th>Diskon</th>
                                <th>Total</th>
                              </tr>
                            </thead>
                            <tbody id="transaksi-item">
                              <?php if(!empty($carts) && is_array($carts)){?>
                                <?php foreach($carts['data'] as $k => $cart){?>
                              <tr id="<?php echo $k;?>" class="cart-value">
                                <td><?php echo $cart['kode'];?></td>
                                <td><?php echo $cart['name'];?></td>
                                <td><?php echo $cart['qty'];?></td>
                                <td>Rp<?php echo number_format($cart['price']);?></td>
                                <td><?php echo $cart['diskon'];?></td>
                                 <td><?php echo $cart['subtotal'];?></td>
                                <td><span class="btn btn-danger btn-sm transaksi-delete-item" data-cart="<?php echo $k;?>">x</span></td>
                              </tr>
                                <?php }?>
                              <?php }?>
                            </tbody>
                          </table>
                        </div>
                        <!-- /.col -->
                      </div>
                      <!-- /.row -->
                      <p class="lead">Metode Pembayaran:</p>
                      <div class="row">
                        <!-- accepted payments column -->
                        <div class="col-xs-6">
                          
                          <table class="table">
                            <thead>
                              <tr>
                                <td><center>Tunai</center></td>
                                <td><center>Voucher</center></td>
                                <td><center>ATM</center></td>
                              </tr>
                            </thead>
                            <tbody>
                              <tr>
                                <td><input type="text" id="tunai" name="tunai" class="form-control"></td>
                                <td><input type="text" id="voucher" name="voucher" class="form-control"></td>
                                <td><input type="text" id="atm" name="atm" class="form-control"></td>
                              </tr>
                            </tbody>
                          </table>
                        </div>
                        <!-- /.col -->
                        <div class="col-xs-6">
                          <div class="table-responsive">
                            <table class="table">
                              <tbody>
                                <tr>
                                  <th style="width:50%">Subtotal:</th>
                                  <td id="total-pembelian"></td>
                                </tr>
                                <tr>
                                  <th>Pembayaran</th>
                                  <td id="pembayaran"></td>
                                </tr>
                                <tr>
                                  <th>Kembali:</th>
                                  <td id="kembali"></td>
                                </tr>
                              </tbody>
                            </table>
                          </div>
                        </div>
                        <!-- /.col -->
                      </div>
                      <!-- /.row -->

                      <!-- this row will not appear when printing -->
                      <div class="row no-print">
                        <div class="col-xs-12">
                         
                          <a class="btn btn-success pull-right" id="bayar-barang"><i class="fa fa-credit-card"></i>Bayar (F6)</a>
                          
                        </div>
                      </div>
                    </section>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>