<div class="container">
<?php if(isset($model['error'])){ ?>
         <div class="alert alert-primary"><?= $model['error'] ?></div>
          <?php   } ?>
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
                      <form action="/anggota/menambah" method="POST">
                      <div class="col-md-6 col-lg-6">
                        <div class="form-group">
                          <label for="email2">Nama</label>
                          <input
                            type="text"
                            class="form-control"
                            id="email2"
                            name="nama"
                            placeholder="Nama"
                          />
                        </div>
                          <div class="form-group">
                          <label for="email2">Alamat</label>
                          <input
                            type="text"
                            class="form-control"
                            id="email2"
                            name="alamat"
                            placeholder="Alamat"
                          />
                          </div>
                          <div class="form-group">
                          <label for="email2">nik</label>
                          <input
                            type="text"
                            class="form-control"
                            id="email2"
                            name="nik"
                            placeholder="Nik"
                          />
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
