<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Editar Publicación') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    <form method="POST" action="{{route('pubs.update',$pub)}}">
						@csrf @method('put')
						<textarea 
						class="block w-full rounded-md border-gray-300 bg-white shadow-sm transition-colors duration-300 focus:ring-opacity-50 dark:border-gray-600 dark:bg-gray-800 dark:text-white dark:focus:border-indigo-300 dark:focus:ring dark:focus:ring-indigo-200 dark:focus:ring-opacity-50" 
						name="publicacion"
						placeholder="{{__('What\' on your mind?')}}">{{old('publicacion',$pub->publicacion)}}</textarea>
						<!--! old() sirve para saver si el campo tenia valores anteriores-->
						<x-input-error :messages="$errors->get('publicacion')" class="mt-2"/>
						<x-primary-button class="mt-4">Publicar</x-primary-button>
					</form>
                </div>
            </div>
		</div>	
	</div>
</x-app-layout>