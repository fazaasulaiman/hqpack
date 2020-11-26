<div class="row">
              <div class="col-md-12">
                <div class="x_panel">
                  <div class="x_title">
                    <h2>Retur Penjualan</h2>
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
                                <small class="pull-left">Kode Penjualan:<div id="id_penjualan"><?php echo $id_penjualan;?></div></small>
                                <small class="pull-right">Date: <?php echo date("d/m/Y")?></small>
                              </h1>
                        </div>
                        <!-- /.col -->
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
                                <td><input type="number" row-id="<?php echo $k;?>" class="retur_penjualan_qty" value="<?php echo $cart['qty'];?>" max="<?php echo $cart['qty'];?>" min="1"/></td>
                                <td>Rp <?php echo number_format($cart['price']);?></td>
                                <td>Rp <?php echo $cart['diskon'];?></td>
                                <td>Rp <?php echo $cart['subtotal'];?></td>
                                <td data-cart="<?php echo $k;?>"><span class="btn btn-danger btn-sm transaksi-delete-item" data-cart="<?php echo $k;?>">x</span></td>
                              </tr>
                                <?php }?>
                              <?php }?>
                            </tbody>
                          </table>
                        </div>
                        <!-- /.col -->
                      </div>
                      <!-- /.row -->
                     
                      <div class="row">
                        <!-- accepted payments column -->
                        
                        <!-- /.col -->
                        <div class="col-xs-6 col-xs-offset-6">
                          <div class="table-responsive">
                            <table class="table">
                              <tbody>
                                <tr>
                                  <th style="width:50%">Total Harga:</th>
                                  <td id="total-pembelian">Rp <?php echo number_format($carts['total_price']);?></td>
                                </tr>
                                <tr>
                                  <th style="width:50%">Total Item:</th>
                                  <td id="total-item"><?php echo $carts['total_item'];?></td>
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
                          <button class="btn btn-default" href="<?php base_url()?>Pos/retur"><i class="fa fa-reply"></i> Kembali</button>
                          <a class="btn btn-success pull-right" id="bayar-barang"><i class="fa fa-check"></i>Submit (F6)</a>
                          
                        </div>
                      </div>
                    </section>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>