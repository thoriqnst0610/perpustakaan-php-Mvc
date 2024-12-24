
<div class="container">
<?php if(isset($model['error'])){ ?>
         <div class="alert alert-primary"><?= $model['error'] ?></div>
          <?php   } ?>
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                </div>
                <div class="card-body">
                    <h5>Kontak Developer Wa : 085261762764</h5>
                    <!-- Modal -->
                    <div class="modal fade" id="addRowModal" tabindex="-1" role="dialog" aria-hidden="true">
                        <div class="modal-dialog" role="document">
                            <div class="modal-content">
                                <div class="modal-header border-0">
                                    <h5 class="modal-title">
                                        <span class="fw-mediumbold"> New</span>
                                        <span class="fw-light"> Row </span>
                                    </h5>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                </div>
                                <div class="modal-body">
                                    <p class="small">Create a new row using this form, make sure you fill them all</p>
                                    <form id="addRowForm">
                                        <div class="row">
                                            <div class="col-sm-12">
                                                <div class="form-group form-group-default">
                                                    <label>Name</label>
                                                    <input id="addName" type="text" class="form-control" placeholder="fill name" required />
                                                </div>
                                            </div>
                                            <div class="col-md-6 pe-0">
                                                <div class="form-group form-group-default">
                                                    <label>Position</label>
                                                    <input id="addPosition" type="text" class="form-control" placeholder="fill position" required />
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="form-group form-group-default">
                                                    <label>Office</label>
                                                    <input id="addOffice" type="text" class="form-control" placeholder="fill office" required />
                                                </div>
                                            </div>
                                        </div>
                                    </form>
                                </div>
                                <div class="modal-footer border-0">
                                    <button type="button" id="addRowButton" class="btn btn-primary">Add</button>
                                    <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Close</button>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="table-responsive">
                        <table id="bookTable" class="display table table-striped table-hover">
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th>Nama</th>
                                    <th>Pengarang</th>
                                    <th>Penerbit</th>
                                    <th>Tahun Terbit</th>
                                    <th style="width: 10%">Action</th>
                                </tr>
                            </thead>
                            
                            <tbody>
                                <?php $no = 1; foreach($model['buku'] as $buku) { ?>
                                <tr>
                                    <td><?= $no++; ?></td>
                                    <td><?= htmlspecialchars($buku['nama_buku']) ?></td>
                                    <td><?= htmlspecialchars($buku['pengarang']) ?></td>
                                    <td><?= htmlspecialchars($buku['penerbit']) ?></td>
                                    <td><?= htmlspecialchars($buku['tahun_terbit']) ?></td>
                                    <td>
                                        <div class="form-button-action">
                                            <a type="button" class="btn btn-link btn-primary btn-lg" data-bs-toggle="tooltip" title="Edit Task" href="/buku/mengedit?id_buku=<?= $buku['id_buku'] ?>">
                                                <i class="fa fa-edit"></i>
                                            </a>
                                            <a type="button" class="btn btn-link btn-danger" data-bs-toggle="tooltip" title="Remove" href="/buku/menghapus?id_buku=<?= $buku['id_buku'] ?>">
                                                <i class="fa fa-times"></i>
                                            </a>
                                        </div>
                                    </td>
                                </tr>
                                <?php } ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- End Custom template -->
</div>
    <!--   Core JS Files   -->
    <script src="../assets/js/core/jquery-3.7.1.min.js"></script>
    <script src="../assets/js/core/popper.min.js"></script>
    <script src="../assets/js/core/bootstrap.min.js"></script>

    <!-- jQuery Scrollbar -->
    <script src="../assets/js/plugin/jquery-scrollbar/jquery.scrollbar.min.js"></script>
    <!-- Datatables -->
    <script src="../assets/js/plugin/datatables/datatables.min.js"></script>
    <!-- Kaiadmin JS -->
    <script src="../assets/js/kaiadmin.min.js"></script>
    <!-- Kaiadmin DEMO methods, don't include it in your project! -->
    <script src="../assets/js/setting-demo2.js"></script>

<script>
  $(document).ready(function() {
      $('#bookTable').DataTable({
          "pageLength": 5 // Set default page length
      });
      
      $('#addRowButton').on('click', function() {
          var name = $('#addName').val();
          var position = $('#addPosition').val();
          var office = $('#addOffice').val();
          
          var table = $('#bookTable').DataTable();
          table.row.add([
              table.rows().count() + 1, // No
              name,
              position,
              office,
              '<div class="form-button-action">' +
                  '<button type="button" class="btn btn-link btn-primary btn-lg" data-bs-toggle="tooltip" title="Edit Task">' +
                      '<i class="fa fa-edit"></i>' +
                  '</button>' +
                  '<button type="button" class="btn btn-link btn-danger" data-bs-toggle="tooltip" title="Remove">' +
                      '<i class="fa fa-times"></i>' +
                  '</button>' +
              '</div>'
          ]).draw();
          
          $('#addRowModal').modal('hide');
      });
  });
</script>
</body>
</html>
