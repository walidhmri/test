<?php
namespace App\Jobs;

use App\Models\Solution;
use App\Models\Ticket;
use App\Models\User;
use App\Notifications\CreateSolutionNotification;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldBeUnique;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Notification;

class GenerateAISolution implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    protected $ticket;

    /**
     * Create a new job instance.
     */
    public function __construct(Ticket $ticket)
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

        // Sending request to the Gemini API with clear instructions to respond in Markdown format
        $response = Http::post("{$apiUrl}?key={$apiKey}", [
            "contents" => [
                ["parts" => [["text" => "A user submitted a support Ticket:\n\nTitle: {$this->ticket->title}\nDescription: {$this->ticket->description}  \n\nProvide a detailed technical solution in a small paragraph, using the same language as the title and description. Please respond with Markdown format for easy display (including headings, lists, code blocks, etc)."]]]
            ]
        ]);

        // Get the AI's response, or fallback to a default message if not available
        $aiResponse = $response->json()['candidates'][0]['content']['parts'][0]['text'] ?? "No AI solution available";
        
        // Log the response for debugging
        Log::info('Gemini API Response:', ['response' => $response->body()]);
        
       $solution= Solution::create([
            'ticket_id' => $this->ticket->id,
            'user_id' => 1, // Replace with the actual user id if needed
            'title' => 'Bot',
            'description' => $aiResponse,
        ]);
        $user = User::find($solution->ticket->user_id);
        Notification::send($user, new CreateSolutionNotification($solution));
    }
}
