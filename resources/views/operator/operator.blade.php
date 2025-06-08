<x-admin.layouts>
    <x-slot:title>Kelola Data {{$title}}</x-slot:title>
    <!-- Card -->
    <div class="grid gap-6 mb-8 md:grid-cols-2 justify-center place-items-center">
        <!-- Admin Card -->
        <div class="min-w-[250px] w-full max-w-sm p-6 bg-white border border-gray-200 rounded-2xl shadow 
                    dark:bg-gray-800 dark:border-gray-700 transition duration-300 transform hover:scale-105 hover:shadow-xl">
            <div class="flex justify-between items-center">
                <div>
                    <h5 class="text-xl font-bold tracking-tight text-gray-900 dark:text-white">Administrator</h5>
                    <p class="font-normal text-gray-700 dark:text-gray-400">
                        Jumlah: <strong>{{ $adminCount }}</strong>
                    </p>
                </div>
                <img src="{{ asset('assets/img/administrator.png') }}" alt="Admin Icon" class="w-16 h-16">
            </div>
        </div>

        <!-- Operator Card -->
        <div class="min-w-[250px] w-full max-w-sm p-6 bg-white border border-gray-200 rounded-2xl shadow 
                    dark:bg-gray-800 dark:border-gray-700 transition duration-300 transform hover:scale-105 hover:shadow-xl">
            <div class="flex justify-between items-center">
                <div>
                    <h5 class="text-xl font-bold tracking-tight text-gray-900 dark:text-white">Operator Hari ini</h5>
                    <p class="font-normal text-gray-700 dark:text-gray-400">
                        Jumlah: <strong>{{ $operatorCount }}</strong>
                    </p>
                </div>
                <img src="{{ asset('assets/img/operators.png') }}" alt="Operator Icon" class="w-16 h-16">
            </div>
        </div>
    </div>

    <!-- Table -->
    <h4 class="mb-4 text-lg font-semibold text-gray-600 dark:text-gray-300">
        Table Data {{$title}}
    </h4>
    <div class="w-full overflow-hidden rounded-lg shadow-xs">
        <div class="flex items-center justify-between p-4 bg-gray-50 dark:bg-gray-800 border-t dark:border-gray-700">
            <!-- Bagian Pencarian -->
            <div class="flex flex-1 justify-center lg:mr-32">
                <div class="relative w-full max-w-xl mr-6 focus-within:text-purple-500">
                    <div class="absolute inset-y-0 left-0 flex items-center pl-2">
                        <svg class="w-5 h-5 text-gray-500 dark:text-gray-400" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                            <path fill-rule="evenodd" d="M8 4a4 4 0 100 8 4 4 0 000-8zM2 8a6 6 0 1110.89 3.476l4.817 4.817a1 1 0 01-1.414 1.414l-4.816-4.816A6 6 0 012 8z" clip-rule="evenodd" />
                        </svg>
                    </div>
                    <input type="text" id="simple-search" class="w-full pl-8 pr-2 text-sm text-gray-900 placeholder-gray-600 bg-gray-100 border-0 rounded-md dark:placeholder-gray-400 dark:bg-gray-700 focus:placeholder-gray-500 dark:focus:placeholder-gray-600 focus:bg-white dark:focus:bg-gray-600 focus:border-purple-300 focus:outline-none form-input" placeholder="Cari" required>
                </div>
            </div>
            <!-- Bagian Tombol Tambah -->
            <div class="flex-shrink-0">
                <button id="defaultModalButton" data-modal-target="defaultModal" data-modal-toggle="defaultModal" type="button" class="flex items-center justify-center text-white bg-amber-700 hover:bg-amber-800 focus:ring-4 focus:ring-amber-300 font-medium rounded-lg text-sm px-4 py-2 dark:bg-amber-600 dark:hover:bg-amber-700 focus:outline-none dark:focus:ring-amber-800">
                    <svg class="h-3.5 w-3.5 mr-2" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg" aria-hidden="true">
                        <path clip-rule="evenodd" fill-rule="evenodd" d="M10 3a1 1 0 011 1v5h5a1 1 0 110 2h-5v5a1 1 0 11-2 0v-5H4a1 1 0 110-2h5V4a1 1 0 011-1z" />
                    </svg>
                    Create
                </button>
            </div>
            <!-- Bagian Tombol Unduh -->
            <div class="flex-shrink-0">
                <button type="button" class="flex ml-2 items-center justify-center text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:ring-blue-300 font-medium rounded-lg text-sm px-4 py-2 dark:bg-blue-600 dark:hover:bg-blue-700 focus:outline-none dark:focus:ring-blue-800">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="-3.5 w-3.5 mr-2" aria-hidden="true">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M3 16.5v2.25A2.25 2.25 0 0 0 5.25 21h13.5A2.25 2.25 0 0 0 21 18.75V16.5M16.5 12 12 16.5m0 0L7.5 12m4.5 4.5V3" />
                    </svg>
                    Export
                </button>
            </div>
        </div>
        <div class="w-full overflow-x-auto">
            <table class="w-full whitespace-no-wrap">
                <thead>
                    <tr class="text-xs font-semibold tracking-wide text-left text-gray-500 uppercase border-b dark:border-gray-700 bg-gray-50 dark:text-gray-400 dark:bg-gray-800">
                        <th class="px-2 py-1 text-center">No</th>
                        <th class="px-2 py-1 text-center">Name</th>
                        <th class="px-2 py-1 text-center">Username</th>
                        <th class="px-2 py-1 text-center">Email</th>
                        <th class="px-2 py-1 text-center">Password</th>
                        <th class="px-2 py-1 text-center">Role</th>                        
                        <th class="px-2 py-1 text-center">Actions</th>
                    </tr>
                </thead>
                <tbody class="bg-white divide-y text-sm font-normal dark:divide-gray-700 dark:bg-gray-800">
                    @forelse ($users as $key => $user)
                        <tr class="text-gray-700 dark:text-gray-400">
                            <td class="px-2 py-1 text-center">{{ $users->firstItem() + $key }}</td>
                            <td class="px-2 py-1 text-center">{{ $user->name }}</td>
                            <td class="px-2 py-1 text-center">{{ $user->username }}</td>
                            <td class="px-2 py-1 text-center">{{ $user->email }}</td>
                            <td class="px-2 py-1 text-center">********</td>
                            <td class="px-2 py-1 text-center">{{ $user->role }}</td>
                            <!-- Actions -->
                            <td class="px-2 py-1 text-xs text-center">
                                <div class="flex justify-center space-x-2">
                                    <!-- Edit -->
                                    <button id="updateProductButton-{{ $user->id }}" data-modal-target="updateProductModal-{{ $user->id }}" data-modal-toggle="updateProductModal-{{ $user->id }}" type="button"
                                        class="inline-block text-gray-500 hover:text-yellow-600 transition-colors duration-200"
                                        aria-label="Edit">
                                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-5">
                                            <path stroke-linecap="round" stroke-linejoin="round" d="m16.862 4.487 1.687-1.688a1.875 1.875 0 1 1 2.652 2.652L10.582 16.07a4.5 4.5 0 0 1-1.897 1.13L6 18l.8-2.685a4.5 4.5 0 0 1 1.13-1.897l8.932-8.931Zm0 0L19.5 7.125M18 14v4.75A2.25 2.25 0 0 1 15.75 21H5.25A2.25 2.25 0 0 1 3 18.75V8.25A2.25 2.25 0 0 1 5.25 6H10" />
                                        </svg>
                                    </button>
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
                                                <form action="{{ route('operator.update', $user->id) }}" method="POST">
                                                    @csrf
                                                    @method('PUT')
                                                    <!-- Form Fields -->
        
                                                    <!-- Name Field -->
                                                    <div>
                                                        <label for="name" class="block text-sm font-medium text-gray-900 dark:text-white text-left mt-2">Name</label>
                                                        <input type="text" name="name" id="name-update-{{ $user->id }}"
                                                            class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-yellow-600 focus:border-yellow-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-yellow-500 dark:focus:border-yellow-500"
                                                            placeholder="Name" required autofocus value="{{ old('name', $user->name) }}">
                                                    </div>
                                                    <!-- username Field -->
                                                    <div>
                                                        <label for="username" class="block text-sm font-medium text-gray-900 dark:text-white text-left mt-2">Username</label>
                                                        <input type="text" name="username" id="username-update-{{ $user->id }}"
                                                            class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-yellow-600 focus:border-yellow-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-yellow-500 dark:focus:border-yellow-500"
                                                            placeholder="Username" required value="{{ old('username', $user->username) }}">
                                                    </div>
                                                    <!-- Role Field -->
                                                    <div>
                                                        <label for="role" class="block text-sm font-medium text-gray-900 dark:text-white text-left mt-2">Role</label>
                                                        <select name="role" id="role-update-{{ $user->id }}"
                                                            class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-yellow-600 focus:border-yellow-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-yellow-500 dark:focus:border-yellow-500"
                                                            required>
                                                            <option value="">-- Pilih Role --</option>
                                                            <option value="admin" {{ $user->role == 'admin' ? 'selected' : '' }}>Admin</option>
                                                            <option value="operator" {{ $user->role == 'operator' ? 'selected' : '' }}>Operator</option>
                                                        </select>
                                                    </div>
                                                    <!-- Email Field -->
                                                    <div>
                                                        <label for="email" class="block text-sm font-medium text-gray-900 dark:text-white text-left mt-2">Email</label>
                                                        <input type="email" name="email" id="email-update-{{ $user->id }}" readonly
                                                            value="{{ $user->email }}"
                                                            class="bg-gray-100 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-yellow-600 focus:border-yellow-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-yellow-500 dark:focus:border-yellow-500"
                                                            placeholder="Email akan terisi otomatis">
                                                    </div>
                                                    <!-- Password Field -->
                                                    <div>
                                                        <label for="password" class="block text-sm font-medium text-gray-900 dark:text-white text-left mt-2">Password</label>
                                                        <input type="password" name="password" id="password-update-{{ $user->id }}"
                                                            class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-yellow-600 focus:border-yellow-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-yellow-500 dark:focus:border-yellow-500"
                                                            placeholder="Biarkan kosong jika tidak ingin diubah">
                                                    </div>
                                                    <!-- Submit and Cancel Buttons -->
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
                                                            data-modal-toggle="updateProductModal-{{ $user->id }}">
                                                            <svg class="mr-1 -ml-1 w-5 h-5" xmlns="http://www.w3.org/2000/svg" fill="none"
                                                                viewBox="0 0 24 24">
                                                                <path stroke="currentColor" stroke-linecap="round" stroke-width="2"
                                                                    d="m6 6 12 12m3-6a9 9 0 1 1-18 0 9 9 0 0 1 18 0Z" />
                                                            </svg>
                                                            Cancel
                                                        </button>
                                                    </div>
                                                    <script>
                                                        document.addEventListener("DOMContentLoaded", function () {
                                                            const nameUpdate = document.getElementById('name-update-{{ $user->id }}');
                                                            const roleUpdate = document.getElementById('role-update-{{ $user->id }}');
                                                            const emailUpdate = document.getElementById('email-update-{{ $user->id }}');
        
                                                            function generateEmailUpdate() {
                                                                const nameValue = nameUpdate.value.trim().split(" ")[0].toLowerCase();
                                                                const roleValue = roleUpdate.value;
                                                                if (nameValue && roleValue) {
                                                                    emailUpdate.value = `${nameValue}.${roleValue}@locatorgis.test`;
                                                                } else {
                                                                    emailUpdate.value = '';
                                                                }
                                                            }
        
                                                            // Event ketika modal dibuka → trigger update email
                                                            const observer = new MutationObserver(() => {
                                                                if (!nameUpdate || !roleUpdate) return;
                                                                generateEmailUpdate();
                                                            });
        
                                                            const modal = document.getElementById('updateProductModal-{{ $user->id }}');
                                                            if (modal) {
                                                                observer.observe(modal, { attributes: true, attributeFilter: ['class'] });
                                                            }
        
                                                            nameUpdate.addEventListener('input', generateEmailUpdate);
                                                            roleUpdate.addEventListener('change', generateEmailUpdate);
                                                        });
                                                    </script>
                                                 </form>
                                            </div>
                                        </div>
                                    </div>
                                    <!-- Delete -->
                                    <button id="deleteButton-{{ $user->id }}" data-modal-target="deleteModal-{{ $user->id }}" data-modal-toggle="deleteModal-{{ $user->id }}" type="button"
                                    class="inline-block text-gray-500 hover:text-red-600 transition-colors duration-200"
                                    aria-label="Delete">
                                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-5">
                                            <path stroke-linecap="round" stroke-linejoin="round" d="m14.74 9-.346 9m-4.788 0L9.26 9m9.968-3.21c.342.052.682.107 1.022.166m-1.022-.165L18.16 19.673a2.25 2.25 0 0 1-2.244 2.077H8.084a2.25 2.25 0 0 1-2.244-2.077L4.772 5.79m14.456 0a48.108 48.108 0 0 0-3.478-.397m-12 .562c.34-.059.68-.114 1.022-.165m0 0a48.11 48.11 0 0 1 3.478-.397m7.5 0v-.916c0-1.18-.91-2.164-2.09-2.201a51.964 51.964 0 0 0-3.32 0c-1.18.037-2.09 1.022-2.09 2.201v.916m7.5 0a48.667 48.667 0 0 0-7.5 0" />
                                        </svg>
                                    </button>
                                    <!-- Modal Delete -->
                                    <div id="deleteModal-{{ $user->id }}" tabindex="-1" aria-hidden="true" class="hidden overflow-y-auto overflow-x-hidden fixed top-0 right-0 left-0 z-50 justify-center items-center w-full md:inset-0 h-modal md:h-full">
                                        <div class="relative p-4 w-full max-w-md h-full md:h-auto">
                                            <!-- Modal content -->
                                            <div class="relative p-4 text-center bg-white rounded-lg shadow dark:bg-gray-800 sm:p-5">
                                                <button type="button" data-modal-toggle="deleteModal-{{ $user->id }}" class="text-gray-400 absolute top-2.5 right-2.5 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm p-1.5 ml-auto inline-flex items-center dark:hover:bg-gray-600 dark:hover:text-white" data-modal-toggle="deleteModal">
                                                    <svg aria-hidden="true" class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                                                        <path fill-rule="evenodd" d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z" clip-rule="evenodd"></path>
                                                    </svg>
                                                    <span class="sr-only">Close modal</span>
                                                </button>
                                                <svg class="text-gray-400 dark:text-gray-500 w-11 h-11 mb-3.5 mx-auto" aria-hidden="true" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                                                    <path fill-rule="evenodd" d="M9 2a1 1 0 00-.894.553L7.382 4H4a1 1 0 000 2v10a2 2 0 002 2h8a2 2 0 002-2V6a1 1 0 100-2h-3.382l-.724-1.447A1 1 0 0011 2H9zM7 8a1 1 0 012 0v6a1 1 0 11-2 0V8zm5-1a1 1 0 00-1 1v6a1 1 0 102 0V8a1 1 0 00-1-1z" clip-rule="evenodd"></path>
                                                </svg>
                                                <p class="mb-4 text-gray-500 dark:text-gray-300">Are you sure you want to delete this item?</p>
                                                <div class="flex justify-center items-center space-x-4">
                                                    @if (isset($user))
                                                        <form action="{{ route('operator.destroy', $user->id) }}" method="POST">
                                                            @csrf
                                                            @method('DELETE')
                                                            <button data-modal-toggle="deleteModal-{{ $user->id }}" type="button" class="mr-2 py-2 px-3 text-sm font-medium text-gray-500 bg-white rounded-lg border border-gray-200 hover:bg-gray-100 focus:ring-4 focus:outline-none focus:ring-primary-300 hover:text-gray-900 focus:z-10 dark:bg-gray-700 dark:text-gray-300 dark:border-gray-500 dark:hover:text-white dark:hover:bg-gray-600 dark:focus:ring-gray-600">
                                                                No, cancel
                                                            </button>
                                                            <button type="submit" class="py-2 px-3 text-sm font-medium text-center text-white bg-red-600 rounded-lg hover:bg-red-700 focus:ring-4 focus:outline-none focus:ring-red-300 dark:bg-red-500 dark:hover:bg-red-600 dark:focus:ring-red-900">
                                                                Yes, I'm sure
                                                            </button>    
                                                        </form>
                                                    @else
                                                        <p>Data Tidak Ditemukan</p>
                                                    @endif
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="7" class="text-center py-4 text-gray-500">
                                Belum ada data {{ $title }} yang diinput hari ini.
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>

            <!-- Pagination & Showing -->
            <div class="grid px-4 py-3 text-xs font-semibold tracking-wide text-gray-500 uppercase border-t dark:border-gray-700 bg-gray-50 sm:grid-cols-9 dark:text-gray-400 dark:bg-gray-800">
                <!-- Showing -->
                <span class="flex items-center col-span-3">
                    Showing {{ $users->firstItem() }} to {{ $users->lastItem() }} out of {{ $users->total() }}
                </span>
                <span class="col-span-2"></span>

                <!-- Pagination -->
                <div class="col-span-4 flex items-center justify-end space-x-2">
                    @if ($users->onFirstPage())
                        <span class="px-4 py-2 text-gray-500 bg-gray-200 dark:bg-gray-700 rounded-md cursor-not-allowed">Previous</span>
                    @else
                        <a href="{{ $users->previousPageUrl() }}" class="px-4 py-2 text-gray-700 bg-white border border-gray-300 rounded-md hover:bg-gray-100 dark:text-gray-300 dark:bg-gray-700 dark:border-gray-600 dark:hover:bg-gray-600">Previous</a>
                    @endif

                    <span class="text-gray-700 dark:text-gray-300">
                        Page {{ $users->currentPage() }} of {{ $users->lastPage() }}
                    </span>

                    @if ($users->hasMorePages())
                        <a href="{{ $users->nextPageUrl() }}" class="px-4 py-2 text-gray-700 bg-white border border-gray-300 rounded-md hover:bg-gray-100 dark:text-gray-300 dark:bg-gray-700 dark:border-gray-600 dark:hover:bg-gray-600">Next</a>
                    @else
                        <span class="px-4 py-2 text-gray-500 bg-gray-200 dark:bg-gray-700 rounded-md cursor-not-allowed">Next</span>
                    @endif
                </div>
            </div>
        </div>

        <!-- modals create -->
        @include('operator.create')
    </div>
    <br>

</x-admin.layouts>