<!-- x-app-layout es la plantilla que se edita en /resource/views/layouts/app.blade.php -->
<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Publicaciones') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    <form method="POST" action="{{route('pubs.store')}}">
						@csrf
						<textarea 
						class="block w-full rounded-md border-gray-300 bg-white shadow-sm transition-colors duration-300 focus:ring-opacity-50 dark:border-gray-600 dark:bg-gray-800 dark:text-white dark:focus:border-indigo-300 dark:focus:ring dark:focus:ring-indigo-200 dark:focus:ring-opacity-50" 
						name="publicacion"
						placeholder="{{__('What\' on your mind?')}}">{{old('publicacion')}}</textarea>
						<!--! old() sirve para saver si el campo tenia valores anteriores-->
						<x-input-error :messages="$errors->get('publicacion')" class="mt-2"/>
						<x-primary-button class="mt-4">Publicar</x-primary-button>
					</form>
                </div>
            </div>
			<div class="mt-6 bg-white dark:bg-gray-800 shadow-sm rounded-lg divide-y dark:divide-gray-900">
				@foreach($pubs as $pub)
					<div class="p-3 flex space-x-2">
						<svg class="h-6 w-6 text-gray-600 dark:text-gray-400 -scale-x-100" fill="none" stroke="currentColor">
						<path d="M8.625 9.75a.375.375 0 1 1-.75 0 .375.375 0 0 1 .75 0Zm0 0H8.25m4.125 0a.375.375 0 1 1-.75 0 .375.375 0 0 1 .75 0Zm0 0H12m4.125 0a.375.375 0 1 1-.75 0 .375.375 0 0 1 .75 0Zm0 0h-.375m-13.5 3.01c0 1.6 1.123 2.994 2.707 3.227 1.087.16 2.185.283 3.293.369V21l4.184-4.183a1.14 1.14 0 0 1 .778-.332 48.294 48.294 0 0 0 5.83-.498c1.585-.233 2.708-1.626 2.708-3.228V6.741c0-1.602-1.123-2.995-2.707-3.228A48.394 48.394 0 0 0 12 3c-2.392 0-4.744.175-7.043.513C3.373 3.746 2.25 5.14 2.25 6.741v6.018Z" stroke-linecap="round" stroke-linejoin="round"></path>
						</svg>
						<div class="flex-1">
							<div class="flex justify-between items-center">
								<div>
									<span class="text-gray-800 dark:text-gray-200">
										{{$pub->user->name}}
									</span>
									<small class="ml-2 text-sm text-gray-600 dark:text-gray-400">{{$pub->created_at->diffForHumans()}}</small><!--Tambienpuede ser ->format('Y-')-->
									<!--El equivalente de == pero para fechas es:-->
									<!--unless e el if not-->
									@unless($pub->created_at->eq($pub->updated_at))
										<small class="text-sm text-gray-600 dark:text-gray-400">&middot; {{__('Editado')}} {{$pub->updated_at->diffForHumans()}}</small><!--Tambienpuede ser ->format('Y-')-->
									@endunless
									
									@if($pub->created_at->eq($pub->updated_at))
										<small class="text-sm text-gray-600 dark:text-gray-400">Original</small>
									@endif
								</div>
							</div>
							<p class="mt-4 text-lg text-gray-900 dark:text-gray-100">{{$pub->publicacion}}</p>
						</div>
						<!--if(auth()->user()->id===$pub->user_id)-->
						<!--if(auth()->user()->is($pub->user))-->
						@can('update',$pub)
							<x-dropdown>
								<x-slot name="trigger">
									<button>
									<svg class="w-5 h-5 text-gray-500 dark:text-gray-300" data-slot="icon" aria-hidden="true" fill="none" stroke-width="1.5" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
										<path d="M6.75 12a.75.75 0 1 1-1.5 0 .75.75 0 0 1 1.5 0ZM12.75 12a.75.75 0 1 1-1.5 0 .75.75 0 0 1 1.5 0ZM18.75 12a.75.75 0 1 1-1.5 0 .75.75 0 0 1 1.5 0Z" stroke-linecap="round" stroke-linejoin="round"></path>
									</svg>
									</button>
								</x-slot>
								<x-slot name="content">
									<x-dropdown-link :href="route('pubs.edit',$pub)">{{__('Editar')}}</x-dropdown-link>
									<form method="POST" action="{{route('pubs.destroy',$pub)}}">
										@csrf @method('DELETE')
										<x-dropdown-link :href="route('pubs.destroy',$pub)" onclick="event.preventDefault();this.closest('form').submit();">{{__('Borrar')}}</x-dropdown-link>
									</form>
								</x-slot>
							</x-dropdown>
						@endcan
					</div>
				@endforeach
			</div>
        </div>
    </div>
</x-app-layout>
