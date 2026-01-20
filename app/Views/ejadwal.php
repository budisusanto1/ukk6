<section class="d-flex align-items-center justify-content-center pb-5"
  style="padding-top: 100px; background-color: #E0DBD8;">
  <div class="container">
    <div class="col-lg-12 col-12 mt-5 mb-4 mb-lg-4">
      <div class="d-flex flex-column"
        style="background-color: #FAF5F1; padding: 2rem; border-radius: 10px;
        box-shadow: 0 10px 30px rgba(0,0,0,0.1); color: #292F36;">

        <h3 style="font-weight: bold; margin-bottom: 1.5rem;">Edit Jadwal</h3>

        <form action="<?= base_url('/simpanjadwal') ?>" method="POST">
          <table style="width:100%;">

            <tr>
              <td style="padding-bottom:10px;">
                <label style="font-weight:500;">Hari</label>
              </td>
              <td style="padding-bottom:10px;">
                <select class="form-control" name="hari" required>
                    <option value="Senin"
                      <?= ("Senin" == $jadwal->hari) ? 'selected' : '' ?>>
                      Senin
                    </option>
                    <option value="Selasa"
                      <?= ("Selasa" == $jadwal->hari) ? 'selected' : '' ?>>
                      Selasa
                    </option>
                    <option value="Rabu"
                      <?= ("Rabu" == $jadwal->hari) ? 'selected' : '' ?>>
                      Rabu
                    </option>
                    <option value="Kamis"
                      <?= ("Kamis" == $jadwal->hari) ? 'selected' : '' ?>>
                      Kamis
                    </option>
                    <option value="Jumat"
                      <?= ("Jumat" == $jadwal->hari) ? 'selected' : '' ?>>
                      Jumat
                    </option>
                </select>
              </td>
            </tr>

            <tr>
              <td style="padding-bottom:10px;">
                <label style="font-weight:500;">Ekskul</label>
              </td>
              <td style="padding-bottom:10px;">
                <select class="form-control" name="id_ekskul" required>
                  <?php foreach ($ekskul as $e): ?>
                    <option value="<?= $e->id_ekskul ?>"
                      <?= ($e->id_ekskul == $jadwal->id_ekskul) ? 'selected' : '' ?>>
                      <?= $e->nama_ekskul ?>
                    </option>
                  <?php endforeach; ?>
                </select>
              </td>
            </tr>

            <tr>
              <td style="padding-bottom:10px;">
                <label style="font-weight:500;">Jam Mulai</label>
              </td>
              <td style="padding-bottom:10px;">
                <input type="time" class="form-control"
                  name="jam_mulai"
                  value="<?= $jadwal->jam_mulai ?>"
                  required>
              </td>
            </tr>

            <tr>
              <td style="padding-bottom:10px;">
                <label style="font-weight:500;">Jam Selesai</label>
              </td>
              <td style="padding-bottom:10px;">
                <input type="time" class="form-control"
                  name="jam_selesai"
                  value="<?= $jadwal->jam_selesai ?>"
                  required>
              </td>
            </tr>

            <tr>
              <td></td>
              <td style="padding-top:10px;">
                <input type="hidden" name="id" value="<?= $jadwal->id_jadwal ?>">
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
