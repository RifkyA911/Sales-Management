        <div>

            <button class="btn" onclick="add_customer.showModal()">open modal</button>
            <dialog id="add_customer" class="modal">
                <div class="relative p-4 bg-white rounded-lg shadow-lg sm:p-6">
                    <button type="button" onclick="add_customer.close()"
                        class="absolute top-2 right-2 btn btn-sm btn-circle btn-ghost" aria-label="Close">✕</button>

                    <h3 class="text-lg font-bold" id="modal-title">Tambah Customer Baru</h3>
                    <form id="customer-form" method="POST" action="{{ route('customers.store') }}" class="space-y-4">
                        @csrf
                        <div class="form-control">
                            <label class="label" for="Kode_Customer">Kode Customer</label>
                            <input type="text" name="Kode_Customer" id="Kode_Customer" class="bg-white input"
                                required maxlength="4">
                        </div>
                        <div class="mt-4 form-control">
                            <label class="label" for="Nama_Customer">Nama Customer</label>
                            <input type="text" name="Nama_Customer" id="Nama_Customer" class="bg-white input"
                                required maxlength="40">
                        </div>
                        <div class="space-x-2 modal-action">
                            <button type="button" onclick="add_customer.close()" class="btn">Batal</button>
                            <button type="submit" class="btn btn-primary">Simpan</button>
                        </div>
                    </form>
                </div>
            </dialog>
        </div>
