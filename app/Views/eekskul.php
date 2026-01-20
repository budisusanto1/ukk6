<section class="d-flex align-items-center justify-content-center pb-5"
  style="padding-top: 100px; background-color: #E0DBD8;">
  <div class="container">
    <div class="col-lg-12 col-12 mt-5 mb-4 mb-lg-4">
      <div class="d-flex flex-column"
        style="background-color: #FAF5F1; padding: 2rem; border-radius: 10px;
        box-shadow: 0 10px 30px rgba(0,0,0,0.1); color: #292F36;">

        <h3 style="font-weight: bold; margin-bottom: 1.5rem;">Edit Ekskul</h3>

        <form action="<?= base_url('/simpanekskul') ?>" method="POST">
          <table style="width:100%;">

            <!-- Nama ekskul -->
            <tr>
              <td style="padding-bottom:10px;">
                <label style="font-weight:500;">Nama Ekskul</label>
              </td>
              <td style="padding-bottom:10px;">
                <input type="text" class="form-control"
                  name="nama_ekskul"
                  value="<?= $ekskul->nama_ekskul ?>"
                  required>
              </td>
            </tr>

            <!-- Guru -->
            <tr>
              <td style="padding-bottom:10px;">
                <label style="font-weight:500;">Guru</label>
              </td>
              <td style="padding-bottom:10px;">
                <select class="form-control" name="id_instruktur" required>
                  <?php foreach ($guru as $g): ?>
                    <option value="<?= $g->id_guru ?>"
                      <?= ($g->id_guru == $ekskul->id_instruktur) ? 'selected' : '' ?>>
                      <?= $g->nama_guru ?>
                    </option>
                  <?php endforeach; ?>
                </select>
              </td>
            </tr>

            <!-- Kuota -->
            <tr>
              <td style="padding-bottom:10px;">
                <label style="font-weight:500;">Kuota</label>
              </td>
              <td style="padding-bottom:10px;">
                <input type="text" class="form-control"
                  name="kuota"
                  value="<?= $ekskul->kuota ?>"
                  required>
              </td>
            </tr>

            <!-- Button -->
            <tr>
              <td></td>
              <td style="padding-top:10px;">
                <input type="hidden" name="id_ekskul" value="<?= $ekskul->id_ekskul ?>">
                <button type="submit" class="btn"
                  style="background-color:#A41F13;color:white;">
                  Simpan
                </button>
                <button type="reset" class="btn"
                  style="background-color:#8F7A6E;color:white;">
                  Reset
                </button>
                <button type="button" class="btn"
                  style="background-color:#8F7A6E;color:white;"
                  onclick="window.history.back()">
                  Kembali
                </button>
              </td>
            </tr>

          </table>
        </form>

      </div>
    </div>
  </div>
</section>
