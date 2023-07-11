<?php

namespace App\Models;

class TipoProposicao
{

    protected $lista = [
        (objecct)['nome'=>'Emenda', 'slug'=>'emenda', 'id_integracao'=>12],
        (objecct)['nome'=>'Indicação', 'slug'=>'indicacao', 'id_integracao'=>7],
        (objecct)['nome'=>'Requerimento de Tribuna Livre', 'slug'=>'requerimento-de-tribuna-livre', 'id_integracao'=>122],
        (objecct)['nome'=>'Voto de Congratulação', 'slug'=>'voto-de-congratulacao', 'id_integracao'=>121],
        (objecct)['nome'=>'Voto de Pesar', 'slug'=>'voto-de-pesar', 'id_integracao'=>120],
        (objecct)['nome'=>'Ofício(LEG)', 'slug'=>'oficio-leg', 'id_integracao'=>116],
        (objecct)['nome'=>'Pedido de Informação', 'slug'=>'pedido-de-informacao', 'id_integracao'=>8],
        (objecct)['nome'=>'Projeto de Decreto Legislativo', 'slug'=>'projeto-de-decreto-legislativo', 'id_integracao'=>5],
        (objecct)['nome'=>'Projeto de Lei', 'slug'=>'projeto-de-lei', 'id_integracao'=>2],
        (objecct)['nome'=>'Projeto de Resolução', 'slug'=>'projeto-de-resolucao', 'id_integracao'=>4],
        (objecct)['nome'=>'Projeto Indicativo', 'slug'=>'projeto-indicativo', 'id_integracao'=>16],
        (objecct)['nome'=>'Proposta de Emenda à Lei Orgânica', 'slug'=>'proposta-de-emenda-a-lei-organica', 'id_integracao'=>10],
        (objecct)['nome'=>'Requerimento', 'slug'=>'emenda-modificativa', 'id_integracao'=>161],
        (objecct)['nome'=>'Requerimento de Arquivamento', 'slug'=>'requerimento-de-arquivamento', 'id_integracao'=>141],
        (objecct)['nome'=>'Ofício à Proposição', 'slug'=>'oficio-a-proposicao', 'id_integracao'=>158]
    ];

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
