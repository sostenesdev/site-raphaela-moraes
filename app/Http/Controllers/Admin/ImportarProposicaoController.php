<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\TipoProposicao;

use Illuminate\Http\Request;
use App\Models\Proposicao;
use Intervention\Image\Facades\Image;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Storage;
use App\Services\FileService;
use DateTime;
use Exception;
use Illuminate\Support\Facades\Date;

class ImportarProposicaoController extends Controller
{
    public function index()
    {
        //tiposProposicao
        $tipos = (new TipoProposicao())->getAll();
        return view('admin.importar-proposicao.index',compact('tipos'));
    }


    public function processarArquivoCSV(Request $request)
    {
        // dd($request->file('file'));
        // Verifica se o arquivo foi enviado na requisição
        $arquivo = $request->file('file');

        // Verifica se o arquivo é válido
        if ($arquivo->isValid()) {
            // Salva o arquivo no diretório "storage"
            $nomeArquivo = $arquivo->getClientOriginalName();
            $caminhoArquivo = $arquivo->storeAs('csv', $nomeArquivo.time());

            // Abre o arquivo CSV
            $csv = fopen(storage_path('app/' . $caminhoArquivo), 'r');

            $linhas =[];
            $i = 0;
            // Loop através das linhas do arquivo CSV
            while (($linha = fgetcsv($csv, 1000, ',','"',"\n")) !== false) {
                // Aqui você pode processar cada linha do arquivo
                // Por exemplo, imprimir a linha:
                // dd($linha);
               if($i>0){ 
                    $linhas[] = (object)[
                                "Processo"  => isset($linha[0])? $linha[0] : "",
                                "AnoProcesso" => isset($linha[1])? $linha[1] : "",
                                "Tipo"      => isset($linha[2])? $linha[2] : "",
                                "numero"    => isset($linha[3])? $linha[3] : "",
                                "Ano"      => isset($linha[4])? $linha[4] : "",
                                "Situacao"  => isset($linha[5])? $linha[5] : "",
                                "Ementa"    => isset($linha[6])? $linha[6] : "",
                                "Protocolo" => isset($linha[7])? $linha[7] : "",
                                "Autor"     => isset($linha[8])? $linha[8] : "",
                                "Data"     => isset($linha[8])? $linha[9] : "",
                            ];
                    }
                $i++;
                }
                foreach($linhas as $l){
                    //  dd($l->Situacao);
                    try{
                    $p = new Proposicao();
                    $p->user_id = auth()->user()->id;
                    $p->id_integracao = 1;
                    $p->titulo = $l->Ementa;
                    $p->slug = "indicacao ".$l->Processo."/".$l->AnoProcesso." -".time();
                    $p->protocolo = $l->Protocolo."/".$l->Ano;
                    $p->processo =  $l->Processo."/".$l->AnoProcesso;
                    $p->situacao =  $l->Situacao;
                    $p->data = DateTime::createFromFormat('d/m/Y', $l->Data)->format('Y-m-d');
                    ;
                    $p->tipo = $l->Tipo;
                    $p->categoria = "indicacao";
                    $p->conteudo = null;
                    $p->link = "http://serra.camarasempapel.com.br//spl/consulta-producao.aspx?tipo=7&processo=".$l->Processo."&ano=".$l->AnoProcesso."&ano_proposicao=".$l->Ano."&proposicao=".$l->numero."&autor=1396";
                    $p->descricao = "http://serra.camarasempapel.com.br//spl/consulta-producao.aspx?tipo=7&processo=".$l->Processo."&ano=".$l->AnoProcesso."&ano_proposicao=".$l->Ano."&proposicao=".$l->numero."&autor=1396";
                    $p->save();
                    }catch(Exception $e){
                        dd($e);
                    }
                }

            // Fecha o arquivo
            fclose($csv);

            // Exclui o arquivo após o processamento ser concluído
            Storage::delete($caminhoArquivo);

            // Retorna uma resposta de sucesso
            return response()->json(['sucesso' => 'Arquivo importado com sucesso'], 200);
            } else {
                // Tratar caso o arquivo seja inválido
                return response()->json(['erro' => 'Arquivo inválido'], 400);
            }
    }
}