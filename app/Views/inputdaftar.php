<section class="d-flex align-items-center justify-content-center pb-5" style="padding-top: 100px; background-color: #E0DBD8;">
    <div class="container">
        <div class="col-lg-12 col-12 mt-5 mb-4 mb-lg-4">
            <div class="d-flex flex-column" style="background-color: #FAF5F1; padding: 2rem; border-radius: 10px; box-shadow: 0 10px 30px rgba(0,0,0,0.1); color: #292F36;">

                <!-- Nav Tabs -->
                <ul class="nav nav-tabs mb-4" id="inputTabs" role="tablist">
                    <li class="nav-item" role="presentation">
                        <button class="nav-link active" id="jadwal-tab" data-bs-toggle="tab" data-bs-target="#jadwal-form" type="button" role="tab">Daftar Ekskul</button>
                    </li>
                </ul>

                <!-- Tab Content -->
                <div class="tab-content" id="inputTabsContent">

                    <!-- jadwal Form -->
                    <div class="tab-pane fade show active" id="jadwal-form" role="tabpanel">
                        <h3 style="font-weight: bold; margin-bottom: 1.5rem; color: #292F36;">Daftar Ekskul</h3>
                        <form action="<?= base_url('/inputdaftar') ?>" method="POST">

                            <?php if (session()->get('level') !== '3'): ?>
                                <!-- KHUSUS ADMIN & GURU -->
                                <div class="mb-3">
                                    <label class="form-label">Siswa</label>
                                    <select class="form-control" name="siswa" required>
                                        <option value="">-- Pilih Siswa --</option>
                                        <?php foreach ($siswa as $e): ?>
                                            <option value="<?= $e->id_siswa ?>"><?= $e->nama_siswa ?></option>
                                        <?php endforeach; ?>
                                    </select>
                                </div>
                            <?php endif; ?>

                            <!-- SEMUA ROLE BISA PILIH EKSKUL -->
                            <div class="mb-3">
                                <label class="form-label">Ekskul</label>
                                <select class="form-control" name="ekskul" required>
                                    <option value="">-- Pilih Ekskul --</option>
                                    <?php foreach ($ekskul as $e): ?>
                                        <option value="<?= $e->id_ekskul ?>"><?= $e->nama_ekskul ?></option>
                                    <?php endforeach; ?>
                                </select>
                            </div>

                            <button type="submit" class="btn btn-success" style="background-color:#A41F13">
                                Simpan
                            </button>
                        </form>
                    </div>


                </div>

            </div>
        </div>
    </div>
</section>