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
						<a class="sidebar-link" href="{{route('admin.dashboard')}}">
							<i class="align-middle" data-feather="home"></i> <span class="align-middle">Início</span>
						</a>
					</li>
						<a class="sidebar-link" href="{{route('admin.pagina_inicial')}}">
							<i class="align-middle" data-feather="home"></i> <span class="align-middle">Conteúdo Página Inicial</span>
						</a>
					</li>

					{{-- <li class="sidebar-item
					@if($currentRouteName == 'admin.posts')
						active
					@endif
					">
						<a class="sidebar-link" href="{{route('admin.posts')}}">
              				<i class="align-middle" data-feather="folder"></i> <span class="align-middle">Posts</span>
            			</a>
					</li> --}}
					<li class="sidebar-header">
						Categorias das Notícias
					</li>
					<li class="sidebar-item
					@if($currentRouteName == 'admin.categories')
						active
					@endif
					">
						<a class="sidebar-link" href="{{route('admin.categories')}}">
              				<i class="align-middle" data-feather="folder"></i> <span class="align-middle">Categorias</span>
            			</a>
					</li>
					@php
						$tipos_pagina = [
							(object)['nome' => 'posts',   'icone' => 'image','titulo' => 'Notícia'], 
							(object)['nome' => 'projeto', 'icone' => 'file-plus','titulo' => 'Projeto'], 
							(object)['nome' => 'servico', 'icone' => 'briefcase','titulo' => 'Serviço'], 
							(object)['nome' => 'pagina',  'icone' => 'file','titulo' => 'Página'], 
						];
					@endphp
				@foreach($tipos_pagina as $tp)

				<li class="sidebar-header">
					{{$tp->titulo}}s
				</li>

				<li class="sidebar-item
				@if($currentRouteName == 'admin.'.$tp->nome)
					active
				@endif
				">
					<a class="sidebar-link" href="{{route('admin.'.$tp->nome)}}">
						  <i class="align-middle" data-feather="{{$tp->icone}}"></i> <span class="align-middle">{{$tp->titulo}}s</span>
					</a>
				</li>

					<li class="sidebar-item
					@if($currentRouteName == 'admin.'.$tp->nome.'.new')
						active
					@endif
					">
						<a class="sidebar-link" href="{{route('admin.'.$tp->nome.'.new')}}">
              				<i class="align-middle" data-feather="{{$tp->icone}}"></i> <span class="align-middle">Novo(a) {{$tp->titulo}}</span>
            			</a>
					</li>

				@endforeach

					{{-- <li class="sidebar-item
					@if($currentRouteName == 'admin.servico')
						active
					@endif
					">
						<a class="sidebar-link" href="{{route('admin.servico')}}">
              				<i class="align-middle" data-feather="folder"></i> <span class="align-middle">Serviços Online</span>
            			</a>
					</li>

					<li class="sidebar-item
					@if($currentRouteName == 'admin.servico.new')
						active
					@endif
					">
						<a class="sidebar-link" href="{{route('admin.servico.new')}}">
              				<i class="align-middle" data-feather="file-plus"></i> <span class="align-middle">Novo Serviço</span>
            			</a>
					</li>
					<li class="sidebar-item
					@if($currentRouteName == 'admin.projeto')
						active
					@endif
					">
						<a class="sidebar-link" href="{{route('admin.projeto')}}">
              				<i class="align-middle" data-feather="folder"></i> <span class="align-middle">Projeto</span>
            			</a>
					</li>

					<li class="sidebar-item
					@if($currentRouteName == 'admin.projeto.new')
						active
					@endif
					">
						<a class="sidebar-link" href="{{route('admin.projeto.new')}}">
              				<i class="align-middle" data-feather="file-plus"></i> <span class="align-middle">Novo Projeto</span>
            			</a>
					</li>
					<li class="sidebar-item
					@if($currentRouteName == 'admin.categoria-projeto')
						active
					@endif
					">
						<a class="sidebar-link" href="{{route('admin.categoria-projeto')}}">
              				<i class="align-middle" data-feather="folder"></i> <span class="align-middle">Categoria de Projeto</span>
            			</a>
					</li> --}}

					<li class="sidebar-header">
						Organograma
					</li>
                    <li class="sidebar-item
					@if($currentRouteName == 'admin.organograma')
						active
					@endif
					">
						<a class="sidebar-link" href="{{route('admin.organograma')}}">
              				<i class="align-middle" data-feather="users"></i> <span class="align-middle">Organograma</span>
            			</a>
					</li>

					<li class="sidebar-item
					@if($currentRouteName == 'admin.organograma.new')
						active
					@endif
					">
						<a class="sidebar-link" href="{{route('admin.organograma.new')}}">
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
						<a class="sidebar-link" href="{{route('admin.proposicao')}}">
              				<i class="align-middle" data-feather="briefcase"></i> <span class="align-middle">Proposições</span>
            			</a>
					</li>
					<li class="sidebar-item
					@if($currentRouteName == 'admin.categories')
						active
					@endif
					">
						<a class="sidebar-link" href="{{route('admin.categoria-proposicao')}}">
              				<i class="align-middle" data-feather="folder"></i> <span class="align-middle">Categorias de Proposição</span>
            			</a>
					</li>

					<li class="sidebar-item
					@if($currentRouteName == 'admin.proposicao.new')
						active
					@endif
					">
						<a class="sidebar-link" href="{{route('admin.proposicao.new')}}">
              				<i class="align-middle" data-feather="folder-plus"></i> <span class="align-middle">Add Proposição</span>
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
						<a class="sidebar-link" href="{{route('admin.user')}}">
                            <i class="align-middle" data-feather="users"></i> <span class="align-middle">Usuários</span>
                        </a>
					</li>

				</ul>
			</div>
		</nav>
