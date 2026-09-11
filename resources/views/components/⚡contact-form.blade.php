<?php

use Livewire\Component;

new class extends Component
{
     public $name = '';
    public $email = '';
    public $service = 'Laravel / Full-Stack Development';
    public $message = '';

    public $success = false;
    public $successData = [];

    protected $rules = [
        'name' => 'required|min:2',
        'email' => 'required|email',
        'message' => 'required|min:10',
    ];

    protected $messages = [
        'name.required' => 'Please enter your name.',
        'name.min' => 'Name must be at least 2 characters.',
        'email.required' => 'Please enter your email address.',
        'email.email' => 'Please enter a valid email address (e.g. name@domain.com).',
        'message.required' => 'Please provide details about your project or inquiry.',
        'message.min' => 'Message must be at least 10 characters.',
    ];

    public function submit()
    {
        $this->validate();

        $this->successData = [
            'name' => $this->name,
            'email' => $this->email,
            'service' => $this->service,
            'message' => $this->message,
        ];

        $this->success = true;
    }

    public function resetForm()
    {
        $this->reset(['name', 'email', 'service', 'message', 'success', 'successData']);
    }
};
?>

<div class="max-w-2xl mx-auto glass p-6 md:p-8 relative overflow-hidden mb-12 shadow-xl">
    <div class="flex items-center justify-between pb-4 mb-6 border-b border-border-subtle font-mono text-xs text-mute">
        <div class="flex items-center gap-2">
            <span class="w-2 h-2 rounded-full {{ $success ? 'bg-ok' : 'bg-accent' }}"></span>
            <span class="text-dim font-medium uppercase tracking-wider text-[11px]">COMMUNICATION_CHANNEL // DIRECT_INQUIRY</span>
        </div>
        <div class="hidden sm:block text-[10px] text-mute">AVG RESPONSE: &lt; 24 HRS</div>
    </div>

    @if ($success)
        <div class="py-8 px-4 text-center">
            <div class="w-14 h-14 rounded-full bg-ok/10 border border-ok/30 text-ok flex items-center justify-center mx-auto mb-4 text-2xl shadow-[0_0_20px_rgba(52,211,153,0.2)]">
                &#x2713;
            </div>
            <h3 class="heading-card text-ink text-xl mb-2 font-bold">Message Transmitted!</h3>
            <p class="text-dim text-sm max-w-md mx-auto mb-6 leading-relaxed">
                Thank you for reaching out, <span class="text-ink font-semibold">{{ $successData['name'] }}</span>. Your message regarding <span class="text-accent font-medium">{{ $successData['service'] }}</span> has been received. I'll get back to you at <span class="text-ink font-mono text-xs bg-bg-elevated px-1.5 py-0.5 rounded border border-border">{{ $successData['email'] }}</span> promptly.
            </p>
            <div class="flex justify-center gap-3">
                <button wire:click="resetForm" type="button" class="btn-primary text-xs">
                    Send Another Message
                </button>
            </div>
        </div>
    @else
        <form wire:submit.prevent="submit" class="space-y-5" id="contact-form">
            @if ($errors->any())
                <div class="p-3.5 rounded-lg bg-red-950/40 border border-red-800/60 text-red-300 text-xs font-mono flex items-center gap-2">
                    <span class="text-red-400 font-bold">&#x26A0;</span>
                    <span>{{ $errors->first() }}</span>
                </div>
            @endif

            <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                <div>
                    <label for="contact-name" class="form-label">
                        <span>Your Name <span class="text-accent">*</span></span>
                        @if ($name && !$errors->has('name'))
                            <span class="text-ok text-[10px]">&#x2713; Valid</span>
                        @endif
                    </label>
                    <input id="contact-name" name="name" type="text" wire:model="name" placeholder="e.g. Alex Morgan" class="form-input @error('name') is-invalid @enderror @if($name && !$errors->has('name')) is-valid @endif" required />
                    @error('name') <div class="form-error">{{ $message }}</div> @enderror
                </div>
                <div>
                    <label for="contact-email" class="form-label">
                        <span>Email Address <span class="text-accent">*</span></span>
                        @if ($email && !$errors->has('email'))
                            <span class="text-ok text-[10px]">&#x2713; Valid</span>
                        @endif
                    </label>
                    <input id="contact-email" name="email" type="email" wire:model="email" placeholder="e.g. alex@company.com" class="form-input @error('email') is-invalid @enderror @if($email && !$errors->has('email')) is-valid @endif" required />
                    @error('email') <div class="form-error">{{ $message }}</div> @enderror
                </div>
            </div>

            <div>
                <label for="contact-service" class="form-label">
                    <span>Project Focus / Topic</span>
                    <span class="text-mute text-[10px]">Select Category</span>
                </label>
                <select id="contact-service" name="service" wire:model="service" class="form-select cursor-pointer">
                    <option value="Laravel / Full-Stack Development">Laravel / Full-Stack Development</option>
                    <option value="AI Agents & Claude Subagent Workflows">AI Agents &amp; Claude Subagent Workflows</option>
                    <option value="Legacy PHP Migration (PHP5 → PHP8)">Legacy PHP Migration (PHP5 → PHP8)</option>
                    <option value="Filament & Admin Panels">Filament &amp; Admin Panel Architecture</option>
                    <option value="Livewire & Alpine.js Interactive UI">Livewire &amp; Alpine.js Interactive UI</option>
                    <option value="API Integration & Database Design">API Integration &amp; Database Design</option>
                    <option value="Full-Time / Contract Engineering Role">Full-Time / Contract Engineering Role</option>
                    <option value="Other Consultation">Other Consultation</option>
                </select>
            </div>

            <div>
                <label for="contact-message" class="form-label">
                    <span>Project Details / Message <span class="text-accent">*</span></span>
                    <span class="text-mute text-[10px]">{{ strlen($message) }} chars</span>
                </label>
                <textarea id="contact-message" name="message" rows="4" wire:model="message" placeholder="Tell me about your project scope, technical challenges, or open role requirements..." class="form-textarea resize-y @error('message') is-invalid @enderror @if($message && !$errors->has('message')) is-valid @endif" required></textarea>
                @error('message') <div class="form-error">{{ $message }}</div> @enderror
            </div>

            <div class="pt-2 flex flex-col sm:flex-row items-stretch sm:items-center justify-between gap-4">
                <div class="font-mono text-[11px] text-mute flex items-center gap-1.5">
                    <span class="text-accent">&#x25AA;</span>
                    <span>All inquiries go directly to Alvin</span>
                </div>
                <button type="submit" id="contact-submit-btn" class="btn-primary flex items-center justify-center gap-2 py-3 px-6 text-sm" wire:loading.attr="disabled">
                    <span wire:loading.remove class="flex items-center gap-2">
                        <span>Send Message</span>
                        <span>&rarr;</span>
                    </span>
                    <span wire:loading class="flex items-center gap-2">
                        <span class="spinner"></span>
                        <span>Transmitting...</span>
                    </span>
                </button>
            </div>
        </form>
    @endif
</div>