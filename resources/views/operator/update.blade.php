<!-- Modal Edit -->
<div id="updateProductModal-{{ $user->id }}" tabindex="-1" aria-hidden="true" class="fixed top-0 left-0 right-0 z-50 hidden w-full p-4 overflow-x-hidden overflow-y-auto md:inset-0 h-[calc(100%-1rem)] max-h-full">
    <div class="relative w-full max-w-2xl max-h-full">
        <!-- Modal content -->
        <div class="relative p-4 bg-white rounded-lg shadow dark:bg-gray-800 sm:p-5">
            <!-- Modal header -->
            <div class="flex items-start justify-between p-4 border-b rounded-t dark:border-gray-600">
                <h3 class="text-xl font-semibold text-gray-900 dark:text-white">
                    Update {{$title}}
                </h3>
                <button type="button" data-modal-toggle="updateProductModal-{{ $user->id }}"
                    class="text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm p-1.5 ml-auto inline-flex items-center dark:hover:bg-gray-600 dark:hover:text-white"
                    data-modal-toggle="updateProductModal-{{ $user->id }}">
                    <svg aria-hidden="true" class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20"
                        xmlns="http://www.w3.org/2000/svg">
                        <path fill-rule="evenodd"
                            d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z"
                            clip-rule="evenodd"></path>
                    </svg>
                    <span class="sr-only">Close modal</span>
                </button>
            </div>
            <!-- Modal body -->
            @if (isset($user))
            <form action="{{route('operator.update', $user->id)}}" method="post" enctype="multipart/form-data">
                @csrf
                @method('PUT')
                <div>
                    <label for="name" class="block text-sm font-medium text-gray-900 dark:text-white text-left mt-2">Name</label>
                    <input type="text" name="name" id="name"
                        value="{{ old('name', $user->name) }}"
                        class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-yellow-600 focus:border-yellow-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-yellow-500 dark:focus:border-yellow-500"
                        placeholder="Name" required>
                </div>
                <div>
                    <label for="username" class="block text-sm font-medium text-gray-900 dark:text-white text-left mt-2">Username</label>
                    <input type="text" name="username" id="username"
                        value="{{ old('username', $user->username) }}"
                        class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-yellow-600 focus:border-yellow-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-yellow-500 dark:focus:border-yellow-500"
                        placeholder="Username" required>
                </div>
                <div>
                    <label for="role" class="block text-sm font-medium text-gray-900 dark:text-white text-left mt-2">Role</label>
                    <select name="role" id="role"
                        class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-yellow-600 focus:border-yellow-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-yellow-500 dark:focus:border-yellow-500"
                        required>
                        <option value="">-- Pilih Role --</option>
                        <option value="admin" {{ $user->role == 'admin' ? 'selected' : '' }}>Admin</option>
                        <option value="operator" {{ $user->role == 'operator' ? 'selected' : '' }}>Operator</option>
                    </select>
                </div>
                <div>
                    <label for="email" class="block text-sm font-medium text-gray-900 dark:text-white text-left mt-2">Email</label>
                    <input type="email" name="email" id="email" readonly
                        value="{{ $user->email }}"
                        class="bg-gray-100 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-yellow-600 focus:border-yellow-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-yellow-500 dark:focus:border-yellow-500"
                        placeholder="Email akan terisi otomatis">
                </div>
                <div>
                    <label for="password" class="block text-sm font-medium text-gray-900 dark:text-white text-left mt-2">Password</label>
                    <input type="password" name="password" id="password"
                        class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-yellow-600 focus:border-yellow-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-yellow-500 dark:focus:border-yellow-500"
                        placeholder="Biarkan kosong jika tidak ingin diubah">
                </div>
                <div class="flex justify-end space-x-2 pt-4">
                    <button type="submit"
                        class="text-white inline-flex items-center bg-yellow-700 hover:bg-yellow-800 focus:ring-4 focus:outline-none focus:ring-yellow-300 font-medium rounded-lg text-sm px-5 py-2.5 dark:bg-yellow-600 dark:hover:bg-yellow-700 dark:focus:ring-yellow-800">
                        <svg class="mr-1 -ml-1 w-5 h-5" fill="currentColor" viewBox="0 0 20 20">
                            <path fill-rule="evenodd"
                                d="M10 5a1 1 0 011 1v3h3a1 1 0 110 2h-3v3a1 1 0 11-2 0v-3H6a1 1 0 110-2h3V6a1 1 0 011-1z"
                                clip-rule="evenodd"></path>
                        </svg>
                        Update Data {{ $title }}
                    </button>
                    <button type="button" data-modal-toggle="updateProductModal-{{ $user->id }}"
                        class="text-red-600 inline-flex items-center hover:text-white border border-red-600 hover:bg-red-600 focus:ring-4 focus:outline-none focus:ring-red-300 font-medium rounded-lg text-sm px-5 py-2.5 dark:border-red-500 dark:text-red-500 dark:hover:text-white dark:hover:bg-red-600 dark:focus:ring-red-900"
                        data-modal-hide="defaultModal">
                        <svg class="mr-1 -ml-1 w-5 h-5" xmlns="http://www.w3.org/2000/svg" fill="none"
                            viewBox="0 0 24 24">
                            <path stroke="currentColor" stroke-linecap="round" stroke-width="2"
                                d="m6 6 12 12m3-6a9 9 0 1 1-18 0 9 9 0 0 1 18 0Z" />
                        </svg>
                        Cancel
                    </button>
                </div>

                <script>
                    const nameInput = document.getElementById('name');
                    const roleSelect = document.getElementById('role');
                    const emailInput = document.getElementById('email');

                    function generateEmail() {
                        const nameValue = nameInput.value.trim().split(" ")[0].toLowerCase();
                        const roleValue = roleSelect.value;
                        if (nameValue && roleValue) {
                            emailInput.value = `${nameValue}.${roleValue}@locatorgis.test`;
                        } else {
                            emailInput.value = '';
                        }
                    }
                    nameInput.addEventListener('input', generateEmail);
                    roleSelect.addEventListener('change', generateEmail);
                </script>
            </form>
            @else
            <p>Data tidak ditemukan.</p>
            @endif
        </div>
    </div>
</div>