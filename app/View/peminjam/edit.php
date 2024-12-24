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
                      <form action="/peminjam/mengedit" method="POST">
                      <div class="col-md-6 col-lg-6">
                      <div class="form-group">
                          <label for="email2">Id Peminjam</label>
                          <input
                            type="hidden"
                            class="form-control"
                            name="id_peminjam"
                            value="<?= $model['id_peminjam']; ?>"
                          />
                        </div>
                      <div class="form-group">
                          <label for="email2">Id Anggota</label>
                          <input
                            type="hidden"
                            class="form-control"
                            name="id_anggota"
                            value="<?= $model['id_anggota'] ?>"
                          />
                        </div>
                        <div class="form-group">
                          <label for="email2">id Buku</label>
                          <input
                            type="hidden"
                            class="form-control"
                            id="email2"
                            name="id_buku"
                            value="<?= $model['id_buku'] ?>"
                          />
                        </div>
                          </div>
                          <div class="form-group">
                          <label for="email2">Status</label></label>
                          <select
                            class="form-select form-control-sm"
                            id="smallSelect" name="status"
                          >
                            <option>belum kembali</option>
                            <option>sudah kembali</option>
                          </select>
                          
                          </div>
                          </div>
                          <div class="card-action">
                    <button type="submit" class="btn btn-success">Ubah</button>
                    
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
