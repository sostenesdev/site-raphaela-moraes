<nav id="sidebar" class="sidebar js-sidebar">
	<div class="sidebar-content js-simplebar">
		<a class="sidebar-brand" href="index.html">
			<span class="align-middle">VereadorWeb</span>
		</a>

		<ul class="sidebar-nav">
			<li class="sidebar-header">
				Páginas
			</li>

			<li class="sidebar-item
@if($currentRouteName == 'admin.dashboard')
	active
@endif
					">
				<a class="sidebar-link" href="{{ route('admin.dashboard') }}">
					<i class="align-middle" data-feather="home"></i> <span class="align-middle">Início</span>
				</a>
			</li>
			<a class="sidebar-link" href="{{ route('admin.pagina_inicial') }}">
				<i class="align-middle" data-feather="home"></i> <span class="align-middle">Conteúdo Página
					Inicial</span>
			</a>
			</li>

			{{-- <li class="sidebar-item
@if($currentRouteName == 'admin.posts')
						active
@endif
					">
				<a class="sidebar-link" href="{{ route('admin.posts') }}">
					<i class="align-middle" data-feather="folder"></i> <span class="align-middle">Posts</span>
				</a>
			</li> --}}
			<li class="sidebar-header">
				Agenda
			</li>
			<li class="sidebar-item
@if($currentRouteName == 'admin.agenda')
	active
@endif
					">
				<a class="sidebar-link" href="{{ route('admin.agenda') }}">
					<i class="align-middle" data-feather="folder"></i> <span class="align-middle">Agenda</span>
				</a>
			</li>
			<li class="sidebar-header">
				Categorias das Notícias
			</li>
			<li class="sidebar-item
@if($currentRouteName == 'admin.categories')
	active
@endif
					">
				<a class="sidebar-link" href="{{ route('admin.categories') }}">
					<i class="align-middle" data-feather="folder"></i> <span class="align-middle">Categorias</span>
				</a>
			</li>
			@php
				$tipos_pagina = [
					(object) ['nome' => 'posts', 'icone' => 'image', 'titulo' => 'Notícia'],
					//(object)['nome' => 'projeto', 'icone' => 'file-plus','titulo' => 'Projeto'],
					(object) ['nome' => 'servico', 'icone' => 'briefcase', 'titulo' => 'Serviço'],
					(object) ['nome' => 'pagina', 'icone' => 'file', 'titulo' => 'Página'],
				];
			@endphp
			@foreach($tipos_pagina as $tp)

				<li class="sidebar-header">
					{{ $tp->titulo }}s
				</li>

				<li class="sidebar-item
							@if($currentRouteName == 'admin.' . $tp->nome)
								active
							@endif
											">
					<a class="sidebar-link" href="{{ route('admin.' . $tp->nome) }}">
						<i class="align-middle" data-feather="{{ $tp->icone }}"></i> <span
							class="align-middle">{{ $tp->titulo }}s</span>
					</a>
				</li>

				<li class="sidebar-item
							@if($currentRouteName == 'admin.' . $tp->nome . '.new')
								active
							@endif
												">
					<a class="sidebar-link" href="{{ route('admin.' . $tp->nome . '.new') }}">
						<i class="align-middle" data-feather="{{ $tp->icone }}"></i> <span class="align-middle">Novo(a)
							{{ $tp->titulo }}</span>
					</a>
				</li>

			@endforeach

			<li class="sidebar-header">
				Emendas
			</li>
			<li class="sidebar-item
@if($currentRouteName == 'admin.emenda')
	active
@endif
					">
				<a class="sidebar-link" href="{{ route('admin.emenda') }}">
					<i class="align-middle" data-feather="briefcase"></i> <span class="align-middle">Emendas</span>
				</a>
			</li>
			<li class="sidebar-item
@if($currentRouteName == 'admin.emenda.new')
	active
@endif
					">
				<a class="sidebar-link" href="{{ route('admin.emenda.new') }}">
					<i class="align-middle" data-feather="briefcase"></i> <span class="align-middle">Add Emenda</span>
				</a>
			</li>
			<li class="sidebar-header">
				Organograma
			</li>

			<li class="sidebar-item
@if($currentRouteName == 'admin.organograma')
	active
@endif
					">
				<a class="sidebar-link" href="{{ route('admin.organograma') }}">
					<i class="align-middle" data-feather="users"></i> <span class="align-middle">Organograma</span>
				</a>
			</li>

			<li class="sidebar-item
@if($currentRouteName == 'admin.organograma.new')
	active
@endif
					">
				<a class="sidebar-link" href="{{ route('admin.organograma.new') }}">
					<i class="align-middle" data-feather="user-plus"></i> <span class="align-middle">Add Cargo</span>
				</a>
			</li>

			<li class="sidebar-header">
				Proposições
			</li>
			<li class="sidebar-item
@if($currentRouteName == 'admin.proposicao')
	active
@endif
					">
				<a class="sidebar-link" href="{{ route('admin.proposicao') }}">
					<i class="align-middle" data-feather="briefcase"></i> <span class="align-middle">Proposições</span>
				</a>
			</li>
			<li class="sidebar-item
@if($currentRouteName == 'admin.categories')
	active
@endif
					">
				<a class="sidebar-link" href="{{ route('admin.categoria-proposicao') }}">
					<i class="align-middle" data-feather="folder"></i> <span class="align-middle">Categorias de
						Proposição</span>
				</a>
			</li>

			<li class="sidebar-item
@if($currentRouteName == 'admin.proposicao.new')
	active
@endif
					">
				<a class="sidebar-link" href="{{ route('admin.proposicao.new') }}">
					<i class="align-middle" data-feather="folder-plus"></i> <span class="align-middle">Add
						Proposição</span>
				</a>
			</li>

			<li class="sidebar-header">
				Denúncias
			</li>
			<li class="sidebar-item
@if($currentRouteName == 'admin.denuncia')
	active
@endif
					">
				<a class="sidebar-link" href="{{ route('admin.denuncia') }}">
					<i class="align-middle" data-feather="alert-triangle"></i> <span
						class="align-middle">Denúncias</span>
				</a>
			</li>
			{{-- 
			<li class="sidebar-item
@if($currentRouteName == 'admin.denuncia.new')
	active
@endif
					">
				<a class="sidebar-link" href="{{ route('admin.denuncia.new') }}">
					<i class="align-middle" data-feather="plus-circle"></i> <span class="align-middle">Add
						Denúncia</span>
				</a>
			</li>
			--}}
			<li class="sidebar-item
@if($currentRouteName == 'admin.categoria-denuncia' || $currentRouteName == 'admin.categoria-denuncia.edit')
	active
@endif
					">
				<a class="sidebar-link" href="{{ route('admin.categoria-denuncia') }}">
					<i class="align-middle" data-feather="folder"></i> <span class="align-middle">Categorias de
						Denúncia</span>
				</a>
			</li>

			<li class="sidebar-header">
				Administração
			</li>

			<li class="sidebar-item
@if($currentRouteName == 'admin.user')
	active
@endif
					">
				<a class="sidebar-link" href="{{ route('admin.user') }}">
					<i class="align-middle" data-feather="users"></i> <span class="align-middle">Usuários</span>
				</a>
			</li>

		</ul>
	</div>
</nav>