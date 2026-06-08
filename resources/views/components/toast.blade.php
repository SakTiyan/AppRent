@if (session('success') || session('error') || session('info'))
<script>
    $(document).ready(function() {
        // 1. Ambil session aktif untuk menentukan warna kustom SweetAlert2
        let toastIcon = 'success';
        let customClass = {};

        @if (session('success'))
            toastIcon = 'success';
            customClass = {
                popup: 'rounded-2xl border-2 border-emerald-500 bg-white p-4 shadow-lg shadow-emerald-100',
                title: 'text-emerald-600 font-bold text-lg',
                htmlContainer: 'text-emerald-500 font-medium text-sm mt-0.5'
            };
        @endif

        @if (session('info')) // Kita gunakan 'info' untuk aksi EDIT/UPDATE (Warna Kuning)
            toastIcon = 'info';
            customClass = {
                popup: 'rounded-2xl border-2 border-amber-500 bg-white p-4 shadow-lg shadow-amber-100',
                title: 'text-amber-500 font-bold text-xl tracking-tight',
                htmlContainer: 'text-amber-500 font-medium text-sm mt-0.5'
            };
        @endif

        @if (session('error')) // Kita gunakan 'error' untuk aksi HAPUS/DELETE (Warna Merah)
            toastIcon = 'error';
            customClass = {
                popup: 'rounded-2xl border-2 border-red-500 bg-white p-4 shadow-lg shadow-red-100',
                title: 'text-red-600 font-bold text-lg',
                htmlContainer: 'text-red-500 font-medium text-sm mt-0.5'
            };
        @endif

        // 2. Terapkan Mixin dengan Class Kustom dari Tailwind
        const Toast = Swal.mixin({
            toast: true,
            position: 'top-end',
            showConfirmButton: false,
            timer: 3500,
            timerProgressBar: true,
            customClass: customClass, // Memasukkan gaya warna di atas
            didOpen: (toast) => {
                toast.addEventListener('mouseenter', Swal.stopTimer)
                toast.addEventListener('mouseleave', Swal.resumeTimer)
            }
        });

        // 3. Eksekusi Trigger Pemicu Munculnya Roti Panggang
        @if (session('success'))
            Toast.fire({
                icon: toastIcon,
                title: 'Berhasil',
                text: "{{ session('success') }}"
            });
        @endif

        @if (session('info'))
            Toast.fire({
                icon: toastIcon,
                title: 'Berhasil',
                text: "{{ session('info') }}"
            });
        @endif

        @if (session('error'))
            Toast.fire({
                icon: toastIcon,
                title: 'Berhasil',
                text: "{{ session('error') }}"
            });
        @endif
    });
</script>
@endif