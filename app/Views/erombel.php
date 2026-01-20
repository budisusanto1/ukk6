<section class="d-flex align-items-center justify-content-center pb-5"
  style="padding-top: 100px; background-color: #E0DBD8;">
  <div class="container">
    <div class="col-lg-12 col-12 mt-5 mb-4 mb-lg-4">
      <div class="d-flex flex-column"
        style="background-color: #FAF5F1; padding: 2rem; border-radius: 10px;
        box-shadow: 0 10px 30px rgba(0,0,0,0.1); color: #292F36;">

        <h3 style="font-weight: bold; margin-bottom: 1.5rem;">Edit Rombel</h3>

        <form action="<?= base_url('/simpanrombel') ?>" method="POST">
          <table style="width:100%;">

            <!-- Nama Rombel -->
            <tr>
              <td style="padding-bottom:10px;">
                <label style="font-weight:500;">Nama Rombel</label>
              </td>
              <td style="padding-bottom:10px;">
                <input type="text" class="form-control"
                  name="nama_rombel"
                  value="<?= $rombel->nama_rombel ?>"
                  required>
              </td>
            </tr>

            <!-- Kelas -->
            <tr>
              <td style="padding-bottom:10px;">
                <label style="font-weight:500;">Kelas</label>
              </td>
              <td style="padding-bottom:10px;">
                <select class="form-control" name="id_kelas" required>
                  <?php foreach ($kelas as $k): ?>
                    <option value="<?= $k->id_kelas ?>"
                      <?= ($k->id_kelas == $rombel->id_kelas) ? 'selected' : '' ?>>
                      <?= $k->nama_kelas ?>
                    </option>
                  <?php endforeach; ?>
                </select>
              </td>
            </tr>

            <!-- Jurusan -->
            <tr>
              <td style="padding-bottom:10px;">
                <label style="font-weight:500;">Jurusan</label>
              </td>
              <td style="padding-bottom:10px;">
                <select class="form-control" name="id_jurusan" required>
                  <?php foreach ($jurusan as $j): ?>
                    <option value="<?= $j->id_jurusan ?>"
                      <?= ($j->id_jurusan == $rombel->id_jurusan) ? 'selected' : '' ?>>
                      <?= $j->nama_jurusan ?>
                    </option>
                  <?php endforeach; ?>
                </select>
              </td>
            </tr>

            <!-- Guru -->
            <tr>
              <td style="padding-bottom:10px;">
                <label style="font-weight:500;">Guru</label>
              </td>
              <td style="padding-bottom:10px;">
                <select class="form-control" name="id_guru" required>
                  <?php foreach ($guru as $g): ?>
                    <option value="<?= $g->id_guru ?>"
                      <?= ($g->id_guru == $rombel->id_guru) ? 'selected' : '' ?>>
                      <?= $g->nama_guru ?>
                    </option>
                  <?php endforeach; ?>
                </select>
              </td>
            </tr>

            <!-- Button -->
            <tr>
              <td></td>
              <td style="padding-top:10px;">
                <input type="hidden" name="id_rombel" value="<?= $rombel->id_rombel ?>">
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
