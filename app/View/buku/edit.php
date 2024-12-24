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
                      <form action="/buku/mengedit" method="POST">
                      <div class="col-md-6 col-lg-6">
                      <div class="form-group">
                          <label for="email2">Id Buku</label>
                          <input
                            type="hidden"
                            class="form-control"
                            name="id_buku"
                            value="<?= $model['id_buku'] ?>"
                          />
                        </div>
                        <div class="form-group">
                          <label for="email2">Judul Buku</label>
                          <input
                            type="text"
                            class="form-control"
                            id="email2"
                            name="nama_buku"
                            value="<?= $model['nama_buku'] ?>"
                          />
                        </div>
                          <div class="form-group">
                          <label for="email2">Pengarang</label>
                          <input
                            type="text"
                            class="form-control"
                            id="email2"
                            name="pengarang"
                            value="<?= $model['pengarang'] ?>"
                          />
                          </div>
                          <div class="form-group">
                          <label for="email2">Penerbit</label>
                          <input
                            type="text"
                            class="form-control"
                            id="email2"
                            name="penerbit"
                            value="<?= $model['penerbit'] ?>"
                          />
                          </div>
                          <div class="form-group">
                          <label for="email2">Tahun_terbit</label>
                          <input
                            type="text"
                            class="form-control"
                            id="email2"
                            name="tahun_terbit"
                            value="<?= $model['tahun_terbit'] ?>"
                          />
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
