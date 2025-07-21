<dialog id="editBarangModal" class="modal">
    <div class="p-4 bg-white rounded-lg shadow-lg sm:p-6 relative">
        <button type="button" class="absolute top-2 right-2 btn btn-sm btn-circle btn-ghost"
            onclick="editBarangModal.close()">✕</button>

        <h3 class="text-lg font-bold mb-4">Edit Barang</h3>

        <div id="edit-errors" class="alert alert-error hidden mb-4">
            <ul id="edit-errors-list"></ul>
        </div>

        <form id="editBarangForm">
            @csrf
            @method('PUT')
            <input type="hidden" id="edit_action" name="action">

            <div class="form-control">
                <label class="label">Kode Barang</label>
                <input type="text" id="edit_Kode_Barang" name="Kode_Barang" class="input bg-gray-100" readonly>
                <p class="mt-1 text-sm text-red-500" id="error_Kode_Barang"></p>
            </div>
            <div class="form-control">
                <label class="label">Nama Barang</label>
                <input type="text" id="edit_Nama_Barang" name="Nama_Barang" class="input bg-white" required
                    maxlength="20">
                <p class="mt-1 text-sm text-red-500" id="error_Nama_Barang"></p>
            </div>
            <div class="form-control">
                <label class="label">Harga Barang</label>
                <input type="number" id="edit_Harga_Barang" name="Harga_Barang" class="input bg-white" required
                    step="0.01">
                <p class="mt-1 text-sm text-red-500" id="error_Harga_Barang"></p>
            </div>
            <div class="modal-action">
                <button type="button" onclick="editBarangModal.close()" class="btn">Batal</button>
                <button type="submit" class="btn btn-primary">Update</button>
            </div>
        </form>

    </div>
</dialog>


{{-- JS untuk isi data dan buka modal --}}
<script>
    function openEditModal(kode, nama, harga) {
        if (!kode) {
            alert("Kode Barang kosong, tidak bisa update!");
            return;
        }

        document.getElementById('edit_action').value = `/barangs/${kode}`;
        document.getElementById('edit_Kode_Barang').value = kode;
        document.getElementById('edit_Nama_Barang').value = nama;
        document.getElementById('edit_Harga_Barang').value = harga;

        document.getElementById('edit-errors').classList.add('hidden');
        document.getElementById('edit-errors-list').innerHTML = '';

        editBarangModal.showModal();
    }

    document.getElementById('editBarangForm').addEventListener('submit', async function(e) {
        e.preventDefault();

        // Clear old errors
        ['Kode_Barang', 'Nama_Barang', 'Harga_Barang'].forEach(field => {
            document.getElementById(`error_${field}`).textContent = '';
        });

        const action = document.getElementById('edit_action').value;
        const formData = new FormData(this);

        try {
            const response = await fetch(action, {
                method: 'POST',
                headers: {
                    'X-Requested-With': 'XMLHttpRequest'
                },
                body: formData
            });

            const data = await response.json();

            if (!response.ok) {
                if (data.errors) {
                    for (const [field, messages] of Object.entries(data.errors)) {
                        const errorElem = document.getElementById(`error_${field}`);
                        if (errorElem) {
                            errorElem.textContent = messages.join(', ');
                        }
                    }
                }
                return;
            }



            // Update di DataTable
            let table = $('#barangTable').DataTable();
            let row = table.row($(
                `#row-${data.Kode_Barang}`)); // pastikan row punya ID unik: row-Kode_Barang
            row.data([
                data.Kode_Barang,
                data.Nama_Barang,
                `Rp ${parseFloat(data.Harga_Barang).toLocaleString('id-ID', { minimumFractionDigits: 2 })}`,
                `
                    <div class="flex space-x-2 justify-center">
                        <button class="btn btn-warning btn-sm"
                            onclick="openEditModal('${data.Kode_Barang}', '${data.Nama_Barang}', ${data.Harga_Barang})">
                            Edit
                        </button>
                        <form action="/barangs/${data.Kode_Barang}" method="POST" class="inline">
                            <input type="hidden" name="_token" value="${csrfToken}">
                            <input type="hidden" name="_method" value="DELETE">
                            <button onclick="return confirm('Yakin hapus?')"
                                class="btn btn-error btn-sm text-white">
                                Hapus
                            </button>
                        </form>
                    </div>
                `
            ]).draw(false);

            editBarangModal.close();
            showToast('Barang berhasil diupdate!', 'success');
        } catch (err) {
            console.error(err);
            showToast('Terjadi kesalahan.', 'error');
        }
    });


    // function showToast(message, type = 'info') {
    //     const toast = document.createElement('div');
    //     toast.classList.add('alert', `alert-${type}`);
    //     toast.innerHTML = `<span>${message}</span>`;
    //     toast.style.position = 'fixed';
    //     toast.style.bottom = '20px';
    //     toast.style.right = '20px';
    //     const container = document.getElementById('toast-container');
    //     container.appendChild(toast);
    //     setTimeout(() => toast.remove(), 3000);
    // }
</script>
