<?php

namespace App\Services;

use App\Models\Conversation;
use App\Models\ConversationMessage;
use App\Models\Setting;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;

class WebsiteAssistantService
{
    public function handleUserMessage(Conversation $conversation, string $message): string
    {
        $reply = $this->generateReply($conversation, $message);

        ConversationMessage::create([
            'conversation_id' => $conversation->id,
            'role' => 'assistant',
            'content' => $reply,
        ]);

        return $reply;
    }

    protected function generateReply(Conversation $conversation, string $message): string
    {
        $apiKey = Setting::getValue('ai_openai_api_key', '');

        if (filled($apiKey)) {
            try {
                $aiReply = $this->callAiApi($conversation, $message);
                if ($aiReply !== null) {
                    return $aiReply;
                }
            } catch (\Exception $e) {
                Log::warning('AI API call failed, using fallback: ' . $e->getMessage());
            }
        }

        return $this->keywordFallback($message);
    }

    protected function callAiApi(Conversation $conversation, string $message): ?string
    {
        $baseUrl = rtrim(Setting::getValue('ai_openai_base_url', 'https://api.groq.com/openai/v1'), '/');
        $model = Setting::getValue('ai_openai_model', 'qwen/qwen3-32b');
        $apiKey = Setting::getValue('ai_openai_api_key', '');
        $tone = Setting::getValue('ai_response_tone', 'professional');
        $language = Setting::getValue('ai_response_language', 'en');
        $maxLength = (int) Setting::getValue('ai_max_length', '900');
        $includeLinks = Setting::getValue('ai_include_page_links', '1');
        $followUp = Setting::getValue('ai_follow_up_phrase', '');
        $closing = Setting::getValue('ai_closing_phrase', '');
        $customPrompt = Setting::getValue('ai_assistant_system_prompt', '');
        $uncertainty = Setting::getValue('ai_uncertainty_handling', 'say_uncertain');

        $toneInstructions = [
            'professional' => 'Use a professional, calm, and trustworthy tone.',
            'friendly' => 'Use a warm, approachable, and conversational tone.',
            'concise' => 'Be direct, minimal, and straight to the point.',
            'detailed' => 'Provide thorough explanations with practical examples.',
        ];

        $systemPrompt = filled($customPrompt)
            ? $customPrompt
            : "You are Surma Agro AI Assistant, the helpful customer support agent for Surma Agro, a premier agro-industrial export company based in Bangladesh. "
            . "Your purpose is to assist website visitors with questions about products, orders, delivery, pricing, company info, and general inquiries.\n\n"
            . "CRITICAL: Never include any thinking, reasoning, or internal monologue in your response. Only output the final answer. Do NOT use <think>, <thinking>, <reasoning>, [thinking], [reasoning], or any similar tags.\n\n"
            . "Guidelines:\n"
            . "- {$toneInstructions[$tone]}\n"
            . "- Respond in {$language} language.\n"
            . "- Keep responses under {$maxLength} characters.\n"
            . "- Be helpful, accurate, and friendly.\n"
            . "- If unsure about something, " . ($uncertainty === 'say_uncertain' ? "admit you're not certain and suggest contacting the team." : ($uncertainty === 'recommend' ? "recommend the user speak with a company representative." : "provide your best available information with a disclaimer.")) . "\n"
            . "- Never share pricing specifics unless you have verified information.\n"
            . "- You can suggest visiting https://surmaagro.com for more details.\n"
            . ($includeLinks === '1' ? "- When relevant, suggest specific pages like /catalog, /contact, /about, /export-quality.\n" : "")
            . (filled($followUp) ? "\nAt the end of responses, when appropriate, add: {$followUp}\n" : "")
            . (filled($closing) ? "\nEnd every response with: {$closing}\n" : "");

        $history = $conversation->messages()
            ->latest()
            ->take(10)
            ->get()
            ->reverse()
            ->map(fn ($m) => ['role' => $m->role, 'content' => $m->content])
            ->values()
            ->toArray();

        $messages = array_merge(
            [['role' => 'system', 'content' => $systemPrompt]],
            $history,
            [['role' => 'user', 'content' => $message]]
        );

        $response = Http::withHeaders([
            'Authorization' => 'Bearer ' . $apiKey,
            'Content-Type' => 'application/json',
        ])->timeout(30)->post("{$baseUrl}/chat/completions", [
            'model' => $model,
            'messages' => $messages,
            'max_tokens' => min($maxLength * 2, 2000),
            'temperature' => 0.7,
        ]);

        if ($response->successful()) {
            $data = $response->json();
            $content = $data['choices'][0]['message']['content'] ?? null;
            if ($content) {
                return $this->stripReasoning(trim($content));
            }
        }

        $errorBody = $response->body();
        Log::warning('AI API returned non-success', [
            'status' => $response->status(),
            'body' => substr($errorBody, 0, 500),
        ]);

        return null;
    }

    protected function stripReasoning(string $text): string
    {
        $patterns = [
            '/<think>.*?<\/think>/s',
            '/<thinking>.*?<\/thinking>/s',
            '/<reasoning>.*?<\/reasoning>/s',
            '/\[thinking\].*?\[\/thinking\]/s',
            '/\[reasoning\].*?\[\/reasoning\]/s',
            '/\[INST\].*?\[\/INST\]/s',
            '/```think.*?```/s',
        ];

        $text = preg_replace($patterns, '', $text);
        $text = preg_replace('/\n{3,}/', "\n\n", $text);

        return trim($text);
    }

    protected function keywordFallback(string $message): string
    {
        $message = strtolower(trim($message));

        $keywords = [
            'product' => 'We offer a wide range of premium agricultural products including rice, frozen fish, spices, dry foods, and more. Visit our catalog at ' . route('catalog.index') . ' to explore our full range.',
            'price' => 'Our pricing is competitive and varies by product and volume. Please contact our sales team at ' . route('contact') . ' for a customized quote tailored to your needs.',
            'cost' => 'Our pricing is competitive and varies by product and volume. Please contact our sales team at ' . route('contact') . ' for a customized quote tailored to your needs.',
            'delivery' => 'We offer reliable international shipping to destinations worldwide. Delivery times and costs depend on the destination and order volume. Contact us for a detailed shipping estimate.',
            'shipping' => 'We offer reliable international shipping to destinations worldwide. Delivery times and costs depend on the destination and order volume. Contact us for a detailed shipping estimate.',
            'order' => 'To place an order, please browse our catalog at ' . route('catalog.index') . ' and submit an inquiry. Our team will get back to you within 24 hours with a quotation.',
            'payment' => 'We accept various payment methods including bank transfer, LC (Letter of Credit), and other standard trade finance options. Our team will guide you through the payment process.',
            'export' => 'Yes, we export internationally! Surma Agro supplies premium agricultural products to markets across Asia, Europe, the Middle East, Africa, and the Americas. Visit our Export Quality page at ' . route('export-quality') . ' to learn more.',
            'international' => 'Yes, we export internationally! Surma Agro supplies premium agricultural products to markets across Asia, Europe, the Middle East, Africa, and the Americas.',
            'located' => 'Surma Agro is headquartered in Bangladesh with a global network of offices. Visit our Global Presence page at ' . route('presence') . ' to see our worldwide locations.',
            'location' => 'Surma Agro is headquartered in Bangladesh with a global network of offices. Visit our Global Presence page at ' . route('presence') . ' to see our worldwide locations.',
            'contact' => 'You can reach us through our contact page at ' . route('contact') . ', or call us directly. Our team is available Monday to Friday, 9 AM to 6 PM (BST).',
            'phone' => 'You can find our phone number on the Contact page at ' . route('contact') . '. Our team will be happy to assist you.',
            'email' => 'Please use the contact form at ' . route('contact') . ' to send us a message, and we will respond promptly.',
            'career' => 'We\'re always looking for talented individuals! Check our Careers page at ' . route('careers.index') . ' for current openings.',
            'job' => 'We\'re always looking for talented individuals! Check our Careers page at ' . route('careers.index') . ' for current openings.',
            'blog' => 'Read our latest articles and insights at ' . route('blog.index') . ' to stay updated with Surma Agro news and industry trends.',
            'certificate' => 'Surma Agro holds various international quality certifications. Visit our Certificates page at ' . route('certificates') . ' to learn more about our quality standards.',
            'quality' => 'Quality is our priority at Surma Agro. We maintain strict quality control standards and hold international certifications. Learn more at ' . route('export-quality') . '.',
            'about' => 'Surma Agro is a premier agro-industrial export company based in Bangladesh, dedicated to delivering premium agricultural products to global markets since our founding. Learn more about our journey at ' . route('about') . '.',
            'company' => 'Surma Agro is a premier agro-industrial export company based in Bangladesh, dedicated to delivering premium agricultural products to global markets since our founding.',
            'factory' => 'Our state-of-the-art processing facility ensures the highest quality standards. Take a virtual tour at ' . route('factory') . '.',
            'gallery' => 'Browse our gallery at ' . route('gallery') . ' to see our products, facilities, and team in action.',
            'rice' => 'We export premium quality rice varieties including Miniket, BRRI-28, BRRI-29, Najirshail, and more. Visit our catalog at ' . route('catalog.index') . ' for details.',
            'fish' => 'Surma Agro offers high-quality frozen fish products under our Surma Fish brand. Learn more at ' . route('surma-fish') . '.',
            'hello' => 'Hello! Welcome to Surma Agro. How can I assist you today? You can ask me about our products, delivery, pricing, or anything else.',
            'hi' => 'Hi there! Welcome to Surma Agro. I\'m your AI Assistant. How can I help you today?',
        ];

        foreach ($keywords as $keyword => $response) {
            if (str_contains($message, $keyword)) {
                return $response;
            }
        }

        return 'Thank you for your inquiry. Our team at Surma Agro would be happy to assist you with that. For detailed information, please visit ' . route('contact') . ' or explore our website. You can also ask me about our products, export services, company locations, and more!';
    }
}
