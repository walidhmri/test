<?php
namespace App\Jobs;

use App\Models\Solution;
use App\Models\Ticket;
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
    public function __construct(Ticket $ticket)
    {
        $this->Ticket = $ticket;
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
                ["parts" => [["text" => "A user submitted a support Ticket:\n\nTitle: {$this->Ticket->title}\nDescription: {$this->Ticket->description}  \n\nProvide a detailed technical solution in a small paragraph repond with same language as in title and description."]]]
            ]
        ]);

        $aiResponse = $response->json()['candidates'][0]['content']['parts'][0]['text'] ?? "No AI solution available";
        Log::info('Gemini API Response:', ['response' => $response->body()]);

        Solution::create([
            'Ticket_id' => $this->Ticket->id,
            'user_id' => 1, 
            'title' => 'Bot',
            'description' => $aiResponse,
        ]);
    }
}
