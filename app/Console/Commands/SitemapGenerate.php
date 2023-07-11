<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
//add sitemap library
use Spatie\Sitemap\SitemapGenerator;

class SitemapGenerate extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'sitemap:generate';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Generate sitemap.xml';

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        //Generate sitemap using spatie sitemap generator
        $this->info('Generating sitemap...');
        $sitemap = SitemapGenerator::create(config('app.url'))
            ->writeToFile(public_path('sitemap.xml'));


        return Command::SUCCESS;
    }
}
