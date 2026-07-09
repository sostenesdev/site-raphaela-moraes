@extends('layouts.site_v2.master')
@section('title', 'Início')
@section('header_content')
<!-- Start Breadcrumbs -->
<div class="breadcrumbs">
    <div class="container">
        <div class="row text-center">
            <div class="col-lg-8 offset-lg-2 col-12">
                <div class="breadcrumbs-content">
                    <h1 class="page-title">Emendas Parlamentares</h1>
                     <p>
                        Critérios de Eficiência Alocativa das Emendas
As emendas parlamentares deste mandato são destinadas com base em critérios técnicos de Eficiência Alocativa, divididos em três frentes:

Avaliação de Cenários de Urgência: Priorização de recursos para a Saúde, Proteção Especializada (como a AMAES e Pestalozzi) e Causa Animal (CCZ e Programa Arca), atendendo a demandas sociais imediatas do município.

Alinhamento com as Secretarias Municipais: Destinação de verbas diretamente aos Conselhos de Escola (EMEFs e CMEIs) em conformidade com as metas e prioridades da Secretaria Municipal de Educação, garantindo agilidade na ponta.

Estudos de Impacto Social: Apoio a projetos culturais, esportivos e de desenvolvimento econômico que comprovadamente atuam na redução da vulnerabilidade social nas comunidades da Serra..
                    </p>
                    {{-- <p>{{$model->content_preview }}</p>--}}
                </div>
            </div>
        </div>
    </div>
</div>
<!-- End Breadcrumbs -->
@endsection
@section('content')



<div class="container-fluid pt-2 pb-5">
    <div class="row newsletter-area text-center pt-3 pb-3 text-center">
            {{-- <h3 class="pb-3">Projetos</h3> --}}
            @foreach($emendas as $e)
                <div class="col col-12 pb-5 mb-2">
                    <div class="card text-left">
                        <div class="card-header">
                            <h4>{{$e->titulo}}</h4>
                        </div>
                        <div class="card-body">
                            <p class="card-text">{{$e->descricao}}</p><hr/>
                            <p class="card-text"><strong>Objeto: </strong>{{$e->objeto}}</h5><hr/>
                            <p class="card-text"><strong>Órgão de destino: </strong> {{$e->orgao_destino}}</p><hr/>
                            <p class="card-text"><strong>Beneficiário: </strong> {{$e->beneficiario}}</p><hr/>
                            <p class="card-text"><strong>Estágio do processo: </strong> {{$e->estagio_processo}}</p><hr/>
                            <p class="card-text"><strong>Nº do processo: </strong> {{$e->numero_processo}}&nbsp; | &nbsp;<strong>Valor: </strong> {{$e->valor}}
                            | &nbsp;<strong>Ano: </strong> {{$e->ano}}</p><hr/>
                            <div class="card-footer text-center">
                                    <a href="{{$e->link}}" class="btn btn-primary" target="blank">Saiba Mais</a>
                            </div>
                        </div>
                    </div>
                </div><br/>
            @endforeach

        </div>
    </div>
</div>
@endsection
