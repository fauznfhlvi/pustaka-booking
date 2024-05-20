<?= $this->session->flashdata('pesan'); ?> 

<div style="padding: 25px;"> 
    <div class="x_panel"> 
        <div class="x_content"> 
            <!-- Tampilkan semua produk --> 
            <div class="row"> 
                <!-- looping products --> 
                <?php foreach ($buku as $buku_item) { ?> 
                    <div class="col-md-2 col-md-3"> 
                        <div class="thumbnail" style="height: 370px;"> 
                            <img src="<?= base_url('assets/img/upload/') . $buku_item->image; ?>" style="max-width:100%; max-height: 100%; height: 200px; width: 180px"> 

                            <div class="caption"> 
                                <h5 style="min-height:30px;"><?= $buku_item->pengarang ?></h5> 
                                <h5><?= $buku_item->penerbit ?></h5> 
                                <h5><?= substr($buku_item->tahun_terbit, 0, 4) ?></h5> 
                                <p> 
                                    <?php 
                                    if ($buku_item->stok < 1) { 
                                        echo "<i class=' btn-outline-primary fas fa-shopping-cart'> Booking&nbsp;&nbsp 0</i>"; 
                                    } else { 
                                        echo "<a class=' btn-outline-primary fas fa-shopping-cart' href='" . base_url('booking/tambahBooking/' . $buku_item->id) . "'> Booking</a>"; 
                                    } 
                                    ?> 

                                    <a class=" btn-outline-warning fas fa-search" href="<?= base_url('Home/detailbuku/' . $buku_item->id); ?>"> Detail</a></p> 
                                    
                            </div> 
                        </div> 
                    </div> 
                <?php } ?> 
                <!-- end looping --> 
            </div> 
        </div> 
    </div> 
</div>