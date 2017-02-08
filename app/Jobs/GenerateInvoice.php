<?php

namespace pdfgenerator\Jobs;

use Illuminate\Bus\Queueable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Support\Facades\App;

class GenerateInvoice implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        $snappy = App::make('snappy.pdf');
        $path = __DIR__ . '../../../temp/';
        $fileName = time() . '.pdf';
        $snappy->generateFromHtml('<h1>Bill</h1><p>You owe me money, dude.</p>', $path . $fileName);
    }
}
