<section class="d-flex align-items-center justify-content-center pb-5" style="padding-top: 100px; background-color: #E0DBD8;">
  <div class="container">
    <div class="col-lg-12 col-12 mt-5 mb-4 mb-lg-4">
      <div class="d-flex flex-column" style="background-color: #FAF5F1; padding: 2rem; border-radius: 10px; box-shadow: 0 10px 30px rgba(0,0,0,0.1); color: #292F36;">

        <h3 style="color: #292F36; font-weight: bold; margin-bottom: 1.5rem;">Edit Guru</h3>

        <form action="<?= base_url('/simpanguru') ?>" method="POST" enctype="multipart/form-data">
          <table style="width: 100%;">

            <!-- NIP -->
            <tr>
              <td style="padding-bottom: 10px;"><label for="nip" style="font-weight: 500; color: #292F36;">NIP</label></td>
              <td style="padding-bottom: 10px;">
                <input type="text" class="form-control" id="nip" name="nip" value="<?= $guru->nip ?>" style="border: 1px solid #8F7A6E; border-radius: 8px; padding: 0.6rem; width: 100%;">
              </td>
            </tr>

            <!-- Nama Guru -->
            <tr>
              <td style="padding-bottom: 10px;"><label for="nama_guru" style="font-weight: 500; color: #292F36;">Nama Guru</label></td>
              <td style="padding-bottom: 10px;">
                <input type="text" class="form-control" id="nama_guru" name="nama_guru" value="<?= $guru->nama_guru ?>" style="border: 1px solid #8F7A6E; border-radius: 8px; padding: 0.6rem; width: 100%;">
              </td>
            </tr>

            <!-- Tempat Lahir -->
            <tr>
              <td style="padding-bottom: 10px;"><label for="tempat_lahir" style="font-weight: 500; color: #292F36;">Tempat Lahir</label></td>
              <td style="padding-bottom: 10px;">
                <input type="text" class="form-control" id="tempat_lahir" name="tempat_lahir" value="<?= $guru->tempat_lahir ?>" style="border: 1px solid #8F7A6E; border-radius: 8px; padding: 0.6rem; width: 100%;">
              </td>
            </tr>

            <!-- Tanggal Lahir -->
            <tr>
              <td style="padding-bottom: 10px;"><label for="tanggal_lahir" style="font-weight: 500; color: #292F36;">Tanggal Lahir</label></td>
              <td style="padding-bottom: 10px;">
                <input type="date" class="form-control" id="tanggal_lahir" name="tanggal_lahir" value="<?= $guru->tanggal_lahir ?>" style="border: 1px solid #8F7A6E; border-radius: 8px; padding: 0.6rem; width: 100%;">
              </td>
            </tr>

            <!-- Jenis Kelamin -->
            <tr>
              <td style="padding-bottom: 10px;"><label for="jenis_kelamin" style="font-weight: 500; color: #292F36;">Jenis Kelamin</label></td>
              <td style="padding-bottom: 10px;">
                <select class="form-control" id="jenis_kelamin" name="jenis_kelamin" style="border: 1px solid #8F7A6E; border-radius: 8px; padding: 0.6rem; width: 100%;">
                  <option value="">--Pilih Jenis Kelamin--</option>
                  <option value="Laki-laki" <?= ($guru->jenis_kelamin == 'Laki-laki') ? 'selected' : '' ?>>Laki-laki</option>
                  <option value="Perempuan" <?= ($guru->jenis_kelamin == 'Perempuan') ? 'selected' : '' ?>>Perempuan</option>
                </select>
              </td>
            </tr>
               <tr>
              <td style="padding-bottom: 10px;"><label for="jabatan" style="font-weight: 500; color: #292F36;">Jenis Kelamin</label></td>
              <td style="padding-bottom: 10px;">
                <select class="form-control" id="jabatan" name="jabatan" style="border: 1px solid #8F7A6E; border-radius: 8px; padding: 0.6rem; width: 100%;">
                  <option value="">-- Pilih Jabatan --</option>
                  <option value="Guru Biasa"
            <?= ($guru->jabatan == 'Guru Biasa') ? 'selected' : '' ?>>
            Guru Biasa
        </option>
        <option value="Wali Kelas"
            <?= ($guru->jabatan == 'Wali Kelas') ? 'selected' : '' ?>>
            Wali Kelas
        </option>
        <option value="Guru BK"
            <?= ($guru->jabatan == 'Guru BK') ? 'selected' : '' ?>>
            Guru BK
        </option>
        <option value="Guru Mata Pelajaran" <?= ($guru->jabatan == 'Guru Mata Pelajaran') ? 'selected' : '' ?>>
            Guru Mata Pelajaran </option>
                </select>
              </td>
            </tr>



            <!-- Alamat -->
            <tr>
              <td style="padding-bottom: 10px;"><label for="alamat" style="font-weight: 500; color: #292F36;">Alamat</label></td>
              <td style="padding-bottom: 10px;">
                <textarea class="form-control" id="alamat" name="alamat" rows="3" style="border: 1px solid #8F7A6E; border-radius: 8px; padding: 0.6rem; width: 100%;"><?= $guru->alamat ?></textarea>
              </td>
            </tr>

            <!-- No HP -->
            <tr>
              <td style="padding-bottom: 10px;"><label for="no_hp" style="font-weight: 500; color: #292F36;">No. HP</label></td>
              <td style="padding-bottom: 10px;">
                <input type="text" class="form-control" id="no_hp" name="no_hp" value="<?= $guru->no_hp ?>" style="border: 1px solid #8F7A6E; border-radius: 8px; padding: 0.6rem; width: 100%;">
              </td>
            </tr>

            <!-- Username -->
            <tr>
              <td style="padding-bottom: 10px;"><label for="username" style="font-weight: 500; color: #292F36;">Username</label></td>
              <td style="padding-bottom: 10px;">
                <input type="text" class="form-control" id="username" name="username" value="<?= $guru->username ?>" style="border: 1px solid #8F7A6E; border-radius: 8px; padding: 0.6rem; width: 100%;">
              </td>
            </tr>

            <!-- Email -->
            <tr>
              <td style="padding-bottom: 10px;"><label for="email" style="font-weight: 500; color: #292F36;">Email</label></td>
              <td style="padding-bottom: 10px;">
                <input type="email" class="form-control" id="email" name="email" value="<?= $guru->email ?>" style="border: 1px solid #8F7A6E; border-radius: 8px; padding: 0.6rem; width: 100%;">
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

            <!-- Buttons -->
            <tr>
              <td></td>
              <td style="padding-top: 10px;">
                <input type="hidden" value="<?= $guru->id_guru ?>" name="id_guru">
                <input type="hidden" value="<?= $guru->id_user ?>" name="id_user">
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
