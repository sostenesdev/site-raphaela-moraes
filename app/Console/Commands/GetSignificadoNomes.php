<?php

namespace App\Console\Commands;

use DateTime;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Http;

class GetSignificadoNomes extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'get:names';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        $names = $this->readJsonFile('names.json');
        $highlighted = true;
        foreach($names as $name){
            try{
            $nome = $name['fields']['name'];
            // $slug = $name['fields']['slug'];
            $category = isset($name['fields']['category'])?$name['fields']['category']:"" ;
            $origin = isset($name['fields']['origin'])?$name['fields']['origin']:"";
            $gender = isset($name['fields']['gender'])?$name['fields']['gender']:"";
            $description = "";
            $origem = "<p><strong>Origem do nome ".$nome.": </strong>".str_replace(';',' , ',$origin);
            if(isset($name['fields']['description']) && strlen($name['fields']['description'])> 100 ){
                $description = substr($name['fields']['description'], 0, 100)."...";
            }else{
                $description = $description != null?$description : "Leia o artigo para saber mais sobre o nome ".$nome;
                $description = $origem." ".$description."...";
            }
            //get first 200 characters of description
            $content = "<p><span style='font-weight: bold;'>Categoria: </span>".$category."</p>";
            $content = $content.$origem;
            $content = $content."</p>"."</p><p><strong>Gênero do nome ".$nome.": </strong>".$gender."</p>";
            
            if(isset($name['fields']['description'])){
                $content = $content."<p>".addslashes($name['fields']['description'])."</p>";
            }else{
                $content = null;
            }
           
            //count characters of description


            //create new post
            $post = new \App\Models\Post;
            $post->title = "Significado do nome ".$nome;
            $post->slug = $this->slugfy($post->title);
            $post->content_preview =  html_entity_decode(htmlspecialchars($description, ENT_QUOTES));
            $post->content = html_entity_decode(htmlspecialchars($content, ENT_QUOTES));
            $post->status = 1;
            $post->highlighted = $highlighted;
            $post->created_at = (new DateTime());
            $post->updated_at = $post->created_at;
            $post->image = "1684163877_bookcase.jpg";
            $post->thumbnail = "1684163877_bookcase_thumbnail.jpg";
            $post->user_id = 1;
            $post->save();
            $post->categories()->attach([1]);
            $this->info($post->title." criado com sucesso"."\n");
            $highlighted = !$highlighted;
                                                    
            }catch(\Exception $e){
                $this->warn($e->getMessage()."\n");
                continue;
            }
        }
        
        $this->info("Fim do processamento");

        return Command::SUCCESS;
    }

    //função que gera um slug a partir de uma string considerando os caracteres especiais do portugues brasileiro
    function slugfy($string) {
        // Remove espaços em branco no início e no final da string
        $string = trim($string);
        
        // Converte caracteres especiais em letras normais
        $string = strtolower($string);
        $string = strtr($string, array(
          'á' => 'a',
          'à' => 'a',
          'ã' => 'a',
          'â' => 'a',
          'é' => 'e',
          'è' => 'e',
          'ê' => 'e',
          'í' => 'i',
          'ì' => 'i',
          'î' => 'i',
          'ó' => 'o',
          'ò' => 'o',
          'õ' => 'o',
          'ô' => 'o',
          'ú' => 'u',
          'ù' => 'u',
          'û' => 'u',
          'ç' => 'c',
          'ñ' => 'n',
        ));
        
        // Remove caracteres especiais
        $string = preg_replace('/[^a-z0-9-]+/', '-', $string);
        
        // Remove múltiplos hifens consecutivos
        $string = preg_replace('/-+/', '-', $string);
        
        // Remove hifens no início ou no final da string
        $string = trim($string, '-');
        
        return $string;
      }

      private function askToChatGPT($prompt) 
      {
          $response = Http::withoutVerifying()
              ->withHeaders([
                  'Authorization' => 'Bearer ' . env('CHATGPT_API_KEY'),
                  'Content-Type' => 'application/json',
              ])->post('https://api.openai.com/v1/engines/text-davinci-003/completions', [
                  "prompt" => $prompt,
                  "max_tokens" => 1000,
                  "temperature" => 0.5
              ]);
  
          return $response->json();
      }

      private function askToFreeChatGPT($prompt) 
      {
          $response = Http::withoutVerifying()
              ->withHeaders([
                  //'Authorization' => 'Bearer ' . env('CHATGPT_API_KEY'),
                  'Content-Type' => 'application/json',
              ])->post('https://chatgpt-api.shn.hk/v1/', [
                  "role" => "user",
                  "content" => $prompt
              ]);
  
          return $response->json();
      }

      //function that reads a json file from storage
        private function readJsonFile($file){
            $json = file_get_contents(storage_path('app/public/'.$file));
            $json = json_decode($json, true);
            return $json;
        }

        //função para tratar caracteres especiais de uma string

    
}
