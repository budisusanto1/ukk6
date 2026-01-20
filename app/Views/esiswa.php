<section class="d-flex align-items-center justify-content-center pb-5" style="padding-top: 100px; background-color: #E0DBD8;">
  <div class="container">
    <div class="col-lg-12 col-12 mt-5 mb-4 mb-lg-4">
      <div class="d-flex flex-column" style="background-color: #FAF5F1; padding: 2rem; border-radius: 10px; box-shadow: 0 10px 30px rgba(0,0,0,0.1); color: #292F36;">

        <h3 style="color: #292F36; font-weight: bold; margin-bottom: 1.5rem;">Edit Siswa</h3>

        <form action="<?= base_url('/simpansiswa') ?>" method="POST" enctype="multipart/form-data">
          <table style="width: 100%;">
            <!-- NIS -->
            <tr>
              <td style="padding-bottom: 10px;"><label for="nis" style="font-weight: 500; color: #292F36;">NIS</label></td>
              <td style="padding-bottom: 10px;">
                <input type="text" class="form-control" id="nis" name="nis" value="<?= $siswa->nis ?>" style="border: 1px solid #8F7A6E; border-radius: 8px; padding: 0.6rem; width: 100%;">
              </td>
            </tr>

            <!-- Nama Siswa -->
            <tr>
              <td style="padding-bottom: 10px;"><label for="nama_siswa" style="font-weight: 500; color: #292F36;">Nama Siswa</label></td>
              <td style="padding-bottom: 10px;">
                <input type="text" class="form-control" id="nama_siswa" name="nama_siswa" value="<?= $siswa->nama_siswa ?>" style="border: 1px solid #8F7A6E; border-radius: 8px; padding: 0.6rem; width: 100%;">
              </td>
            </tr>

            <!-- Tempat Lahir -->
            <tr>
              <td style="padding-bottom: 10px;"><label for="tempat_lahir" style="font-weight: 500; color: #292F36;">Tempat Lahir</label></td>
              <td style="padding-bottom: 10px;">
                <input type="text" class="form-control" id="tempat_lahir" name="tempat_lahir" value="<?= $siswa->tempat_lahir ?>" style="border: 1px solid #8F7A6E; border-radius: 8px; padding: 0.6rem; width: 100%;">
              </td>
            </tr>

            <!-- Tanggal Lahir -->
            <tr>
              <td style="padding-bottom: 10px;"><label for="tanggal_lahir" style="font-weight: 500; color: #292F36;">Tanggal Lahir</label></td>
              <td style="padding-bottom: 10px;">
                <input type="date" class="form-control" id="tanggal_lahir" name="tanggal_lahir" value="<?= $siswa->tanggal_lahir ?>" style="border: 1px solid #8F7A6E; border-radius: 8px; padding: 0.6rem; width: 100%;">
              </td>
            </tr>

            <!-- Jenis Kelamin -->
            <tr>
              <td style="padding-bottom: 10px;"><label for="jenis_kelamin" style="font-weight: 500; color: #292F36;">Jenis Kelamin</label></td>
              <td style="padding-bottom: 10px;">
                <select class="form-control" id="jenis_kelamin" name="jenis_kelamin" style="border: 1px solid #8F7A6E; border-radius: 8px; padding: 0.6rem; width: 100%;">
                  <option value="">--Pilih Jenis Kelamin--</option>
                  <option value="Laki-laki" <?= ($siswa->jenis_kelamin == 'Laki-laki') ? 'selected' : '' ?>>Laki-laki</option>
                  <option value="Perempuan" <?= ($siswa->jenis_kelamin == 'Perempuan') ? 'selected' : '' ?>>Perempuan</option>
                </select>
              </td>
            </tr>

            <!-- Alamat -->
            <tr>
              <td style="padding-bottom: 10px;"><label for="alamat" style="font-weight: 500; color: #292F36;">Alamat</label></td>
              <td style="padding-bottom: 10px;">
                <textarea class="form-control" id="alamat" name="alamat" rows="3" style="border: 1px solid #8F7A6E; border-radius: 8px; padding: 0.6rem; width: 100%;"><?= $siswa->alamat ?></textarea>
              </td>
            </tr>

            <!-- No HP -->
            <tr>
              <td style="padding-bottom: 10px;"><label for="no_hp" style="font-weight: 500; color: #292F36;">No. HP</label></td>
              <td style="padding-bottom: 10px;">
                <input type="text" class="form-control" id="no_hp" name="no_hp" value="<?= $siswa->no_hp ?>" style="border: 1px solid #8F7A6E; border-radius: 8px; padding: 0.6rem; width: 100%;">
              </td>
            </tr>

            <!-- Username -->
            <tr>
              <td style="padding-bottom: 10px;"><label for="username" style="font-weight: 500; color: #292F36;">Username</label></td>
              <td style="padding-bottom: 10px;">
                <input type="text" class="form-control" id="username" name="username" value="<?= $siswa->username ?>" style="border: 1px solid #8F7A6E; border-radius: 8px; padding: 0.6rem; width: 100%;">
              </td>
            </tr>

            <!-- Email -->
            <tr>
              <td style="padding-bottom: 10px;"><label for="email" style="font-weight: 500; color: #292F36;">Email</label></td>
              <td style="padding-bottom: 10px;">
                <input type="email" class="form-control" id="email" name="email" value="<?= $siswa->email ?>" style="border: 1px solid #8F7A6E; border-radius: 8px; padding: 0.6rem; width: 100%;">
              </td>
            </tr>

            <!-- Password -->
            <tr>
              <td style="padding-bottom: 10px;">
                <label>Password (Kosongkan jika tidak diubah)</label>
              </td>
              <td>
                <input type="password" class="form-control" name="password" placeholder="Kosongkan jika tidak diubah">
              </td>
            </tr>

            <!-- Rombel -->
            <tr>
              <td style="padding-bottom: 10px;"><label for="id_rombel" style="font-weight: 500; color: #292F36;">Rombel</label></td>
              <td style="padding-bottom: 10px;">
                <select class="form-control" name="id_rombel" style="border: 1px solid #8F7A6E; border-radius: 8px; padding: 0.6rem; width: 100%;">
                  <option disabled>--Pilih Rombel</option>
                  <?php foreach ($rombel as $r): ?>
                    <option value="<?= $r->id_rombel ?>" <?= ($siswa->id_rombel == $r->id_rombel) ? 'selected' : '' ?>>
                      <?= $r->nama_rombel ?> - <?= $r->nama_kelas ?> <?= $r->nama_jurusan ?> (<?= $r->nama_guru ?>)
                    </option>
                  <?php endforeach; ?>
                </select>
              </td>
            </tr>

            <!-- Buttons -->
            <tr>
              <td></td>
              <td style="padding-top: 10px;">
                <input type="hidden" value="<?= $siswa->id_siswa ?>" name="id_siswa">
                <input type="hidden" value="<?= $siswa->id_user ?>" name="id_user">
                <button type="submit" class="btn" style="background-color: #A41F13; color: white; border: none; padding: 0.5rem 1rem; border-radius: 6px; font-weight: 600;">Simpan</button>
                <button type="reset" class="btn" style="background-color: #8F7A6E; color: white; border: none; padding: 0.5rem 1rem; border-radius: 6px;">Reset</button>
                <button type="button" class="btn" style="background-color: #8F7A6E; color: white; border: none; padding: 0.5rem 1rem; border-radius: 6px;" onclick="window.history.back()">Kembali</button>
              </td>
            </tr>
          </table>
        </form>

      </div>
    </div>
  </div>
</section>
