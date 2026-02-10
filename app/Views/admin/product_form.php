<?php Config::header(); ?>

<div class="container-fluid py-5" style="margin-top: 100px;">
    <div class="container py-5">
        <div class="row justify-content-center">
            <div class="col-lg-8">
                <div class="glass-bg p-5 rounded-3 border border-white-50 shadow-lg">
                    <h2 class="text-white mb-4"><?= isset($data['product']) ? 'Sửa Sản Phẩm' : 'Thêm Sản Phẩm Mới' ?></h2>
                    
                    <form action="<?= Config::url() ?>admin/product/<?= isset($data['product']) ? 'update' : 'store' ?>" method="POST" enctype="multipart/form-data">
                        <?php if (isset($data['product'])): ?>
                            <input type="hidden" name="id" value="<?= $data['product']->id ?>">
                            <input type="hidden" name="existing_image" value="<?= $data['product']->image ?>">
                        <?php endif; ?>

                        <div class="mb-3">
                            <label class="form-label text-white">Tên Sản Phẩm</label>
                            <input type="text" class="form-control bg-transparent text-white border-white-50" name="name" value="<?= $data['product']->name ?? '' ?>" required>
                        </div>

                        <div class="mb-3">
                            <label class="form-label text-white">Giá (VNĐ)</label>
                            <input type="number" class="form-control bg-transparent text-white border-white-50" name="price" value="<?= $data['product']->price ?? '' ?>" required>
                        </div>

                        <div class="mb-3">
                            <label class="form-label text-white">Danh Mục</label>
                            <select class="form-select bg-transparent text-white border-white-50" name="category" required>
                                <?php 
                                $cats = ['Bot', 'Tool', 'Source Code', 'Service'];
                                $currentCat = $data['product']->category ?? '';
                                foreach($cats as $cat): 
                                ?>
                                    <option value="<?= $cat ?>" class="text-dark" <?= $currentCat == $cat ? 'selected' : '' ?>><?= $cat ?></option>
                                <?php endforeach; ?>
                            </select>
                        </div>

                        <div class="mb-3">
                            <label class="form-label text-white">Mô Tả Chi Tiết</label>
                            <textarea class="form-control bg-transparent text-white border-white-50" name="description" rows="5"><?= $data['product']->description ?? '' ?></textarea>
                        </div>

                        <div class="mb-3">
                            <label class="form-label text-white">Hình Ảnh</label>
                            <?php if (isset($data['product']->image) && $data['product']->image): ?>
                                <div class="mb-2">
                                    <img src="<?= BASE_URL . 'uploads/' . $data['product']->image ?>" alt="Current Image" style="height: 100px;" class="rounded">
                                </div>
                            <?php endif; ?>
                            <input type="file" class="form-control bg-transparent text-white border-white-50" name="image">
                            <div class="form-text text-white-50">Để trống nếu không muốn thay đổi ảnh.</div>
                        </div>

                        <div class="d-flex justify-content-between mt-4">
                            <a href="<?= Config::url() ?>admin" class="btn btn-outline-light">Hủy Bỏ</a>
                            <button type="submit" class="btn btn-primary"><?= isset($data['product']) ? 'Cập Nhật' : 'Thêm Mới' ?></button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<?php Config::footer(); ?>
