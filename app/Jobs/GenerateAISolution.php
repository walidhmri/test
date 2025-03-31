<?php
namespace App\Jobs;

use App\Models\Solution;
use App\Models\Teket;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldBeUnique;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;

class GenerateAISolution implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    protected $ticket;

    /**
     * Create a new job instance.
     */
    public function __construct(Teket $ticket)
    {
        $this->ticket = $ticket;
    }

    /**
     * Execute the job.
     */
    public function handle(): void
    {
        $apiKey = env('GEMINI_API_KEY');
        $apiUrl = "https://generativelanguage.googleapis.com/v1beta/models/gemini-1.5-flash:generateContent"; 

        $response = Http::post("{$apiUrl}?key={$apiKey}", [
            "contents" => [
                ["parts" => [["text" => "A user submitted a support ticket:\n\nTitle: {$this->ticket->title}\nDescription: {$this->ticket->description}  \n\nProvide a detailed technical solution in 30 word."]]]
            ]
        ]);

        $aiResponse = $response->json()['candidates'][0]['content']['parts'][0]['text'] ?? "No AI solution available.";
        Log::info('Gemini API Response:', ['response' => $response->body()]);

        // ✅ Sauvegarde de la solution
        Solution::create([
            'teket_id' => $this->ticket->id,
            'user_id' => 1, // Toujours 1
            'title' => 'Bot',
            'description' => $aiResponse,
        ]);
    }
}
