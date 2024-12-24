<div class="container">
          <div class="page-inner">
            <div class="page-header">
              
            </div>
            <div class="row">
              <div class="col-md-12">
                <div class="card">
                  <div class="card-header">
                    
                  </div>
                  <div class="card-body">
                    <div class="row">
                      <form action="/peminjam/menambah" method="POST">
                      <div class="col-md-6 col-lg-6">
                        <div class="form-group">
                        <label for="smallSelect">Id Anggota</label>
                          <select
                            class="form-select form-control-sm"
                            id="smallSelect" name="id_anggota"
                          >
                          <?php foreach($model['anggota'] as $anggota) { ?>

                            <option><?= $anggota['id_anggota'] ?></option>

                            <?php } ?>
                          </select>
                        </div>
                          <div class="form-group">
                          <label for="smallSelect">Id Buku</label>
                          <select
                            class="form-select form-control-sm"
                            id="smallSelect" name="id_buku"
                          >
                          <?php foreach($model['buku'] as $buku) { ?>

                            <option><?= $buku['id_buku'] ?></option>

                          <?php } ?>
                          </select>
                          </div>
                          <div class="form-group">
                          <label for="email2">Tanggal Pengembalian</label>
                          <input
                            type="date"
                            class="form-control"
                            id="email2"
                            name="waktu_pengembalian"
                            placeholder="Tanggal Pengembalian"
                          />
                          </div>
                          </div>
                          
                          <div class="card-action">
                    <button type="submit" class="btn btn-success">Tambah</button>
                    
                  </div>
                  </form>
                          </div>
                          </div>
                          </div>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
</div>
