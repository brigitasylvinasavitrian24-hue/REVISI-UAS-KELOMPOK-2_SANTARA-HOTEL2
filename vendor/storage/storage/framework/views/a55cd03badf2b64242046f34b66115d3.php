<?php $__env->startSection('content'); ?>
<div class="relative bg-gradient-to-r from-blue-900 to-indigo-900 text-white">
    <div class="max-w-7xl mx-auto px-4 py-24 sm:px-6 lg:px-8">
        <div class="text-center">
            <h1 class="text-4xl md:text-6xl font-bold mb-4">Selamat Datang di Santara Hotel</h1>
            <p class="text-xl md:text-2xl mb-8 text-blue-200">Pengalaman Menginap yang Tak Terlupakan</p>
            <a href="<?php echo e(route('rooms.index')); ?>" class="inline-block bg-amber-500 hover:bg-amber-600 text-white font-semibold px-8 py-4 rounded-lg text-lg transition">
                Pesan Kamar Sekarang
            </a>
        </div>
    </div>
    <div class="absolute bottom-0 left-0 right-0 h-16 bg-gradient-to-t from-gray-100 to-transparent"></div>
</div>

<div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 -mt-8 relative z-10">
    <div class="bg-white rounded-xl shadow-2xl p-6 md:p-8">
        <form action="<?php echo e(route('rooms.index')); ?>" method="GET" class="grid grid-cols-1 md:grid-cols-5 gap-4 items-end">
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-1">Check-in</label>
                <input type="date" name="check_in" class="w-full rounded-lg border-gray-300 border px-3 py-2 focus:ring-amber-500 focus:border-amber-500">
            </div>
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-1">Check-out</label>
                <input type="date" name="check_out" class="w-full rounded-lg border-gray-300 border px-3 py-2 focus:ring-amber-500 focus:border-amber-500">
            </div>
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-1">Tamu</label>
                <select name="guests" class="w-full rounded-lg border-gray-300 border px-3 py-2 focus:ring-amber-500 focus:border-amber-500">
                    <option value="1">1 Tamu</option>
                    <option value="2" selected>2 Tamu</option>
                    <option value="3">3 Tamu</option>
                    <option value="4">4 Tamu</option>
                </select>
            </div>
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-1">Tipe Kamar</label>
                <select name="room_type" class="w-full rounded-lg border-gray-300 border px-3 py-2 focus:ring-amber-500 focus:border-amber-500">
                    <option value="">Semua Tipe</option>
                    <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::openLoop(); ?><?php endif; ?><?php $__currentLoopData = $roomTypes; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $type): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::startLoopIteration(); ?><?php endif; ?>
                        <option value="<?php echo e($type->id); ?>"><?php echo e($type->name); ?></option>
                    <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::endLoop(); ?><?php endif; ?><?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::closeLoop(); ?><?php endif; ?>
                </select>
            </div>
            <div>
                <button type="submit" class="w-full bg-amber-500 hover:bg-amber-600 text-white font-semibold px-6 py-2.5 rounded-lg transition">
                    Cari Kamar
                </button>
            </div>
        </form>
    </div>
</div>

<div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-16">
    <div class="text-center mb-12">
        <h2 class="text-3xl font-bold text-gray-900">Tipe Kamar Kami</h2>
        <p class="mt-4 text-gray-600">Pilih kamar yang sesuai dengan kebutuhan Anda</p>
    </div>
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-8">
        <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::openLoop(); ?><?php endif; ?><?php $__currentLoopData = $roomTypes; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $type): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::startLoopIteration(); ?><?php endif; ?>
        <div class="bg-white rounded-xl shadow-lg overflow-hidden hover:shadow-xl transition">
            <div class="h-48 bg-gray-200 flex items-center justify-center overflow-hidden">
                <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($type->image): ?>
                    <img src="<?php echo e(asset('storage/' . $type->image)); ?>" alt="<?php echo e($type->name); ?>" class="w-full h-full object-cover">
                <?php else: ?>
                    <span class="text-6xl">🏨</span>
                <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
            </div>
            <div class="p-6">
                <h3 class="text-xl font-semibold mb-2"><?php echo e($type->name); ?></h3>
                <p class="text-gray-600 text-sm mb-4"><?php echo e($type->description); ?></p>
                <div class="flex justify-between items-center">
                    <span class="text-sm text-gray-500"><?php echo e($type->rooms_count); ?> Kamar</span>
                    <span class="text-sm text-gray-500">Kapasitas: <?php echo e($type->capacity); ?> org</span>
                </div>
            </div>
        </div>
        <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::endLoop(); ?><?php endif; ?><?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::closeLoop(); ?><?php endif; ?>
    </div>
</div>

<?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($featuredRooms->isNotEmpty()): ?>
<div class="bg-gray-50 py-16">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="text-center mb-12">
            <h2 class="text-3xl font-bold text-gray-900">Kamar Pilihan</h2>
            <p class="mt-4 text-gray-600">Kamar terbaik dengan harga spesial</p>
        </div>
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-8">
            <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::openLoop(); ?><?php endif; ?><?php $__currentLoopData = $featuredRooms; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $room): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::startLoopIteration(); ?><?php endif; ?>
            <div class="bg-white rounded-xl shadow-lg overflow-hidden hover:shadow-xl transition">
                <div class="h-48 bg-gray-200 flex items-center justify-center overflow-hidden">
                    <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if(!empty($room->photos) && count($room->photos) > 0): ?>
                        <img src="<?php echo e(asset('storage/' . $room->photos[0])); ?>" alt="<?php echo e($room->roomType->name); ?>" class="w-full h-full object-cover">
                    <?php else: ?>
                        <span class="text-6xl">🛏️</span>
                    <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
                </div>
                <div class="p-6">
                    <h3 class="text-lg font-semibold"><?php echo e($room->roomType->name); ?></h3>
                    <p class="text-2xl font-bold text-amber-600 mt-2">Rp <?php echo e(number_format($room->price, 0, ',', '.')); ?><span class="text-sm text-gray-500 font-normal">/malam</span></p>
                    <p class="text-sm text-gray-500 mt-2">Kamar <?php echo e($room->room_number); ?></p>
                    <a href="<?php echo e(route('rooms.show', $room)); ?>" class="mt-4 inline-block w-full text-center bg-amber-500 hover:bg-amber-600 text-white font-semibold px-4 py-2 rounded-lg transition">
                        Lihat Detail
                    </a>
                </div>
            </div>
            <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::endLoop(); ?><?php endif; ?><?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::closeLoop(); ?><?php endif; ?>
        </div>
    </div>
</div>
<?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>

<div class="bg-white py-16">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 text-center">
        <h2 class="text-3xl font-bold text-gray-900 mb-8">Mengapa Memilih Santara Hotel?</h2>
        <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
            <div class="p-6">
                <div class="text-5xl mb-4">🔒</div>
                <h3 class="text-xl font-semibold mb-2">Pembayaran Aman</h3>
                <p class="text-gray-600">Transaksi online yang aman dan terpercaya</p>
            </div>
            <div class="p-6">
                <div class="text-5xl mb-4">⚡</div>
                <h3 class="text-xl font-semibold mb-2">Konfirmasi Instan</h3>
                <p class="text-gray-600">Booking langsung terkonfirmasi setelah pembayaran</p>
            </div>
            <div class="p-6">
                <div class="text-5xl mb-4">🔄</div>
                <h3 class="text-xl font-semibold mb-2">Pembatalan Mudah</h3>
                <p class="text-gray-600">Kebijakan pembatalan yang fleksibel</p>
            </div>
        </div>
    </div>
</div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\Laravel10\SantaraHotel\resources\views/home.blade.php ENDPATH**/ ?>