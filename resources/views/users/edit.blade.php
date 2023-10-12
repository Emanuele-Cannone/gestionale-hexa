@section('script')

    @vite(['resources/js/tagify.js'])

    <script type='text/javascript'>
        let tagifyData = @json($roles
                ->map(fn($role) => [
                        'id' => $role->id,
                        'value' => $role->name,
                        'editable' => false
                    ]
                )
            ),
            inputElm = document.querySelectorAll('input[name=roles]');

        let tagifyDataSelected = @json($roleExists);

    </script>

@endsection
<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('comunication.comunications') }}
        </h2>
    </x-slot>


    <form action="{{ route('users.update', $user->id) }}" method="post">
        @method('PUT')
        @csrf

        <div class="max-w-7xl mx-auto py-10 sm:px-6 lg:px-8">
            <x-form-section submit="syncRoles">
                <x-slot name="title">
                    {{ __('rolePermission.user_edit_roles') }}
                </x-slot>

                <x-slot name="description">
                    {{ __('rolePermission.user_edit_role_description') }}
                </x-slot>

                <x-slot name="form" class="">

                    <div style="min-width: 350px">
                        <x-input-label for="roles"
                                       :value="__('user.form.product_customization')"/>
                        <x-text-input name='roles'
                                      class="mt-1 block w-full"
                        />
                    </div>



                </x-slot>

                <x-slot name="actions">
                    <x-button>
                        {{ __('common.assign') }}
                    </x-button>
                </x-slot>
            </x-form-section>
        </div>

    </form>
</x-app-layout>
