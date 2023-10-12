<div>
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <x-input class="my-2" type="text" placeholder="Cerca per nome, codice" wire:model="searchUser"/>
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="relative overflow-x-auto">
                    <table class="w-full text-sm text-center text-gray-500 dark:text-gray-400">
                        <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
                        <tr>
                            <th scope="col" class="px-6 py-3">
                                {{ __('rolePermission.permissions') }}
                            </th>
                            <th scope="col" class="px-6 py-3">
                                {{ __('rolePermission.permission_sections') }}
                            </th>
                            <th scope="col" class="px-6 py-3">
                                {{ __('rolePermission.permission_url') }}
                            </th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach ($users as $user)
                            <tr
                                class="bg-white border-b dark:bg-gray-800 dark:border-gray-700"
                                x-data="{
                                        observe () {
                                            let observer = new IntersectionObserver((entries) => {
                                                entries.forEach(entry => {
                                                    if (entry.isIntersecting) {
                                                        @this.call('loadMore')
                                                    }
                                                })
                                            }, {
                                                root: null
                                            })

                                            observer.observe(this.$el)
                                        }
                                    }"
                                x-init="observe"
                            >
                                <td class="px-6 py-4">{{ $user->name }}</td>
                                <td class="px-6 py-4">
                                    <div class="flex justify-center flex-wrap">
                                        @foreach($user->roles->pluck('name')->toArray() as $roleName)
                                            <span
                                                class="my-1 bg-green-100 text-green-800 text-xs font-medium mr-2 px-2.5 py-0.5 rounded-full dark:bg-green-900 dark:text-green-300 border border-green-400">
                                                    {{ $roleName }}
                                                </span>
                                        @endforeach
                                    </div>
                                </td>
                                <td class="px-6 py-4">
                                    <a href="{{ route('users.edit', $user->id) }}"
                                       class="inline-flex items-center font-semibold text-indigo-700 dark:text-indigo-300">
                                        Ruoli Utente
                                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20"
                                             class="ml-1 w-5 h-5 fill-indigo-500 dark:fill-indigo-200">
                                            <path fill-rule="evenodd"
                                                  d="M5 10a.75.75 0 01.75-.75h6.638L10.23 7.29a.75.75 0 111.04-1.08l3.5 3.25a.75.75 0 010 1.08l-3.5 3.25a.75.75 0 11-1.04-1.08l2.158-1.96H5.75A.75.75 0 015 10z"
                                                  clip-rule="evenodd"/>
                                        </svg>
                                    </a>
                                </td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
