<?php

namespace App\Models;

class TipoProposicao
{

    protected $lista;


    public function __construct()
    {
        $this->lista = [
            (object)['nome'=>'Emenda', 'slug'=>'emenda', 'id_integracao'=>12],
            (object)['nome'=>'Indicação', 'slug'=>'indicacao', 'id_integracao'=>7],
            (object)['nome'=>'Requerimento de Tribuna Livre', 'slug'=>'requerimento-de-tribuna-livre', 'id_integracao'=>122],
            (object)['nome'=>'Voto de Congratulação', 'slug'=>'voto-de-congratulacao', 'id_integracao'=>121],
            (object)['nome'=>'Voto de Pesar', 'slug'=>'voto-de-pesar', 'id_integracao'=>120],
            (object)['nome'=>'Ofício(LEG)', 'slug'=>'oficio-leg', 'id_integracao'=>116],
            (object)['nome'=>'Pedido de Informação', 'slug'=>'pedido-de-informacao', 'id_integracao'=>8],
            (object)['nome'=>'Projeto de Decreto Legislativo', 'slug'=>'projeto-de-decreto-legislativo', 'id_integracao'=>5],
            (object)['nome'=>'Projeto de Lei', 'slug'=>'projeto-de-lei', 'id_integracao'=>2],
            (object)['nome'=>'Projeto de Resolução', 'slug'=>'projeto-de-resolucao', 'id_integracao'=>4],
            (object)['nome'=>'Projeto Indicativo', 'slug'=>'projeto-indicativo', 'id_integracao'=>16],
            (object)['nome'=>'Proposta de Emenda à Lei Orgânica', 'slug'=>'proposta-de-emenda-a-lei-organica', 'id_integracao'=>10],
            (object)['nome'=>'Requerimento', 'slug'=>'emenda-modificativa', 'id_integracao'=>161],
            (object)['nome'=>'Requerimento de Arquivamento', 'slug'=>'requerimento-de-arquivamento', 'id_integracao'=>141],
            (object)['nome'=>'Ofício à Proposição', 'slug'=>'oficio-a-proposicao', 'id_integracao'=>158]
        ];
    }

    public function getAll()
    {
        return $this->lista;
    }

    public function getBySlug(string $slug)
    {
        foreach($this->lista as $item){
            if($item->slug == $slug){
                return $item;
            }
        }
        return null;
    }
}
