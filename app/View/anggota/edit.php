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
                      <form action="/anggota/mengedit" method="POST">
                      <div class="col-md-6 col-lg-6">
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
                          <label for="email2">Nama</label>
                          <input
                            type="text"
                            class="form-control"
                            id="email2"
                            name="nama"
                            value="<?= $model['nama'] ?>"
                          />
                        </div>
                          <div class="form-group">
                          <label for="email2">Alamat</label>
                          <input
                            type="text"
                            class="form-control"
                            id="email2"
                            name="alamat"
                            value="<?= $model['alamat'] ?>"
                          />
                          </div>
                          <div class="form-group">
                          <label for="email2">Nik</label>
                          <input
                            type="text"
                            class="form-control"
                            id="email2"
                            name="nik"
                            value="<?= $model['nik'] ?>"
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